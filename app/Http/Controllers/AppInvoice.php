<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Invoice;
use App\Customer;
use App\Condition;
use App\Product;
use App\Item;
use App\Stock;
use App\Chalan;
use App\Payment;
use App\Transection;

class AppInvoice extends App
{

	public function Save(Request $request){
		
	   	$this->validate($request, [
	   		'invoice.date' => 'required|max:15|string',
	   		'invoice.perchase_date' => 'max:15|string',
	   		'invoice.perchase_no' => 'max:150|string',
	        'invoice.vat' => 'required|numeric',
	        'invoice.subtotal' => 'required|numeric',
	        'invoice.total' => 'required|numeric',
	        'invoice.shipping_cost' => 'required|numeric',
	        'invoice.traking' => 'max:150|string',
	        'invoice.comments' => 'max:250|string',
	        'invoice.note' => 'max:250|string',
	        'invoice.terms' => 'max:250|string',
	        'invoice.user.id' => 'numeric|exists:users,id'
	    ]);

	    $this->validate($request, [
	    	'invoice.customer.name' => 'max:100|string',
            'invoice.customer.company' => 'max:150|string',
            'invoice.customer.phone' => 'max:50|string',
            'invoice.customer.billing' => 'max:250|string',
            'invoice.customer.shipping' => 'max:250|string'
	    ]);

	    if($request['invoice.items']){
	    	for($i=0;$i<count($request['invoice.items']);$i++){
		    	$this->validate($request, [
			        'invoice.items.'. $i .'.description' => 'required|max:250|string',
		            'invoice.items.'. $i .'.brand' => 'max:250|string',
		            'invoice.items.'. $i .'.unit' => 'max:15|string',
		            'invoice.items.'. $i .'.discount' => 'required|min:0|numeric',
		            'invoice.items.'. $i .'.qty' => 'required|min:0|numeric',
		            'invoice.items.'. $i .'.sell' => 'required|min:0|numeric'
			    ]);
		    }
	    }
	    
	    if($request['invoice.conditions']){
		    for($i=0;$i<count($request['invoice.conditions']);$i++){
		    	$this->validate($request, [
			        'invoice.conditions.'. $i .'.description' => 'max:250|string',
			        'invoice.conditions.'. $i .'.value' => 'required|numeric'
			    ]);
		    }
		}

		//Customer Section
		if(Customer::where('id', $request['invoice.customer.id'])->count()>0){
	    	$Customer = Customer::find($request['invoice.customer.id']);
	    }else{
	    	$Customer = new Customer();
	    }

	    $name=$company=$phone=$billing=$shipping='';
        if($request['invoice.customer.name']){ $name = $request['invoice.customer.name']; }
        if($request['invoice.customer.company']){ $company = $request['invoice.customer.company']; }
        if($request['invoice.customer.phone']){ $phone = $request['invoice.customer.phone']; }
        if($request['invoice.customer.billing']){ $billing = $request['invoice.customer.billing']; }
        if($request['invoice.customer.shipping']){ $shipping = $request['invoice.customer.shipping']; }else{ $shipping = $request['invoice.customer.billing']; }
	    
		$Customer->name = $name;
		$Customer->company = $company;
		$Customer->phone = $phone;
		$Customer->billing = $billing;
		$Customer->shipping = $shipping;
		$Customer->save();

		//Customer Section

		$date=$perchase_date=$perchase_no=$traking=$comments=$note=$terms='';
		$vat=$subtotal=$total=$shipping_cost=$user_id=0;
        if($request['invoice.date']){ $date = $request['invoice.date']; }
        if($request['invoice.perchase_date']){ $perchase_date = $request['invoice.perchase_date']; }
        if($request['invoice.perchase_no']){ $perchase_no = $request['invoice.perchase_no']; }
        if($request['invoice.traking']){ $traking = $request['invoice.traking']; }
        if($request['invoice.vat']){ $vat = $request['invoice.vat']; }
        if($request['invoice.subtotal']){ $subtotal = $request['invoice.subtotal']; }
        if($request['invoice.total']){ $total = $request['invoice.total']; }
        if($request['invoice.shipping_cost']){ $shipping_cost = $request['invoice.shipping_cost']; }
        if($request['invoice.user.id']){ $user_id = $request['invoice.user.id']; }
        if($request['invoice.comments']){ $comments = $request['invoice.comments']; }
        if($request['invoice.note']){ $note = $request['invoice.note']; }
        if($request['invoice.terms']){ $terms = $request['invoice.terms']; }

	    $Invoice = new Invoice();
	    $Invoice->customer_id = $Customer->id;
	    if(Chalan::where('id', $request['invoice.id'])->count() < 1){
			$Invoice->chalan_id = $request['invoice.id'];
		}
		$Invoice->date = $date;
		$Invoice->perchase_date = $perchase_date;
		$Invoice->perchase_no = $perchase_no;
		$Invoice->vat = round($vat,2);
		$Invoice->traking = $traking;
		$Invoice->subtotal = round($subtotal,2);
		$Invoice->total = round($total,2);
		$Invoice->shipping_cost = round($shipping_cost,2);
		$Invoice->user_id = $user_id;
		$Invoice->comments = $comments;
		$Invoice->note = $note;
		$Invoice->terms = $terms;
		$Invoice->save();

		$Transection = new Transection();
		$Transection->date = $Invoice->date;
		$Transection->customer_id = $Customer->id;
		$Transection->invoice_id = $Invoice->id;
		$Transection->type = 'Debit';
		$Transection->amount = $Invoice->total;
		$Transection->save();

		//Item Section
		if($request['invoice.items']){
			for($i=0;$i<count($request['invoice.items']);$i++){
		    	
		    	$brand=$description=$unit='';
				$qty=$sell=$discount=0;
		        if($request['invoice.items.'.$i.'.brand']){ $brand = $request['invoice.items.'.$i.'.brand']; }
		        if($request['invoice.items.'.$i.'.description']){ $description = $request['invoice.items.'.$i.'.description']; }
		        if($request['invoice.items.'.$i.'.unit']){ $unit = $request['invoice.items.'.$i.'.unit']; }
		        if($request['invoice.items.'.$i.'.qty']){ $qty = $request['invoice.items.'.$i.'.qty']; }
		        if($request['invoice.items.'.$i.'.sell']){ $sell = $request['invoice.items.'.$i.'.sell']; }
		        if($request['invoice.items.'.$i.'.discount']){ $discount = $request['invoice.items.'.$i.'.discount']; }
		        
			    if(Product::where('id', $request['invoice.items.'.$i.'.product_id'])->count()>0){

			    	$Product = Product::find($request['invoice.items.'.$i.'.product_id']);
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

				if(Chalan::where('id', $request['invoice.id'])->count() < 1){
					$new_stock = ($Stock->qty - $qty);
					$Stock->qty = round($new_stock, 2);
					$Stock->save();
			    }

				$Item = new Item();
				$Item->invoice_id = $Invoice->id;
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
	    if($request['invoice.conditions']){
			foreach($request['invoice.conditions'] as $condition){
		    	$Condition = new Condition();
		    	$Condition->invoice_id = $Invoice->id;
				$Condition->description = $condition['description'];
				$Condition->value = round($condition['value'],2);
				$Condition->save();
		    }
		}
		
		return $this->DataReturn($Invoice);
		
	}

	public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:invoices,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Invoice = Invoice::find($request['select.'.$i]);
		    	foreach ($Invoice->transections as $DBTransection) {
		    		$Transection = Transection::find($DBTransection->id);
		    		$Transection->delete();
		    	};
			    foreach($Invoice->items as $item){
			    	$Item = Item::find($item->id);
			    	if($Invoice->chalan_id > 0){
						$Product = Product::find($item->product_id);
				    	$Stock = Stock::find($Product->stock_id);
				    		$new_stock = ($Stock->qty + $Item->qty);
				    	$Stock->qty = round($new_stock,2);
				    	$Stock->save();
				    }
					$Item->delete();
			    }
                $Invoice->delete();
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
                    'select.'.$i => 'required|numeric|exists:invoices,id',
                    'offer.description' => 'required|max:250|string',
			        'offer.value' => 'required|numeric'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Invoice = Invoice::find($request['select.'.$i]);
            	$Transection = Transection::where('date', $Invoice->date)
            				->where('invoice_id', $Invoice->id)
            				->where('customer_id', $Invoice->customer_id)
            				->where('amount', $Invoice->total)
            				->where('type', 'Debit')
            				->first();

                $total = round($Invoice->total - $request['offer.value']);
		    	$Invoice->total = $total;
                $Invoice->save();

                	$Transection->amount = $Invoice->total;			
                	$Transection->save();

                $Condition = new Condition();
		    	$Condition->invoice_id = $Invoice->id;
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
			        'payment.customers.'. $selects[$i] => 'required|numeric',
			        'select.'. $i => 'required|exists:customers,id'
			    ]);
		    }
		    $Amounts = $request['payment.customers'];
		    foreach($selects as $select){
		    	$Transection = new Transection();
				$Transection->date = $request['payment.date'];
				$Transection->customer_id = $select;
				$Transection->type = 'Credit';
				$Transection->amount = $Amounts[$select];
				$Transection->save();
		    	$total += $Amounts[$select];
		    }
		    $payment = new Payment();
		    $payment->account_id = $request['payment.account.id'];
		    $payment->date = $request['payment.date'];
		    $payment->summery = 'Due Collection';
		    $payment->type = 'Debit';
		    $payment->amount = round($total, 2);
		    $payment->save();

	    }
		
		return $this->DataReturn('blank');
		
	}

}
