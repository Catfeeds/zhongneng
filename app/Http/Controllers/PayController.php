<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Validator,Auth;
use App\Models\PayLog,App\Models\VideoOrder,App\Models\VipOrder;
use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;
class PayController extends Controller
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
    protected function wx_config(){
        return $wx_config = [
            // 'appid' => 'wxb3fxxxxxxxxxxx', // APP APPID
            'app_id' => 'wx3e2f2acc04f5e83e', // 公众号 APPID
            // 'miniapp_id' => 'wxb3fxxxxxxxxxxx', // 小程序 APPID
            'app_secret' => '13540943de904a7d513069b2bc36428f',//公众号AppSecret
            'mch_id' => '1509537671',//商户号
            'key' => 'dataimagepngbase64iVBORw0KGgklia',//商户密钥
            'notify_url'  => URL('wechat_notify_url'),
            'cert_client' => 'wxzs/apiclient_cert.pem', // optional, 退款，红包等情况时需要用到
            'cert_key' => 'wxzs/apiclient_key.pem',// optional, 退款，红包等情况时需要用到
            'log' => [ // optional
                'file' => './logs/wechat.log',
                'level' => 'debug'
            ],
        ];
    }
    public function pay(Request $request){
        //支付发起
        $this->validate($request,[
            'id'    => 'required',
        ],[],[
            'id'=>"订单",
        ]);
        if(!$request['id']>0){
            return redirect("/");
        }
        $id = $request['id'];
        $user_info = Auth::user();
        $pay_log = PayLog::where('user_id',$user_info['id'])->where("id",$id)->where("pay_status",1)->first();
        if(!$pay_log){
            return redirect("/");
        }
        if($pay_log['pay_type']==1){
            //微信支付流程
            if(isMobile()){
                $wx_config = $this->wx_config();
                if(strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')!==false){
                    if(!session()->has('pay_open_id')){
                        if(!isset($request['code'])){
                            $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$wx_config['app_id']."&redirect_uri=".url('').$request->getRequestUri()."&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
                            header("Location:".$url);
                            exit;
                        }else{
                            $code=$request['code'];
                            $get_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$wx_config['app_id']."&secret=".$wx_config['app_secret']."&code=".$code."&grant_type=authorization_code";
                            $ch = curl_init();
                            curl_setopt($ch,CURLOPT_URL,$get_token_url);
                            curl_setopt($ch,CURLOPT_HEADER,0);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
                            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                            $res = curl_exec($ch);
                            curl_close($ch);
                            $json_obj = json_decode($res,true);
                            $open_id=$json_obj['openid'];
                            session(['pay_open_id'=>$open_id]);
                        }
                    }
                }
                $order = [
                    'out_trade_no' => $pay_log['order_no'],
                    'body'         => '订单支付',
                    'total_fee'    => round($pay_log['price']*100),
                    'openid'      => session("pay_open_id"),
                ];
                $Pay = Pay::wechat($wx_config)->mp($order);
                switch($pay_log['type']){
                    case '1':
                        $url_ok = url('video-info',[$pay_log['VideoTo']['video_id']]);
                        $url_no = url('video-info',[$pay_log['VideoTo']['video_id']]);
                        break;
                    case '2':
                        $url_ok = url('member');
                        $url_no = url('member');
                        break;
                }
                $assign = [
                    "Pay"       =>$Pay,
                    "pay_log"   =>$pay_log,
                    'url_ok'    => $url_ok,
                    'url_no'    => $url_no,
                    'is_header' => 0,//隐藏头部
                    'is_footer' => 0,//隐藏底部
                ];
                return view('mobile.pay.wxmp',$assign);
            }else{
                // 扫码支付
                $wx_config = $this->wx_config();
                $order = [
                    'out_trade_no' => $pay_log['order_no'],
                    'body'         => '订单支付',
                    'total_fee'    => round($pay_log['price']*100),
                ];
                $Pay = Pay::wechat($wx_config)->scan($order);
                // var_dump($Pay);
                $assign = [
                    "Pay"       =>$Pay,
                    "pay_log"   =>$pay_log,
                    'is_header' => 0,//隐藏头部
                    'is_footer' => 0,//隐藏底部
                ];
                return view('home.pay.wxscan',$assign);
            }
            
        }
    }
    public function wechat_notify_url(Request $request){
        //微信支付回调
        $wx_config = $this->wx_config();
        $wechat = Pay::wechat($wx_config);
        $data = $wechat->verify();
        error_log($data."\r\n",3,'wx_pay_log.log');
        if($data['result_code']=='SUCCESS'){
            $PayLog = PayLog::where("order_no",$data['out_trade_no'])->where('pay_status',1)->first();
            if(!$PayLog){
                return false;
            }
            if($PayLog['price']*100!=$data['total_fee']){
                return false;
            }
            $PayLog->pay_time = date('Y-m-d H:i:s');
            $PayLog->pay_status = 2;
            $PayLog->save();
            switch ($PayLog['type']) {
                case '1':
                    VideoOrder::Nutify(['id'=>$PayLog['order_id']]);
                    break;
                case '2':
                    VipOrder::Nutify(['id'=>$PayLog['order_id']]);
                    break;
            }
            return $wechat->success();
        }
        // return false;
        
    }
    public function pay_is(Request $request){
        set_time_limit(0);//设置脚本超时时间为无限
        $user_info = Auth::user();
        while(true){
            $PayLog = PayLog::where("id",$request['id'])->where("user_id",$user_info['id'])->first();
            if($PayLog['pay_status']==2){
                switch($PayLog['type']){
                    case '1':
                        return render("支付成功",200,url('video-info',[$PayLog['VideoTo']['video_id']]));
                        break;
                    case '2':
                        return render("支付成功",200,url('member'));
                        break;
                }
            }
            usleep(1000);
        }
    }
}
