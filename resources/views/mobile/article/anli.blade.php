@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    @include('mobile.layouts.sub_nav')
    <div class="main">
        <ul class="clearfix case_list">
            @foreach($article_list as $v)
            <li><a href="{{url('article',[$v['id']])}}">
                <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></div>
                <h3>{{$v['title']}}</h3>
                <p>{{$v['ArticleCategoryTo']['title']}}</p>
            </a></li>
            @endforeach
        </ul>
        @include('mobile.layouts.page',['page'=>$article_list])
    </div>
@endsection
@section('script')
    @parent
@endsection