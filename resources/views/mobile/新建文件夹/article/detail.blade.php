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
        <div class="detail">
            {!!$cate_info['content']!!}
        </div>
    </div>
@endsection
@section('script')
    @parent
@endsection