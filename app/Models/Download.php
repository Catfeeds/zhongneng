<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use App\Models\ArticleCategory;
class Download extends Model
{
    protected $table = 'download';
    public function ArticleTo(){
        return $this->belongsTo('App\Models\Article','article_id','id');
    }
    public function ArticleCategoryTo(){
        return $this->belongsTo('App\Models\ArticleCategory','article_id','id');
    }
    public function UserTo(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    static public function DownloadSave($attributes=array()){
        if($attributes['id']>0){
            $info = Download::find($attributes['id']);
        }
        if(!isset($info)||!$info){
            $info = Download::where(['user_id'=>$attributes['user_id'],'article_id'=>$attributes['article_id']])->first();
        }
        if(!isset($info)||!$info){
            $info = new Download;
        }
        if(isset($attributes['user_id'])){
            $info->user_id = $attributes['user_id'];
        }
        if(isset($attributes['article_id'])){
            $info->article_id = $attributes['article_id'];
        }
        if(isset($attributes['type'])){
            $info->type = $attributes['type'];
        }
        $info->save();
        return $info;
    }
    static public function DownloadList($attributes = array()){
        Download::leftjoin('article',"article.id","=","download.article_id")->where('type',1)->whereNull("article.id")->delete();
        Download::leftjoin('article_category',"article_category.id","=","download.article_id")->where('type',2)->whereNull("article_category.id")->delete();
        $list = new Download;
        if(isset($attributes['user_id'])&&trim($attributes['user_id'])!=''){
            $list = $list->where('user_id',$attributes['user_id']);
        }
        
        if(isset($attributes['order'])&&trim($attributes['order'])!=''){
            $list = $list->orderBy($attributes['order'],$attributes['sort']);
        }
        $list = $list->orderBy("updated_at","DESC")->orderBy("id","DESC");
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
