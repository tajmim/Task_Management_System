<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function manager_register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:managers,email',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|string|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()], 400);
        }

        $employee_id = 'manager-'.rand(0,9999);

        $manager  = new Manager;
        $manager->name = $request->name;
        $manager->email = $request->email;
        $manager->phonenumber = $request->phone;
        $manager->password = bcrypt($request->password);
        $manager->employee_id = $employee_id;
        $manager->save();
        return redirect()->back()->with(['success'=> 'You are Registered Successfully'],200);
    }
}
