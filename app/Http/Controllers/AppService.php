<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Service;
use App\Customer;
use App\Job;
use App\Product;
use App\Item;
use App\Stock;
use App\Payment;
use App\Transection;
use App\Condition;
use App\Estimate;

class AppService extends App
{

	public function Save(Request $request){
		
		$item_Array = $job_Array = [];

	   	$this->validate($request, [
	        'service.date' => 'required|string',
	        'service.status' => 'required|string',
	        'service.vat' => 'required|numeric',
	        'service.subtotal' => 'required|numeric',
	        'service.total' => 'required|numeric',
	        'service.estimate' => 'string',
	        'service.reg' => 'string',
	        'service.make' => 'string',
	        'service.model' => 'string',
	        'service.engine' => 'string',
	        'service.milage' => 'string',
	        'service.note' => 'string',
	        'service.terms' => 'string',
	        'service.jobno' => 'string'
	    ]);

	    $this->validate($request, [
	        'service.customer.name' => 'max:100|string',
            'service.customer.company' => 'max:150|string',
            'service.customer.phone' => 'max:50|string',
            'service.customer.billing' => 'max:250|string'
	    ]);

	    if($request['service.items']){
	    	for($i=0;$i<count($request['service.items']);$i++){
		    	$this->validate($request, [
			        'service.items.'. $i .'.description' => 'required|max:250|string',
		            'service.items.'. $i .'.brand' => 'max:250|string',
		            'service.items.'. $i .'.unit' => 'max:15|string',
		            'service.items.'. $i .'.discount' => 'required|min:0|numeric',
		            'service.items.'. $i .'.qty' => 'required|min:0|numeric',
		            'service.items.'. $i .'.sell' => 'required|min:0|numeric'
			    ]);
		    }
	    }
	    
	    if($request['service.jobs']){
		    for($i=0;$i<count($request['service.jobs']);$i++){
		    	$this->validate($request, [
			        'service.jobs.'. $i .'.description' => 'string',
			        'service.jobs.'. $i .'.value' => 'required|numeric' 
			    ]);
		    }
		}

	    //Customer Section
		if(Customer::where('id', $request['service.customer.id'])->count()>0){
	    	$Customer = Customer::find($request['service.customer.id']);
	    }else{
	    	$Customer = new Customer();
	    }

	    $name=$company=$phone=$billing='';
        if($request['service.customer.name']){ $name = $request['service.customer.name']; }
        if($request['service.customer.company']){ $company = $request['service.customer.company']; }
        if($request['service.customer.phone']){ $phone = $request['service.customer.phone']; }
        if($request['service.customer.billing']){ $billing = $request['service.customer.billing']; }
	    
		$Customer->name = $name;
		$Customer->company = $company;
		$Customer->phone = $phone;
		$Customer->billing = $billing;
		$Customer->save();

		//Service section
		$jobno=$date=$status=$estimate=$reg=$make=$model=$engine=$milage=$comments=$note=$terms='';
		$jobno=$vat=$subtotal=$total=0;
        if($request['service.jobno']){ $jobno = $request['service.jobno']; }
        if($request['service.date']){ $date = $request['service.date']; }
        if($request['service.vat']){ $vat = $request['service.vat']; }
        if($request['service.subtotal']){ $subtotal = $request['service.subtotal']; }
        if($request['service.total']){ $total = $request['service.total']; }
        if($request['service.status']){ $status = $request['service.status']; }
        if($request['service.reg']){ $reg = $request['service.reg']; }
        if($request['service.estimate']){ $estimate = $request['service.estimate']; }
        if($request['service.make']){ $make = $request['service.make']; }
        if($request['service.model']){ $model = $request['service.model']; }
        if($request['service.engine']){ $engine = $request['service.engine']; }
        if($request['service.milage']){ $milage = $request['service.milage']; }
        if($request['service.comments']){ $comments = $request['service.comments']; }
        if($request['service.note']){ $note = $request['service.note']; }
        if($request['service.terms']){ $terms = $request['service.terms']; }

		if($status == 'Delivered'){
	    	$Service = new Service();
	    }elseif($status != 'Delivered' && Estimate::where('jobno', $jobno)->count()>0){
	    	$Service = Estimate::where('jobno', $jobno)->first();
	    }else{
	    	$Service = new Estimate();
	    }
	    $Service->customer_id = $Customer->id;
		$Service->jobno = $jobno;
		$Service->date = $date;
		$Service->estimate = $estimate;
		$Service->vat = $vat;
		$Service->subtotal = round($subtotal,2);
		$Service->total = round($total,2);
		$Service->status = $status;
		$Service->reg = $reg;
		$Service->model = $model;
		$Service->make = $make;
		$Service->engine = $engine;
		$Service->milage = $milage;
		$Service->comments = $comments;
		$Service->note = $note;
		$Service->terms = $terms;
		$Service->save();

		if($status == 'Delivered'){
			$Transection = new Transection();
			$Transection->date = $Service->date;
			$Transection->customer_id = $Customer->id;
			$Transection->service_id = $Service->id;
			$Transection->type = 'Debit';
			$Transection->amount = $Service->total;
			$Transection->save();
		}

		//Item Section
		if($request['service.items']){
			for($i=0;$i<count($request['service.items']);$i++){
		    	
		    	$brand=$description=$unit='';
				$qty=$sell=$discount=0;
		        if($request['service.items.'.$i.'.brand']){ $brand = $request['service.items.'.$i.'.brand']; }
		        if($request['service.items.'.$i.'.description']){ $description = $request['service.items.'.$i.'.description']; }
		        if($request['service.items.'.$i.'.unit']){ $unit = $request['service.items.'.$i.'.unit']; }
		        if($request['service.items.'.$i.'.qty']){ $qty = $request['service.items.'.$i.'.qty']; }
		        if($request['service.items.'.$i.'.sell']){ $sell = $request['service.items.'.$i.'.sell']; }
		        if($request['service.items.'.$i.'.discount']){ $discount = $request['service.items.'.$i.'.discount']; }
		    	
		    	if(Product::where('id', $request['service.items.'.$i.'.product_id'])->count()>0){

			    	$Product = Product::find($request['service.items.'.$i.'.product_id']);
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
				if($status == 'Delivered'){
					if(
						Item::where('product_id', $request['service.items.'.$i.'.product_id'])
							->where('service_id', $request['service.items.'.$i.'.service_id'])
							->count()>0
					){
			    		$Item = Item::where('product_id', $request['service.items.'.$i.'.product_id'])
			    					->where('service_id', $request['service.items.'.$i.'.service_id'])
			    					->first();
			    	}else{
			    		$Item = new Item();
			    		$Item->qty = 0;
			    	}
			    }else{
			    	if(
						Item::where('product_id', $request['service.items.'.$i.'.product_id'])
							->where('estimate_id', $request['service.items.'.$i.'.service_id'])
							->count()>0
					){
			    		$Item = Item::where('product_id', $request['service.items.'.$i.'.product_id'])
			    					->where('estimate_id', $request['service.items.'.$i.'.service_id'])
			    					->first();
			    	}else{
			    		$Item = new Item();
			    		$Item->qty = 0;
			    	}
			    }

		    	//Stock
				if($status != 'Estimate'){
					$new_stock = ($Stock->qty - ($qty - $Item->qty));
					$Stock->qty = round($new_stock, 2);
					$Stock->save();
				}
				if($status == 'Delivered'){
					$Item->service_id = $Service->id;
				}else{
					$Item->estimate_id = $Service->id;
				}
				$Item->product_id = $Product->id;
				$Item->brand = $brand;
				$Item->description = $description;
				$Item->qty = $qty;
				$Item->sell = $sell;
				$Item->discount = $discount;
				$Item->unit = $unit;
				$Item->save();
				$item_Array[] = $Item->id;
		    }
		}

	    //Job Section
	    if($request['service.jobs']){
			for($i=0;$i<count($request['service.jobs']);$i++){
		    	if(Job::where('id', $request['service.jobs.'.$i.'.id'])->count()>0){
		    		$Job = Job::find($request['service.jobs.'.$i.'.id']);
		    	}else{
		    		$Job = new Job();
		    	}
		    	if($status == 'Delivered'){
					$Job->service_id = $Service->id;
				}else{
					$Job->estimate_id = $Service->id;
				}
				$Job->description = $request['service.jobs.'.$i.'.description'];
				$Job->value = round($request['service.jobs.'.$i.'.value'],2);
				$Job->save();
				$job_Array[] = $Job->id;
		    }
		}

		foreach ($Service->items as $Item) {
			if(!in_array($Item->id, $item_Array)){
				if($status != 'Estimate'){
					$new_stock = ($Stock->qty + $Item->qty);
					$Stock->qty = round($new_stock, 2);
					$Stock->save();
				}
				$delItem = Item::find($Item->id);
				if($delItem!=null){
					$delItem->delete();
				}
			}
		}

		foreach ($Service->jobs as $Job) {
			if(!in_array($Job->id, $job_Array)){
				$delJob = Job::find($Job->id);
				if($delJob!=null){
					$delJob->delete();
				}
			}
		}

		$Service->customer;

		if($status == 'Delivered'){
	    	$Estimate = Estimate::where('id', $request['service.id'])->first();
	    	if($Estimate!=null){
				$Estimate->delete();
			}
	    }
		
		return $this->DataReturn($Service);
		
	}

	public function Offer(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:services,id',
                    'offer.description' => 'required|max:250|string',
			        'offer.value' => 'required|numeric'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Service = Service::find($request['select.'.$i]);
            	$Transection = Transection::where('date', $Service->date)
            				->where('service_id', $Service->id)
            				->where('customer_id', $Service->customer_id)
            				->where('amount', $Service->total)
            				->where('type', 'Debit')
            				->first();

                $total = round($Service->total - $request['offer.value']);
		    	$Service->total = $total;
                $Service->save();

                	$Transection->amount = $Service->total;			
                	$Transection->save();

                $Condition = new Condition();
		    	$Condition->service_id = $Service->id;
				$Condition->description = $request['offer.description'];
				$Condition->value = round($request['offer.value'],2);
				$Condition->save();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

	public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:services,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Service = Service::find($request['select.'.$i]);
		    	foreach ($Service->transections as $DBTransection) {
		    		$Transection = Transection::find($DBTransection->id);
		    		$Transection->delete();
		    	};
			    foreach($Service->items as $item){
			    	$Item = Item::find($item->id);
			    	if($Service->status != 'Estimate'){
						$Product = Product::find($item->product_id);
				    	$Stock = Stock::find($Product->stock_id);
				    		$new_stock = ($Stock->qty + $Item->qty);
				    	$Stock->qty = round($new_stock,2);
				    	$Stock->save();
				    }
					$Item->delete();
			    }
                $Service->delete();
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
