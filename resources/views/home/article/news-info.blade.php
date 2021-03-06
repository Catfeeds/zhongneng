@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('home.layouts.top_banner')
    <div class="main">
        @include('home.layouts.sub_nav')
        <div class="news_det">
            <div class="tit">{{$info['title']}}<p><em>编辑：{{$info['editor']}}</em><em>人气：{{$info['click']}}</em><em>发表时间：{{date("Y-m-d H:i",strtotime($info['add_time']))}}</em></p></div>
            <div class="w content_box">
                {!!$info['content']!!}
            </div>
        </div>
        @include("home.layouts.pagebox")
    </div>
@endsection
@section('script')
    @parent
    
@endsection