@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('home.layouts.top_banner')
    <div class="main">
        @include('home.layouts.sub_nav')
        <div class="news_det yewu_det">
            <div class="tit">{{$info['title']}}</div>
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