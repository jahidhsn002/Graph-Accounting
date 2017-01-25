<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Customer;

class AppCustomer extends App
{

	public function Change(Request $request){

        $this->validate($request, [
        	'element.name' => 'required|max:100|string',
            'element.company' => 'max:150|string',
            'element.phone' => 'max:50|string',
            'element.billing' => 'max:250|string',
            'element.shipping' => 'max:250|string'
        ]);

        $name=$company=$phone=$billing=$shipping='';
        if($request['element.name']){ $name = $request['element.name']; }
        if($request['element.company']){ $company = $request['element.company']; }
        if($request['element.phone']){ $phone = $request['element.phone']; }
        if($request['element.billing']){ $billing = $request['element.billing']; }
        if($request['element.shipping']){ $shipping = $request['element.shipping']; }

        if(is_array($request['select'])){

            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:customers,id'
                ]);

                //Check Ability
                $Customer = Customer::find($request['select.'.$i]);
            }
            for ($i=0;$i<count($request['select']);$i++) {
                $Customer = Customer::find($request['select.'.$i]);
                $Customer->name=$name;
                $Customer->company=$company;
                $Customer->phone=$phone;
                $Customer->billing=$billing;
                $Customer->shipping=$shipping;
                $Customer->save();
            }

        }else{

            $Customer = new Customer();
            $Customer->name=$name;
            $Customer->company=$company;
            $Customer->phone=$phone;
            $Customer->billing=$billing;
            $Customer->shipping=$shipping;
            $Customer->save();
        }
        return $this->DataReturn('blank');
    }

    public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:customers,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Customer = Customer::find($request['select.'.$i]);
                $Customer->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
