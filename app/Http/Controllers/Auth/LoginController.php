<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    public function username(){
        //设置验证账户名的字段
        return 'name';
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin($request){
        $Validator = Validator::make($request->all(), [
            'name'     => 'required|string',
            'password' => 'required|string',
        ],[
        ],[
            'name'     => '用户名',
            'password' => '密码',
        ]);
        $Validator->after(function($validator) use ($request){
            $user_info = User::where('name',$request['name'])->first();
            if($user_info&&$user_info['status']==2){
                $validator->errors()->add('status', '该用户已经被禁用');
            }
        });
        if($Validator->errors()->messages()||$Validator->fails()){
            // redirect()->back()->withErrors($Validator)->send();
            $Validator->validate();
        }
        // return $Validator;
    }

    public function showLoginForm(){
        //更改登陆页面模版路径
        if(isMobile()){
            return view('mobile.user.login',['is_footer'=>0]);
        }else{
            return view('home.user.login');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
