<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route,Auth;
// use Illuminate\Routing\Router;
use App\Models\ArticleCategory,App\Models\Article,App\Models\Activity,App\Models\AdsPosition,App\Models\AdsImage,App\Models\Region,App\Models\Collection;
class ActivityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
        // $this->middleware('auth');
    }

    /**
     * 文章分类
     *
     * @return \Illuminate\Http\Response
     */
    public function activity_list(Request $request){
        //从顶部到当前分类
        //获取列表数据
        $activity_list = Activity::ActivityList([
            "activity_type" => $request['activity_type'],
            "search_type"   => $request['search_type'],
            "keyword"       => $request['keyword'],
            "start_time"       => $request['start_time'],
            "end_time"       => $request['end_time'],
            'paginate'      => 6,
        ]);
        $cate_tree_on = ['artivity'];
        $assign = [
            'activity_list'       =>$activity_list,
            'cate_tree_on'       =>$cate_tree_on,
            'head_title'         => "活动",
            'head_keywords'      => !empty($cate_info['seo_keywords'])?$cate_info['seo_keywords']:$cate_info['title'],
            'head_description'   => !empty($cate_info['seo_description'])?$cate_info['seo_description']:$cate_info['title'],
        ];
        if(isMobile()){
            return view('mobile.article.activity',$assign);
        }else{
            return view('home.article.activity',$assign);
        }
    }
    /**
     * 文章详情
     */
    public function activity_info(Request $request,$id){
        // Activity::where("id",$id)->increment('click',1);
        $user_info = Auth::user();
        $info = Activity::find($id);
        if (!$info) {
            abort(404);
        }
        
        $cate_tree_on = ['artivity'];
        $collection_on = Collection::CollectionOn([
            'user_id'=>$user_info['id'],
            'type'=>2,
            'article_id'=>$id,
        ]);
        $assign = [
            'collection_id'    =>$id,
            'collection_on'    =>$collection_on,
            'collection_type'  =>2,
            'cate_tree_on'     =>$cate_tree_on,
            'cate_info'        =>$cate_info,
            'head_title'       => !empty($info['seo_title'])?$info['seo_title']:$info['title'],
            'head_keywords'    => !empty($info['seo_keywords'])?$info['seo_keywords']:$info['title'],
            'head_description' => !empty($info['seo_description'])?$info['seo_description']:$info['title'],
            'info'             =>$info,
        ];
        
        if(isMobile()){
            return view("mobile.article.activity-info",$assign);
        }else{
            return view("home.article.activity-info",$assign);
        }
    }

}
