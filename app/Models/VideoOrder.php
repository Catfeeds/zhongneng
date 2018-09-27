<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
class VideoOrder extends Model
{
    protected $table = 'video_order';
    protected $primaryKey = 'order_id';
    public function UserTo(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function VideoTo(){
        return $this->belongsTo('App\Models\Video','video_id','video_id');
    }
    public function is_pay($order_id,$user_id){
        //验证会员是否购买课程
        $order_info = VideoOrder::where([
            'user_id'=>$user_id,
            'video_id'=>$order_id,
            'status'=>2,
        ])->first();
        return $order_info;
    }
    public function Nutify($attributes = array()){
        $id = $attributes['id'];
        $info = VideoOrder::find($id);
        if($info['status']==1){
            $info->status = 2;
            $info->pay_time = date('Y-m-d H:i:s');
            $info->save();
        }
    }
}
