<?php

namespace App\Admin\Controllers;

use App\Models\Video,App\Models\VideoOrder,App\Models\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
class VideoOrderController extends Controller
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

            $content->header('课程购买记录');
            $content->description('课程购买记录');

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
            $content->header('课程购买记录');
            $content->description('课程购买记录');
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

            $content->header('课程购买记录');
            $content->description('课程购买记录');

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
        return Admin::grid(VideoOrder::class, function (Grid $grid) use ($request){

            $grid->disableCreateButton();//禁止创建按钮
            $grid->disableExport();
            $grid->paginate(15);
            //默认排序
            $grid->model()->where('status',2)->orderBy('pay_time','DESC');

            $grid->column('order_id',"ORDER ID");
            $grid->UserTo()->name('会员');
            $grid->VideoTo()->title('课程');
            $grid->column('pay_time',"购买日期")->sortable();
            $grid->column('price',"购买价格");
            $grid->column('order_no',"订单号");

            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();//关闭批量删除
                });
            });
            $grid->actions(function ($actions) {
                $actions->disableDelete();//关闭编辑
                $actions->disableEdit();//关闭删除
            });
            // $grid->actions(function ($actions) {
            //     $row = $actions->row;
            //     //课程按钮添加
            //     $actions->prepend('<a href="/admin/VideoOrder-course?VideoOrder_id='.$row['VideoOrder_id'].'"><i class="fa fa-file-VideoOrder-o"></i></a>');
            // });
            // if($request['cate_id']>0){
            //     $grid->urlCreateButton('/admin/VideoOrder/create?cate_id='.$request['cate_id']);//修改添加按钮链接
            // }
            //筛选
            $grid->filter(function ($filter) {
                $filter->like('order_no',"订单号");
                $filter->where(function($query){
                    if(!empty($this->input)){
                        $user_id_arr = [-1];
                        $user = User::orWhere('name','like',"%".$this->input."%")->orWhere('phone','like',"%".$this->input."%")->get();
                        foreach($user as $v){
                            $user_id_arr[] = $v['id'];
                        }
                        $query->whereIn('user_id',$user_id_arr);
                    }
                },'会员名称或手机号码');
                $filter->where(function($query){
                    if(!empty($this->input)){
                        $video_id_arr = [-1];
                        $video = Video::orWhere('title','like',"%".$this->input."%")->get();
                        foreach($video as $v){
                            $video_id_arr[] = $v['id'];
                        }
                        $query->whereIn('video_id',$video_id_arr);
                    }
                },'课程');
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
        return Admin::form(VideoOrder::class, function (Form $form) use ($request){

        	// $form->tools(function (Form\Tools $tools) {
        	//     // 去掉跳转列表按钮
        	//     $tools->disableListButton();
        	// });
        	
            $form->hidden('VideoOrder_id','ID');
            $form->text('title','标题')->rules('required');
            // $form->text('en_title','英文标题');
            // $form->text('title2','副标题');

            $cate = Category::where('type',1)->orderBy('order',"ASC")->get()->toarray();
            // foreach($cate as &$v){
            //     $width = trans('template.template_width.'.$v['template'])>0?trans('template.template_width.'.$v['template']):0;
            //     $height = trans('template.template_height.'.$v['template'])>0?trans('template.template_height.'.$v['template']):0;
            //     $v['title'] .= "(".$width."*".$height.")";
            // }
            $cate_options = optionsDate(getTree($cate));
            $form->select('cate_id','所属分类')->options($cate_options)->rules('required')->default($request['cate_id']);

            $form->select('type','类型')->options(trans("home.VideoOrder.type"))->default(1);
            $form->image('img','图片')->move('/uploads/VideoOrder/'.date('Ymd'))->uniqueName();
            $form->text('alt','图片alt');
            $form->textarea('desc','描述')->rows(3);
            $form->editor('content','内容');
            $form->currency('price','价格');
            $form->currency('old_price','原价');
            $form->select('is_fee','收费情况')->options(['1'=>'全部收费','2'=>'vip免费','3'=>'全部免费'])->default(1);

            $form->text('seo_title', 'seo title');
            $form->text('seo_keywords', 'seo keywords');
            $form->text('seo_description', 'seo description');




            // $form->textarea('desc2','描述2')->rows(3);
            
            // $form->image('img2','图片2')->move('/uploads/article/'.date('Ymd'))->uniqueName();
            // $form->text('alt2','图片2alt');
            // // $form->number('click','访问量');
            // // $form->text('editor','来源')->default('萌货国际烘焙');
            // $states = [
            //     'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            //     'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
            // ];
            // $form->switch('is_top','推荐')->states($states);
            // $form->datetime('add_time','创建日期')->format('YYYY-MM-DD HH:mm:ss')->default(date('Y-m-d H:i:s'));
            
            // // $form->text('job_title', '职称');
            // $form->text('VideoOrder', '视频链接');
            // $form->text('url', '链接');

            // $form->html('', $label = '知识解答');
            // $form->divide();
            // $form->textarea('problem', '问题');
            // $form->textarea('reply', '回答');

            // $form->html('', $label = '招贤纳士');
            // $form->divide();
            // $form->text('work_place', '工作地点');
            // $form->text('department', '部门');
            // $form->text('working_years', '工作年限');
            // $form->text('education', '学历');
            // $form->text('recruitment_number', '招聘人数');

            // $form->html('', $label = '校区');
            // $form->divide();
            // $form->text('address', '地址');
            // $form->text('phone', '电话');
            // $form->text('trade_date', '营业日期');
            // $form->text('trade_time', '营业时间');

            // $form->select('province','省份')->options(
            //     Region::province()->pluck('region_name','region_id')
            // )->load('city', '/admin/city');
            // $form->select('city','城市')->options(function ($region_id) {
            //     return Region::options($region_id);
            // });


            $form->saving(function (Form $form) {
                // $caregory_info = Category::find($form->cate_id);
                // $width = trans('template.template_width.'.$caregory_info['template']);
                // $height = trans('template.template_height.'.$caregory_info['template']);
                // if($width>0||$height>0){
                    $form->img = Image($form->img,537,289,"uploads/VideoOrder/".date("Ymd")."/");
                // }
            });
            // $form->saved(function (Form $form) {
            //     //链接推送
            //     baidu_url(env('APP_URL').'/show-'.$form->cate_id.'-'.$form->id.'-1.html');
            // });
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
    //     //视频课程保存
    //     Article::ArticleSave($request->all());
    //     admin_toastr(trans('admin.update_succeeded'));
    //     return redirect('/admin/article');
    // }
}
