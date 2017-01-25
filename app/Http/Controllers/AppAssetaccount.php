<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Assetaccount;

class AppAssetaccount extends App
{

	public function Change(Request $request){

        $this->validate($request, [
        	'element.name' => 'required|max:100|string'
        ]);
        if(is_array($request['select'])){

            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:assetaccounts,id'
                ]);

                //Check Ability
                $Assetaccount = Assetaccount::find($request['select.'.$i]);
            }
            for ($i=0;$i<count($request['select']);$i++) {
                $Assetaccount = Assetaccount::find($request['select.'.$i]);
                $Assetaccount->name=$request['element.name'];
                $Assetaccount->save();
            }

        }else{

            $Assetaccount = new Assetaccount();
            $Assetaccount->name=$request['element.name'];
            $Assetaccount->save();
        }
        return $this->DataReturn('blank');
    }

    public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:assetaccounts,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Assetaccount = Assetaccount::find($request['select.'.$i]);
                $Assetaccount->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
