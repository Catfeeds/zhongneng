<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
class PayLog extends Model
{
    protected $table = 'pay_log';
    public function VideoTo(){
        return $this->belongsTo('App\Models\VideoOrder','order_id','order_id');
    }
    static public function PaySave($attributes=array()){
        if($attributes['id']>0){
        	$info = PayLog::find($attributes['id']);
        }
        if(!isset($info)||!$info){
            if(isset($attributes['order_id'])&&trim($attributes['order_id'])!=''&&isset($attributes['type'])&&trim($attributes['type'])!=''){
                $info = PayLog::where('order_id',$attributes['order_id'])->where('type',$attributes['type'])->first();
            }
        }
        if(!isset($info)||!$info){
            $info = new PayLog;
        }
        if(isset($attributes['order_id'])){
        	$info->order_id = $attributes['order_id'];
        }
        if(isset($attributes['type'])){
        	$info->type = $attributes['type'];
        }
        if(isset($attributes['price'])){
            $info->price = $attributes['price'];
        }
        if(isset($attributes['order_no'])){
            $info->order_no = $attributes['order_no'];
        }
        if(isset($attributes['user_id'])){
            $info->user_id = $attributes['user_id'];
        }
        if(isset($attributes['pay_status'])){
        	$info->pay_status = $attributes['pay_status'];
        }
        if(isset($attributes['add_time'])){
            $info->add_time = $attributes['add_time'];
        }
        if(isset($attributes['pay_type'])){
            $info->pay_type = $attributes['pay_type'];
        }
        $info->save();
    	return $info;
    }

}
