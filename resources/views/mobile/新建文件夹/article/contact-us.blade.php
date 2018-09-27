@extends('home.layouts.app')
@section('style')
    @parent
    <style type="text/css">
        .map img{width: auto;height: auto;max-width: inherit;}
    </style>
@endsection
@section('content')
    <div class="map" id="allmap"></div>
    <div class="layout contact_con">
        @include('home.layouts.location')
        <div class="clearfix">
            <div class="contact_left">
                <p class="title">联系我们</p>
                {!!nl2br(ConfigGet('contact_us'))!!}
                <a class="kefu_btn"><img src="{{asset('resources/home/images/ico/zx.gif')}}" alt="">在线咨询</a>
            </div>
            <div class="contact_right">
                <div class="way">
                    <span class="on">公交</span>
                    <span>地铁</span>
                    <span>火车</span>
                    <span>飞机</span>
                </div>
                <ul>
                    <li class="cur">
                        {!!nl2br(ConfigGet('contact_us1'))!!}
                    </li>
                    <li>
                        {!!nl2br(ConfigGet('contact_us2'))!!}
                    </li>
                    <li>
                        {!!nl2br(ConfigGet('contact_us3'))!!}
                    </li>
                    <li>
                        {!!nl2br(ConfigGet('contact_us4'))!!}
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @parent
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=c2AOMaFjyxR1itkA2z1yWOKysUgdjE6I"></script>
    <script type="text/javascript">
        // 百度地图API功能
        var map = new BMap.Map("allmap");
        var point = new BMap.Point(113.347704,23.178216);
        var marker = new BMap.Marker(point);  // 创建标注

        map.addOverlay(marker);              // 将标注添加到地图中
        map.centerAndZoom(point,16);
        map.enableScrollWheelZoom(true);
        var opts = {
          title : "地址：广州市天河区元岗路8号慧通产业广场A1栋1323--1328" , // 信息窗口标题
          enableMessage:true,//设置允许信息窗发送短息
          // message:"亲耐滴，晚上一起吃个饭吧？戳下面的链接看下地址喔~"
        }
        var infoWindow = new BMap.InfoWindow("笃爱情感", opts);  // 创建信息窗口对象 
        marker.addEventListener("click", function(){          
            map.openInfoWindow(infoWindow,point); //开启信息窗口
        });
        $(function(){
            $('.contact_right .way span').hover(function() {
                $(this).addClass('on').siblings().removeClass('on');
                var num=$(this).index();
                $('.contact_right ul li').eq(num).show().siblings().hide();
            });
        })
    </script>
@endsection