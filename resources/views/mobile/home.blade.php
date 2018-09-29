@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
<?php 
$banner = ads_image(36);
 ?>
@if(isset($banner)&&$banner->count())
<div class="swiper-container banner">
    <div class="swiper-wrapper">
        @foreach($banner as $v)
        <div><a @if(!empty($v['url']))href="{{URL($v['url'])}}"@endif><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></a></div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>
@endif
<?php 
    //获取推荐文章
    $index_1 = \App\Models\ArticleCategory::find(5);
    $index_1['article'] = \App\Models\Article::ArticleList([
        'cate_id_in' => sub_cate_in(5),
        'take'=>9,
        'is_top'=>1,
    ]);
?>
<div class="index_1">
    <div class="title">{{$index_1['title']}}<p>{{$index_1['en_title']}}</p></div>
    <ul class="ser_list">
        @foreach($index_1['article'] as $v)
        <li><a href="{{url('article',[$v['id']])}}" class="clearfix">
            <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"><span></span></div>
            <div class="w">
                <h3>{{$v['title']}}</h3>
                <p class="dot">{!!nl2br($v['desc'])!!}</p>
            </div>
        </a></li>
        @endforeach
    </ul>
    <a href="{{URL('category',[$index_1['id']])}}" class="more">more</a>
</div>
<?php 
    //获取推荐文章
    $index_2 = \App\Models\ArticleCategory::find(1);
    $index_2['article'] = \App\Models\Article::ArticleList([
        'cate_id_in' => sub_cate_in(1),
        'take'=>6,
        'is_top'=>1,
    ]);
?>
<div class="index_2">
    <div class="title">{{$index_2['title']}}<p>{{$index_2['en_title']}}</p></div>
    <ul class="clearfix case_list">
        @foreach($index_2['article'] as $v)
        <li><a href="{{url('article',[$v['id']])}}">
            <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></div>
            <h3>{{$v['title']}}</h3>
            <p>{{$v['ArticleCategoryTo']['title']}}</p>
        </a></li>
        @endforeach
    </ul>
    <a href="{{URL('category',[$index_2['id']])}}" class="more">more</a>
</div>
<?php 
    //获取推荐文章
    $index_3 = \App\Models\ArticleCategory::find(6);
    $index_3_i1 = ads_image(37);
?>
<div class="index_3">
    <div class="title">{{$index_3['title']}}<p>{{$index_3['en_title']}}</p></div>
    <div class="w">
        {!!nl2br($index_3['cat_desc'])!!}
    </div>
    <a href="{{URL('category/8')}}" class="more">more</a>
    <ul class="clearfix">
        <li><a href="{{url('category/7')}}"><img src="/resources/mobile/images/ic1.png"></a></li>
        <li><img src="/resources/mobile/images/ic2.png"></li>
        <li><img src="/resources/mobile/images/ic3.png"></li>
        <li><img src="/resources/mobile/images/ic4.png"></li>
    </ul>
</div>
<?php 
    //获取推荐文章
    $index_4 = \App\Models\ArticleCategory::find(3);
    $index_4['article'] = \App\Models\Article::ArticleList([
        'cate_id_in' => sub_cate_in(3),
        'take'=>9,
        'is_top'=>1,
    ]);
?>
<div class="index_4">
    <div class="title">{{$index_4['title']}}<p>{{$index_4['en_title']}}</p></div>
    <ul class="news_list">
        @foreach($index_5['article'] as $v)
        <li><a href="{{url('article',[$v['id']])}}">
            <h3>{{$v['title']}}</h3>
            <h4>{{date("Y-m-d",strtotime($v['add_time']))}}</h4>
            <p class="dot">{!!nl2br($v['desc'])!!}</p>
        </a></li>
        @endforeach
    </ul>
    <a href="{{URL('category',[$index_4['id']])}}" class="more">more</a>
</div>
@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function(){
            var banner=new Swiper('.banner',{
                loop:true,
                pagination : '.swiper-pagination',
                autoplay: 3000
            });
        });
    </script>
@endsection