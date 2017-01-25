<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Employe;

class AppEmploye extends App
{

	public function Change(Request $request){

        $this->validate($request, [
            'element.empid' => 'required|max:100|string',
        	'element.name' => 'required|max:100|string',
            'element.designation' => 'max:100|string',
            'element.phone' => 'max:100|string',
            'element.joining' => 'max:100|string',
            'element.address' => 'max:250|string',
            'element.salary' => 'max:100|string',
            'element.note' => 'max:100|string'
        ]);

        $empid=$name=$designation=$phone=$joining=$address=$salary=$note='';
        if($request['element.empid']){ $empid = $request['element.empid']; }
        if($request['element.name']){ $name = $request['element.name']; }
        if($request['element.designation']){ $designation = $request['element.designation']; }
        if($request['element.phone']){ $phone = $request['element.phone']; }
        if($request['element.joining']){ $joining = $request['element.joining']; }
        if($request['element.address']){ $address = $request['element.address']; }
        if($request['element.salary']){ $salary = $request['element.salary']; }
        if($request['element.note']){ $note = $request['element.note']; }

        if(is_array($request['select'])){

            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:employes,id'
                ]);

                //Check Ability
                $Employe = Employe::find($request['select.'.$i]);
            }
            for ($i=0;$i<count($request['select']);$i++) {
                $Employe = Employe::find($request['select.'.$i]);
                $Employe->empid=$empid;
                $Employe->name=$name;
                $Employe->designation=$designation;
                $Employe->phone=$phone;
                $Employe->joining=$joining;
                $Employe->address=$address;
                $Employe->salary=$salary;
                $Employe->note=$note;
                $Employe->save();
            }

        }else{

            $Employe = new Employe();
            $Employe->empid=$empid;
            $Employe->name=$name;
            $Employe->designation=$designation;
            $Employe->phone=$phone;
            $Employe->joining=$joining;
            $Employe->address=$address;
            $Employe->salary=$salary;
            $Employe->note=$note;
            $Employe->save();
        }
        return $this->DataReturn('blank');
    }

    public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:employes,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $Employe = Employe::find($request['select.'.$i]);
                $Employe->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
