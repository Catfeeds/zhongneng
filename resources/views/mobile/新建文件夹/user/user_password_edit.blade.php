@extends('home.layouts.app')
@section('style')
@parent
@endsection
@section('content')
<div class="login" style="background-image: url({{asset('resources/home/images/loginbg.jpg')}})">
    <div class="txt">
        <div class="loginbox clearfix">
            <div class="text">数据治理技术与服务提供商</div>
            <div class="showbox">
                <div class="login-item">
                    <div class="changePwd">修改密码</div>           
                </div>
                <div class="logins active">
                    <form method="POST" id="logo_form" action="{{URL('user-password-save')}}">
                        @csrf
                        <div class="mz clearfix">
                            <label>旧密码</label>
                            <input type="password" name="old_password" datatype="*" nullmsg="请输入旧密码">
                        </div>
                        <div class="mz clearfix">
                            <label>新密码</label>
                            <input type="password" name="password" datatype="*" nullmsg="请输入新密码">
                        </div>
                        <div class="mz clearfix">
                            <label style="line-height: normal">再输入新密码</label>
                            <input type="password" name="password_confirmation" datatype="*" recheck="password" errormsg="您两次输入的密码不一致！">
                        </div>
                        <input type="submit" class="submit" value="提交">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@parent
<script type="text/javascript">
    $("#logo_form").Validform({
        // tiptype:3,
        showAllError:false,
        tiptype:function(msg,o){
            if(o.type==3){
                layer.msg(msg,{icon:2});
            }
        },
        // btnSubmit:".loginin-btn",
        beforeSubmit:function(date){
            var formData=$("#logo_form").serialize();
            var form_url=$("#logo_form").attr('action');
            $.ajax({
              type: "POST",
              url:form_url,
              data:formData,
              success:function(data){
                if(data.code==200){
                    layer.msg(data.message,{icon:1});
                }else{
                    layer.msg(data.message,{icon:2});
                }
              },
              error:function(data){
                var obj = new Function("return" + data.responseText)();
                obj = obj.errors;
                var msg='';
                for (var prop in obj){
                    tx = obj[prop]+"<br/>";
                    console.log(msg.indexOf(tx));
                    if(msg.indexOf(tx)==-1){
                        msg += obj[prop]+"<br/>";
                    }
                }
                layer.msg(msg,{icon:2});
              }
            });
            return false;
        },
    });
    @if(count($errors) > 0)
        var error = "";
        @foreach ($errors->all() as $error)
            error += "{{$error}}<br/>";
        @endforeach
        layer.msg(error,{icon:2});
    @endif
</script>
@endsection