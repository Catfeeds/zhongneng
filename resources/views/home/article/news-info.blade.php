@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('home.layouts.top_banner')
    <div class="main">
        @include('home.layouts.sub_nav')
        <div class="case_det1 clearfix">
            <div class="pic"><img src="{{asset($info['img'])}}" alt="{{$info['alt']}}"></div>
            <div class="w">
                <h3>{{$info['title']}}</h3>
                <p>
                    项目地点：{{$info['address']}}<br /><br />
                    项目简介：{!!nl2br($info['desc'])!!}<br /><br />
                    工程概况：<br />
                    {!!nl2br($info['desc2'])!!}
                </p>
            </div>
        </div>
        <div class="case_det2 content_box">
            <div class="title">项目详情：</div>
            {!!$info['content']!!}
        </div>
        @include("home.layouts.pagebox")
    </div>
@endsection
@section('script')
    @parent
    
@endsection