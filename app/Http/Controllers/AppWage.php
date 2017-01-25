<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Wage;
use App\Employe;
use App\Payment;
use App\Dbwage;
use App\Transection;

class AppWage extends App
{

	public function Save(Request $request){
		
	   	$this->validate($request, [
	        'wage.date' => 'required|string',
	        'wage.note' => 'string',
	        'wage.total' => 'required|numeric'
	    ]);

	    if($request['dbwages']){
	    	for($i=0;$i<count($request['dbwages']);$i++){
		    	$this->validate($request, [
		    		'dbwages.'. $i .'.employe.id' => 'required|exists:employes,id',
			        'dbwages.'. $i .'.basic' => 'required|numeric',
			        'dbwages.'. $i .'.absent' => 'required|numeric',
			        'dbwages.'. $i .'.late' => 'required|numeric',
			        'dbwages.'. $i .'.tada' => 'required|numeric',
			        'dbwages.'. $i .'.bonus' => 'required|numeric',
			        'dbwages.'. $i .'.advance' => 'required|numeric',
			        'dbwages.'. $i .'.charge' => 'required|numeric'
			    ]);
		    }
	    }

	    $Wage = new Wage();
	    $Wage->date = $request['wage.date'];
		$Wage->note = $request['wage.note'];
		$Wage->total = round($request['wage.total'],2);
		$Wage->save();

		//Dbwage Section
		if($request['dbwages']){
			for($i=0;$i<count($request['dbwages']);$i++){
				$Dbwage = new Dbwage();
				$Dbwage->wage_id = $Wage->id;
				$Dbwage->employe_id = $request['dbwages.'.$i.'.employe.id'];
				$Dbwage->date = $request['wage.date'];
				$Dbwage->basic = round($request['dbwages.'.$i.'.basic'],2);
				$Dbwage->absent = round($request['dbwages.'.$i.'.absent'],2);
				$Dbwage->late = round($request['dbwages.'.$i.'.late'],2);
				$Dbwage->tada = round($request['dbwages.'.$i.'.tada'],2);
				$Dbwage->bonus = round($request['dbwages.'.$i.'.bonus'],2);
				$Dbwage->advance = round($request['dbwages.'.$i.'.advance'],2);
				$Dbwage->charge = round($request['dbwages.'.$i.'.charge'],2);
				$Dbwage->save();

				$Transection = new Transection();
				$Transection->date = $request['wage.date'];
				$Transection->employe_id = $request['dbwages.'.$i.'.employe.id'];
				$Transection->wage_id = $Wage->id;
				$Transection->type = 'Credit';
				$Transection->amount = round( 
							$Dbwage->basic
							+ $Dbwage->tada
							+ $Dbwage->bonus
							- $Dbwage->advance
							- $Dbwage->charge
							+ (($Dbwage->basic * $Dbwage->absent)/30)
							+ (($Dbwage->basic * $Dbwage->late)/(30*3))
						, 2);
				$Transection->save();
		    }
		}
		
		return $this->DataReturn($Wage);
		
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
			        'payment.invoices.'. $selects[$i] => 'required|numeric',
			        'select.'. $i => 'required|exists:employes,id'
			    ]);
		    }
		    $Amounts = $request['payment.invoices'];
		    foreach($selects as $select){
		    	$Transection = new Transection();
				$Transection->date = $request['payment.date'];
				$Transection->employe_id = $select;
				$Transection->type = 'Debit';
				$Transection->amount = $Amounts[$select];
				$Transection->save();
		    	$total += $Amounts[$select];
		    }
		    $payment = new Payment();
		    $payment->account_id = $request['payment.account.id'];
		    $payment->date = $request['payment.date'];
		    $payment->summery = 'Due Wages';
		    $payment->type = 'Credit';
		    $payment->amount = round($total, 2);
		    $payment->save();

	    }
		
		return $this->DataReturn('blank');
		
	}

	public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:wages,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Wage = Wage::find($request['select.'.$i]);
		    	foreach ($Wage->transections as $DBTransection) {
		    		$Transection = Transection::find($DBTransection->id);
		    		$Transection->delete();
		    	};
			    foreach ($Wage->dbwages as $ddbwage) {
		    		$Dbwage = Dbwage::find($ddbwage->id);
		    		$Dbwage->delete();
		    	};
                $Wage->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
