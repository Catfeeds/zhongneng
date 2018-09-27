@extends('mobile.layouts.app')
@section('style')
@parent
@endsection
@section('content')
<!--  登录  -->
<div class="login_box">
    <div class="login-banner">
        <img src="{{asset('resources/mobile/images/ico20.jpg')}}" alt="banner">
        <div class="login-banner-user">
            <div class="login-banner-header">
                <img src="{{asset('resources/mobile/images/ico21.jpg')}}" alt="header">
            </div>
            <p>用户</p>
        </div>
    </div>
    <div class="login-input">
        <div class="login-input-register">
            还没有笃爱账号？
            <a href="{{URL('register')}}">立即注册</a>
        </div>
        <form method="POST" id="demoform" action="{{URL('login')}}">
            @csrf
            <div class="login-input-user">
                <i class="iconfont2 font-user-input"></i>
                <input id="login-phone" type="text" placeholder="手机号" class="form-control text-input text-name" name="phone" datatype="*" nullmsg="请输入手机号" value="{{old('phone')}}">
                <label for="login-phone" class="error Validform_checktip  @if($errors->has('phone')) Validform_wrong @endif">
                    @if ($errors->has('phone'))
                    {{ $errors->first('phone') }}
                    @endif
                </label>
            </div>
            <div class="login-input-password">
                <i class="iconfont2 font-pwd"></i>
                <input id="login-msg" type="password" name="password" class="form-control text-input text-pass" placeholder="密码" datatype="*" nullmsg="请输入密码" value="{{old('password')}}"/>
                <label for="login-msg" class="error Validform_checktip  @if($errors->has('password')) Validform_wrong @endif">
                    @if ($errors->has('password'))
                    {{ $errors->first('password') }}
                    @endif
                </label>
            </div>
            <div class="clearfix login-input-menu">
                <a href="{{URL('password-reset')}}">忘记密码?</a>
            </div>
            <input type="submit" class="button button-fill loginin-btn" id="login-submit" value="登录">
        </form>
        <!-- 微信登录 -->
        <!-- <div class="login-input-more">
            <div class="login-input-more-list">
                <a href="/account/wechat/login">
                    <span class="wat"><img src="http://a3.huazhen.com/huazhen0624/i/icon1.png" alt=""></span>
                    <p>微信登录</p>
                </a>
            </div>
        </div> -->
    </div>
</div>
@endsection
@section('script')
@parent
<script type="text/javascript">
    $("#demoform").Validform({
        tiptype:function(msg,o){
            if(o.type==3){
                alert(msg);
            }
        },
        showAllError:true,
        tipSweep:true,
        btnSubmit:".loginin-btn",
        beforeSubmit:function(date){
            // submit();
            // return false;
        }
    });
</script>
@endsection