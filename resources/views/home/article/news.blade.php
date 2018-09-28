@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('home.layouts.top_banner')
    <div class="main">
        @include('home.layouts.sub_nav')
        <div class="index_5 news">
            <ul class="clearfix">
                @foreach($article_list as $v)
                <li><a href="{{url('article',[$v['id']])}}">
                    <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></div>
                    <div class="w clearfix">
                        <div class="time"><b>{{date("m/d",strtotime($v['add_time']))}}</b>{{date("Y",strtotime($v['add_time']))}}</div>
                        <div class="fr">
                            <h3>{{$v['title']}}</h3>
                            <p class="dot">{!!nl2br($v['desc'])!!}</p>
                        </div>
                    </div>
                </a></li>
                @endforeach
            </ul>
        </div>
        @include('home.layouts.page',['page'=>$article_list])
    </div>
@endsection
@section('script')
    @parent
    
@endsection