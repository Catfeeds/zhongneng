@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    @include('mobile.layouts.sub_nav')
    <div class="main">
        <div class="news_det">
            <div class="tit">
                <h3>{{$info['title']}}</h3>
                <p>编辑：{{$info['editor']}}&nbsp;&nbsp;&nbsp;人气：{{$info['click']}}&nbsp;&nbsp;&nbsp;发表时间：{{date('Y-m-d',strtotime($info['add_time']))}}</p>
            </div>
            <div class="con contain_con">
                {!!$info['content']!!}
            </div>
            @include('mobile.layouts.pagebox')
        </div>
    </div>
@endsection
@section('script')
    @parent
@endsection