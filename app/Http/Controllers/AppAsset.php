<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Asset;
use App\Assetaccount;
use App\Payment;

class AppAsset extends App
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
		        'element.category.id' => 'required|exists:assetaccounts,id'
		    ]);
		    $category = Assetaccount::find($request['element.category.id']);
	    }else{
	    	$this->validate($request, [
		        'element.category.name' => 'required|string'
		    ]);
	    	$category = new Assetaccount();
	    	$category->name = $request['element.category.name'];
	    	$category->save();
	    }

	    $asset = new Asset();
	   	$asset->date = $request['element.date'];
	   	$asset->note = $request['element.note'];
	   	$asset->amount = round($request['element.amount'],2);
	    $asset->assetaccount_id = $category->id;
	    $asset->type = $request['element.type'];
	    $asset->save();

	    $payment = new Payment();
	   	$payment->date = $request['element.date'];
	    $payment->account_id = $request['element.account.id'];
	    if($asset->type == 'Debit'){
	    	$payment->type = 'Credit';
	    }else{
	    	$payment->type = 'Debit';
	    }
	    $payment->amount = round($request['element.amount'],2);
	    $payment->summery = 'Asset | ' . $category->name;
	    $payment->save();
		
		return $this->DataReturn('blank');
		
	}

	public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:assets,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

            	$type = 'Debit';
                $Asset = Asset::find($request['select.'.$i]);
                	$Assetaccount = Assetaccount::find($Asset->assetaccount_id);
                	if($Asset->type == 'Debit'){
				    	$type = 'Credit';
				    }
                	$Payment = Payment::where('date', $Asset->date)
                				->where('amount', $Asset->amount)
                				->where('type', $type)
                				->where('summery', 'Asset | ' . $Assetaccount->name)
                				->first();
                	$Payment->delete();
                $Asset->delete();

            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
