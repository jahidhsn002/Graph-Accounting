<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Expense;
use App\Expenseaccount;
use App\Payment;

class AppExpense extends App
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
		        'element.category.id' => 'required|exists:expenseaccounts,id'
		    ]);
		    $category = Expenseaccount::find($request['element.category.id']);
	    }else{
	    	$this->validate($request, [
		        'element.category.name' => 'required|string'
		    ]);
	    	$category = new Expenseaccount();
	    	$category->name = $request['element.category.name'];
	    	$category->save();
	    }

	    $Expense = new Expense();
	   	$Expense->date = $request['element.date'];
	   	$Expense->note = $request['element.note'];
	   	$Expense->amount = round($request['element.amount'],2);
	    $Expense->expenseaccount_id = $category->id;
	    $Expense->type = 'Debit';
	    $Expense->save();

	    $payment = new Payment();
	   	$payment->date = $request['element.date'];
	    $payment->account_id = $request['element.account.id'];
	    $payment->type = 'Credit';
	    $payment->amount = round($request['element.amount'],2);
	    $payment->summery = 'Expense | ' . $category->name;
	    $payment->save();
		
		return $this->DataReturn('blank');
		
	}

	public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:expenses,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Expense = Expense::find($request['select.'.$i]);
                	$Expenseaccount = Expenseaccount::find($Expense->expenseaccount_id);
                	$Payment = Payment::where('date', $Expense->date)
                				->where('amount', $Expense->amount)
                				->where('type', 'Credit')
                				->where('summery', 'Expense | ' . $Expenseaccount->name)
                				->first();
                	$Payment->delete();
                $Expense->delete();

            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }
}
