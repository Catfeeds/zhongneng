@extends('mobile.layouts.app')
@section('style')
<style type="text/css">
    body{background-color: #f2f2f2}
</style>
@parent
@endsection
@section('content')
<div class="mainSelf">
    <div class="selfGroup selfTop">
        <div class="selfImg">
            <img src="{{asset($user_info['pic'])}}" alt="" />
        </div>
        <div class="selfName">
            <span class="selfNameValue">{{$user_info['name']}}</span>
            <a href="{{URL('member-edit')}}"><span class="editIcon"></span></a>
        </div>
        @if($user_info['grade']==1)
        <p class="user_kt">
            <a href="{{URL('vip-pay')}}" class="vip_btn">成为VIP</a>
        </p>
        @else
        <div class="vip">
            <span>{{date('Y-m-d',strtotime($user_info['grade_end']))}}到期</span><a href="{{URL('vip-pay')}}" class="xufei">续费</a>
        </div>
        @endif
    </div>
            <!-- <span class="wxNo"><a href="/account/wechat/login" style="color:#ff5266;">去绑定微信</a></span> -->
    <div class="selfGroup selfList">
        <ul>
            <a href="{{URL('member-video-list')}}">
                <li class="wdkc">
                    <i class="bgIcon"></i>
                    <p>我的课程</p>
                    <i class="moreIcon"></i>
                </li>
            </a>
            <a href="{{URL('logout')}}">
                <li class="end">
                    <i class="bgIcon"></i>
                    <p>退出</p>
                    <i class="moreIcon"></i>
                </li>
            </a>
        </ul>
    </div>
</div>


@endsection
@section('script')
@parent
    <script type="text/javascript">
        // 名称修改
        $(".xg").click(function(){
            $(".user_name_show").hide();
            $(".user_name_edit").show();
        })
        $(".sure").click(function(){
            $(".user_name_show").show();
            $(".user_name_edit").hide();
        })
        $(".user_center_colse").click(function(){
            var name = $(".user_name_edit").find("input[name='name']").val();
            if($(".get-msg").attr('is')!=false){
                $(".get-msg").attr("is",false);
                $.ajax({
                    type: "POST",
                    url:"{{URL('user-name-save')}}",
                    data:"name="+name,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data){
                        if(data.code==200){
                            $(".update_field").html(data.data);
                            $(".user_name_show").show();
                            $(".user_name_edit").hide();
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
        // 名称修改end
        // 修改绑定手机
        $(".cxbd").click(function(){
            $("#bangding").show();
        })
        $(".bd1_gb").click(function(){
            $("#bangding").hide();
        })
        var t=60;
        $("#rebind-get-msg").click(function(){
            var phone = $("#rebind-mobile").val();
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
            $("#rebind-get-msg").val("")
            sint = setInterval(function(){
              $("#rebind-get-msg").val(t--);
              if(t<=0){
                $("#rebind-get-msg").attr("is",true);
                $("#rebind-get-msg").val("获取验证码");
                clearInterval(sint);
              }
            },1000)
        }
        $("#rebindform .subt").click(function(){
            var formData=$("#rebindform").serialize();
            var form_url=$("#rebindform").attr('action');
            if($("#rebindform .subt").attr('is')!=false){
                $("#rebindform .subt").attr("is",false);
                $.ajax({
                    type: "POST",
                    url:form_url,
                    data:formData,
                    success:function(data){
                        if(data.code==200){
                            $(".user_phone").html(data.data);
                            $("#bangding").hide();
                        }else{
                            $(".get-msg").attr("is",true);
                            alert(data.message);
                        }
                    },
                    error:function(data){
                        var obj = new Function("return" + data.responseText)();
                        obj = obj.errors;
                        var msg='';
                        $("#rebindform .subt").attr("is",true);
                        for (var prop in obj){
                            msg += obj[prop]+"\r";
                        }
                        alert(msg);
                    }
                });
            }
        })
        // 修改绑定手机end
        // 修改密码
        $(".xg3").click(function(){
            $("#xgmm").show();
        })
        $(".xgmm_gb").click(function(){
            $("#xgmm").hide();
        })
        var t=60;
        
        $(".get-msg").click(function(){
            var phone = $("#rebind-mobile").val();
            if($(".get-msg").attr('is')!=false){
                $(".get-msg").attr("is",false);
                $.ajax({
                    type: "POST",
                    url:"{{URL('password-sms-send')}}",
                    data:"phone="+phone,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data){
                        if(data.code==200){
                            alert(data.message+data.data.captcha);
                            t=60;
                            captcha_up2();
                        }else{
                            $(".get-msg").attr("is",true);
                            alert(data.message);
                        }
                    },
                    error:function(data){
                        var obj = new Function("return" + data.responseText)();
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
        function captcha_up2(){
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
        $("#passwordform .save2").click(function(){
            var formData=$("#passwordform").serialize();
            var form_url=$("#passwordform").attr('action');
            if($("#passwordform .save2").attr('is')!=false){
                $("#passwordform .save2").attr("is",false);
                $.ajax({
                    type: "POST",
                    url:form_url,
                    data:formData,
                    success:function(data){
                        if(data.code==200){
                            alert(data.message);
                            $("#xgmm").hide();
                        }else{
                            alert(data.message);
                        }
                    },
                    error:function(data){
                        var obj = new Function("return" + data.responseText)();
                        obj = obj.errors;
                        var msg='';
                        $("#passwordform .save2").attr("is",true);
                        for (var prop in obj){
                            msg += obj[prop]+"\r";
                        }
                        alert(msg);
                    }
                });
            }
        })
        // 修改密码end
       
    </script>
@endsection