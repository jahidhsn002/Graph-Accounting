<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Dbreturn;
use App\Customer;
use App\Supplier;
use App\Condition;
use App\Product;
use App\Item;
use App\Stock;
use App\Chalan;
use App\Payment;

class AppReturn extends App
{
    public function Save(Request $request){
		
	   	$this->validate($request, [
	   		'return.date' => 'required|max:15|string',
	        'return.type' => 'required|max:15|string',
	        'return.total' => 'required|numeric',
	        'return.note' => 'max:250|string'
	    ]);

	   	if($request['return.type']=='Sale'){
	   		$this->validate($request, [
		    	'return.customer.name' => 'required|max:100|string',
	            'return.customer.phone' => 'max:50|string',
	            'return.customer.billing' => 'max:250|string',
		        'return.account.id' => 'required|exists:accounts,id'
		    ]);
	   	}else{
	   		$this->validate($request, [
		    	'return.supplier.name' => 'required|max:100|string',
	            'return.supplier.phone' => 'max:50|string',
	            'return.supplier.address' => 'max:250|string',
		        'return.account.id' => 'required|exists:accounts,id'
		    ]);
	   	}
	    
	    if($request['return.items']){
	    	for($i=0;$i<count($request['return.items']);$i++){
		    	$this->validate($request, [
			        'return.items.'. $i .'.description' => 'required|max:250|string',
		            'return.items.'. $i .'.brand' => 'max:250|string',
		            'return.items.'. $i .'.unit' => 'max:15|string',
		            'return.items.'. $i .'.discount' => 'required|min:0|numeric',
		            'return.items.'. $i .'.qty' => 'required|min:0|numeric',
		            'return.items.'. $i .'.sell' => 'required|min:0|numeric'
			    ]);
		    }
	    }

	    if($request['return.type']=='Sale'){
	   		//Customer Section
			if(Customer::where('id', $request['return.customer.id'])->count()>0){
		    	$Customer = Customer::find($request['return.customer.id']);
		    }else{
		    	$Customer = new Customer();
		    	$Customer->due = 0;
		    	$Customer->shipping = '';
		    	$Customer->company = '';
		    }

		    $name=$phone=$billing='N/A';
	        if($request['return.customer.name']){ $name = $request['return.customer.name']; }
	        if($request['return.customer.phone']){ $phone = $request['return.customer.phone']; }
	        if($request['return.customer.billing']){ $billing = $request['return.customer.billing']; }
		    
			$Customer->name = $name;
			$Customer->phone = $phone;
			$Customer->billing = $billing;
			$Customer->save();
	   	}else{
	   		//Customer Section
			if(Supplier::where('id', $request['return.customer.id'])->count()>0){
		    	$Supplier = Supplier::find($request['return.customer.id']);
		    }else{
		    	$Supplier = new Supplier();
		    	$Supplier->company = '';
		    }

		    $name=$phone=$address='N/A';
	        if($request['return.supplier.name']){ $name = $request['return.supplier.name']; }
	        if($request['return.supplier.phone']){ $phone = $request['return.supplier.phone']; }
	        if($request['return.supplier.address']){ $address = $request['return.supplier.address']; }
		    
			$Supplier->name = $name;
			$Supplier->phone = $phone;
			$Supplier->address = $address;
			$Supplier->save();
	   	}
		

		//Return Section
		$date=$note=$type='';
		$total=0;
        if($request['return.date']){ $date = $request['return.date']; }
        if($request['return.total']){ $total = $request['return.total']; }
        if($request['return.note']){ $note = $request['return.note']; }
        if($request['return.type']){ $type = $request['return.type']; }

        $Return = new Dbreturn();
        if($type=='Sale'){
	    	$Return->customer_id = $Customer->id;
	    }else{
	    	$Return->supplier_id = $Supplier->id;
	    }
		$Return->date = $date;
		$Return->total = round($total,2);
		$Return->note = $note;
		$Return->type = $type;
		$Return->save();

		//Payment Section
		$payment = new Payment();
	    $payment->account_id = $request['return.account.id'];
	    $payment->date = $date;
	    $payment->summery = $type.' Returns';
	    if($type=='Sale'){
	    	$payment->type = 'Credit';
	    }else{
	    	$payment->type = 'Debit';
	    }
	    $payment->amount = round($total, 2);
	    $payment->save();

		//Item Section
		if($request['return.items']){
			for($i=0;$i<count($request['return.items']);$i++){
		    	
		    	$brand=$description=$unit='';
				$qty=$sell=$discount=0;
		        if($request['return.items.'.$i.'.brand']){ $brand = $request['return.items.'.$i.'.brand']; }
		        if($request['return.items.'.$i.'.description']){ $description = $request['return.items.'.$i.'.description']; }
		        if($request['return.items.'.$i.'.unit']){ $unit = $request['return.items.'.$i.'.unit']; }
		        if($request['return.items.'.$i.'.qty']){ $qty = $request['return.items.'.$i.'.qty']; }
		        if($request['return.items.'.$i.'.sell']){ $sell = $request['return.items.'.$i.'.sell']; }
		        if($request['return.items.'.$i.'.discount']){ $discount = $request['return.items.'.$i.'.discount']; }
		        
			    if(Product::where('id', $request['return.items.'.$i.'.product_id'])->count()>0){

			    	$Product = Product::find($request['return.items.'.$i.'.product_id']);
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

				if($type=='Sale'){
			    	$new_stock = ($Stock->qty + $qty);
					$Stock->qty = round($new_stock, 2);
					$Stock->save();
			    }else{
			    	$new_stock = ($Stock->qty - $qty);
					$Stock->qty = round($new_stock, 2);
					$Stock->save();
			    }

				$Item = new Item();
				$Item->return_id = $Return->id;
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
		
		return $this->DataReturn($Return);
		
	}

	public function Remove(Request $request){

		$type = 'Debit';
        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:returns,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Return = Dbreturn::find($request['select.'.$i]);
                if($Return->type=='Sale'){
			    	$type = 'Credit';
			    }
                $Payment = Payment::where('date', $Return->date)
            				->where('amount', $Return->total)
            				->where('type', $type)
            				->where('summery', $Return->type.' Returns')
            				->first();
            	$Payment->delete();
			    foreach($Return->items as $item){
			    	$Item = Item::find($item->id);
						$Product = Product::find($item->product_id);
				    	$Stock = Stock::find($Product->stock_id);
				    	if($Return->type=='Sale'){
				    		$new_stock = ($Stock->qty + $Item->qty);
				    	}else{
				    		$new_stock = ($Stock->qty - $Item->qty);
				    	}
				    	$Stock->qty = round($new_stock,2);
				    	$Stock->save();
						
					$Item->delete();
			    }
                $Return->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }
}
