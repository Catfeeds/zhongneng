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
