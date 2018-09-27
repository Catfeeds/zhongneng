@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    <div class="ststem_article">
        {!!$info['content']!!}
    </div>
@endsection
@section('script')
    @parent
@endsection