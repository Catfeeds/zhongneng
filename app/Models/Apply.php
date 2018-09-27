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
        if(isset($attributes['age'])){
            $info->age = $attributes['age'];
        }
        if(isset($attributes['sex'])){
        	$info->sex = $attributes['sex'];
        }
        if(isset($attributes['income'])){
            $info->income = $attributes['income'];
        }
        if(isset($attributes['fine_time'])){
            $info->fine_time = $attributes['fine_time'];
        }
        if(isset($attributes['address'])){
        	$info->address = $attributes['address'];
        }
        if(isset($attributes['years'])){
        	$info->years = $attributes['years'];
        }
        if(isset($attributes['cate_id'])){
        	$info->cate_id = $attributes['cate_id'];
        }
        $info->save();
    	return $info;
    }

}
