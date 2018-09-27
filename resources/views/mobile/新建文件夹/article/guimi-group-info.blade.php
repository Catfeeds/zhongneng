@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @if(!empty($top_category['img']))
    <div class="banner" style="background-image: url({{asset($top_category['img'])}}); height:482px;"></div>
    @endif
    <div class="layout article-content">
        @include('home.layouts.location')
        <div class="artic_in clearfix">
            <div class="expert_left">
                <div class="intro">
                    <span>{{$info['title']}}</span>
                    <span>{{$info['title2']}}</span>
                </div>
                <p><img src="{{asset($info['img'])}}" alt="{{$info['alt']}}"></p>
                <div class="details">
                    {!!$info['content']!!}
                </div>
                @foreach(ads_image(22,1) as $v)
                <div class="ad" style="background-image: url({{asset($v['image'])}});">
                    <div class="ad_zx">
                        <a class="kefu_btn ad_zx1" target="_self"><i></i>在线咨询</a>
                        <a class="apply_box_btn ad_zx2" target="_self"><i></i>网上预约</a>
                    </div>
                </div>
                @endforeach
                <!-- <div class="tag">
                    <div class="tag_in">
                        标签：

                        <a href="/article/tag?tag=冷爱" target="_self">冷爱</a>
                    </div>
                    <div class="return">
                        <a href="/" target="_self">返回首页</a>
                    </div>
                </div> -->
                <div class="artic_list">
                    <p>上一篇：<a @if($prev_article) href="{{URL($cate_info['url'],$prev_article['id'])}}" @endif>{{$prev_article['title'] or '暂无'}}</a></p>
                    <p>下一篇：<a @if($next_article) href="{{URL($cate_info['url'],$next_article['id'])}}" @endif>{{$next_article['title'] or '暂无'}}</a></p>
                </div>
                <div class="member">
                    <p>幸福闺蜜团其他成员</p>
                    @foreach($article_recommend_list as $v)
                    <a href="{{URL($cate_info['url'],$v['id'])}}" target="_self">{{$v['title']}}</a>
                    @endforeach
                </div>
            </div>
            @include("home.layouts.detail_right")
        </div>
    </div>
@endsection
@section('script')
    @parent
@endsection