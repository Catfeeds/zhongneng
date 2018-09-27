<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article,App\Models\ArticleCategory;

class HomeController extends Controller
{
    // Illuminate\Validation\Concerns\ValidatesAttributes//验证规则文件
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        $index_1_cate = ArticleCategory::find(379);
        $index_1 = Article::ArticleList([
            'cate_id_in'=>sub_cate_in(379),
            'order'=>'is_top',
            'sort'=>'DESC',
            'take'=>6,
        ]);
     
        $index_2_cate = ArticleCategory::find(389);

        $index_3 = Article::ArticleList([
            'cate_id'=>385,
            'order'=>'is_top',
            'sort'=>'DESC',
            'take'=>8,
        ]);
        $index_3_cate = ArticleCategory::find(385);

        $assign = [
            'index_1' => $index_1,
            'index_1_cate' => $index_1_cate,
            'index_2_cate' => $index_2_cate,
            'index_3'      => $index_3,
            'index_3_cate' => $index_3_cate,
            'nav_index'=>true,
        ];
        if(isMobile()){
            return view('mobile.home',$assign);
        }else{
            return view('home.home',$assign);
        }
    }
    public function search(Request $request){
        //搜索
        $cate_id = [-1];
        $cate = ArticleCategory::whereIn("template",["news","case"])->get();
        foreach($cate as $v){
            $cate_id[] = $v['id'];
        }
        $article_list = Article::ArticleList([
            'cate_id_in'=>$cate_id,
            'paginate'=>6,
            'keyword'=>$request['keyword'],
        ]);

        $assign = [
            'article_list'=>$article_list,
        ];
        if(isMobile()){
            return view('mobile.article.news',$assign);
        }else{
            return view('home.article.news',$assign);
        }
    }
}
