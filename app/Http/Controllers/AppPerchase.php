<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Perchase;
use App\Supplier;
use App\Condition;
use App\Product;
use App\Item;
use App\Stock;
use App\Payment;
use App\Transection;

class AppPerchase extends App
{

		public function Save(Request $request){
		
	   	$this->validate($request, [
	   		'perchase.date' => 'required|max:15|string',
	        'perchase.tax' => 'required|numeric',
	        'perchase.subtotal' => 'required|numeric',
	        'perchase.total' => 'required|numeric',
	        'perchase.shipping_cost' => 'required|numeric',
	        'perchase.memo' => 'max:100|string',
	        'perchase.comments' => 'max:250|string',
	        'perchase.note' => 'max:250|string',
	        'perchase.terms' => 'max:250|string',
	        'perchase.user.id' => 'numeric|exists:users,id'
	    ]);

	    $this->validate($request, [
	    	'perchase.supplier.name' => 'required|max:100|string',
            'perchase.supplier.company' => 'max:150|string',
            'perchase.supplier.phone' => 'max:50|string',
            'perchase.supplier.address' => 'max:250|string'
	    ]);

	    if($request['perchase.items']){
	    	for($i=0;$i<count($request['perchase.items']);$i++){
		    	$this->validate($request, [
			        'perchase.items.'. $i .'.description' => 'required|max:250|string',
		            'perchase.items.'. $i .'.brand' => 'max:250|string',
		            'perchase.items.'. $i .'.unit' => 'max:15|string',
		            'perchase.items.'. $i .'.discount' => 'required|min:0|numeric',
		            'perchase.items.'. $i .'.qty' => 'required|min:0|numeric',
		            'perchase.items.'. $i .'.buy' => 'required|min:0|numeric'
			    ]);
		    }
	    }
	    
	    if($request['perchase.conditions']){
		    for($i=0;$i<count($request['perchase.conditions']);$i++){
		    	$this->validate($request, [
			        'perchase.conditions.'. $i .'.description' => 'max:250|string',
			        'perchase.conditions.'. $i .'.value' => 'required|numeric'
			    ]);
		    }
		}

		//supplier Section
		if(Supplier::where('id', $request['perchase.supplier.id'])->count()>0){
	    	$Supplier = Supplier::find($request['perchase.supplier.id']);
	    }else{
	    	$Supplier = new Supplier();
	    }

	    $name=$company=$phone=$address='';
        if($request['perchase.supplier.name']){ $name = $request['perchase.supplier.name']; }
        if($request['perchase.supplier.company']){ $company = $request['perchase.supplier.company']; }
        if($request['perchase.supplier.phone']){ $phone = $request['perchase.supplier.phone']; }
        if($request['perchase.supplier.address']){ $address = $request['perchase.supplier.address']; }
	    
		$Supplier->name = $name;
		$Supplier->company = $company;
		$Supplier->phone = $phone;
		$Supplier->address = $address;
		$Supplier->save();

		//supplier Section

		$date=$due_date=$comments=$note=$terms=$memo='';
		$tax=$subtotal=$total=$shipping_cost=$user_id=0;
        if($request['perchase.date']){ $date = $request['perchase.date']; }
        if($request['perchase.tax']){ $tax = $request['perchase.tax']; }
        if($request['perchase.subtotal']){ $subtotal = $request['perchase.subtotal']; }
        if($request['perchase.total']){ $total = $request['perchase.total']; }
        if($request['perchase.shipping_cost']){ $shipping_cost = $request['perchase.shipping_cost']; }
        if($request['perchase.user.id']){ $user_id = $request['perchase.user.id']; }
        if($request['perchase.memo']){ $memo = $request['perchase.memo']; }
        if($request['perchase.comments']){ $comments = $request['perchase.comments']; }
        if($request['perchase.note']){ $note = $request['perchase.note']; }
        if($request['perchase.terms']){ $terms = $request['perchase.terms']; }

	    $Perchase = new Perchase();
	    $Perchase->supplier_id = $Supplier->id;
		$Perchase->date = $date;
		$Perchase->tax = round($tax,2);
		$Perchase->subtotal = round($subtotal,2);
		$Perchase->total = round($total,2);
		$Perchase->shipping_cost = round($shipping_cost,2);
		$Perchase->user_id = $user_id;
		$Perchase->memo = $memo;
		$Perchase->comments = $comments;
		$Perchase->note = $note;
		$Perchase->terms = $terms;
		$Perchase->save();

		$Transection = new Transection();
		$Transection->date = $Perchase->date;
		$Transection->supplier_id = $Supplier->id;
		$Transection->perchase_id = $Perchase->id;
		$Transection->type = 'Credit';
		$Transection->amount = $Perchase->total;
		$Transection->save();

		//Item Section
		if($request['perchase.items']){
			for($i=0;$i<count($request['perchase.items']);$i++){
		    	
		    	$brand=$description=$unit='';
				$qty=$buy=$discount=0;
		        if($request['perchase.items.'.$i.'.brand']){ $brand = $request['perchase.items.'.$i.'.brand']; }
		        if($request['perchase.items.'.$i.'.description']){ $description = $request['perchase.items.'.$i.'.description']; }
		        if($request['perchase.items.'.$i.'.unit']){ $unit = $request['perchase.items.'.$i.'.unit']; }
		        if($request['perchase.items.'.$i.'.qty']){ $qty = $request['perchase.items.'.$i.'.qty']; }
		        if($request['perchase.items.'.$i.'.buy']){ $buy = $request['perchase.items.'.$i.'.buy']; }
		        if($request['perchase.items.'.$i.'.discount']){ $discount = $request['perchase.items.'.$i.'.discount']; }
		        
			    if(Product::where('id', $request['perchase.items.'.$i.'.product_id'])->count()>0){

			    	$Product = Product::find($request['perchase.items.'.$i.'.product_id']);
			    	$Stock = Stock::find($Product->stock_id);

			    }else{

			    	$Stock = new Stock();
            		$Stock->qty = 0;
            		$Stock->save();

            		$Product = new Product();
            		$Product->stock_id=$Stock->id;
            		$Product->iban='';
            		$Product->sell=0;
			    }

				$Product->brand = $brand;
				$Product->description = $description;
				$new_buy = ( ($Product->stock->qty * $Product->buy) + ($buy * $qty) ) / ($Product->stock->qty + $qty);
				$Product->buy = $new_buy;
				$Product->unit = $unit;
				$Product->save();

					$new_stock = ($Stock->qty + $qty);
					$Stock->qty = round($new_stock, 2);
					$Stock->save();


				$Item = new Item();
				$Item->perchase_id = $Perchase->id;
				$Item->product_id = $Product->id;
				$Item->brand = $brand;
				$Item->description = $description;
				$Item->qty = $qty;
				$Item->buy = $buy;
				$Item->discount = $discount;
				$Item->unit = $unit;
				$Item->save();
		    }
		}

	    //Condition Section
	    if($request['perchase.conditions']){
			foreach($request['perchase.conditions'] as $condition){
		    	$Condition = new Condition();
		    	$Condition->perchase_id = $Perchase->id;
				$Condition->description = $condition['description'];
				$Condition->value = round($condition['value'],2);
				$Condition->save();
		    }
		}
		
		return $this->DataReturn($Perchase);
		
	}

	public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:perchases,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Perchase = Perchase::find($request['select.'.$i]);
		    	foreach ($Perchase->transections as $DBTransection) {
		    		$Transection = Transection::find($DBTransection->id);
		    		$Transection->delete();
		    	};
			    foreach($Perchase->items as $item){
			    	$Item = Item::find($item->id);
						$Product = Product::find($item->product_id);
				    	$Stock = Stock::find($Product->stock_id);
				    		$new_stock = ($Stock->qty - $Item->qty);
				    	$Stock->qty = round($new_stock,2);
				    	$Stock->save();
				    
					$Item->delete();
			    }
                $Perchase->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

    public function Offer(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:perchases,id',
                    'offer.description' => 'required|max:250|string',
			        'offer.value' => 'required|numeric'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Perchase = Perchase::find($request['select.'.$i]);
            	$Transection = Transection::where('date', $Perchase->date)
            				->where('perchase_id', $Perchase->id)
            				->where('supplier_id', $Perchase->supplier_id)
            				->where('amount', $Perchase->total)
            				->where('type', 'Credit')
            				->first();

                $total = round($Perchase->total - $request['offer.value']);
		    	$Perchase->total = $total;
                $Perchase->save();

                	$Transection->amount = $Perchase->total;			
                	$Transection->save();

                $Condition = new Condition();
		    	$Condition->perchase_id = $Perchase->id;
				$Condition->description = $request['offer.description'];
				$Condition->value = round($request['offer.value'],2);
				$Condition->save();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

	public function Payment(Request $request){
		
	    $this->validate($request, [
	        'payment.account.id' => 'required|exists:accounts,id',
	        'payment.date' => 'required|string'
	    ]);

	    if($request['select']){
	    	$selects = $request['select'];
	    	$total = 0;
	    	for($i=0;$i<count($selects);$i++){
		    	$this->validate($request, [
			        'payment.suppliers.'. $selects[$i] => 'required|numeric',
			        'select.'. $i => 'required|exists:suppliers,id'
			    ]);
		    }
		    $Amounts = $request['payment.suppliers'];
		    foreach($selects as $select){
		    	$Transection = new Transection();
				$Transection->date = $request['payment.date'];
				$Transection->supplier_id = $select;
				$Transection->type = 'Debit';
				$Transection->amount = $Amounts[$select];
				$Transection->save();
		    	$total += $Amounts[$select];
		    }
		    $payment = new Payment();
		    $payment->account_id = $request['payment.account.id'];
		    $payment->date = $request['payment.date'];
		    $payment->summery = 'Due Payment';
		    $payment->type = 'Credit';
		    $payment->amount = round($total, 2);
		    $payment->save();

	    }
		
		return $this->DataReturn('blank');
		
	}
}
