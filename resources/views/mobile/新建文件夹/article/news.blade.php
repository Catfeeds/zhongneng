@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    @include('mobile.layouts.sub_nav')
    <div class="main">
        <ul class="news">
            @foreach($article_list as $k=>$v)
            <li><a href="{{URL($cate_info['url'],$v['id'])}}" class="clearfix">
                <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></div>
                <div class="w">
                    <h3 title="{{$v['title']}}">{{$v['title']}}</h3>
                    <span>{{date("Y-m-d",strtotime($v['add_time']))}}</span>
                    <p class="dot" title="{!!nl2br($v['desc'])!!}">{!!nl2br($v['desc'])!!}</p>
                </div>
            </a></li>
            @endforeach
        </ul>
        @include('mobile.layouts.page',['page'=>$article_list])
    </div>
@endsection
@section('script')
    @parent
@endsection