<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
class VideoCourse extends Model
{
    protected $table = 'video_course';
    protected $primaryKey = 'course_id';
    public function VideoTo(){
        return $this->belongsTo('App\Models\Video','video_id','video_id');
    }
    static public function VideoCourseList($attributes = array()){
    	$list = VideoCourse::orderBy("created_at","ASC")->orderBy("course_id","ASC");
    	if(isset($attributes['video_id'])&&trim($attributes['video_id'])!=''){
    		$list = $list->where('video_id',$attributes['video_id']);
    	}
    	$paginate = isset($attributes['paginate'])?$attributes['paginate']:10;
    	if($paginate){
    		$list = $list->paginate($paginate);
    		$list->appends($attributes);
    	}else{
    		$list = $list->get();
    	}
    	return $list;
    }
}
