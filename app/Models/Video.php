<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use App\Models\Video,App\Models\VideoCourse,App\Models\User,App\Models\Category,App\Models\VideoOrder;
class Video extends Model
{
    protected $table = 'video';
    protected $primaryKey = 'video_id';
    public function VideoCourseMany(){
        return $this->hasMany('App\Models\VideoCourse','video_id','video_id')->orderBy("created_at","ASC")->orderBy("course_id","ASC");
    }
    public function CategoryTo(){
        return $this->belongsTo('App\Models\Category','cate_id','id');
    }
    public function VideoList($attributes = array()){
        $list = Video::with(['CategoryTo','VideoCourseMany']);
        if(isset($attributes['cate_id'])&&trim($attributes['cate_id'])!=''){
            $list = $list->where('cate_id',$attributes['cate_id']);
        }
        if(isset($attributes['type'])&&trim($attributes['type'])!=''){
            $list = $list->where('type',$attributes['type']);
        }
        if(isset($attributes['video_id_in'])&&count($attributes['video_id_in'])){
            $list = $list->whereIn('video_id',$attributes['video_id_in']);
        }

        if(isset($attributes['order'])&&count($attributes['order'])){
            foreach($attributes['order'] as $k=>$v){
                $list = $list->orderBy($v['order'],$v['sort']);
            }
        }

        $list = $list->orderBy("created_at","DESC")->orderBy("video_id","DESC");
        if(isset($attributes['take'])&&trim($attributes['take'])!=''){
            $list = $list->take($attributes['take'])->get();
        }else{
            $paginate = isset($attributes['paginate'])?$attributes['paginate']:10;
            if($paginate){
                $list = $list->paginate($paginate);
                $list->appends($attributes);
            }else{
                $list = $list->get();
            }
        }
        foreach($list as $v){
        	$v['is_try'] = false;
        	foreach($v['VideoCourseMany'] as $v2){
        		if(!empty($v2['try_video'])){
        			$v['is_try'] = true;
        			break;
        		}
        	}
        }
        return $list;
    }
    
}
