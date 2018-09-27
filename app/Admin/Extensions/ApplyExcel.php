<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;

class ApplyExcel extends AbstractExporter{
    public function export(){

        $data = $this->getData();
        $title = $data[0]['activity_to']['title']?$data[0]['activity_to']['title']."报名列表":'活动报名列表';
        Excel::create($title, function($excel) use ($title,$data){
            $excel->sheet($title, function($sheet) use ($data){

                // 这段逻辑是从表格数据中取出需要导出的字段
                $th[] = ["ID",'姓名','手机号码','邮箱','公司','活动','状态','提交时间'];
                $sheet->rows($th);
                $rows = collect($data)->map(function ($item) {
                    $item['is_read'] = $item['is_read']==1?"处理":"未处理";
                    return [
                        $item['id'],
                        $item['name'],
                        $item['phone'],
                        $item['email'],
                        $item['gongsi'],
                        $item['activity_to']['title'],
                        $item['is_read'],
                        $item['created_at'],
                    ];
                });
                $sheet->rows($rows);
            });
        })->export('xls');
    }
}

?>