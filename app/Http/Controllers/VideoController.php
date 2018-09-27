<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Validator,Auth;
use App\Models\Video,App\Models\VideoCourse,App\Models\User,App\Models\Category,App\Models\VideoOrder,App\Models\PayLog;
class VideoController extends Controller
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
    public function video_list(Request $request){
        //课程列表
        $order = array();
        if($request['order']=='number'){
            $order[] = [
                'order'=>'number',
                'sort'=>'DESC',
            ];
        }
        $video_list = Video::VideoList([
            'cate_id'  =>$request['cate_id'],
            'type'     =>$request['type'],
            'order'    =>$order,
            'paginate' =>16,
        ]);
        $location = [
            0=>[
                'title'=>'学习课程',
            ],
        ];
        $Category = Category::where('type',1)->orderBy('order',"ASC")->get();
        $assign = [
            'head_title' => '学习课程',
            'location'   => $location,
            'video_list' => $video_list,
            'Category'   => $Category,
        ];
        if(isMobile()){
            return view('mobile.video.video-list',$assign);
        }else{
            return view('home.video.video-list',$assign);
        }
    }
    public function video_info(Request $request,$id){
        //课程详情
        $user_info = Auth::user();
        $info = Video::with(['CategoryTo','VideoCourseMany'])->where('video_id',$id)->first();
        if(!$info){
            return redirect()->back();
        }
        $info['is_try'] = false;
        foreach($info['VideoCourseMany'] as $v2){//查看是否可以试听
            if(!empty($v2['try_video'])){
                $info['is_try'] = true;
                break;
            }
        }
        if($user_info['id']>0){
            $is_pay = VideoOrder::is_pay($id,$user_info['id']);
            switch ($info['is_fee']) {
                case '1':
                //全部收费
                    if($is_pay){
                        $is_pay = "已购买";
                    }
                    break;
                case '2':
                //vip免费，普通会员收费
                    if($is_pay){
                        $is_pay = "已购买";
                    }elseif($user_info['grade']==2){
                        $is_pay = "免费观看";
                    }
                    break;
                case '3':
                    $is_pay = "免费观看";
                    break;
            }
        }
        $location = [
            0=>[
                'url'=>URL('video-list'),
                'title'=>'学习课程',
            ],
            1=>[
                'title'=>$info['title'],
            ],
        ];
        
        $assign = [
            'like_video_list'  => $like_video_list,
            'location'         => $location,
            'info'             => $info,
            'is_pay'           => $is_pay,
            'head_title'       => !empty($info['seo_title'])?$info['seo_title']:$info['title'],
            'head_keywords'    => !empty($info['seo_keywords'])?$info['seo_keywords']:$info['title'],
            'head_description' => !empty($info['seo_description'])?$info['seo_description']:$info['title'],
        ];
        if(isMobile()){
            $assign['is_footer'] = 0;
            return view('mobile.video.video-info',$assign);
        }else{
            return view('home.video.video-info',$assign);
        }
    }
    public function video_play(Request $request,$id){
        //课程播放
        $user_info = Auth::user();
        $VideoCourse = VideoCourse::find($id);
        if(!$VideoCourse){
            return redirect()->back();
        }
        $Video = Video::with(['CategoryTo','VideoCourseMany'])->find($VideoCourse['video_id']);
        if(!$Video){
            return redirect()->back();
        }
        $is_video = true;
        $video_url = '';
        $is_pay = VideoOrder::is_pay($Video['video_id'],$user_info['id']);
        if($is_pay||($Video['is_fee']==2&&$user_info['grade']==2)||$Video['is_fee']==3){
            //可以查看正式视频的
            $video_url = $VideoCourse['video'];
            $is_video = false;
        }elseif(!empty($VideoCourse['try_video'])){
            //有试看的
            $video_url = $VideoCourse['try_video'];
        }
        // dd($video_url);
        if($is_video&&empty($video_url)){
            //没得观看，跳转回去
            return redirect('video-info/'.$Video['video_id'])->with('error_message',"请先购买课程");
        }

        $assign = [
            'Video'            => $Video,
            'VideoCourse'      => $VideoCourse,
            'video_url'        => $video_url,
            'is_video'         => $is_video,
            'is_header'        => 0,//隐藏头部
            'is_footer'        => 0,//隐藏底部
            'head_title'       => !empty($Video['seo_title'])?$Video['seo_title']:$Video['title'],
            'head_keywords'    => !empty($Video['seo_keywords'])?$Video['seo_keywords']:$Video['title'],
            'head_description' => !empty($Video['seo_description'])?$Video['seo_description']:$Video['title'],
        ];
        return view('home.video.video-play',$assign);
    }
    public function video_pay(Request $request,$id){
        //课程购买
        $user_info = Auth::user();
        $Video = Video::find($id);
        if(!$Video){
            return redirect()->back();
        }
        $is_pay = VideoOrder::is_pay($id,$user_info['id']);
        if($is_pay||($Video['is_fee']==2&&$user_info['grade']==2)||$Video['is_fee']==3){
            //已经购买或无需购买的跳转回去
            return redirect('video-info/'.$id);
        }
        $assign = [
            'Video'            => $Video,
            'head_title'       => !empty($Video['seo_title'])?$Video['seo_title']:$Video['title'],
            'head_keywords'    => !empty($Video['seo_keywords'])?$Video['seo_keywords']:$Video['title'],
            'head_description' => !empty($Video['seo_description'])?$Video['seo_description']:$Video['title'],
        ];
        if(isMobile()){
            return view('mobile.video.video-pay',$assign);
        }else{
            return view('home.video.video-pay',$assign);
        }
    }
    public function video_pay_save(Request $request){
        //课程购买-支付确认
        $this->validate($request,[
            'id'    => 'required',
            'pay_type'   => 'required',
        ],[],[
            'id'=>"课程",
            'pay_type'=>"支付方式",
        ]);
        if(!$request['id']>0){
            return redirect("/");
        }
        $id = $request['id'];
        $user_info = Auth::user();
        $Video = Video::find($id);
        if(!$Video){
            return redirect("/");
        }
        $is_pay = VideoOrder::is_pay($id,$user_info['id']);
        if($is_pay||($Video['is_fee']==2&&$user_info['grade']==2)||$Video['is_fee']==3){
            //已经购买或无需购买的跳转回去
            return redirect('video-info/'.$id);
        }
        //生成订单
        $arr = VideoOrder::where(['user_id'=>$user_info['id'],"video_id"=>$id])->first();
        if(!$arr){
            $arr = new VideoOrder;
        }
        $arr->user_id = $user_info['id'];
        $arr->video_id = $id;
        $arr->status = 1;
        $arr->price = $Video['price'];
        $arr->order_no = video_order_no();
        $arr->pay_time = date('Y-m-d H:i:s');
        $arr->pay_type = $request['pay_type'];
        $arr->save();

        //创建支付记录
        $pay_log = PayLog::PaySave([
            'order_id'=>$arr['order_id'],
            'type'=>1,
            'price'=>$arr['price'],
            'user_id'=>$arr['user_id'],
            'order_no'=>$arr['order_no'],
            'pay_type'=>$request['pay_type'],
            'add_time'=>date('Y-m-d H:i:s'),
        ]);

        return redirect('pay?id='.$pay_log['id']);
    }

    public function member_video_list(Request $request){
        //我购买的课程
        $user_info = Auth::user();
        $video_id_in = [-1];
        $order = VideoOrder::where([
            'user_id'=>$user_info['id'],
            'status'=>2,
        ])->get();
        foreach($order as $v){
            $video_id_in[] = $v['video_id'];
        }
        $video_list = Video::VideoList([
            'video_id_in' => $video_id_in,
            'paginate' =>9,
        ]);
        
        $assign = [
            'head_title'     => '我的课程',
            'video_list'     => $video_list,
            'Gs_panel_title' => 2,
        ];
        if(isMobile()){
            return view('mobile.video.member-video-list',$assign);
        }else{
            return view('home.video.member-video-list',$assign);
        }
    }
}
