@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    @include('mobile.layouts.sub_nav')
    <div class="photo_list main video_list">
        <div class="title2">{{$cate_info['en_title']}}<p>{{$cate_info['title']}}</p></div>
        <ul class="clearfix">
            @foreach($article_list as $k=>$v)
            <li>
                <a href="{{URL($cate_info['url'],$v['id'])}}" class="box"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"><i></i></a>
                <p>{{$v['title']}}</p>
            </li>
            @endforeach
        </ul>
        @include('mobile.layouts.page',['page'=>$article_list])
    </div>
@endsection
@section('script')
    @parent
@endsection