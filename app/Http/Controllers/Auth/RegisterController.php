<?php

namespace App\Http\Controllers\Auth;

use App\Models\User,App\Models\SmsCaptcha;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm(){
        //更改注册页面模版路径
        if(isMobile()){
            return view('mobile.user.register',['is_footer'=>0]);
        }else{
            return view('home.user.register');
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $Validator = Validator::make($data, [
            'name'     => 'required|string|min:6|max:25|unique:users',
            'phone'    => 'required|phone|max:255|unique:users',
            'password' => 'required|string|min:6|max:25',
            'email'    => 'required|email|unique:users',
            // 'captcha' => 'required|captcha',
            // 'xieyi'       => 'required',
        ],[
        ],[
            'name'     => '用户名',
            'phone'    => '手机号',
            'email'    => '邮箱',
            'password' => '密码',
        ]);
        
        // $SmsCaptcha = SmsCaptcha::where([
        //     'phone'=>$data['phone'],
        //     'captcha'=>$data['verify_code'],
        //     'status'=>1,
        // ])->where('add_time',">",time()-1800)->first();
        // $Validator->after(function($validator) use ($SmsCaptcha){
        //     if(!$SmsCaptcha){
        //         $validator->errors()->add('verify_code', '短信验证码过期或不存在，请重新获取');
        //     }
        // });
        // if(!$Validator->errors()->messages()&&!$Validator->fails()){
        //     $SmsCaptcha->status=2;
        //     $SmsCaptcha->save();
        // }
        return $Validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return User::create([
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'name'     => $data['name'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
