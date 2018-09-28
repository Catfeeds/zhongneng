@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('home.layouts.top_banner')
    <div class="main">
        @include('home.layouts.sub_nav')
        <div class="intro">
            <div class="tit">{{$cate_info['title']}}<span>/{{$cate_info['en_title']}}</span></div>
            <div class="content_box">
                {!!$cate_info['content']!!}
            </div>
        </div>
    </div>
@endsection
@section('script')
    @parent
    
@endsection