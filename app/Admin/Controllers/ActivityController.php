<?php

namespace App\Admin\Controllers;

use App\Models\Activity,App\Models\ArticleCategory,App\Models\Region;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
class ActivityController extends Controller
{
    use ModelForm;

    // public function iframe(){
    // 	return Admin::content(function (Content $content) use ($request){
    // 	    // $content->header('活动');
    // 	    // $content->description('活动');
    // 	    $ArticleCategory = ArticleCategory::orderBy("order","ASC")->get()->toArray();
	   //      foreach($ArticleCategory as $k=>&$v){
	   //        $v['target'] = "box-container";
	   //        $v['url'] = URL('admin/Activity')."?no_header=true&no_sidebar=true&no_footer=true&cate_id=".$v['id'];
	   //      }
    // 	    $assign = [
    // 	    	'ArticleCategory'=>json_encode($ArticleCategory,JSON_UNESCAPED_UNICODE),
    // 	    ];
    // 	    $content->body(view('admin.Activity',$assign));
    // 	});

    // }
    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Request $request)
    {
       
        return Admin::content(function (Content $content) use ($request){

            $content->header('活动');
            $content->description('活动');

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
            $content->header('活动');
            $content->description('活动');
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

            $content->header('活动');
            $content->description('活动');

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
        return Admin::grid(Activity::class, function (Grid $grid) use ($request){
            $grid->disableExport();
            $grid->paginate(15);
            //默认排序
            $grid->model()->orderBy('activity_time','DESC');

            $grid->id('ID')->sortable();
            $grid->column('title',"标题");
            
            // $grid->img("图片")->image();
            $states = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            ];
            $grid->is_top('推荐')->switch($states);
            $grid->activity_time('活动开始日期')->sortable();
            $grid->activity_time2('活动结束日期')->sortable();

            
            $grid->actions(function ($actions) {
                $row = $actions->row;
                $actions->prepend('<a href="/admin/more-image?cate_id=3&more_id='.$row['id'].'"><i class="fa fa-image"></i></a>');
                $actions->prepend('<a href="/admin/more-article?cate_id=1&more_id='.$row['id'].'"> 嘉宾 </a>');
                $actions->prepend('<a href="/admin/more-article?cate_id=2&more_id='.$row['id'].'"> 合作伙伴 </a>');
                $actions->prepend('<a href="/admin/apply?activity_id='.$row['id'].'"> 报名列表 </a>');
            });
            // if($request['cate_id']>0){
            //     $grid->urlCreateButton('/admin/Activity/create?cate_id='.$request['cate_id']);//修改添加按钮链接
            // }
            //筛选
            $grid->filter(function ($filter) {
                $filter->like('title','标题');
                // $filter->equal('cate_id','分类')->select(ArticleCategory::selectOptions(['top'=>false]));
                // $filter->equal('is_top','推荐')->radio([
                //     ''   => '全部',
                //     0    => '否',
                //     1    => '是',
                // ]);
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
        return Admin::form(Activity::class, function (Form $form) use ($request){

            // $Activity_info = ArticleCategory::find($request['cate_id']);

        	$form->tools(function (Form\Tools $tools) {
        	    // 去掉跳转列表按钮
        	    $tools->disableListButton();
        	});
        	
            $form->hidden('id','ID');
            $form->text('title','标题')->rules('required');
            $form->text('title2','副标题');
            $form->textarea('desc','描述')->rows(3);
            
            $states = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            ];
            $form->switch('is_top','推荐')->states($states);

            $states = [
                'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            ];
            $form->switch('is_apply','报名')->states($states);

            $form->editor('content','内容');
            $form->image('img','图片')->move('/uploads/Activity/'.date('Ymd'))->uniqueName()->help('图片尺寸377*158');
            $form->text('alt','图片alt');

            $form->text('seo_title','seo title');
            $form->text('seo_keywords','seo keywords');
            $form->text('seo_description','seo description');

            // $form->text('address', '地址');
            $form->textarea('desc2','参会指引')->rows(3);
            $form->image('img2','参会指引图片')->move('/uploads/Activity/'.date('Ymd'))->uniqueName()->help('图片尺寸680*310');
            $form->text('alt2','参会指引图片alt');
            $form->text('url', '外部报名链接');

            // $form->datetime('activity_time','活动日期')->format('YYYY-MM-DD HH:mm:ss')->default(date('Y-m-d H:i:s'));
            $form->datetimeRange('activity_time','activity_time2','活动日期');

            $form->select('province','省份')->options(
                Region::province()->pluck('region_name','region_id')
            )->load('city', '/admin/city');
            $form->select('city','城市')->options(function ($region_id) {
                return Region::options($region_id);
            });
            $form->editor('content2','会议议程');

            //首页新闻关联
            $news_related_list = ArticleCategory::select("article.id","article.title")->where("template","news")->leftjoin("article","article.cate_id","=","article_category.id")->get();
            $news_related_list = optionsDate($news_related_list);
            $form->multipleSelect('news_related',"专题报道")->options($news_related_list);
            // }

            $form->image('banner','banner图')->move('/uploads/Activity/'.date('Ymd'))->uniqueName()->help('图片尺寸1920*600');
            $form->image('mobile_banner','手机banner图')->move('/uploads/Activity/'.date('Ymd'))->uniqueName()->help('图片量尺寸750*545');
            $form->image('ewm','二维码')->move('/uploads/article/'.date('Ymd'))->uniqueName()->help('图片尺寸 200 X 200');

            $form->saving(function (Form $form) {
                if($form->video){
                    $form->video = upload_file($form->video);
                    $form->video_text = $form->video;
                }else{
                    $form->video = $form->video_text;
                }

                // $caregory_info = ArticleCategory::find($form->cate_id);
                $form->img = Image($form->img,377,158,"uploads/Activity/".date("Ymd")."/");
                $form->img2 = Image($form->img2,680,310,"uploads/Activity/".date("Ymd")."/");
                $form->banner = Image($form->banner,1920,600,"uploads/Activity/".date("Ymd")."/");
                $form->mobile_banner = Image($form->mobile_banner,750,545,"uploads/Activity/".date("Ymd")."/");
                $form->ewm = Image($form->ewm,200,200,"uploads/Activity/".date("Ymd")."/");
            });
            $form->saved(function (Form $form) {
                //链接推送
                baidu_url(env('APP_URL').'/show-'.$form->cate_id.'-'.$form->id.'-1.html');
                admin_toastr(trans('admin.update_succeeded'));
                // return redirect('/admin/Activity?cate_id='.$form->cate_id);
            });
            // $form->setAction('/admin/Activity-save');//提交地址

            // 设置日期格式，更多格式参考http://momentjs.com/docs/#/displaying/format/
            // $form->display('updated_at', '更新日期');
        });
    }

    // public function Activity_save(Request $request){
    //     $this->validate($request,[
    //         'title' => 'required',
    //         'cate_id' => 'required',
    //     ],[],[
    //         'title'=>'标题',
    //         'cate_id'=>'所属分类',
    //     ]);
    //     //活动保存
    //     Activity::ActivitySave($request->all());
    //     admin_toastr(trans('admin.update_succeeded'));
    //     return redirect('/admin/Activity');
    // }
}
