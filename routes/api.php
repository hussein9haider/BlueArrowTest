<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function ($router) {
    ################################ Admin Auth ##################################
    Route::group(['prefix' => 'admin'], function () {
        Route::post('/login', 'AuthController@login');
        Route::post('/register', 'AuthController@register');
    });
    ################################ Admin Auth ##################################
    ################################ Admin Auth ##################################
    Route::group(['prefix' => 'notes','middleware' => ['jwtVerify:admin-api']], function () {
        Route::get('/get', 'NoteController@get');
        Route::post('/store', 'NoteController@store');
        Route::post('/update', 'NoteController@update');
        Route::get('/delete/{id}', 'NoteController@delete');
    });
    ################################ Admin Auth ##################################
    
}); 

Route::group(['middleware' => ['jwtVerify']], function() {
    Route::get('test', function(){
        return response()->json(['sd','sds']);
    });
   
});


 ################################ User Auth ##################################
    Route::group(['prefix' => 'user'], function () {
                
        Route::post('/login', function(Request $request){
            //try {
                $rules = [
                    'phone' => ['required', 'string','exists:users,phone', 'digits_between:1,16'],
                    'password' => ['required', 'string'],
                ];
                //dd($request->all());
                $validator = Validator::make($request->all() , $rules);

                $credentials = $request->only('phone','password');

                $token = Auth::guard('user-api')->attempt($credentials);
                
                if(!$token){
                    return false;
                }

                $user = Auth::guard('user-api')->user();

                $user->token = 'bearer '.$token;  

                
                return $user;

            // }catch (\Throwable $th) {
                
            // }
        });

        Route::post('/reg', function(Request $request){
            $rules = [
                'name' => ['required', 'string', 'max:191'],
                'phone' => ['required', 'string', 'unique:users,phone','digits_between:1,191'],
                'password' => ['required', 'string'],
                'onesignal'=>['required','string'],
            ];

            $validator = Validator::make($request->all() , $rules);

            //  if($validator->fails()){

            //     $code = $this->returnCodeAccordingToInput($validator);

            //     return $this->returnValidationError($code , $validator);
            // }


            $user = User::create([
                'name'  => "323232",
                'phone' => "07729181299",
                'password' => bcrypt("12345678"),
                'onesignal' => "21212121"
            ]);

             $token = Auth::guard('user-api')->login($user);

            if(!$token){
                return $this->returnError('E001', __('dashboard.error login') );
            }
            $user->token = 'bearer '.$token;  
            return  $user;   
        });


        
    });
    ################################ User Auth  ##################################

