@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    @include('mobile.layouts.sub_nav')
    <div class="main">
        <ul class="pro_list pro_list2 clearfix">
            @foreach($article_list as $k=>$v)
            <li><a href="{{URL($cate_info['url'],$v['id'])}}">
                <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></div>
                <div class="w">
                    <h3>{{$v['title']}}</h3>
                    <p>￥{{$v['price']}}</p>
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