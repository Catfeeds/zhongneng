@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @if(!empty($top_category['img']))
    <div class="banner"><img src="{{asset($top_category['img'])}}"></div>
    @endif
    <div class="layout expert_con">
        <div class="expert_in">
            <div class="">
                @foreach($cate_list as $v)
                    @if($v['template']=='master-group')
                        <div class="hzzj clearfix">
                            <h2><span>{{$v['title']}}</span></h2>
                            <ul class="clearfix list">
                                @foreach($v['article'] as $b_k=>$b_v)
                                    <li>
                                        <a href="{{URL($v['url'],$b_v['id'])}}" >
                                            <div class="img" style="background-image: url({{asset($b_v['img'])}});"></div>
                                            <h3 class="ellipsis">{{$b_v['title']}}<i class="iconfont2 font-arrow-left"></i></h3>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif($v['template']=='guimi-group')
                        <div class="hzzj clearfix">
                            <h2><span>{{$v['title']}}</span></h2>
                            <ul class="clearfix list">
                                @foreach($v['article'] as $b_k=>$b_v)
                                    <li>
                                        <a href="{{URL($v['url'],$b_v['id'])}}" >
                                            <div class="img" style="background-image: url({{asset($b_v['img'])}});"></div>
                                            <h3 class="ellipsis">{{$b_v['title']}}<i class="iconfont2 font-arrow-left"></i></h3>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @include('mobile.layouts.location')
    </div>
@endsection
@section('script')
    @parent
@endsection