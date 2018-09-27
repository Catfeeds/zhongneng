@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    <div class="expert_con">
        <div class="videoType">
            <div class="typeSel_box">
                <form method="GET" id="filterform" action="{{URL('video-list')}}">
                    <div class="typeSel">
                        <div class="select">
                            <a >
                                学习方向
                                <img src="{{asset('resources/mobile/images/ico14.png')}}" class="subtype">
                            </a>
                            <a >
                                课程类型
                                <img src="{{asset('resources/mobile/images/ico14.png')}}" class="subtype">
                            </a>
                        </div>
                        <div class="types">
                            <div class="type1 typeF">
                                <a name="direction" class="cate_id @if(empty(request()->cate_id)) active @endif"  tag="">全部</a>
                                @foreach($Category as $k=>$v)
                                <a name="direction" class="cate_id @if(request()->cate_id==$v['id']) active @endif" tag="{{$v['id']}}" >{{$v['title']}}</a>
                                @endforeach
                            </div>
                            <div class="type1 typeS">
                                <a name="courseType" class="type @if(empty(request()->type)) active @endif " tag="">全部</a>
                                @foreach(trans("home.video.type") as $k=>$v)
                                <a name="courseType" class="type @if(request()->type==$k) active @endif" tag="{{$k}}">{{$v}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="cate_id" id="cate_id" value="{{request()->cate_id}}">
                    <input type="hidden" name="type" id="type" value="{{request()->type}}">
                    <input type="hidden" name="order" id="order" value="{{request()->order}}">
                </form>
            </div>
        </div>
        <div class="videoCon_list">
            <ul class="videoList"  id="pageDiv">
                @foreach($video_list as $v)
                    <li>
                        <a href="{{URL('video-info',[$v])}}">
                            <div class="courseImg"><img src="{{asset($v['img'])}}"></div>
                                <div class="courseInfo">
                                    <p class="courseTit">{{$v['title']}}</p>
                                    <div class="pricesa">
                                    <p class="price colff5562">￥<span class="newPrice">{{$v['price']}}</span><span class="oldPrice">{{$v['old_price']}}</span></p>
                                    <p class="tag">{{count($v['VideoCourseMany'])}}个课时</p>
                                </div>
                            </div>
                        </a> 
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @include('mobile.layouts.page2',['page'=>$video_list])
@endsection
@section('script')
    @parent
    <script type="text/javascript">
        $(".select a").click(function(){
            $(this).find('img').toggleClass('subp');
            $(this).siblings().find("img").removeClass("subp");
            if($(this).index() == 0){
                $(".typeS").slideUp();
                $(".typeF").slideToggle();
            }else{
                $(".typeF").slideUp();
                $(".typeS").slideToggle();
            }
        });
        $(".typeF a").click(function(){
            $(this).addClass("active").siblings().removeClass("active");
            $(".select a").find('img').removeClass('subp');
            $("#cate_id").val($(this).attr('tag'));
            $("#filterform").submit();
        });
        $(".typeS a").click(function(){
            $(this).addClass("active").siblings().removeClass("active");
            $(".select a").find('img').removeClass('subp');
            $("#type").val($(this).attr('tag'));
            $("#filterform").submit();
        });
    </script>
@endsection