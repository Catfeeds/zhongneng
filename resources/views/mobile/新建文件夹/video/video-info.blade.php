@extends('mobile.layouts.app')
@section('style')
<style type="text/css">
    body{background-color: #f8f8f8;}
</style>
@parent
@endsection
@section('content')
<div class="video_info">
    <div class="video_pay">
        <div id="video" style="width:100%; height:4.8rem;"></div>
        <a id='try'>
            <img src="{{asset('resources/mobile/images/ico19.png')}}">
        </a>
    </div>
    <div class="weui_tab " id="tab1"><!--tab-fixed添加顶部-->
        <div class="clearfix weui_navbar">
            <div class="weui_navbar_item  tab-red">
                课程介绍
            </div>
            <div class="weui_navbar_item">
                课程目录
            </div>
            <div class="weui_navbar_item">
                常见问题
            </div>
        </div>
    </div>
    <div class="course-con">
        <div class="item text" style="display: block;">
            <div class="introduce">
                <p class="introduceTit">爱情三重奏</p>
                <p class="introduceInfo">
                    {{$info['number']}}人学习过 | {{count($info['VideoCourseMany'])}}个课时
                    <span>
                        ￥
                        <i class="newP">{{$info['price']}}</i>
                        <i class="oldP">{{$info['old_price']}}</i>
                    </span>
                </p>
            </div>
            <div class="jianjie">
                <span>课程详情</span>
                {!!$info['content']!!}
            </div>
        </div>
        <div class="item cur">
            <ul>
                @foreach($info['VideoCourseMany'] as $k=>$v)
                @if($is_pay!='免费观看'&&$is_pay!='已购买')
                <li data-src="{{asset($v['try_video'])}}" data-try='1' @if($k==0) class="on" @endif>{{$v['title']}}</li>
                @else
                <li data-src="{{asset($v['video'])}}" @if($k==0) class="on" @endif>{{$v['title']}}</li>
                @endif
                @endforeach
            </ul>
        </div>
        <div class="item des">
            <p class="desTit">注意问题</p>
            {!!f_article_info(1249)['content']!!}
        </div>
    </div>
    <div class="course-footer-box">
        <div class="course-footer">
            <div class="collect left" id="actionToggle">
                课程价格:
                <p>
                    ￥
                    <span class="newP">{{$info['price']}}</span>
                    <span class="oldP">{{$info['old_price']}}</span>
                </p>
            </div>
            @if($is_pay)
                <a class="right cz">{{$is_pay}}</a>
            @else
                <a href="{{URL('video-pay',$info['video_id'])}}" class="right cz">立刻购买</a>
            @endif
        </div>
    </div>
</div>
@endsection
@section('script')
@parent
<script type="text/javascript">
    $(function(){
        $(".weui_navbar_item").click(function(){
            $(this).addClass('tab-red').siblings().removeClass("tab-red");
            $(".course-con .item").eq($(this).index()).show().siblings().hide();
        })
        var video_url = $(".cur").find("li").eq(0).attr('data-src');
        if($(".cur").find("li").eq(0).attr('data-try')==1){
            $("#try").show();
        }else{
            $("#try").hide();
        }
        
        changeVideo(video_url);

        function changeVideo(videoUrl) {
            alert(videoUrl);
            if(videoUrl.indexOf(".mp3") != -1){
                $("#video").html('<video src="'+videoUrl+'" controls="controls" poster="{{asset($info['img'])}}" id="video" style="width: 100%; height:100%;"></video>');
                return true;
            }else{
                $("#video").html('');
                var videoObject = {
                    container: '#video', //容器的ID
                    variable: 'player',
                    flashplayer:true,
                    poster:'{{asset($info['img'])}}',//封面图片
                    video: videoUrl
                };
                var player = new ckplayer(videoObject);
                return true;
            }
            // if(player == null) {
            //     return;
            // }
            // var newVideoObject = {
            //     container: '#video', //容器的ID
            //     variable: 'player',
            //     flashplayer:true,
            //     poster:'{{asset($info['img'])}}',//封面图片
            //     // loaded: 'loadedHandler', //当播放器加载后执行的函数
            //     video: videoUrl
            // }
            // //判断是需要重新加载播放器还是直接换新地址
            // if(player.playerType == 'html5video') {
            //     if(player.getFileExt(videoUrl) == '.flv' || player.getFileExt(videoUrl) == '.m3u8' || player.getFileExt(videoUrl) == '.f4v' || videoUrl.substr(0, 4) == 'rtmp') {
            //         player.removeChild();

            //         player = null;
            //         player = new ckplayer();
            //         player.embed(newVideoObject);
            //     } else {
            //         player.newVideo(newVideoObject);
            //     }
            // } else {
            //     if(player.getFileExt(videoUrl) == '.mp4' || player.getFileExt(videoUrl) == '.webm' || player.getFileExt(videoUrl) == '.ogg') {
            //         player = null;
            //         player = new ckplayer();
            //         player.embed(newVideoObject);
            //     } else {
            //         player.newVideo(newVideoObject);
            //     }
            // }
        }
        
        $(".cur").find("li").click(function(){
            $(this).addClass('on').siblings().removeClass("on");
            var video_url = $(this).attr('data-src');
            if($(this).attr('data-try')==1){
                $("#try").show();
            }else{
                $("#try").hide();
            }
            changeVideo(video_url);
        })
        $("#try").click(function(){
            player.videoPlay();
            $("#try").hide();
        })
    })
</script>
@endsection