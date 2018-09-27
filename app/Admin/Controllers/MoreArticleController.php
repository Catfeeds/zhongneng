<?php

namespace App\Admin\Controllers;

use App\Models\MoreArticle;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
class MoreArticleController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Request $request)
    {
        return Admin::content(function (Content $content) use ($request){
            $content->header('图片');
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
            $content->header('图片');
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
            $content->header('图片');
            $content->body($this->form($request));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid($request=array())
    {

        return Admin::grid(MoreArticle::class, function (Grid $grid) use ($request){
            $grid->disableExport();//禁止导出
            $grid->disableFilter();//禁止筛选
            //默认排序
            $grid->model()->orderBy('order','DESC');
            $grid->id('ID')->sortable();
            $grid->column('title', '标题');
            // $grid->image("图片")->image();
            // $grid->column('video',"视频链接");
            
            $grid->column('order',"排序")->sortable();

            $grid->urlCreateButton('/admin/more-article/create?cate_id='.$request['cate_id'].'&more_id='.$request['more_id']);//修改添加按钮链接
            $grid->filter(function ($filter) {
                $filter->equal('cate_id','分类')->select();
                $filter->equal('more_id','分类')->select();
            });
        });

    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($request=array())
    {
        return Admin::form(MoreArticle::class, function (Form $form) use ($request){
            $form->tools(function (Form\Tools $tools) {
                // 去掉跳转列表按钮
                $tools->disableListButton();
            });
            $form->hidden('cate_id','分类')->value($request['cate_id']);
            $form->hidden('more_id','分类')->value($request['more_id']);

            $form->text('title', '标题');
            $form->number('order', '排序');
            // $form->text('video', '视频链接');
            $form->textarea('desc','描述')->rows(3);
            $form->image('image','图片')->move('/uploads/images/'.date('Ymd'))->uniqueName()->help('宾客图片尺寸255 X 255<br/>合作伙伴图片尺寸222 X 89');
            $form->file('file','资料上传')->move('/uploads/article/'.date('Ymd'));

            // $form->setAction('/admin/ads-image');//提交地址

            $form->saving(function (Form $form) {
                switch ($form->cate_id) {
                    case '1':
                        $width = 255;
                        $height = 255;
                        break;
                    case '2':
                        $width = 222;
                        $height = 89;
                        break;
                    default:
                        $width = null;
                        $height = null;
                        break;
                }
                $form->image = Image($form->image,$width,$height,"uploads/images/".date("Ymd")."/");

                if($form->file){
                    $form->file = upload_file($form->file,'/uploads/course_ware/'.date('Ymd')."/",$form->file->getClientOriginalName());
                }
            });
            $form->saved(function (Form $form) {
                admin_toastr(trans('admin.update_succeeded'));
                return redirect('/admin/more-article?cate_id='.$form->cate_id.'&more_id='.$form->more_id);
            });
        });
    }
}
