<?php

namespace App\Admin\Controllers;

use App\Models\ArticleCategory,App\Models\Article,App\Models\Region;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
class ArticleController extends Controller
{
    use ModelForm;

    public function iframe(){
    	return Admin::content(function (Content $content) use ($request){
    	    // $content->header('文章');
    	    // $content->description('文章');
    	    $ArticleCategory = ArticleCategory::orderBy("order","ASC")->orderBy("id","ASC")->get()->toArray();
	        foreach($ArticleCategory as $k=>&$v){
	          $v['target'] = "box-container";
	          $v['url'] = URL('admin/article')."?no_header=true&no_sidebar=true&no_footer=true&collapse=true&cate_id=".$v['id'];
	        }
    	    $assign = [
    	    	'ArticleCategory'=>json_encode($ArticleCategory,JSON_UNESCAPED_UNICODE),
    	    ];
    	    $content->body(view('admin.article',$assign));
    	});

    }
    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Request $request)
    {
       
        return Admin::content(function (Content $content) use ($request){

            // $content->header('文章');
            // $content->description('文章');

            $content->body($this->grid($request));
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            // $content->header('文章');
            // $content->description('文章');
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create(Request $request)
    {
        return Admin::content(function (Content $content) use ($request){

            // $content->header('文章');
            // $content->description('文章');

            $content->body($this->form($request));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid($request='')
    {
        return Admin::grid(Article::class, function (Grid $grid) use ($request){
            $grid->disableExport();
            $grid->paginate(15);
            //默认排序
            $grid->model()->orderBy('sort','DESC')->orderBy('add_time','DESC');

            $grid->id('ID')->sortable();
            $grid->column('title',"标题");
            
            $grid->ArticleCategoryTo()->title('分类');
            // $grid->img("图片")->image();
            $states = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            ];
            $grid->is_top('推荐')->switch($states);
            $grid->add_time('创建日期')->sortable();
            $grid->sort('排序')->sortable();

            
            $grid->actions(function ($actions) {
                $row = $actions->row;
                // if($row['article_category_to']['template']=='product'){
                //     $actions->prepend('<a href="/admin/more-image?cate_id=1&more_id='.$row['id'].'"><i class="fa fa-image"></i></a>');
                //     // $actions->prepend('<a href="/admin/more-video?cate_id=1&more_id='.$row['id'].'"><i class="fa fa-file-video-o"></i></a>');
                // }
                // if($row['article_category_to']['template']=='activity'){
                //     $actions->prepend('<a href="/admin/more-article?cate_id=1&more_id='.$row['id'].'"> 嘉宾 </a>');
                //     $actions->prepend('<a href="/admin/more-article?cate_id=2&more_id='.$row['id'].'"> 合作伙伴 </a>');
                //     // $actions->prepend('<a href="/admin/more-video?cate_id=1&more_id='.$row['id'].'"><i class="fa fa-file-video-o"></i></a>');
                // }
            });
            if($request['cate_id']>0){
                $grid->urlCreateButton('/admin/article/create?cate_id='.$request['cate_id']);//修改添加按钮链接
            }
            //筛选
            $grid->filter(function ($filter) {
                $filter->like('title','标题');
                $filter->equal('cate_id','分类')->select(ArticleCategory::selectOptions(['top'=>false]));
                $filter->equal('is_top','推荐')->radio([
                    ''   => '全部',
                    0    => '否',
                    1    => '是',
                ]);
            });

            // $grid->created_at();
            // $grid->updated_at();
            
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($request='')
    {
        return Admin::form(Article::class, function (Form $form) use ($request){

            $article_info = ArticleCategory::find($request['cate_id']);

        	$form->tools(function (Form\Tools $tools) {
        	    // 去掉跳转列表按钮
        	    $tools->disableListButton();
        	});
        	
            $form->hidden('id','ID');
            $form->text('title','标题')->rules('required');
            // $form->text('title2','副标题');
            // $form->file('file','资料上传')->move('/uploads/article/'.date('Ymd'));
            // $form->text('en_title','英文标题');

            $cate = ArticleCategory::orderBy('order',"ASC")->orderBy('id',"ASC")->get()->toarray();
            foreach($cate as &$v){
                $width = trans('template.template_width.'.$v['template'])>0?trans('template.template_width.'.$v['template']):'0';
                $height = trans('template.template_height.'.$v['template'])>0?trans('template.template_height.'.$v['template']):'0';
                $v['title'] .= "(图片尺寸:".$width."X".$height.")";
            }
            $cate_options = optionsDate(getTree($cate));

            $form->select('cate_id','所属分类')->options($cate_options)->rules('required')->default($request['cate_id']);
            $form->textarea('desc','简述')->rows(3);
            $form->editor('content','内容');
            $form->image('img','图片')->move('/uploads/article/'.date('Ymd'))->uniqueName();
            $form->text('alt','图片alt');
            // $form->image('img2','图片2')->move('/uploads/article/'.date('Ymd'))->uniqueName()->help('品牌架构图片量尺寸 71 X 71');
            // $form->text('alt2','图片2alt');
            // $form->currency('price','价格');
            // $form->text('url', '链接');
            $form->number('click','人气');
            $form->text('editor','来源')->default('中能电力');
            $form->textarea('desc2','工程概况')->rows(3);
            $form->text('address','项目地点');
            // $form->text('tag','标签')->help('用作相关信息');
            $states = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            ];
            $form->switch('is_top','推荐')->states($states);
            $form->number('sort','排序')->default(50);
            $form->datetime('add_time','创建日期')->format('YYYY-MM-DD HH:mm:ss')->default(date('Y-m-d H:i:s'));
            $form->text('seo_title', 'seo title');
            $form->text('seo_keywords', 'seo keywords');
            $form->text('seo_description', 'seo description');
            // $form->text('job_title', '职称');
            // $form->text('video_text', '视频链接');
            // $form->file('video','视频')->move('/uploads/video/'.date('Ymd'))->uniqueName()->options(['maxFileSize'=>1024*10,'msgSizeTooLarge'=>'文件 "{name}" ({size} KB) 超出允许的最大上传大小 {maxSize} KB. 请重试上传！']);
            // $form->slider('video','视频')->options(['max' => 100, 'min' => 1, 'step' => 1, 'postfix' => 'years old']);


            // $form->html('', $label = '知识解答');
            // $form->divide();
            // $form->textarea('problem', '问题');
            // $form->textarea('reply', '回答');

            // $form->html('', $label = '招贤纳士');
            // $form->divide();
            // $form->text('work_place', '工作地点');
            // $form->text('recruitment_number', '招聘人数');
            // $form->text('department', '部门');
            // $form->text('working_years', '工作年限');
            // $form->text('education', '学历');

            // if($article_info['template']=='activity'){
                // $form->html('', $label = '活动');
                // $form->divide();
                // $form->text('address', '地址');
                // $form->textarea('desc2','参会指引')->rows(3);
                // $form->datetime('activity_time','活动日期')->format('YYYY-MM-DD HH:mm:ss')->default(date('Y-m-d H:i:s'));
                // $form->select('province','省份')->options(
                //     Region::province()->pluck('region_name','region_id')
                // )->load('city', '/admin/city');
                // $form->select('city','城市')->options(function ($region_id) {
                //     return Region::options($region_id);
                // });
                // $form->editor('content2','会议议程');

                // //首页新闻关联
                // $news_related_list = ArticleCategory::select("article.id","article.title")->where("template","news")->leftjoin("article","article.cate_id","=","article_category.id")->get();
                // $news_related_list = optionsDate($news_related_list);
                // $form->multipleSelect('news_related',"专题报道")->options($news_related_list);

            // }

            $form->saving(function (Form $form) {
                if($form->video){
                    $form->video = upload_file($form->video);
                    $form->video_text = $form->video;
                }else{
                    $form->video = $form->video_text;
                }

                $caregory_info = ArticleCategory::find($form->cate_id);
                $width = trans('template.template_width.'.$caregory_info['template'])>0?trans('template.template_width.'.$caregory_info['template']):null;
                $height = trans('template.template_height.'.$caregory_info['template'])>0?trans('template.template_height.'.$caregory_info['template']):null;
                if($width>0||$height>0){
                    $form->img = Image($form->img,$width,$height,"uploads/article/".date("Ymd")."/");
                }
                if($form->file){
                    $form->file = upload_file($form->file,'/uploads/course_ware/'.date('Ymd')."/",$form->file->getClientOriginalName());
                }
            });
            $form->saved(function (Form $form) {
                //链接推送
                baidu_url(env('APP_URL').'/show-'.$form->cate_id.'-'.$form->id.'-1.html');
                admin_toastr(trans('admin.update_succeeded'));
                return redirect('/admin/article?cate_id='.$form->cate_id);
            });
            // $form->setAction('/admin/article-save');//提交地址

            // 设置日期格式，更多格式参考http://momentjs.com/docs/#/displaying/format/
            // $form->display('updated_at', '更新日期');
        });
    }

    // public function article_save(Request $request){
    //     $this->validate($request,[
    //         'title' => 'required',
    //         'cate_id' => 'required',
    //     ],[],[
    //         'title'=>'标题',
    //         'cate_id'=>'所属分类',
    //     ]);
    //     //文章保存
    //     Article::ArticleSave($request->all());
    //     admin_toastr(trans('admin.update_succeeded'));
    //     return redirect('/admin/article');
    // }
}
