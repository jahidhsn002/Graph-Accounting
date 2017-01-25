<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Drawing;
use App\Owner;
use App\Payment;

class AppDrawing extends App
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

	    $Drawing = new Drawing();
	   	$Drawing->date = $request['element.date'];
	   	$Drawing->note = $request['element.note'];
	   	$Drawing->amount = round($request['element.amount'],2);
	    $Drawing->owner_id = $category->id;
	    $Drawing->type = 'Debit';
	    $Drawing->save();

	    $payment = new Payment();
	   	$payment->date = $request['element.date'];
	    $payment->account_id = $request['element.account.id'];
	    $payment->type = 'Credit';
	    $payment->amount = round($request['element.amount'],2);
	    $payment->summery = 'Drawing | ' . $category->name;
	    $payment->save();
		
		return $this->DataReturn('blank');
		
	}

	public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:drawings,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Drawing = Drawing::find($request['select.'.$i]);
                	$Owner = Owner::find($Drawing->owner_id);
                	$Payment = Payment::where('date', $Drawing->date)
                				->where('amount', $Drawing->amount)
                				->where('type', 'Credit')
                				->where('summery', 'Drawing | ' . $Owner->name)
                				->first();
                	$Payment->delete();
                $Drawing->delete();

            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
