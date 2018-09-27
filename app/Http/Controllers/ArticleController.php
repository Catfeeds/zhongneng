<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route,Auth,Cookie;
// use Illuminate\Routing\Router;
use App\Models\ArticleCategory,App\Models\Article,App\Models\AdsPosition,App\Models\AdsImage,App\Models\Region,App\Models\Collection;
class ArticleController extends Controller
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
    public function article_category(Request $request,$id){

        // $url = Route::currentRouteName();
        // $cate_info = ArticleCategory::with(['MoreImageMany'])->where('url',$url)->first();
        $cate_info = ArticleCategory::with(['MoreImageMany'])->where('id',$id)->first();
        // $cate_info = ArticleCategory::with(['MoreImageMany'])->where('id',$cate_id)->first();
        if (!$cate_info||empty($cate_info['template'])) {
            abort(404);
        }
        
        $top_category = top_category($cate_info,ArticleCategory::class,'parent_id');//获取顶级分类
        $sub_category = ArticleCategory::orderBy('order',"ASC")->where('parent_id',$top_category['id'])->get();//获取一级分类
        // $province = Region::regionList([
        //     'paginate'=>0,
        //     'region_type'=>1,
        // ]);
        // $class = ArticleCategory::orderBy('order',"ASC")->where('parent_id',46)->get();//获取意向班级
        $location = [
            0=>[
                'url'=>'',
                'title'=>$cate_info['title'],
                // 'en_title'=>$cate_info['en_title'],
            ],
        ];
        //获取萌货新闻推荐
        // $new_recommend_list = Article::ArticleList([
        //     'cate_id_in'=>sub_cate_in(40),
        //     'order'=>'is_top',
        //     'sort'=>'DESC',
        //     'take'=>12,
        // ]);
        //从顶部到当前分类
        $cate_tree = cate_tree($cate_info['id']);
        $cate_tree_on = array();
        foreach($cate_tree as $v){
            // if(!empty($v['url'])){
            //     $cate_tree_on[] = $v['url'];
            // }
            if(!empty($v['id'])){
                $cate_tree_on[] = $v['id'];
            }
        }
        $assign = [
            // 'url'                =>$url,
            'cate_tree_on'       =>$cate_tree_on,
            // 'url'             => [
            //     "list-".$top_category['id']."-1.html",
            //     "list-".$cate_info['id']."-1.html",
            // ],
            // 'class'           =>$class,
            // 'province'        =>$province,
            'new_recommend_list' => $new_recommend_list,
            'top_category'       => $top_category,
            'sub_category'       => $sub_category,
            'cate_info'          => $cate_info,
            'head_title'         => !empty($cate_info['seo_title'])?$cate_info['seo_title']:$cate_info['title'],
            'head_keywords'      => !empty($cate_info['seo_keywords'])?$cate_info['seo_keywords']:$cate_info['title'],
            'head_description'   => !empty($cate_info['seo_description'])?$cate_info['seo_description']:$cate_info['title'],
            'location'           => $location,
        ];
        // $AdsPosition = AdsPosition::where('title',$cate_info['title'])->first();//获取广告位
        // if($AdsPosition){
        //     $AdsImage = AdsImage::AdsImageList([
        //         'cate_id'=>$AdsPosition['id'],
        //         'paginate'=>0,
        //     ]);
        //     $assign['AdsImage'] = $AdsImage;
        // }

        //根据模板获取相应数据
        // $recommend_cate = $cate_info['id'];
        // $take = 20;
        // switch ($cate_info['template']) {
        //     case 'news':
        //         $recommend_cate = $cate_info['id'];
        //         $take = 20;
        //         break;
        // }
        switch ($cate_info['template']) {
            case 'index2'://普通主页
            case 'product'://普通主页
            case 'service'://普通主页
            case 'about'://普通主页
                $cate_list = ArticleCategory::orderBy('order',"ASC")->where('parent_id',$cate_info['id'])->get();//获取一级分类
                foreach($cate_list as $k=>$v){
                    $v['article'] = Article::ArticleList([
                        'cate_id'=>$v['id'],
                        'paginate'=>0,
                    ]);
                }
                $assign['cate_list'] = $cate_list;
                $user_info = Auth::user();
                $assign['collection_on'] = Collection::CollectionOn([
                    'user_id'=>$user_info['id'],
                    'type'=>3,
                    'article_id'=>$cate_info['id'],
                ]);
                $assign['collection_id'] = $cate_info['id'];
                $assign['collection_type'] = 3;
                break;
            case 'problem'://问题
                $c_sub = ArticleCategory::where('parent_id',$cate_info['id'])->orderBy('order',"ASC")->first();
                if($c_sub){
                    return redirect(URL($c_sub['url']));
                }
                if(isMobile()){
                    $cate_list = ArticleCategory::orderBy('order',"ASC")->where('parent_id',$cate_info['parent_id'])->get();//获取一级分类
                    foreach($cate_list as $k=>$v){
                        $v['article'] = Article::ArticleList([
                            'cate_id'=>$v['id'],
                            'paginate'=>0,
                        ]);
                    }
                    $assign['cate_list'] = $cate_list;
                }else{
                    $article_list = Article::ArticleList([
                        'cate_id'=>$cate_info['id'],
                        'paginate'=>0,
                    ]);
                    $assign['article_list'] = $article_list;
                    //获取同级分类
                    $two_category = ArticleCategory::orderBy('order',"ASC")->where('parent_id',$cate_info['parent_id'])->get();//
                    $assign['two_category'] = $two_category;
                }
                break;
            case 'anli':
                if(isMobile()){
                    $paginate = 4;
                }else{
                    $paginate = 9;
                }
                //获取列表数据
                $article_list = Article::ArticleList([
                    'cate_id_in' => sub_cate_in($cate_info['id']),
                    'paginate'   => $paginate,
                ]);
                $assign['article_list'] = $article_list;
                break;
        }
        if(isMobile()){
            return view('mobile.article.'.$cate_info['template'],$assign);
        }else{
            return view('home.article.'.$cate_info['template'],$assign);
        }
    }
    /**
     * 文章详情
     */
    public function article_info(Request $request,$id){
        // Article::where("id",$id)->increment('click',1);
        $info = Article::with(['ArticleCategoryTo','MoreImageMany','MoreVideoMany'])->find($id);
        if (!$info) {
            abort(404);
        }
        $cate_info = $info['ArticleCategoryTo'];
        if (!$cate_info||empty($cate_info['template'])) {
            abort(404);
        }
        $top_category = top_category($cate_info,ArticleCategory::class,'parent_id');//获取顶级分类
        $sub_category = ArticleCategory::orderBy('order',"ASC")->where('parent_id',$top_category['id'])->get();//获取一级分类
        $location = [
            0=>[
                'url'=>url('category',[$cate_info['id']]),
                'title'=>$cate_info['title'],
                // 'en_title'=>$cate_info['en_title'],
            ],
            1=>[
                'title'=>$info['title'],
            ]
        ];
        // $url = $cate_info['url'];
        
        //获取新闻推荐
        // $new_recommend_list = Article::ArticleList([
        //     'cate_id_in'=>sub_cate_in(40),
        //     'order'=>'is_top',
        //     'sort'=>'DESC',
        //     'take'=>12,
        // ]);
        //从顶部到当前分类
        $cate_tree = cate_tree($cate_info['id']);
        $cate_tree_on = array();
        foreach($cate_tree as $v){
            // if(!empty($v['url'])){
            //     $cate_tree_on[] = $v['url'];
            // }
            if(!empty($v['id'])){
                $cate_tree_on[] = $v['id'];
            }
        }
        $user_info = Auth::user();
        $collection_on = Collection::CollectionOn([
            'user_id'=>$user_info['id'],
            'type'=>1,
            'article_id'=>$id,
        ]);
        $assign = [
            // 'url'                => [
            //     "list-".$top_category['id']."-1.html",
            //     "list-".$cate_info['id']."-1.html",
            // ],
            // 'new_recommend_list' =>$new_recommend_list,
            // 'url'                   =>$url,
            'collection_id'    =>$id,
            'collection_on'    =>$collection_on,
            'collection_type'  =>1,
            'cate_tree_on'     =>$cate_tree_on,
            'top_category'     =>$top_category,
            'sub_category'     =>$sub_category,
            'cate_info'        =>$cate_info,
            'head_title'       => !empty($info['seo_title'])?$info['seo_title']:$info['title'],
            'head_keywords'    => !empty($info['seo_keywords'])?$info['seo_keywords']:$info['title'],
            'head_description' => !empty($info['seo_description'])?$info['seo_description']:$info['title'],
            'location'         =>$location,
            'info'             =>$info,
        ];
        //根据模板获取相应数据
        // $recommend_cate = 7;
        // $take = 8;
        // switch ($cate_info['template']) {
        //     case 'personnel':
        //     case 'news':
        //         $recommend_cate = $cate_info['id'];
        //         $take = 6;
        //         break;
        // }
        
        switch ($cate_info['template']) {
            case 'guimi-group':
            case 'master-group':
                $location = [
                    0=>[
                        'url'=>url('category',[$top_category['id']]),
                        'title'=>$top_category['title'],
                        // 'en_title'=>$cate_info['en_title'],
                    ],
                    1=>[
                        'title'=>$info['title'],
                    ]
                ];
                $assign['location'] = $location;
                break;
        }
        switch ($cate_info['template']) {
            case 'news'://新闻列表
            case 'video'://视频
            // case 'guimi-group'://新闻列表
            case 'product'://产品
            // case 'cases'://案例
            // case 'teacher'://师资
                //获取列表
                $article_recommend_list = Article::ArticleList([
                    'cate_id'=>$cate_info['id'],
                    'order'=>'is_top',
                    'sort'=>'DESC',
                    'take'=>6,
                    'no_id'=>$info['id'],
                ]);
                $assign['article_recommend_list'] = $article_recommend_list;

                //获取上下篇
                $article_all = Article::select('id')->where('cate_id',$info['cate_id'])->orderBy("add_time","DESC")->orderBy("id","DESC")->get();
                $prev_id = 0;
                $next_id = 0;
                foreach($article_all as $k=>$v){
                    if($v['id']==$info['id']){
                        $prev_id = $article_all[$k+1]['id'];
                        $next_id = $article_all[$k-1]['id'];
                        break;
                    }
                }
                $prev_article = Article::find($prev_id);
                $assign['prev_article'] = $prev_article;
                $next_article = Article::find($next_id);
                $assign['next_article'] = $next_article;

                //获取右侧推荐
                if(!$info['tag']){
                    $info['tag'] = -1;
                }
                $art_1 = \App\Models\ArticleCategory::select("article.*")->where("template","news")->leftjoin("article","article.cate_id","=","article_category.id")->where('tag',$info['tag'])->where('article.id',"<>",$info['id'])->orderBy('sort','DESC')->orderBy("add_time","DESC")->orderBy("id","DESC")->take(3)->get();
                // $art_1 = Article::ArticleList([
                //     'tag'=>$info['tag'],
                //     'sort'=>'DESC',
                //     'take'=>3,
                // ]);
                $assign['art_1'] = $art_1;
                break;
        }

        if(isMobile()){
            return view('mobile.article.'.$cate_info['template']."-info",$assign);
        }else{
            return view('home.article.'.$cate_info['template']."-info",$assign);
        }
    }

    public function contact_us(Request $request){
        $location = [
            0=>[
                'url'=>'',
                'title'=>"联系我们",
                // 'en_title'=>$cate_info['en_title'],
            ],
        ];
        $assign = [
            'location' => $location,
        ];
        return view('home.article.contact-us',$assign);
    }
    /**
     * 点赞
     */
    public function praise(Request $request,$id){
        Article::where("id",$id)->increment('click',1);
        $praise = Cookie::get('praise');
        $praise = explode(",",$praise);
        $praise[] = $id;
        $minutes = 60*60*24*30;
        Cookie::queue('praise',implode(",",$praise),$minutes);
        // $return = array(
        //     'code' => 200,
        //     'message'  => "点赞成功",
        // );
        // return response()->json($return)->cookie('praise',implode(",",$praise),$minutes);;
        return render("点赞成功",200);
    }
}
