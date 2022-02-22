<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Menu\CreateFormRequest;
use App\User;

class LoginController extends Controller
{
    //

    public function index()
    {
        // dd('dawng nhap di');
        return view('admin_login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ],[
            'email.required'=>'Email không được để trống',
            'password.required'=>'password không được để trống',
        ]);


        if (Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ], $request->input('remember'))) {

            return redirect()->route('admin');
        }

        Session::put('message-login', 'Email hoặc Mật khẩu không đúng');
        return redirect()->back();
    }
 
}