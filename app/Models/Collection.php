<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use App\Models\ArticleCategory;
class Collection extends Model
{
    protected $table = 'collection';
    public function ArticleTo(){
        return $this->belongsTo('App\Models\Article','article_id','id');
    }
    public function ActivityTo(){
        return $this->belongsTo('App\Models\Activity','article_id','id');
    }
    public function ArticleCategoryTo(){
        return $this->belongsTo('App\Models\ArticleCategory','article_id','id');
    }
    public function UserTo(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    static public function CollectionSave($attributes=array()){
        if($attributes['id']>0){
            $info = Collection::find($attributes['id']);
        }
        if(!isset($info)||!$info){
            $info = Collection::where(['user_id'=>$attributes['user_id'],'article_id'=>$attributes['article_id'],'type'=>$attributes['type']])->first();
        }
        if(!isset($info)||!$info){
            $info = new Collection;
        }
        if(isset($attributes['user_id'])){
            $info->user_id = $attributes['user_id'];
        }
        if(isset($attributes['type'])){
            $info->type = $attributes['type'];
        }
        if(isset($attributes['article_id'])){
            $info->article_id = $attributes['article_id'];
        }
        $info->save();
        return $info;
    }
    static public function CollectionList($attributes = array()){
        $list = new Collection;
        if(isset($attributes['user_id'])&&trim($attributes['user_id'])!=''){
            $list = $list->where('user_id',$attributes['user_id']);
        }
        if(isset($attributes['order'])&&trim($attributes['order'])!=''){
            $list = $list->orderBy($attributes['order'],$attributes['sort']);
        }
        $list = $list->orderBy("created_at","DESC")->orderBy("id","DESC");
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
    static public function CollectionOn($attributes = array()){
        $list = new Collection;
        if(isset($attributes['user_id'])&&trim($attributes['user_id'])!=''){
            $list = $list->where('user_id',$attributes['user_id']);
        }
        if(isset($attributes['article_id'])&&trim($attributes['article_id'])!=''){
            $list = $list->where('article_id',$attributes['article_id']);
        }
        if(isset($attributes['type'])&&trim($attributes['type'])!=''){
            $list = $list->where('type',$attributes['type']);
        }
        $list = $list->count();
        return $list;
    }
}
