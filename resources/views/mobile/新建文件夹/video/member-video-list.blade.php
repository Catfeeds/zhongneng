@extends('mobile.layouts.app')
@section('style')
@parent
@endsection
@section('content')
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
@include('mobile.layouts.page2',['page'=>$video_list])
@endsection
@section('script')
@parent
    
@endsection