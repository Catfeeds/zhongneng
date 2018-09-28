@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    @include('mobile.layouts.sub_nav')
    <div class="main">
        <div class="index_1">
            <ul class="ser_list">
                @foreach($article_list as $v)
                <li><a href="{{url('article',[$v['id']])}}" class="clearfix">
                    <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></div>
                    <div class="w">
                        <h3>{{$v['title']}}</h3>
                        <p class="dot">{!!nl2br($v['desc'])!!}</p>
                    </div>
                </a></li>
                @endforeach
            </ul>
        </div>
        @include('mobile.layouts.page',['page'=>$article_list])
    </div>
@endsection
@section('script')
    @parent
@endsection