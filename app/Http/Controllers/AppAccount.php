<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Account;

class AppAccount extends App
{

    public function Change(Request $request){

        $this->validate($request, [
            'element.name' => 'required|max:100|string',
            'element.ac' => 'required|max:100|string'
        ]);

        $name=$ac='';
        if($request['element.name']){ $name = $request['element.name']; }
        if($request['element.ac']){ $ac = $request['element.ac']; }

        if(is_array($request['select'])){

            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:accounts,id'
                ]);

                //Check Ability
                $Account = Account::find($request['select.'.$i]);
            }
            for ($i=0;$i<count($request['select']);$i++) {
                $Account = Account::find($request['select.'.$i]);
                $Account->name=$name;
                $Account->ac=$ac;
                $Account->save();
            }

        }else{

            $Account = new Account();
            $Account->name=$name;
            $Account->ac=$ac;
            $Account->save();
        }
        return $this->DataReturn('blank');
    }

    public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:accounts,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Account = Account::find($request['select.'.$i]);
                $Account->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
