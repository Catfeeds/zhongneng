<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use App\Models\User;
class VipOrder extends Model
{
    protected $table = 'vip_order';
    protected $primaryKey = 'order_id';
    public function UserTo(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function Nutify($attributes = array()){
        $id = $attributes['id'];
        $info = VipOrder::find($id);
        if($info['status']==1){
            $info->status = 2;
            $info->pay_time = date('Y-m-d H:i:s');
            $info->save();
            
            $user_info = User::find($info['user_id']);
            if($user_info['grade']==2){
                //续费
                $user_info->grade_end = date('Y-m-d H:i:s',strtotime($user_info->grade_end)+60*60*24*365);//增加1年
            }else{
                //新购
                $user_info->grade = 2;
                $user_info->grade_start = date('Y-m-d H:i:s');
                $user_info->grade_end = date('Y-m-d H:i:s',time()+60*60*24*365);//增加1年
            }
            $user_info->save();
            
        }
    }
}
