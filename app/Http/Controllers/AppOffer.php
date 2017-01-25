<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Offer;
use App\Customer;
use App\Condition;
use App\Product;
use App\Item;
use App\Stock;

class AppOffer extends App
{

	public function Save(Request $request){
		
	   	$this->validate($request, [
	        'offer.date' => 'required|max:15|string',
	        'offer.vat' => 'required|numeric',
	        'offer.subtotal' => 'required|numeric',
	        'offer.total' => 'required|numeric',
	        'offer.shipping_cost' => 'required|numeric',
	        'offer.comments' => 'max:250|string',
	        'offer.note' => 'max:250|string',
	        'offer.terms' => 'max:250|string'
	    ]);

	    $this->validate($request, [
	        'offer.customer.name' => 'required|max:100|string',
            'offer.customer.company' => 'max:150|string',
            'offer.customer.phone' => 'max:50|string',
            'offer.customer.billing' => 'max:250|string',
            'offer.customer.shipping' => 'max:250|string'
	    ]);

	    if($request['offer.items']){
	    	for($i=0;$i<count($request['offer.items']);$i++){
		    	$this->validate($request, [
			        'offer.items.'. $i .'.description' => 'required|max:250|string',
		            'offer.items.'. $i .'.brand' => 'max:250|string',
		            'offer.items.'. $i .'.unit' => 'max:15|string',
		            'offer.items.'. $i .'.discount' => 'required|min:0|numeric',
		            'offer.items.'. $i .'.qty' => 'required|min:0|numeric',
		            'offer.items.'. $i .'.sell' => 'required|min:0|numeric'
			    ]);
		    }
	    }
	    
	    if($request['offer.conditions']){
		    for($i=0;$i<count($request['offer.conditions']);$i++){
		    	$this->validate($request, [
			        'offer.conditions.'. $i .'.description' => 'max:250|string',
			        'offer.conditions.'. $i .'.value' => 'required|numeric'
			    ]);
		    }
		}

		//Customer Section
	    if(Customer::where('id', $request['offer.customer.id'])->count()>0){
	    	$Customer = Customer::find($request['offer.customer.id']);
	    }else{
	    	$Customer = new Customer();
	    }

	    $name=$company=$phone=$billing=$shipping='N/A';
        if($request['offer.customer.name']){ $name = $request['offer.customer.name']; }
        if($request['offer.customer.company']){ $company = $request['offer.customer.company']; }
        if($request['offer.customer.phone']){ $phone = $request['offer.customer.phone']; }
        if($request['offer.customer.billing']){ $billing = $request['offer.customer.billing']; }
        if($request['offer.customer.shipping']){ $shipping = $request['offer.customer.shipping']; }else{ $shipping = $request['offer.customer.billing']; }
	    
		$Customer->name = $name;
		$Customer->company = $company;
		$Customer->phone = $phone;
		$Customer->billing = $billing;
		$Customer->shipping = $shipping;
		$Customer->save();

		$date=$comments=$note=$terms='';
		$vat=$subtotal=$total=$shipping_cost=0;
        if($request['offer.date']){ $date = $request['offer.date']; }
        if($request['offer.vat']){ $vat = $request['offer.vat']; }
        if($request['offer.subtotal']){ $subtotal = $request['offer.subtotal']; }
        if($request['offer.total']){ $total = $request['offer.total']; }
        if($request['offer.shipping_cost']){ $shipping_cost = $request['offer.shipping_cost']; }
        if($request['offer.comments']){ $comments = $request['offer.comments']; }
        if($request['offer.note']){ $note = $request['offer.note']; }
        if($request['offer.terms']){ $terms = $request['offer.terms']; }

	    $Offer = new Offer();
	    $Offer->customer_id = $Customer->id;
		$Offer->date = $date;
		$Offer->vat = $vat;
		$Offer->subtotal = $subtotal;
		$Offer->total = $total;
		$Offer->shipping_cost = $shipping_cost;
		$Offer->comments = $comments;
		$Offer->note = $note;
		$Offer->terms = $terms;
		$Offer->save();

		//Item Section
		if($request['offer.items']){
			for($i=0;$i<count($request['offer.items']);$i++){
		    	
		    	$brand=$description=$unit='';
				$qty=$sell=$discount=0;
		        if($request['offer.items.'.$i.'.brand']){ $brand = $request['offer.items.'.$i.'.brand']; }
		        if($request['offer.items.'.$i.'.description']){ $description = $request['offer.items.'.$i.'.description']; }
		        if($request['offer.items.'.$i.'.unit']){ $unit = $request['offer.items.'.$i.'.unit']; }
		        if($request['offer.items.'.$i.'.qty']){ $qty = $request['offer.items.'.$i.'.qty']; }
		        if($request['offer.items.'.$i.'.sell']){ $sell = $request['offer.items.'.$i.'.sell']; }
		        if($request['offer.items.'.$i.'.discount']){ $discount = $request['offer.items.'.$i.'.discount']; }
		        
			    if(Product::where('id', $request['offer.items.'.$i.'.product_id'])->count()>0){

			    	$Product = Product::find($request['offer.items.'.$i.'.product_id']);

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

				$Item = new Item();
				$Item->offer_id = $Offer->id;
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
	    if($request['offer.conditions']){
			foreach($request['offer.conditions'] as $condition){
		    	$Condition = new Condition();
		    	$Condition->offer_id = $Offer->id;
				$Condition->description = $condition['description'];
				$Condition->value = $condition['value'];
				$Condition->save();
		    }
		}
		
		return $this->DataReturn($Offer);
		
	}

	public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:offers,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Offer = Offer::find($request['select.'.$i]);
                foreach($Offer->conditions as $condition){
			    	$Condition = Condition::find($condition->id);
					$Condition->delete();
			    }
			    foreach($Offer->items as $item){
			    	$Item = Item::find($item->id);
			    	//$Product = Product::find($item->product_id);
			    	//$Stock = Stock::find($Product->stock_id);
					$Item->delete();
			    }
                $Offer->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }
}
