<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Sale;
use App\Customer;
use App\Condition;
use App\Product;
use App\Item;
use App\Stock;
use App\Chalan;
use App\Payment;

class AppSale extends App
{
    public function Save(Request $request){
		
	   	$this->validate($request, [
	   		'sale.date' => 'required|max:15|string',
	        'sale.vat' => 'required|numeric',
	        'sale.subtotal' => 'required|numeric',
	        'sale.total' => 'required|numeric',
	        'sale.comments' => 'max:250|string',
	        'sale.note' => 'max:250|string',
	        'sale.terms' => 'max:250|string',
	        'sale.user.id' => 'numeric|exists:users,id'
	    ]);

	    $this->validate($request, [
	    	'sale.customer.name' => 'max:100|string',
            'sale.customer.phone' => 'max:50|string',
            'sale.customer.billing' => 'max:250|string',
	        'sale.account.id' => 'required|exists:accounts,id'
	    ]);

	    if($request['sale.items']){
	    	for($i=0;$i<count($request['sale.items']);$i++){
		    	$this->validate($request, [
			        'sale.items.'. $i .'.description' => 'required|max:250|string',
		            'sale.items.'. $i .'.brand' => 'max:250|string',
		            'sale.items.'. $i .'.unit' => 'max:15|string',
		            'sale.items.'. $i .'.discount' => 'required|min:0|numeric',
		            'sale.items.'. $i .'.qty' => 'required|min:0|numeric',
		            'sale.items.'. $i .'.sell' => 'required|min:0|numeric'
			    ]);
		    }
	    }
	    
	    if($request['sale.conditions']){
		    for($i=0;$i<count($request['sale.conditions']);$i++){
		    	$this->validate($request, [
			        'sale.conditions.'. $i .'.description' => 'string',
			        'sale.conditions.'. $i .'.value' => 'required|numeric'
			    ]);
		    }
		}

		//Customer Section
		if(Customer::where('id', $request['sale.customer.id'])->count()>0){
	    	$Customer = Customer::find($request['sale.customer.id']);
	    }else{
	    	$Customer = new Customer();
	    	$Customer->shipping = '';
	    	$Customer->company = '';
	    }

	    $name=$phone=$billing='';
        if($request['sale.customer.name']){ $name = $request['sale.customer.name']; }
        if($request['sale.customer.phone']){ $phone = $request['sale.customer.phone']; }
        if($request['sale.customer.billing']){ $billing = $request['sale.customer.billing']; }
	    
		$Customer->name = $name;
		$Customer->phone = $phone;
		$Customer->billing = $billing;
		$Customer->save();

		//Sale Section

		$date=$comments=$note=$terms='';
		$vat=$subtotal=$total=$user_id=0;
        if($request['sale.date']){ $date = $request['sale.date']; }
        if($request['sale.vat']){ $vat = $request['sale.vat']; }
        if($request['sale.subtotal']){ $subtotal = $request['sale.subtotal']; }
        if($request['sale.total']){ $total = $request['sale.total']; }
        if($request['sale.shipping_cost']){ $shipping_cost = $request['sale.shipping_cost']; }
        if($request['sale.user.id']){ $user_id = $request['sale.user.id']; }
        if($request['sale.comments']){ $comments = $request['sale.comments']; }
        if($request['sale.note']){ $note = $request['sale.note']; }
        if($request['sale.terms']){ $terms = $request['sale.terms']; }

        $Sale = new Sale();
	    $Sale->customer_id = $Customer->id;
		$Sale->date = $date;
		$Sale->vat = round($vat,2);
		$Sale->subtotal = round($subtotal,2);
		$Sale->total = round($total,2);
		$Sale->user_id = $user_id;
		$Sale->comments = $comments;
		$Sale->note = $note;
		$Sale->terms = $terms;
		$Sale->save();

		//Payment Section
		$payment = new Payment();
	    $payment->account_id = $request['sale.account.id'];
	    $payment->date = $date;
	    $payment->summery = 'Sales';
	    $payment->type = 'Debit';
	    $payment->amount = round($total, 2);
	    $payment->save();

		//Item Section
		if($request['sale.items']){
			for($i=0;$i<count($request['sale.items']);$i++){
		    	
		    	$brand=$description=$unit='';
				$qty=$sell=$discount=0;
		        if($request['sale.items.'.$i.'.brand']){ $brand = $request['sale.items.'.$i.'.brand']; }
		        if($request['sale.items.'.$i.'.description']){ $description = $request['sale.items.'.$i.'.description']; }
		        if($request['sale.items.'.$i.'.unit']){ $unit = $request['sale.items.'.$i.'.unit']; }
		        if($request['sale.items.'.$i.'.qty']){ $qty = $request['sale.items.'.$i.'.qty']; }
		        if($request['sale.items.'.$i.'.sell']){ $sell = $request['sale.items.'.$i.'.sell']; }
		        if($request['sale.items.'.$i.'.discount']){ $discount = $request['sale.items.'.$i.'.discount']; }
		        
			    if(Product::where('id', $request['sale.items.'.$i.'.product_id'])->count()>0){

			    	$Product = Product::find($request['sale.items.'.$i.'.product_id']);
			    	$Stock = Stock::find($Product->stock_id);

			    }else{

			    	$Stock = new Stock();
            		$Stock->qty = 0;
            		$Stock->save();

            		$Product = new Product();
            		$Product->stock_id=$Stock->id;
            		$Product->iban='';
            		$Product->buy=0;
			    }

				$Product->brand = $brand;
				$Product->description = $description;
				$Product->sell = $sell;
				$Product->unit = $unit;
				$Product->save();

					$new_stock = ($Stock->qty - $qty);
					$Stock->qty = round($new_stock, 2);
					$Stock->save();

				$Item = new Item();
				$Item->sale_id = $Sale->id;
				$Item->product_id = $Product->id;
				$Item->brand = $brand;
				$Item->description = $description;
				$Item->qty = $qty;
				$Item->sell = $sell;
				$Item->discount = $discount;
				$Item->unit = $unit;
				$Item->save();
		    }
		}

	    //Condition Section
	    if($request['sale.conditions']){
			foreach($request['sale.conditions'] as $condition){
		    	$Condition = new Condition();
		    	$Condition->sale_id = $Sale->id;
				$Condition->description = $condition['description'];
				$Condition->value = round($condition['value'],2);
				$Condition->save();
		    }
		}
		
		return $this->DataReturn($Sale);
		
	}

	public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:sales,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Sale = Sale::find($request['select.'.$i]);
			    foreach($Sale->items as $item){
			    	$Item = Item::find($item->id);
						$Product = Product::find($item->product_id);
				    	$Stock = Stock::find($Product->stock_id);
				    		$new_stock = ($Stock->qty + $Item->qty);
				    	$Stock->qty = round($new_stock,2);
				    	$Stock->save();
				    
					$Item->delete();
			    }
                $Sale->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }
}
