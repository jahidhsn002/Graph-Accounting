<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Supplier;

class AppSupplier extends App
{

	public function Change(Request $request){

        $this->validate($request, [
        	'element.name' => 'required|max:100|string',
            'element.company' => 'max:150|string',
            'element.phone' => 'max:50|string',
            'element.address' => 'max:250|string'
        ]);

        $name=$company=$phone=$address='';
        if($request['element.name']){ $name = $request['element.name']; }
        if($request['element.company']){ $company = $request['element.company']; }
        if($request['element.phone']){ $phone = $request['element.phone']; }
        if($request['element.address']){ $address = $request['element.address']; }

        if(is_array($request['select'])){

            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:suppliers,id'
                ]);

                //Check Ability
                $Supplier = Supplier::find($request['select.'.$i]);
            }
            for ($i=0;$i<count($request['select']);$i++) {
                $Supplier = Supplier::find($request['select.'.$i]);
                $Supplier->name=$name;
                $Supplier->company=$company;
                $Supplier->phone=$phone;
                $Supplier->address=$address;
                $Supplier->save();
            }

        }else{

            $Supplier = new Supplier();
            $Supplier->name=$name;
            $Supplier->company=$company;
            $Supplier->phone=$phone;
            $Supplier->address=$address;
            $Supplier->save();
        }
        return $this->DataReturn('blank');
    }

    public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:suppliers,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Supplier = Supplier::find($request['select.'.$i]);
                $Supplier->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
