@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    @include('mobile.layouts.sub_nav')
    <div class="index2">
        @foreach($cate_list as $v)
            @include('mobile.layouts.index2-box',['index2_box'=>$v])
        @endforeach
    </div>
@endsection
@section('script')
    @parent
@endsection