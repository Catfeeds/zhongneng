@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    <div class="main">
        <div class="yewu_det">
            <div class="tit">{{$info['title']}}</div>
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