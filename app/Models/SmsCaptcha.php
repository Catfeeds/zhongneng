<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Request;
class SmsCaptcha extends Model
{
	public $timestamps = false;
    protected $table = 'sms_captcha';

    public function smsSend($phone){
        //验证码发送
        $ip = Request::getClientIp();
        $count = SmsCaptcha::where('add_time',">",strtotime(date('Y-m-d')))->where(function($query){
        	$query->where('phone',$phone)->orWhere('ip',$ip);
        })->count();
        if($count>5){
        	//每天5次验证码
        	return false;
        }
        $count = SmsCaptcha::where('add_time',">",time()-60)->where(function($query){
            $query->where('phone',$phone)->orWhere('ip',$ip);
        })->count();
        if($count){
            //60秒内重复请求
            return false;
        }
        
        $add_arr = new SmsCaptcha;
        $add_arr->phone = $phone;
        $add_arr->add_time = time();
        $add_arr->captcha = mt_rand(1000,9999);
        $add_arr->ip = $ip;
        $add_arr->save();
        //发送邮件
        //xxxx();
        return $add_arr;
    }
    
}
