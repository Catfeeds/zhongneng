@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @if(!empty($cate_info['img']))
    <div class="banner"><img src="{{asset($cate_info['img'])}}"></div>
    @endif
    @foreach($cate_list as $v)
        @include('mobile.layouts.index2-box',['index2_box'=>$v])
    @endforeach
@endsection
@section('script')
    @parent
@endsection