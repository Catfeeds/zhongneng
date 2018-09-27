@extends('mobile.layouts.app')
@section('style')
@parent
@endsection
@section('content')
<div class="login_box">
    <div class="login-input">
        <form method="POST" id="demoform" action="{{URL('password-reset')}}">
            @csrf
            <div class="login-input-text">
                <input type="text" class="form-control retpadding text-input" placeholder="请输入手机号码" id="reset-phone"
                name="phone" required value="{{old('phone')}}" datatype="*,m" nullmsg="请输入手机号码" errormsg="请输入手机号码"/>
                <label for="reset-phone" class="error1 Validform_checktip  @if($errors->has('phone')) Validform_wrong @endif">
                    @if ($errors->has('phone'))
                    {{ $errors->first('phone') }}
                    @endif
                </label>
            </div>
            <div class="login-input-text">
                <input type="text" class="form-control retpadding note text-input" placeholder="短信验证码" name="verify_code"
                id="register-code" required datatype="*" nullmsg="请输入短信验证码" value="{{old('verify_code')}}" />
                <input class="get-msg" id="register-get-code" value="获取验证码" type="button">
                <label for="register-code" class="Validform_checktip @if($errors->has('verify_code')) Validform_wrong @endif" >
                    @if ($errors->has('verify_code'))
                        {{ $errors->first('verify_code') }}
                    @endif
                </label>
            </div>
            <div class="login-input-text">
                <input type="password" class="form-control retpadding text-input" placeholder="密码由6-20位组成"
                id="register-password" name="password" datatype="*6-20" errormsg="密码由6-20位组成" value="{{old('password')}}" />
                <label for="register-password" class="error Validform_checktip @if($errors->has('password')) Validform_wrong @endif">
                    @if ($errors->has('password'))
                        {{ $errors->first('password') }}
                    @endif
                </label>
            </div>
            <div class="login-input-text">
                <input type="password" class="form-control retpadding text-input" placeholder="请再次输入上面的密码"  name="password_confirmation" id="register-password_confirmation" datatype="*" recheck="password" errormsg="您两次输入的密码不一致！" value="{{old('password_confirmation')}}"/>
                <label for="register-password_confirmation" class="error Validform_checktip @if($errors->has('password_confirmation')) Validform_wrong @endif">
                    @if ($errors->has('password_confirmation'))
                        {{ $errors->first('password_confirmation') }}
                    @endif
                </label>
            </div>
            <input type="submit" class="button button-fill loginin-btn" id="login-submit" value="确认">
        </form>
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
    var t=60;
    $(".get-msg").click(function(){
        var phone = $("#reset-phone").val();
        if($(".get-msg").attr('is')!=false){
            $(".get-msg").attr("is",false);
            $.ajax({
                type: "POST",
                url:"{{URL('password-reset-sms-send')}}",
                data:"phone="+phone,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    if(data.code==200){
                        alert(data.message+data.data.captcha);
                        t=60;
                        captcha_up();
                    }else{
                        alert(data.message);
                    }
                },
                error:function(data){
                    var obj = new Function("return" + data.responseText)();
                    console.log(obj);
                    obj = obj.errors;
                    var msg='';
                    $(".get-msg").attr("is",true);
                    for (var prop in obj){
                        msg += obj[prop]+"\r";
                    }
                    alert(msg);
                }
            });
        }
    })
    function captcha_up(){
        $(".get-msg").val("")
        sint = setInterval(function(){
          $(".get-msg").val(t--);
          if(t<=0){
            $(".get-msg").attr("is",true);
            $(".get-msg").val("获取验证码");
            clearInterval(sint);
          }
        },1000)
    }
</script>
@endsection