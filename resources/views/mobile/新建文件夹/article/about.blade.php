@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    @include('mobile.layouts.sub_nav')
    <div class="main">
        <div class="brand">
            <div class="title2">{{$cate_info['en_title']}}<p>{{$cate_info['title']}}</p></div>
            <div class="w contain_con">
                {!!$cate_info['content']!!}
            </div>
        </div>
    </div>
@endsection
@section('script')
    @parent
@endsection