<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function manager_register(Request $request)
    {
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

        $employee_id = 'manager-' . rand(0, 9999);

        $manager  = new Manager;
        $manager->name = $request->name;
        $manager->email = $request->email;
        $manager->phonenumber = $request->phone;
        $manager->password = bcrypt($request->password);
        $manager->employee_id = $employee_id;
        $manager->save();
        return redirect()->back()->with(['success' => 'You are Registered Successfully'], 200);
    }
    public function manager_login(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required|string|min:6',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()], 400);
        }


        $credentials = $request->only('email', 'password');

        if (Auth::guard('manager')->attempt($credentials)) {
            return redirect()->route('manager.dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function manager_logout()
    {
        Auth::guard('manager')->logout();
        return redirect()->route('home');
    }

    public function developer_register(Request $request)
    {
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

        $employee_id = 'developer-' . rand(0, 9999);

        $manager  = new Developer;
        $manager->name = $request->name;
        $manager->email = $request->email;
        $manager->phonenumber = $request->phone;
        $manager->password = bcrypt($request->password);
        $manager->employee_id = $employee_id;
        $manager->save();
        return redirect()->back()->with(['success' => 'You are Registered Successfully'], 200);
    }
    public function developer_login(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required|string|min:6',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()], 400);
        }


        $credentials = $request->only('email', 'password');

        if (Auth::guard('developer')->attempt($credentials)) {
            return redirect()->route('developer.dashboard');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }
    public function developer_logout()
    {
        Auth::guard('developer')->logout();
        return redirect()->route('home');
    }

}
