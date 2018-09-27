<?php

namespace App\Admin\Controllers;

use App\Models\Collection,App\Models\User,App\Models\Article;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class CollectionController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('收藏记录');
            $content->description('收藏记录');

            $content->body($this->grid());
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

            $content->header('收藏记录');
            $content->description('收藏记录');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('收藏记录');
            $content->description('收藏记录');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Collection::class, function (Grid $grid) {
            $grid->disableExport();//禁止导出
            // $grid->disableFilter();//禁止筛选
            $grid->disableCreateButton();//禁止创建按钮
            $grid->actions(function ($actions) {
                // $actions->disableDelete();
                $actions->disableEdit();
            });

            


            // $grid->disableActions();//禁止操作列
            // $grid->tools(function ($tools) {//禁止批量删除
            //     $tools->batch(function ($batch) {
            //         $batch->disableDelete();
            //     });
            // });

            $grid->disableExport();
            $grid->model()->orderBy('updated_at','DESC');
            $grid->id('ID')->sortable();
            $grid->UserTo()->name('会员');

            $grid->column('type','资料名称')->display(function($type) {
                switch ($type) {
                    case '2':
                        return $this->ActivityTo->title;
                        break;
                    case '3':
                        return $this->ArticleCategoryTo->title;
                        break;
                    default:
                        return $this->ArticleTo->title;
                        break;
                }
                
            });
            // $grid->column('ArticleTo.title',"资料名称");
            // $grid->column('ArticleTo.ArticleCategoryTo.title',"所属类别");
            // $grid->ArticleTo()->title()->display(function($article){
            //     // return 123123;
            //     dd($article);
            //     // return $article->ArticleCategoryTo()->title();
            // });
            
            // $grid->column('email',"邮箱");
            // $grid->column('grade',"收藏记录等级")->display(function($grade){
            //     if($grade==2){
            //         return '<span class="badge bg-red">'.trans('home.Collection.grade.'.$grade).'</span>';
            //     }else{
            //         return '<span class="badge bg-gray">'.trans('home.Collection.grade.'.$grade).'</span>';
            //     }
            // });
            $grid->column('updated_at',"收藏时间")->sortable();

            $grid->filter(function ($filter) {
                // $filter->where(function($query){
                //     if(!empty($this->input)){
                //         $user = User::where('name','like',"%".$this->input."%")->get();
                //         $query->orWhere('name','like',"%".$this->input."%")->orWhere('phone','like',"%".$this->input."%");
                //     }
                // },'会员');
                $filter->where(function($query){
                    if(!empty($this->input)){
                        $user_id_arr = [-1];
                        $user = User::Where('name','like',"%".$this->input."%")->get();
                        foreach($user as $v){
                            $user_id_arr[] = $v['id'];
                        }
                        $query->whereIn('user_id',$user_id_arr);
                    }
                },'会员');
                // $filter->where(function($query){
                //     if(!empty($this->input)){
                //         $article_id_arr = [-1];
                //         $article = Article::Where('title','like',"%".$this->input."%")->get();
                //         foreach($article as $v){
                //             $article_id_arr[] = $v['id'];
                //         }
                //         $query->whereIn('article_id',$article_id_arr);
                //     }
                // },'资料名称');
                // $filter->like('name','帐号');
                // $filter->like('phone','手机号码');
                // $filter->like('email','邮箱');
                
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(){
        return Admin::form(Collection::class, function (Form $form) {
            // $form->image('pic','头像')->move('/uploads/Collection/'.date('Ymd'))->uniqueName();

            $form->text('name', '帐号')->rules(function ($form) {
                // 如果不是编辑状态，则添加字段唯一验证
                return [
                    'required',
                    Rule::unique('Collections')->ignore($form->model()->id),
                ];
            });
            $form->text('phone', '手机号码')->rules(function ($form) {
                // 如果不是编辑状态，则添加字段唯一验证
                return [
                    'required',
                    'phone',
                    Rule::unique('Collections')->ignore($form->model()->id),
                ];
            });
            $form->text('email', '邮箱')->rules(function ($form) {
                // 如果不是编辑状态，则添加字段唯一验证
                return [
                    'required',
                    'email',
                    Rule::unique('Collections')->ignore($form->model()->id),
                ];
            });
            $form->password('password', '密码')->rules(function ($form) {
                // 如果不是编辑状态，则添加字段唯一验证
                if (!$id = $form->model()->id) {
                    return 'required|min:6|max:25';
                }
            });

            // $form->display('grade', '收藏记录等级')->with(function ($grade) {
            //     if(!isset($grade)){
            //         $grade = 1;
            //     }
            //     return trans('home.Collection.grade.'.$grade);
            // });

            // $form->datetime('grade_end','Vip结束时间')->format('YYYY-MM-DD HH:mm:ss');

            // $form->datetime('grade_end','Vip结束时间')->format('YYYY-MM-DD HH:mm:ss')->with(function($grade_end){
            //     return date('Y-m-d H:i:s',$grade_end);
            // });

            $form->hidden('id','ID');

            // $form->display('created_at', 'Created At');
            // $form->display('updated_at', 'Updated At');

            $form->saving(function($arr){
                // admin_toastr('laravel-admin 提示','success');
                $password = $arr->password;
                if(isset($password)&&!empty($password)){
                    $arr->password = Hash::make($password);
                }
                $arr->pic = Image($arr->pic,100,100,"uploads/Collection/".date("Ymd")."/");
                if(strtotime($arr->grade_end)<time()){
                    $arr->grade = 1;
                }else{
                    $arr->grade = 2;
                }
            });
        });
    }
}
