<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use App\Models\ActivityCategory;
class Activity extends Model
{
    protected $table = 'activity';
    public function CityTo(){
        return $this->belongsTo('App\Models\Region','city','region_id');
    }
    public function MoreImageMany(){
        return $this->hasMany('App\Models\MoreImage','more_id','id')->where('cate_id',3)->orderBy("order","DESC")->orderBy("id","DESC");
    }
    public function MoreVideoMany(){
        return $this->hasMany('App\Models\MoreVideo','more_id','id')->where('cate_id',3)->orderBy("order","DESC")->orderBy("id","DESC");
    }
    public function MoreActivityMany1(){
        return $this->hasMany('App\Models\MoreArticle','more_id','id')->where('cate_id',1)->orderBy("order","DESC")->orderBy("id","DESC");
    }
    public function MoreActivityMany2(){
        return $this->hasMany('App\Models\MoreArticle','more_id','id')->where('cate_id',2)->orderBy("order","DESC")->orderBy("id","DESC");
    }
    public function setNewsRelatedAttribute($value){
        $this->attributes['news_related'] = implode(",",$value);
    }
    static public function ActivityList($attributes = array()){
        // $list = Activity::with(['ActivityCategoryTo','CityTo','MoreImageMany']);
        $list = new Activity;
        
        if(isset($attributes['province'])&&trim($attributes['province'])!=''){
            $list = $list->where('province',$attributes['province']);
        }
        if(isset($attributes['no_id'])&&trim($attributes['no_id'])!=''){
            $list = $list->where('id',"<>",$attributes['no_id']);
        }
        if(isset($attributes['id_in'])&&count($attributes['id_in'])){
            $list = $list->whereIn('id',$attributes['id_in']);
        }
        if(isset($attributes['city'])&&trim($attributes['city'])!=''){
            $list = $list->where('city',$attributes['city']);
        }
        if(isset($attributes['is_top'])&&trim($attributes['is_top'])!=''){
            $list = $list->where('is_top',$attributes['is_top']);
        }

        if((isset($attributes['keyword'])&&trim($attributes['keyword'])!='')||(isset($attributes['search_type'])&&trim($attributes['search_type']))){
            if(isset($attributes['search_type'])&&trim($attributes['search_type'])){
                switch ($attributes['search_type']) {
                    case '1':
                        $list = $list->where(function($query) use ($attributes){
                            $query->Orwhere('title',"like","%".$attributes['keyword']."%")->Orwhere(function($query) use ($attributes){
                                $query->where('activity_time2',">",date("Y-m-d",strtotime($attributes['keyword'])))->where('activity_time',"<",date("Y-m-d",strtotime("+1day",strtotime($attributes['keyword']))));
                            });
                        });
                        break;
                    case '3':
                        $list = $list->where('activity_time2',">",date("Y-m-d",strtotime($attributes['start_time'])))->where('activity_time',"<",date("Y-m-d",strtotime("+1day",strtotime($attributes['end_time']))));
                        break;
                    default:
                        $list = $list->where('title',"like","%".$attributes['keyword']."%");
                        break;
                }
            }else{
                $list = $list->where('title',"like","%".$attributes['keyword']."%");
            }
        }
        if(isset($attributes['activity_type'])&&trim($attributes['activity_type'])!=''){
            switch ($attributes['activity_type']) {
                case '1':
                    $list = $list->where('activity_time2',">",date('Y-m-d H:i:s'));
                    break;
                case '2':
                    $list = $list->where('activity_time2',"<=",date('Y-m-d H:i:s'));
                    break;
            }
        }

        if(isset($attributes['order'])&&trim($attributes['order'])!=''){
            $list = $list->orderBy($attributes['order'],$attributes['sort']);
        }
        $list = $list->orderBy("activity_time2","DESC")->orderBy("id","DESC");
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
        return $list;
    }

}
