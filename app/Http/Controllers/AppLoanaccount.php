<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Loanaccount;

class AppLoanaccount extends App
{

	public function Change(Request $request){

        $this->validate($request, [
        	'element.name' => 'required|max:100|string'
        ]);
        if(is_array($request['select'])){

            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:loanaccounts,id'
                ]);

                //Check Ability
                $Loanaccount = Loanaccount::find($request['select.'.$i]);
            }
            for ($i=0;$i<count($request['select']);$i++) {
                $Loanaccount = Loanaccount::find($request['select.'.$i]);
                $Loanaccount->name=$request['element.name'];
                $Loanaccount->save();
            }

        }else{

            $Loanaccount = new Loanaccount();
            $Loanaccount->name=$request['element.name'];
            $Loanaccount->save();
        }
        return $this->DataReturn('blank');
    }

    public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:loanaccounts,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Loanaccount = Loanaccount::find($request['select.'.$i]);
                $Loanaccount->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
