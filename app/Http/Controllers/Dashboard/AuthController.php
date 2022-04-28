<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Dashboard\AdminLoginRequest;
use App\Http\Requests\Dashboard\AdminRegisterRequest;

class AuthController extends Controller
{
    public function showAdminLoginForm(){
        return view('dashboard.auth.login');
    }

    public function adminLogin(AdminLoginRequest $request){
        try{
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))){
                return redirect()->intended('/dashboard');
            }
            session()->flash('error-login',__('dashboard.error-login'));
            return back()->withInput($request->only('email', 'remember'));
        }catch (\Throwable $th) {
            session()->flash('error_ex', __('dashboard.error_ex'));
            return redirect(route('dashboard.login.show'));
        }
    }

    public function showAdminRegisterForm(){
        return view('dashboard.auth.register');
    }

    public function adminRegister(AdminRegisterRequest $request){
        //try{
            $data = $request->only( 'name','email');
            $data['password'] = Hash::make($request->password);
            Admin::create($data);
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))){
                return redirect()->intended('/dashboard');
            }
            session()->flash('error-login',__('dashboard.error-login'));
            return back()->withInput($request->only('email','name'));
        // }catch (\Throwable $th) {
        //     session()->flash('error_ex', __('dashboard.error_ex'));
        //     return redirect(route('dashboard.register.show'));
        // }
    }
}
