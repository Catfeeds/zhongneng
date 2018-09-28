@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    <div class="main">
        <div class="news_det">
            <div class="tit">{{$info['title']}}<p>编辑：{{$info['editor']}}<em>人气：{{$info['click']}}</em>发表时间：{{date("Y-m-d",strtotime($info['add_time']))}}</p></div>
            <div class="w content_box">
                {!!$info['content']!!}
            </div>
        </div>
        @include("mobile.layouts.pagebox")
    </div>
@endsection
@section('script')
    @parent
@endsection