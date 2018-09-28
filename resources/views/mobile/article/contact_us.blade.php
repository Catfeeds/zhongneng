@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('mobile.layouts.top_banner')
    @include('mobile.layouts.sub_nav')
    <div class="contact_1">
        <div class="tit">{{ConfigGet('gs_title')}}<p>{{ConfigGet('gs_en_title')}}</p></div>
        <div class="tit2">联系我们<h3>{{ConfigGet('tel')}}</h3></div>
        <ul>
            <li>地址/Add： {{ConfigGet('address')}}</li>
            <li>邮箱/Mail： {{ConfigGet('email')}}</li>
            <li>邮编/Code： {{ConfigGet('zip_code')}}</li>
        </ul>
    </div>
    <div class="contact_2">
        <div class="tit">Online feedback<p>在线反馈</p></div>
        <form method="POST" action="{{URL('apply-save')}}">
            <div class="clearfix int">
                <span>您的名字：</span>
                <input type="text" name="name" class="text" />
            </div>
            <div class="clearfix int">
                <span>您的邮箱：</span>
                <input type="text" name="email" class="text" />
            </div>
            <div class="clearfix int">
                <span>联系方式：</span>
                <input type="text" name="phone" class="text" />
            </div>
            <div class="clearfix int">
                <span>您的地址：</span>
                <input type="text" name="address" class="text" />
            </div>
            <div class="clearfix int">
                <span>留言信息：</span>
                <input type="text" name="remark" class="text" />
            </div>
            <input type="button" class="more" value="提交" id="apply_submit"/>
        </form>
    </div>
@endsection
@section('script')
    @parent
    <script type="text/javascript">
        $(".yzm").click(function(){
            $(this).find("img").attr('src',"{{captcha_src()}}"+Math.random());
        })
        $("#apply_submit").click(function(){
          var formData=$(this).parents("form").serialize();
          var form_url=$(this).parents("form").attr('action');
          if($("#apply_submit").attr('is')!="false"){
            $("#apply_submit").attr("is","false");
            $.ajax({
              type: "POST",
              url:form_url,
              data:formData,
              headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
              },
              success:function(data){
                $(".yzm").find("img").attr('src',"{{captcha_src()}}"+Math.random());
                layer.msg(data.message,{icon:1});
              },
              error:function(data){
                $(".yzm").find("img").attr('src',"{{captcha_src()}}"+Math.random());
                var obj = new Function("return" + data.responseText)();
                obj = obj.errors;
                var msg='';
                $("#apply_submit").attr("is","true");
                for (var prop in obj){
                    msg += obj[prop]+"<br/>";
                }
                layer.msg(msg,{icon:2});
              }
            });
          }
        })
    </script>
@endsection