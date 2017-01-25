<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Capital;
use App\Owner;
use App\Payment;

class AppCapital extends App
{

	public function Save(Request $request){
		
	    $this->validate($request, [
	        'element.account.id' => 'required|exists:accounts,id',
	        'element.date' => 'required|string',
	        'element.amount' => 'required|string',
	        'element.note' => 'string'
	    ]);

	    if($request['element.category.id']){
	    	$this->validate($request, [
		        'element.category.id' => 'required|exists:owners,id'
		    ]);
		    $category = Owner::find($request['element.category.id']);
	    }else{
	    	$this->validate($request, [
		        'element.category.name' => 'required|string'
		    ]);
	    	$category = new Owner();
	    	$category->name = $request['element.category.name'];
	    	$category->save();
	    }

	    $Capital = new Capital();
	   	$Capital->date = $request['element.date'];
	   	$Capital->note = $request['element.note'];
	   	$Capital->amount = round($request['element.amount'],2);
	    $Capital->owner_id = $category->id;
	    $Capital->type = 'Credit';
	    $Capital->save();

	    $payment = new Payment();
	   	$payment->date = $request['element.date'];
	    $payment->account_id = $request['element.account.id'];
	    $payment->type = 'Debit';
	    $payment->amount = round($request['element.amount'],2);
	    $payment->summery = 'Capital | ' . $category->name;
	    $payment->save();
		
		return $this->DataReturn('blank');
		
	}

	public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:capitals,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Capital = Capital::find($request['select.'.$i]);
                	$Owner = Owner::find($Capital->owner_id);
                	$Payment = Payment::where('date', $Capital->date)
                				->where('amount', $Capital->amount)
                				->where('type', 'Debit')
                				->where('summery', 'Capital | ' . $Owner->name)
                				->first();
                	$Payment->delete();
                $Capital->delete();

            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
