@extends('mobile.layouts.app')
@section('style')
@parent
@endsection
@section('content')
<div class="login_box">
    <div class="login-input">
        <form method="POST" id="demoform" action="{{URL('user-bangding-save')}}">
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
                <input class="get-msg" id="rebind-get-msg" value="获取验证码" type="button">
                <label for="register-code" class="Validform_checktip @if($errors->has('verify_code')) Validform_wrong @endif" >
                    @if ($errors->has('verify_code'))
                        {{ $errors->first('verify_code') }}
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
            var formData=$("#demoform").serialize();
            var form_url=$("#demoform").attr('action');
            if($("#demoform").attr('is')!=false){
              $("#demoform").attr("is",false);
              $.ajax({
                type: "POST",
                url:form_url,
                data:formData,
                success:function(data){
                    if(data.code==200){
                        layer.msg(data.message);
                        setTimeout(function(){
                            window.location.replace("{{URL('member')}}");
                        },500);
                    }else{
                        layer.msg(data.message);
                    }
                },
                error:function(data){
                  var obj = new Function("return" + data.responseText)();
                  obj = obj.errors;
                  var msg='';
                  $("#demoform").attr("is",true);
                  for (var prop in obj){
                      msg += obj[prop]+"\r";
                  }
                  alert(msg);
                }
              });
            }
            return false;
        }
    });
    var t=60;
    $("#rebind-get-msg").click(function(){
        var phone = $("#reset-phone").val();
        if($("#rebind-get-msg").attr('is')!=false){
            $("#rebind-get-msg").attr("is",false);
            $.ajax({
                type: "POST",
                url:"{{URL('bangding-sms-send')}}",
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
                    obj = obj.errors;
                    var msg='';
                    $("#rebind-get-msg").attr("is",true);
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