@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    @include('mobile.layouts.sub_nav')
    <div class="main">
        <div class="news">
            <ul>
                @foreach($article_list as $v)
                <li><a href="{{url('article',[$v['id']])}}">
                    <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"><div class="time">{{date("m/d",strtotime($v['add_time']))}}<em>{{date("Y",strtotime($v['add_time']))}}</em></div></div>
                    <h3>{{$v['title']}}</h3>
                    <p class="dot">{!!nl2br($v['desc'])!!}</p>
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