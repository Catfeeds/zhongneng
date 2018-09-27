@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @if(!empty($cate_info['img']))
    <div class="banner" style="background-image: url({{asset($cate_info['img'])}}); height: 466px;"></div>
    @endif
    @if(isset($universal_cate_list[0]))
        @include('home.layouts.index2-box',['index2_box'=>$universal_cate_list[0]])
    @endif
    @foreach($cate_list as $v)
        @include('home.layouts.index2-box',['index2_box'=>$v])
    @endforeach
    @foreach($universal_cate_list as $k=>$v)
        @if($k>0)
            @include('home.layouts.index2-box',['index2_box'=>$v])
        @endif
    @endforeach
    @include('home.layouts.fhns-bottom')
@endsection
@section('script')
    @parent
@endsection