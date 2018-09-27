<?php 
$user_info = Auth::user();
?>
<div class="user_navigate">
    <div class="user_img xgtx1">
        <img src="{{asset($user_info['pic'])}}" alt="" onclick="window.open('{{URL('member-pic')}}')">
    </div>
    <div class="user_info">
        <p class="user_ming">{{$user_info['name']}}</p>
        @if($user_info['grade']==1)
        <p class="user_kt">
            <a href="{{URL('vip-pay')}}"  class="vip_btn">成为VIP</a>
        </p>
        @else
        <div class="vip">
            <span>{{date('Y-m-d',strtotime($user_info['grade_end']))}}到期</span><a href="{{URL('vip-pay')}}" class="xufei">续费</a>
        </div>
        @endif
        @if(empty($user_info['wx_openid']))
        <!-- 微信绑定 -->
        <div class="my_weixin" >
            <span class="wx_ann">绑定微信</span>
        </div>
        @endif
    </div>
    <div class="Gs_panel_title ">
        <ul>
            <li @if($Gs_panel_title==1) class="on" @endif><a href="{{URL('member')}}"><img class="icon_img" src="{{asset('resources/home/images/ico/ico29.png')}}">安全设置</a></li>
            <li @if($Gs_panel_title==2) class="on" @endif><a href="{{URL('member-video-list')}}"><img class="icon_img" src="{{asset('resources/home/images/ico/ico28.png')}}">我的课程</a></li>
        </ul>
    </div>
</div>