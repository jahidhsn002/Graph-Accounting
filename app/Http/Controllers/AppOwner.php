<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Owner;

class AppOwner extends App
{

	public function Change(Request $request){

        $this->validate($request, [
        	'element.name' => 'required|max:100|string',
            'element.address' => 'max:250|string',
        ]);
        if(is_array($request['select'])){

            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:owners,id'
                ]);

                //Check Ability
                $Owner = Owner::find($request['select.'.$i]);
            }
            for ($i=0;$i<count($request['select']);$i++) {
                $Owner = Owner::find($request['select.'.$i]);
                $Owner->name=$request['element.name'];
                $Owner->address=$request['element.address'];
                $Owner->save();
            }

        }else{

            $Owner = new Owner();
            $Owner->name=$request['element.name'];
            $Owner->address=$request['element.address'];
            $Owner->save();
        }
        return $this->DataReturn('blank');
    }

    public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:owners,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Owner = Owner::find($request['select.'.$i]);
                $Owner->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
