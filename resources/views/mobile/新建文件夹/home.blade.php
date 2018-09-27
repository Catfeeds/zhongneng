@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
<?php 
$banner = ads_image(27);
 ?>
@if(isset($banner)&&$banner->count())
<div class="swiper-container banner">
    <div class="swiper-wrapper">
        @foreach($banner as $v)
        <div><a @if(!empty($v['url']))href="{{$v['url']}}"@endif target="_blank"><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></a></div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>
@endif
<div class="index_1">
    <div class="title">{{$index_1_cate['title']}}<p>{{$index_1_cate['en_title']}}</p></div>
    <ul class="pro_list clearfix">
        @foreach($index_1 as $k=>$v)
        <li><a href="{{URL($v['ArticleCategoryTo']['url'],$v['id'])}}" class="clearfix">
            <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></div>
            <div class="w">
                <h3>{{$v['title']}}</h3>
                <p class="dot">{!!nl2br($v['desc'])!!}</p>
            </div>
        </a></li>
        @endforeach
    </ul>
    @foreach($index_1 as $k=>$v)
    @if($k==0)
    <a href="{{URL($v['ArticleCategoryTo']['url'])}}" class="more">more</a>
    @endif
    @endforeach
</div>
<div class="index_2">
    <div class="title">{{$index_2_cate['title']}}<p>{{$index_2_cate['en_title']}}</p></div>
    <div class="w">
        <p>{!!nl2br($index_2_cate['cat_desc'])!!}</p>
        <a href="{{URL($index_2_cate['url'])}}" class="more">more</a>
    </div>
    <div class="pic"><a href="{{URL($index_2_cate['url'])}}"><img src="{{asset($index_2_cate['img2'])}}"></a></div>
</div>
<div class="index_3">
   <div class="title">{{$index_3_cate['title']}}<p>{{$index_3_cate['en_title']}}</p></div>
    <ul class="news_list">
        @foreach($index_3 as $k=>$v)
        <li><a href="{{URL($v['ArticleCategoryTo']['url'],$v['id'])}}" class="clearfix">
            <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></div>
            <div class="w">
                <h3>{{$v['title']}}</h3>
                <span>{{date("Y-m-d",strtotime($v['add_time']))}}</span>
                <p class="dot">{!!nl2br($v['desc'])!!}</p>
            </div>
        </a></li>
        @endforeach
    </ul>
    <a href="{{URL($index_3_cate['url'])}}" class="more">more</a>
</div>
@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function(){
            var banner=new Swiper('.banner',{
                loop:true,
                pagination : '.swiper-pagination',
                autoplay: 2500
            });
        });
    </script>
@endsection