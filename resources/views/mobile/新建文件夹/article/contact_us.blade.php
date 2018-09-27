@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    @include('mobile.layouts.sub_nav')
    <div class="main">
        <div class="con_1">
            <div class="title2">Contact us<p>联系方式</p></div>
            <div class="w">
                <h3>{{ConfigGet('contact_title')}}</h3>
                <p>
                    地址/Add： {{ConfigGet('address')}}<br />
                    电话/Tel： {{ConfigGet('tel')}}<br />
                    邮箱/Mail： {{ConfigGet('mail')}}
                </p>
            </div>
            <a href="{{asset(ConfigGet('jd_url'))}}" class="linkbox">
                <p>{{ConfigGet('jd_title')}}<em>{{asset(ConfigGet('jd_url'))}}</em></p>
            </a>
        </div>
        <div class="con_2">
            <div class="title2">Online feedback<p>在线反馈</p></div>
            <form>
                <div class="int clearfix">
                    <span>您的名字：</span>
                    <input type="text" class="text" value="" />
                </div>
                <div class="int clearfix">
                    <span>您的邮箱：</span>
                    <input type="text" class="text" value="" />
                </div>
                <div class="int clearfix">
                    <span>联系方式：</span>
                    <input type="text" class="text" value="" />
                </div>
                <div class="int clearfix">
                    <span>您的地址：</span>
                    <input type="text" class="text" value="" />
                </div>
                <div class="int clearfix">
                    <span>留言信息：</span>
                    <input type="text" class="text" value="" />
                </div>
                <input type="submit" class="button" value="提交" />
            </form>
        </div>
    </div>
@endsection
@section('script')
    @parent
@endsection