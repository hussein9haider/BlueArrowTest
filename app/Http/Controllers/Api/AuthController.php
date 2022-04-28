<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    use GeneralTrait;
    public function login(Request $request){
        try {
            $rules = [
                'email' => ['required', 'string','exists:admins,email','email'],
                'password' => ['required', 'string'],
            ];
            $validator = Validator::make($request->all() , $rules);
            if($validator->fails()){
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code , $validator);
            }
            $credentials = $request->only('email','password');
            $token = Auth::guard('admin-api')->attempt($credentials);
            if(!$token){
                return $this->returnError('E001', __('dashboard.error login') );
            }
            $admin = Auth::guard('admin-api')->user();
            $admin->token = 'bearer '.$token;          
            return $this->returnData('admin', $admin);
        }catch (\Throwable $th) {
            return $this->returnError($th->getCode() , $th->getMessage()); 
        }
    }

    public function register(Request $request){
        try{
            $rules = [
                'name' => ['required' ,'string','max:191'],
                'email' => ['required', 'string','email','max:191','unique:admins,email'],
                'password' => ['required', 'string'],
            ];
            $validator = Validator::make($request->all() , $rules);
            if($validator->fails()){
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code , $validator);
            }
            $data = $request->only('name','email','password');
            $admin = Admin::create($data);
            $token = Auth::guard('admin-api')->login($admin);
            if(!$token){
                return $this->returnError('E001', __('dashboard.error login') );
            }
            $admin->token = 'bearer '.$token;          
            return $this->returnData('admin', $admin);
        }catch (\Throwable $th) {
            return $this->returnError($th->getCode() , $th->getMessage()); 
        }
    }
     
}
