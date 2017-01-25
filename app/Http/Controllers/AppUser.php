<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

class AppUser extends App
{

	public function Change(Request $request){

        $this->validate($request, [
            'element.empid' => 'required|max:100|string',
        	'element.name' => 'required|max:100|string',
            'element.designation' => 'max:100|string',
            'element.address' => 'max:250|string',
            'element.email' => 'required|max:100|string',
            'element.roll' => 'required|max:100|string',
            'element.password' => 'required|max:100|string'
        ]);

        $empid=$name=$designation=$email=$address=$roll=$password='';
        if($request['element.empid']){ $empid = $request['element.empid']; }
        if($request['element.name']){ $name = $request['element.name']; }
        if($request['element.designation']){ $designation = $request['element.designation']; }
        if($request['element.email']){ $email = $request['element.email']; }
        if($request['element.address']){ $address = $request['element.address']; }
        if($request['element.roll']){ $roll = $request['element.roll']; }
        if($request['element.password']){ $password = $request['element.password']; }

        if(is_array($request['select'])){

            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:users,id'
                ]);

                //Check Ability
                $User = User::find($request['select.'.$i]);
            }
            for ($i=0;$i<count($request['select']);$i++) {
                $User = User::find($request['select.'.$i]);
                $User->empid=$empid;
                $User->name=$name;
                $User->designation=$designation;
                $User->email=$email;
                $User->address=$address;
                $User->roll=$roll;
                $User->password=bcrypt($password);
                $User->save();
            }

        }else{

            $User = new User();
            $User->empid=$empid;
            $User->name=$name;
            $User->designation=$designation;
            $User->email=$email;
            $User->address=$address;
            $User->roll=$roll;
            $User->password=bcrypt($password);
            $User->save();
        }
        return $this->DataReturn('blank');
    }

    public function Remove(Request $request){

        if(is_array($request['select'])){
            for ($i=0;$i<count($request['select']);$i++) {
                $this->validate($request, [
                    'select.'.$i => 'required|numeric|exists:users,id'
                ]);
            }
            for ($i=0;$i<count($request['select']);$i++) {

                $User = User::find($request['select.'.$i]);
                $User->delete();
            }
            return $this->DataReturn('blank');
        }else{
            return response()->json(['error' => ['No item selected']], 422);
        }
    }

}
