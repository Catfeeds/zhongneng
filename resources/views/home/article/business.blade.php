@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('home.layouts.top_banner')
    <div class="main">
        @include('home.layouts.sub_nav')
        <div class="yewu">
            <ul class="clearfix">
                @foreach($article_list as $v)
                <li><a href="{{url('article',[$v['id']])}}" class="yw_box">
                    <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"><span><em>查看详情</em></span></div>
                    <div class="w">
                        <h3>{{$v['title']}}</h3>
                        <p class="dot">{!!nl2br($v['desc'])!!}</p>
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