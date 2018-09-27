<?php

namespace Encore\Admin\Controllers;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Auth\Database\OperationLog;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;

class LogController extends Controller
{
    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header(trans('admin.operation_log'));
            $content->description(trans('admin.list'));

            $grid = Admin::grid(OperationLog::class, function (Grid $grid) {
                $grid->model()->where('method',"<>","GET")->orderBy('id', 'DESC');

                $grid->disableExport();//禁止导出

                $grid->id('ID')->sortable();
                $grid->user()->name('管理员');
                $grid->method("方法")->display(function ($method) {
                    $color = array_get(OperationLog::$methodColors, $method, 'grey');
                    return "<span class=\"badge bg-$color\">".trans('admin.log.method.'.$method)."</span>";
                });
                $grid->path("请求")->label('info')->display(function($data){
                    return str_replace(trans('admin.log.url'),trans('admin.log.title'),$data);
                });
                $grid->ip()->label('primary');
                $grid->input("数据")->display(function ($input) {
                    $input = json_decode($input, true);
                    $input = array_except($input, ['_pjax', '_token', '_method', '_previous_']);
                    if (empty($input)) {
                        return '<code>{}</code>';
                    }

                    return '<pre>'.json_encode($input, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE).'</pre>';
                });

                $grid->created_at(trans('admin.created_at'));

                $grid->actions(function (Grid\Displayers\Actions $actions) {
                    $actions->disableEdit();
                });

                $grid->disableCreation();

                $grid->filter(function ($filter) {
                    $filter->equal('user_id','管理员')->select(Administrator::all()->pluck('name', 'id'));
                    $filter->equal('method')->select(trans('admin.log.method'));
                    $filter->like('请求');
                    $filter->equal('ip');
                });
            });

            $content->body($grid);
        });
    }

    public function destroy($id)
    {
        $ids = explode(',', $id);

        if (OperationLog::destroy(array_filter($ids))) {
            return response()->json([
                'status'  => true,
                'message' => trans('admin.delete_succeeded'),
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => trans('admin.delete_failed'),
            ]);
        }
    }
}
