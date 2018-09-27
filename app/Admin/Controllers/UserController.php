<?php

namespace App\Admin\Controllers;

use App\Models\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Admin\Extensions\UserExcel;
class UserController extends Controller
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

            $content->header('会员');
            $content->description('会员');

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

            $content->header('会员');
            $content->description('会员');

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

            $content->header('会员');
            $content->description('会员');

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
        return Admin::grid(User::class, function (Grid $grid) {
            $grid->tools(function ($tools) {//禁止批量删除
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });
            $grid->actions(function ($actions) {
                $actions->disableDelete();//关闭删除按钮
                // $actions->disableEdit();//关闭修改按钮
                // $actions->disableView();//关闭查看按钮
            });
            $grid->disableCreateButton();//禁止创建按钮
            $grid->exporter(new UserExcel());
            // $grid->disableExport();//禁用导出
            $grid->model()->orderBy('created_at','DESC');
            $grid->id('ID')->sortable();
            $grid->column('name',"会员帐号");
            $grid->column('phone',"手机号码");
            $grid->column('email',"邮箱");

            $states = [
                'on'  => ['value' => 1, 'text' => '开启', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '禁用', 'color' => 'danger'],
            ];
            $grid->column('status','状态')->switch($states);

            // $grid->column('grade',"会员等级")->display(function($grade){
            //     if($grade==2){
            //         return '<span class="badge bg-red">'.trans('home.user.grade.'.$grade).'</span>';
            //     }else{
            //         return '<span class="badge bg-gray">'.trans('home.user.grade.'.$grade).'</span>';
            //     }
            // });
            $grid->column('created_at',"注册日期")->sortable();

            $grid->filter(function ($filter) {
                // $filter->where(function($query){
                //     if(!empty($this->input)){
                //         $query->orWhere('name','like',"%".$this->input."%")->orWhere('phone','like',"%".$this->input."%");
                //     }
                // },'会员账号');
                $filter->like('name','帐号');
                $filter->like('phone','手机号码');
                $filter->like('email','邮箱');
                
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(){
        return Admin::form(User::class, function (Form $form) {
            // $form->image('pic','头像')->move('/uploads/user/'.date('Ymd'))->uniqueName();

            // $form->text('name', '帐号')->rules(function ($form) {
            //     // 如果不是编辑状态，则添加字段唯一验证
            //     return [
            //         'required',
            //         Rule::unique('users')->ignore($form->model()->id),
            //     ];
            // });
            // $form->text('phone', '手机号码')->rules(function ($form) {
            //     // 如果不是编辑状态，则添加字段唯一验证
            //     return [
            //         'required',
            //         'phone',
            //         Rule::unique('users')->ignore($form->model()->id),
            //     ];
            // });
            // $form->text('email', '邮箱')->rules(function ($form) {
            //     // 如果不是编辑状态，则添加字段唯一验证
            //     return [
            //         'required',
            //         'email',
            //         Rule::unique('users')->ignore($form->model()->id),
            //     ];
            // });
            $form->display('name', '帐号');
            $form->display('phone', '手机号码');
            $form->display('email', '邮箱');
            $form->password('password', '密码')->rules(function ($form) {
                // 如果不是编辑状态，则添加字段唯一验证
                if (!$id = $form->model()->id) {
                    return 'required|min:6|max:25';
                }
            });
            
            $states = [
                'on'  => ['value' => 1, 'text' => '开启', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '禁用', 'color' => 'danger'],
            ];
            $form->switch('status','状态')->states($states);



            // $form->display('grade', '会员等级')->with(function ($grade) {
            //     if(!isset($grade)){
            //         $grade = 1;
            //     }
            //     return trans('home.user.grade.'.$grade);
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
                $arr->pic = Image($arr->pic,100,100,"uploads/user/".date("Ymd")."/");
                if(strtotime($arr->grade_end)<time()){
                    $arr->grade = 1;
                }else{
                    $arr->grade = 2;
                }
            });
        });
    }
}
