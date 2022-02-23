<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Validator;
class SignupController extends Controller
{
    function list() {
        return Device::all();
}

function add(Request $req){

    $validator = Validator::make($req->all(), [
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        
        return response()->json([
            'errorMessage'=> true,
            'message' => $validator->errors()
        ]);
    }

    $device = New Device;
    $device -> name = $req -> name;
    $device -> email = $req -> email;
    $device -> password = $req -> password;
    // $device -> save(); //save data into the db
    $result = $device -> save();

    if($result){
        return ["Result" => "Data has been posted successfully!"];
    }
    else{
        return ["Result" => "Operation Filed!"];
    }
}



function test(Request $req){
    $rules=array(
        "name"=>"required",
        "email"=>"required | unique",
        "password"=>"required | min:5 | max:12"
    );

    $validator = validator::make($req->all(), $rules);

    if($validator->fails())
    {
        return response()->json($validator->errors(), 401);
    }
    else{
        $device = New Device;
        $device -> name = $req -> name;
        $device -> email = $req -> email;
        $device -> password = $req -> password;
        // $device -> save(); //save data into the db
        $result = $device -> save();
    
        if($result){
            return ["Result" => "Data has been posted successfully!"];
        }
        else{
            return ["Result" => "Operation Filed!"];
        }
    }
}

}
