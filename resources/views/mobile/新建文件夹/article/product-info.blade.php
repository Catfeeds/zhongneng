@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    <div class="main pad20">
        <div class="bgfff">
            <div class="swiper-container pro_det1">
                <div class="swiper-wrapper">
                    @foreach($info['MoreImageMany'] as $k=>$v)
                    <div class="swiper-slide"><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="pro_det1_w">
                <p>{{$info['title']}}</p>
                <div class="clearfix">
                    <span><em>￥</em>{{$info['price']}}</span>
                    <a href="{{$info['url']}}" class="buybtn">立即购买&gt;</a>
                </div>
            </div>
            <div class="pro_det2 contain_con">
                {!!$info['content']!!}
            </div>
        </div>
        @include('mobile.layouts.pagebox')
    </div>
@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function(){
            var pro_det1=new Swiper('.pro_det1',{
                loop:true,
                pagination : '.swiper-pagination',
                autoplay: 2500
            });
        });
    </script>
@endsection