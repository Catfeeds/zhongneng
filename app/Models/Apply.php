<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use App\Models\ArticleCategory;
class Apply extends Model
{
    protected $table = 'apply';
    public function ActivityTo(){
        return $this->belongsTo('App\Models\Activity','activity_id','id');
    }
    static public function ApplySave($attributes=array()){
        if($attributes['id']>0){
        	$info = Apply::find($attributes['id']);
        }
        if(!isset($info)||!$info){
        	$info = new Apply;
        }
        if(isset($attributes['name'])){
        	$info->name = $attributes['name'];
        }
        if(isset($attributes['phone'])){
        	$info->phone = $attributes['phone'];
        }
        if(isset($attributes['email'])){
            $info->email = $attributes['email'];
        }
        if(isset($attributes['remark'])){
        	$info->remark = $attributes['remark'];
        }
        if(isset($attributes['address'])){
            $info->address = $attributes['address'];
        }
        $info->save();
    	return $info;
    }

}
