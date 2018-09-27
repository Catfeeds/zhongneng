@extends('mobile.layouts.app')
@section('style')
@parent
@endsection
@section('content')
<!--  登录  -->
<div class="login_box">
    <div class="login-input">
        <form method="POST" id="demoform" action="{{URL('user-name-save')}}">
            @csrf
            <div class="login-input-user">
                <i class="iconfont2 font-user-input"></i>
                <input id="login-name" type="text" placeholder="名称" class="form-control text-input text-name" name="name" datatype="*" nullmsg="请输入名称" value="{{$user_info['name']}}">
                <label for="login-name" class="error Validform_checktip  @if($errors->has('name')) Validform_wrong @endif">
                    @if ($errors->has('name'))
                    {{ $errors->first('name') }}
                    @endif
                </label>
            </div>
            <input type="submit" class="button button-fill loginin-btn" id="login-submit" value="提交">
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
                        window.location.replace("{{URL('member')}}");
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
</script>
@endsection