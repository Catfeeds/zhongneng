<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route,DB;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Routing\Router;
use App\Models\Apply;
class ApplyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
        // $this->middleware('auth');
    }

    /**
     * 申请提交
     *
     * @return \Illuminate\Http\Response
     */
    public function apply_save(Request $request){
        $vail = [
            'name.*'    => 'required',
            'phone.*'   => 'required|phone',
            'email.*'   => 'required|email',
            'code'    => 'sometimes|required|captcha',
        ];
        if($request['gongsi_type']==2){
            $vail["gongsi.*"] = 'required';
        }else{
            $vail["gongsi.0"] = 'required';
        }
        $this->validate($request,$vail,[],[
            'name.*'=>"姓名",
            'phone.*'=>"手机号码",
            'code'=>"验证码",
            'email.*'=>"邮箱",
            'gongsi.*'=>"公司",
            'gongsi.0'=>"公司",
        ]);

        // $info = Apply::ApplySave([
        //     'name'=>$request['name'],
        //     'phone'=>$request['phone'],
        //     'sex'=>$request['sex'],
        //     'age'=>$request['age'],
        //     'income'=>$request['income'],
        //     'fine_time'=>$request['fine_time'],
        // ]);

        // // $mail = Mail::send("emails.emails",['info'=>$info],function ($message) use ($info) {
        // //     $message->to(['75531120@qq.com','715783591@qq.com'])->subject("加盟申请");
        // // });
        $add = [];
        foreach($request['name'] as $k=>$v){
            $arr = [];
            if($request['gongsi_type']==2){
                $arr['gongsi'] = $request['gongsi'][$k];
            }else{
                $arr['gongsi'] = $request['gongsi'][0];
            }
            $arr['name'] = $request['name'][$k];
            $arr['phone'] = $request['phone'][$k];
            $arr['email'] = $request['email'][$k];
            $arr['activity_id'] = $request['activity_id'];
            $arr['created_at'] = date('Y-m-d H:i:s');
            $arr['updated_at'] = date('Y-m-d H:i:s');
            $add[] = $arr;

        }
        DB::table('apply')->insert($add);

        return render("提交成功",200,$info);
    }
}
