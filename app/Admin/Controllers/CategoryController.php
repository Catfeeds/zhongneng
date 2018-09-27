<?php

namespace App\Admin\Controllers;

use App\Models\Category;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
class CategoryController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index(Request $request)
    {
        return Admin::content(function (Content $content) use($request){

            $content->header('分类');
            $content->description('分类');

            $content->body($this->grid($request['type']));
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit(Request $request,$id)
    {
        return Admin::content(function (Content $content) use ($id,$request) {
            $content->header('分类');
            $content->description('分类');
            $content->body($this->form($request['type'])->edit($id));
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

            $content->header('分类');
            $content->description('分类');

            $content->body($this->form($request['type']));
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid($type=0)
    {
        // return Admin::grid(Category::class, function (Grid $grid) {
        //     $grid->id('ID')->sortable();

        //     $grid->created_at();
        //     $grid->updated_at();
        //     $grid->actions(function ($actions) {
        //         $actions->append('<a href=""><i class="fa fa-eye"></i></a>');
        //     });
        // });
        return Category::tree(function ($tree) use($type){
            $tree->query(function ($model) use($type){
                return $model->where('type',$type);
            });
            $tree->urlCreateButton('/admin/category/create?type='.$type);//修改添加按钮链接
            $tree->branch(function ($branch) use ($type){
                // $src = config('admin.upload.host') . '/' . $branch['logo'] ;
                // $logo = "<img src='$src' style='max-width:30px;max-height:30px' class='img'/>";
                // return "{$branch['id']} - {$branch['title']} ";
                return <<<EOT
              {$branch['id']} - {$branch['title']} 
              <span class="pull-right dd-nodrag">
                  <a href="/admin/category/{$branch['id']}/edit?type={$type}"><i class="fa fa-edit"></i></a>
                  <a href="javascript:void(0);" data-id="{$branch['id']}" class="tree_branch_delete"><i class="fa fa-trash"></i></a>
              </span>
EOT;
            });
        });
        // return Category::tree();
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($type=0)
    {
        return Admin::form(Category::class, function (Form $form) use ($type){

            // $form->display('id', 'ID');

            $form->tools(function (Form\Tools $tools) {
                // 去掉跳转列表按钮
                $tools->disableListButton();
            });

            $form->text('title', '名称')->rules('required');
            // $form->text('url', '链接');
            $form->hidden('type','分类')->value($type);

            $category_options[0] = '顶级';
            $category = Category::orderBy('order',"ASC")->where('type',$type)->get()->toarray();
            $category_options += optionsDate(getTree($category));

            $form->select('parent_id','所属')->options($category_options);
            // $states = [
            //     'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            //     'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            // ];
            // $form->switch('is_blank','新窗口')->states($states);
            // if($type==3){
              // $form->image('ico','图标')->move('/uploads/ico/'.date('Ymd'))->uniqueName();
            // }
            
            $form->saved(function (Form $form) {
                // \Cache::forget('Category'.$form->type);
                admin_toastr(trans('admin.update_succeeded'));
                return redirect('/admin/category?type='.$form->type);
            });
            // $form->display('created_at', '创建日期');
            // $form->display('updated_at', '更新日期');
        });
    }
}
