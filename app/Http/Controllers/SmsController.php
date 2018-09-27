<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator,Auth;
use App\Models\SmsCaptcha,App\Models\User;

class SmsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        
        parent::__construct();
        // $this->middleware('auth');
    }
    public function register_sms_send(Request $request){
        $this->validate($request,[
            'phone'   => 'required|phone|unique:users',
            'captcha' => 'required|captcha',
        ],[],[
            'phone'=>"手机号码",
            'captcha'=>"验证码",
        ]);
        $sms = SmsCaptcha::smsSend($request['phone']);
        if(!$sms){
            return render("请求过多,请稍后重试",500);
        }
        return render("验证码发送成功",200,$sms);
    }
    public function password_reset_sms_send(Request $request){
        $this->validate($request,[
            'phone'   => 'required|phone',
            // 'captcha' => 'required|captcha',
        ],[],[
            'phone'=>"手机号码",
            // 'captcha'=>"验证码",
        ]);
        $user = User::where('phone',$request['phone'])->count();
        if(!$user){
            return render("该手机号还未注册",500);
        }
        $sms = SmsCaptcha::smsSend($request['phone']);
        if(!$sms){
            return render("请求过多,请稍后重试",500);
        }
        return render("验证码发送成功",200,$sms);
    }
    public function bangding_sms_send(Request $request){

        $this->validate($request,[
            'phone'   => 'required|phone|unique:users',
            // 'captcha' => 'required|captcha',
        ],[],[
            'phone'=>"手机号码",
            // 'captcha'=>"验证码",
        ]);
        $sms = SmsCaptcha::smsSend($request['phone']);
        if(!$sms){
            return render("请求过多,请稍后重试",500);
        }
        return render("验证码发送成功",200,$sms);
    }
    public function password_sms_send(Request $request){
        $user_info = Auth::user();
        if(empty($user_info['phone'])){
            return render("请先绑定手机",500);
        }
        $sms = SmsCaptcha::smsSend($user_info['phone']);
        if(!$sms){
            return render("请求过多,请稍后重试",500);
        }
        return render("验证码发送成功",200,$sms);
    }
}
