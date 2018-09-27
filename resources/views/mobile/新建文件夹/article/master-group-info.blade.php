@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    <div class="master-banner">
        <img src="{{asset($info['img2'])}}" alt="{{$info['alt2']}}">
    </div>
    <div class="layout master-content">
        <div class="info-title">
            <h1>
                {{$info['title']}}
                <small>{{$info['title2']}}</small>
            </h1>
            <button class="button kefu_btn">立即咨询</button>
        </div>
        <div class="info-text info-text-up">
            <div class="info-text-table">
                <p class="t1">导师介绍</p>
                {!!nl2br($info['desc'])!!}
            </div>
            <button class="button">
                <i class="icon icon-caret"></i>
            </button>
        </div>
        <script>
            $('.info-text').on('click', '.button', function () {
                $('.info-text').toggleClass("info-text-up");
            })
        </script>
        <div class="clearfix buttons-tab info-buttons-tab">
            <a class="tab-link button active">导师视频</a>
            <a class="tab-link button">导师荣誉</a>
        </div>
        <div class="tabs info-tabs">
            <div id="info-tab2" class="clearfix tab info-tab-video" style="display: block;">
                @foreach($info['MoreVideoMany'] as $k=>$v)
                <a class="info-video-list video_play" data-vid="{{$v['video']}}">
                    <div class="info-video-bg">
                        <img src="{{asset($v['image'])}}" alt="video">
                        <i class="iconfont3 font-play video_play" data-vid="{{$v['video']}}"></i>
                    </div>
                    <p>{{$v['title']}}</p>
                </a>
                @endforeach
            </div>
            <div id="info-tab3" class="clearfix tab info-tab-glory">
                @foreach($info['MoreImageMany'] as $k=>$v)
                <a class="info-glory-list">
                    <div class="info-glory-bg">
                        <img src="{{asset($v['image'])}}" alt="{{$v['alt']}}" alt="video">
                    </div>
                    <p>{{$v['title']}}</p>
                </a>
                @endforeach
            </div>
        </div>
        <div class="video_play_box">
            <div class="box">
                <i class="ico13"></i>
            </div>
        </div>
        @include('mobile.layouts.location')
@endsection
@section('script')
    @parent
    <script type="text/javascript">
        $(function(){
            $(".info-buttons-tab .button").click(function(){
                $(this).addClass('active').siblings().removeClass('active');
                $(".info-tabs .tab").eq($(this).index()).show().siblings().hide();
            })
            //视频
            $(".info-tabs").on('click','.video_play', function(){
                var video = $(this).attr('data-vid');
                var iframe = '<iframe frameborder="0" src="'+video+'" allowfullscreen></iframe>';
                $(".video_play_box").show();
                $(".video_play_box .box").append(iframe);
            });
            $(".video_play_box").on("click", ".ico13", function() {
                $(".video_play_box").hide();
                $(".video_play_box").find("iframe").remove();
            });
        })
    </script>
@endsection