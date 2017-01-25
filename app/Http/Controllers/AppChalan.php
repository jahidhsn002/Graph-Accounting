<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Chalan;
use App\Customer;
use App\Condition;
use App\Product;
use App\Item;
use App\Stock;

class AppChalan extends App
{

	public function Save(Request $request){
		
	   	$this->validate($request, [
	        'chalan.date' => 'required|max:15|string',
	        'chalan.perchase_date' => 'max:15|string',
	   	'chalan.perchase_no' => 'max:150|string',
	        'chalan.traking' => 'max:150|string',
	        'chalan.shipping_cost' => 'required|numeric',
	        'chalan.comments' => 'max:250|string',
	        'chalan.note' => 'max:250|string',
	        'chalan.terms' => 'max:250|string' 
	    ]);

	    $this->validate($request, [
	        'chalan.customer.name' => 'required|max:100|string',
            'chalan.customer.company' => 'max:150|string',
            'chalan.customer.phone' => 'max:50|string',
            'chalan.customer.shipping' => 'max:250|string'
	    ]);

	    if($request['chalan.items']){
	    	for($i=0;$i<count($request['chalan.items']);$i++){
		    	$this->validate($request, [
			        'chalan.items.'. $i .'.description' => 'required|max:250|string',
		            'chalan.items.'. $i .'.brand' => 'max:250|string',
		            'chalan.items.'. $i .'.qty' => 'required|min:0|numeric',
		            'chalan.items.'. $i .'.sell' => 'required|min:0|numeric'
			    ]);
		    }
	    }

		//Customer Section
	    if(Customer::where('id', $request['chalan.customer.id'])->count()>0){
	    	$Customer = Customer::find($request['chalan.customer.id']);
	    }else{
	    	$Customer = new Customer();
	    	$Customer->billing = '';
	    }

	    $name=$company=$phone=$shipping='N/A';
        if($request['chalan.customer.name']){ $name = $request['chalan.customer.name']; }
        if($request['chalan.customer.company']){ $company = $request['chalan.customer.company']; }
        if($request['chalan.customer.phone']){ $phone = $request['chalan.customer.phone']; }
        if($request['chalan.customer.shipping']){ $shipping = $request['chalan.customer.shipping']; }else{ $shipping = $request['chalan.customer.billing']; }

        $Customer->name = $name;
		$Customer->company = $company;
		$Customer->phone = $phone;
		$Customer->shipping = $shipping;
		$Customer->save();

		$date=$comments=$note=$terms=$traking='';
		$shipping_cost=0;
        if($request['chalan.date']){ $date = $request['chalan.date']; }
        if($request['chalan.perchase_date']){ $perchase_date = $request['chalan.perchase_date']; }
        if($request['chalan.perchase_no']){ $perchase_no = $request['chalan.perchase_no']; }
        if($request['chalan.traking']){ $traking = $request['chalan.traking']; }
        if($request['chalan.shipping_cost']){ $shipping_cost = $request['chalan.shipping_cost']; }
        if($request['chalan.comments']){ $comments = $request['chalan.comments']; }
        if($request['chalan.note']){ $note = $request['chalan.note']; }
        if($request['chalan.terms']){ $terms = $request['chalan.terms']; }

	    $Chalan = new Chalan();
	    $Chalan->customer_id = $Customer->id;
		$Chalan->date = $date;
		$Chalan->perchase_date = $perchase_date;
		$Chalan->perchase_no = $perchase_no;
		$Chalan->traking = $traking;
		$Chalan->shipping_cost = round($shipping_cost,2);
		$Chalan->comments = $comments;
		$Chalan->note = $note;
		$Chalan->terms = $terms;
		$Chalan->save();

		//Item Section
		if($request['chalan.items']){
			for($i=0;$i<count($request['chalan.items']);$i++){
		    	
		    	$brand=$description=$unit='';
				$qty=$sell=0;
		        if($request['chalan.items.'.$i.'.brand']){ $brand = $request['chalan.items.'.$i.'.brand']; }
		        if($request['chalan.items.'.$i.'.description']){ $description = $request['chalan.items.'.$i.'.description']; }
		        if($request['chalan.items.'.$i.'.unit']){ $unit = $request['chalan.items.'.$i.'.unit']; }
		        if($request['chalan.items.'.$i.'.qty']){ $qty = $request['chalan.items.'.$i.'.qty']; }
		        if($request['chalan.items.'.$i.'.sell']){ $sell = $request['chalan.items.'.$i.'.sell']; }

			    if(Product::where('id', $request['chalan.items.'.$i.'.product_id'])->count()>0){
			    	$Product = Product::find($request['chalan.items.'.$i.'.product_id']);
			    	$Stock = Stock::find($Product->stock_id);
			    }else{
			    	$Stock = new Stock();
            		$Stock->qty = 0;
            		$Stock->save();

			    	$Product = new Product();
			    	$Product->stock_id=$Stock->id;
			    	$Product->iban='';
			    	$Product->sell = $sell;
			    	$Product->buy = 0;
			    }

				$Product->description = $description;
				$Product->brand = $brand;
				$Product->unit = $unit;
				$Product->save();

				$new_stock = ($Stock->qty - $qty);
				$Stock->qty = round($new_stock, 2);
				$Stock->save();
				
				$Item = new Item();
				$Item->chalan_id = $Chalan->id;
				$Item->product_id = $Product->id;
				$Item->description = $description;
				$Item->brand = $brand;
				$Item->unit = $unit;
				$Item->qty = round($qty,2);
				$Item->sell = round($sell,2);
				$Item->save();
		    }
		}
		
		return $this->DataReturn($Chalan);
		
	}

	public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:chalans,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Chalan = Chalan::find($request['select.'.$i]);
			    foreach($Chalan->items as $item){
			    	$Item = Item::find($item->id);
			    	$Product = Product::find($item->product_id);
			    	$Stock = Stock::find($Product->stock_id);
			    		$new_stock = ($Stock->qty + $Item->qty);
			    	$Stock->qty = round($new_stock,2);
			    	$Stock->save();
					$Item->delete();
			    }
                $Chalan->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }
}
