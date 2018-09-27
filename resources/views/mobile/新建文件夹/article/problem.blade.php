@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    @include('mobile.layouts.sub_nav')
    <div class="main">
        @foreach($cate_list as $c_v)
        <div class="all_wt">
            <div class="tit">{{$c_v['title']}}</div>
            <ul class="all_q">
                @foreach($c_v['article'] as $v)
                <li>
                    <div class="top"><em></em>{{$v['title']}}</div>
                    <div class="con contain_con">
                        {!!$v['content']!!}
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function(){
            $('.all_q li .top').on('click',function(){
                $(this).siblings().stop(false,true).slideToggle().parents('li').toggleClass('on');
                $(this).parents('li').siblings().removeClass('on').find('.con').slideUp();
            })
        });
    </script>
@endsection