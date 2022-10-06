<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('Admin.auth.login');
    }

    public function loginPost(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $admin = User::where(['user_type' => 1, 'email' => $request->email])->first();
        if (!$admin) {
            return redirect()->back()->withErrors(['msg' => 'Invalid email or password']);
        }

        if (Hash::check($request->password, $admin->password)) {
            Auth::attempt($request->except('_token'));
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Invalid email or password']);
        }
    }
}
