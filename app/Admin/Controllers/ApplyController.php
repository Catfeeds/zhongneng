<?php

namespace App\Admin\Controllers;

use App\Models\Apply,App\Models\ArticleCategory;
use DB;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use App\Admin\Extensions\ApplyExcel;
use Maatwebsite\Excel\Facades\Excel;

class ApplyController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content){
            $content->header('活动报名');
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
            $content->header('活动报名');
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
            $content->header('活动报名');
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

        return Admin::grid(Apply::class, function (Grid $grid) use ($request){

            // $grid->disableExport();//禁止导出
            $grid->disableFilter();//禁止筛选
            $grid->disableCreateButton();//禁止创建按钮
            $grid->disableActions();//禁止操作列
            $grid->tools(function ($tools) {//禁止批量删除
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
                $tools->append('<div class="btn-group upload_btn pull-right" style="margin-right: 10px">
                                    <form method="post" action="'.url("admin/apply-upload").'" enctype="multipart/form-data">
                                        <div class="btn btn-sm btn-twitter">
                                            <i class="fa fa-upload"></i> 导入 
                                            <input type="file" name="upload_file" class="upload_file" >
                                            <input type="hidden" name="activity_id" value="'.$_GET['activity_id'].'">
                                            <input type="hidden" name="_token" value="'.csrf_token().'">
                                        </div>
                                    </form>
                                </div>');
            });

            $grid->exporter(new ApplyExcel());
            //默认排序
            $grid->model()->orderBy('created_at','DESC')->orderBy('id','DESC');
            $grid->id('ID')->sortable();
            $grid->column('name',"姓名");
            $grid->column('phone',"手机号码");
            // $grid->column('sex',"性别")->display(function($grade){
            //     if($grade==1){
            //         return '男';
            //     }else{
            //         return '女';
            //     }
            // });
            $grid->column('email',"邮箱");
            $grid->column('gongsi',"公司");
            $grid->ActivityTo()->title('活动');

            $states = [
                'on'  => ['value' => 1, 'text' => '处理', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '未处理', 'color' => 'danger'],
            ];
            $grid->column('is_read',"状态")->switch($states);

            $grid->column('created_at',"提交时间")->sortable();

            $grid->filter(function ($filter) {
                $filter->equal('activity_id','活动')->select();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Apply::class, function (Form $form) use ($cate_id){
            $form->display('name', '姓名');
            $form->display('phone', '手机号码');
            $form->display('sex',"性别")->with(function($value){
                if($value==1){
                    return '男';
                }else{
                    return '女';
                }
            });
            $form->display('age', '年龄');
            $form->display('income', '月收入');
            $form->display('fine_time', '最佳致电时间');
            $states = [
                'on'  => ['value' => 1, 'text' => '处理', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => '未处理', 'color' => 'danger'],
            ];
            $form->switch('is_read','状态')->states($states);
            // $form->display('years', '学画时间')->with(function ($value) {
            //     switch ($value) {
            //         case '1':
            //             return '半年';
            //             break;
            //         case '2':
            //             return '半年至一年';
            //             break;
            //         case '3':
            //             return '一年以上';
            //             break;
            //     }
            // });
            // $form->display('cate_id', '意向班级')->with(function ($value) {
            //     if($value>0){
            //         $cate_info = ArticleCategory::find($value);
            //         return $cate_info['title'];
            //     }else{
            //         return "无";
            //     }
            // });
            
        });
    }
    public function apply_upload(Request $request){
        Excel::load($request->upload_file, function($reader) use($request){
            $data = $reader->all();
            $arr = array();
            foreach($data as $v){
                if(isset($v['姓名'])&&isset($v['手机号码'])&&isset($v['邮箱'])&&isset($v['公司'])&&isset($v['状态'])&&isset($v['提交时间'])){
                    $is_read = $v['状态']=='处理'?1:2;
                    $arr[] = [
                        'name'=>$v['姓名'],
                        'phone'=>$v['手机号码'],
                        'email'=>$v['邮箱'],
                        'gongsi'=>$v['公司'],
                        'is_read'=>$is_read,
                        'created_at'=>$v['提交时间'],
                        'activity_id'=>$request->activity_id,
                    ];
                }
            }
            if(!empty($arr)){
                DB::table('apply')->insert($arr);
            }
        });
        admin_toastr(trans('admin.update_succeeded'));
        return redirect()->back();
    }
}
