@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    <div class="case_det1">
        <h3>{{$info['title']}}</h3>
        <p>
            项目地点：{{$info['address']}}<br />
            项目简介：{!!nl2br($info['desc'])!!}<br />
            工程概况：<br />
            {!!nl2br($info['desc2'])!!}
        </p>
    </div>
    <div class="case_det1 case_det2 ">
        <h3 >项目详情：</h3>
        <div class="content_box">
            {!!$info['content']!!}
        </div>
        @include("mobile.layouts.pagebox")
    </div>
@endsection
@section('script')
    @parent
@endsection