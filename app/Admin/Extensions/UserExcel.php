<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;

class UserExcel extends AbstractExporter{
    public function export(){
        Excel::create('会员', function($excel) {
            $excel->sheet('会员', function($sheet) {
                // 这段逻辑是从表格数据中取出需要导出的字段
                $title[] = ["ID",'用户名','手机号码','邮箱','注册时间','状态'];
                $sheet->rows($title);

                $rows = collect($this->getData())->map(function ($item) {
                    $item['status'] = $item['status']==1?"激活":"禁止";
                    // return array_only($item,['id','name','phone','email','created_at','status']);
                    return [
                        $item['id'],
                        $item['name'],
                        $item['phone'],
                        $item['email'],
                        $item['created_at'],
                        $item['status'],
                    ];
                });
                $sheet->rows($rows);
            });
        })->export('xls');
    }
}

?>