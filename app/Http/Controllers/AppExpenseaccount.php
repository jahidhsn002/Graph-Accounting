<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Expenseaccount;

class AppExpenseaccount extends App
{

	public function Change(Request $request){

        $this->validate($request, [
        	'element.name' => 'required|max:100|string'
        ]);
        if(is_array($request['select'])){

            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:expenseaccounts,id'
                ]);

                //Check Ability
                $Expenseaccount = Expenseaccount::find($request['select.'.$i]);
            }
            for ($i=0;$i<count($request['select']);$i++) {
                $Expenseaccount = Expenseaccount::find($request['select.'.$i]);
                $Expenseaccount->name=$request['element.name'];
                $Expenseaccount->save();
            }

        }else{

            $Expenseaccount = new Expenseaccount();
            $Expenseaccount->name=$request['element.name'];
            $Expenseaccount->save();
        }
        return $this->DataReturn('blank');
    }

    public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:expenseaccounts,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Expenseaccount = Expenseaccount::find($request['select.'.$i]);
                $Expenseaccount->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
