<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Loan;
use App\Loanaccount;
use App\Payment;

class AppLoan extends App
{

	public function Save(Request $request){
		
	    $this->validate($request, [
	        'element.account.id' => 'required|exists:accounts,id',
	        'element.date' => 'required|string',
	        'element.type' => 'required|string',
	        'element.amount' => 'required|string',
	        'element.note' => 'string'
	    ]);

	    if($request['element.category.id']){
	    	$this->validate($request, [
		        'element.category.id' => 'required|exists:loanaccounts,id'
		    ]);
		    $category = Loanaccount::find($request['element.category.id']);
	    }else{
	    	$this->validate($request, [
		        'element.category.name' => 'required|string'
		    ]);
	    	$category = new Loanaccount();
	    	$category->name = $request['element.category.name'];
	    	$category->save();
	    }

	    $Loan = new Loan();
	   	$Loan->date = $request['element.date'];
	   	$Loan->note = $request['element.note'];
	   	$Loan->amount = round($request['element.amount'],2);
	    $Loan->loanaccount_id = $category->id;
	    $Loan->type = $request['element.type'];
	    $Loan->save();

	    $payment = new Payment();
	   	$payment->date = $request['element.date'];
	    $payment->account_id = $request['element.account.id'];
	    if($Loan->type == 'Debit'){
	    	$payment->type = 'Credit';
	    }else{
	    	$payment->type = 'Debit';
	    }
	    $payment->amount = round($request['element.amount'],2);
	    $payment->summery = 'Liabality | ' . $category->name;
	    $payment->save();
		
		return $this->DataReturn('blank');
		
	}

	public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:loans,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

            	$type = 'Debit';
                $Loan = Loan::find($request['select.'.$i]);
                	$Loanaccount = Loanaccount::find($Loan->loanaccount_id);
                	if($Loan->type == 'Debit'){
				    	$type = 'Credit';
				    }
                	$Payment = Payment::where('date', $Loan->date)
                				->where('amount', $Loan->amount)
                				->where('type', $type)
                				->where('summery', 'Liabality | ' . $Loanaccount->name)
                				->first();
                	$Payment->delete();
                $Loan->delete();

            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
