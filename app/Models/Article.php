<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use App\Models\ArticleCategory;
use Auth;
use App\Models\Collection;
class Article extends Model
{
    protected $table = 'article';
    public function ArticleCategoryTo(){
        return $this->belongsTo('App\Models\ArticleCategory','cate_id','id');
    }
    public function CityTo(){
        return $this->belongsTo('App\Models\Region','city','region_id');
    }
    public function MoreImageMany(){
        return $this->hasMany('App\Models\MoreImage','more_id','id')->where('cate_id',1)->orderBy("order","DESC")->orderBy("id","DESC");
    }
    public function MoreVideoMany(){
        return $this->hasMany('App\Models\MoreVideo','more_id','id')->where('cate_id',1)->orderBy("order","DESC")->orderBy("id","DESC");
    }
    public function MoreArticleMany1(){
        return $this->hasMany('App\Models\MoreArticle','more_id','id')->where('cate_id',1)->orderBy("order","DESC")->orderBy("id","DESC");
    }
    public function MoreArticleMany2(){
        return $this->hasMany('App\Models\MoreArticle','more_id','id')->where('cate_id',2)->orderBy("order","DESC")->orderBy("id","DESC");
    }
    public function setNewsRelatedAttribute($value){
        $this->attributes['news_related'] = implode(",",$value);
    }
    
    static public function ArticleList($attributes = array()){
        // $list = Article::with(['ArticleCategoryTo','CityTo','MoreImageMany']);
        $list = new Article;
        if(isset($attributes['cate_id'])&&trim($attributes['cate_id'])!=''){
            $list = $list->where('cate_id',$attributes['cate_id']);
        }
        if(isset($attributes['cate_id_in'])&&count($attributes['cate_id_in'])){
            $list = $list->whereIn('cate_id',$attributes['cate_id_in']);
        }
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
                        $time = strtotime($attributes['keyword']);
                        $list = $list->where(function($query) use ($attributes,$time){
                            $query->Orwhere('title',"like","%".$attributes['keyword']."%")->Orwhere(function($query) use ($attributes,$time){
                                if($time){
                                    $query->where('add_time',">",date("Y-m-d",$time))->where('add_time',"<",date("Y-m-d",strtotime("+1day",$time)));
                                }
                            });
                        });
                        break;
                    case '3':
                        $list = $list->where('add_time',">",date("Y-m-d",strtotime($attributes['start_time'])))->where('add_time',"<",date("Y-m-d",strtotime("+1day",strtotime($attributes['end_time']))));
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
                    $list = $list->where('activity_time',">",date('Y-m-d H:i:s'));
                    break;
                case '2':
                    $list = $list->where('activity_time',"<=",date('Y-m-d H:i:s'));
                    break;
            }
        }

        if(isset($attributes['order'])&&trim($attributes['order'])!=''){
            $list = $list->orderBy($attributes['order'],$attributes['sort']);
        }
        $list = $list->orderBy('sort','DESC')->orderBy("add_time","DESC")->orderBy("id","DESC");
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
        if(isset($attributes['is_collection'])&&$attributes['is_collection']>0){
            //判断是否收藏
            $user_info = Auth::user();
            if($user_info){
                foreach($list as $v){
                    $v['is_collection'] = Collection::where(['user_id'=>$user_info['id'],'article_id'=>$v['id'],'type'=>$attributes['is_collection']])->count();
                }
            }
        }
        return $list;
    }

}
