@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @include('home.layouts.top_banner')
    <div class="layout">
        <div class="location clearfix">
            <span>{{$cate_info['title']}}<em>{{$cate_info['en_title']}}</em></span>
        </div>
        <div class="contact1">
            <div class="tit">{{ConfigGet('gs_title')}}<em>{{ConfigGet('gs_en_title')}}</em></div>
            <div class="tit2">联系我们<em>{{ConfigGet('tel')}}</em></div>
            <ul class="clearfix">
                <li>
                    <p class="p1"><em>联系地址：</em>{{ConfigGet('address')}}</p>
                </li>
                <li>
                    <p class="p2"><em>电子邮箱：</em>{{ConfigGet('email')}}</p>
                </li>
                <li>
                    <p class="p3"><em>邮政编码：</em>{{ConfigGet('zip_code')}}</p>
                </li>
            </ul>
            <h4>{!!$cate_info['content']!!}</h4>
        </div>
    </div>
    <div class="contact2">
        <div class="layout">
            <div class="tit">在线留言咨询<em>Feedback</em></div>
            <form method="POST" action="{{URL('apply-save')}}">
                <div class="int clearfix">
                    <input type="text" class="text fl" name="name" placeholder="请输入姓名" />
                    <input type="text" class="text fr" name="phone" placeholder="请输入联系方式" />
                </div>
                <div class="int clearfix">
                    <input type="text" class="text fl" name="email" placeholder="请输入邮箱" />
                    <input type="text" class="text fr" name="address" placeholder="请输入地址" />
                </div>
                <div class="int clearfix">
                    <textarea name="remark" placeholder="请输入备注信息"></textarea>
                </div>
                <div class="int clearfix">
                    <input type="text" name="code" class="text text2 fl" placeholder="请输入验证码" />
                    <div class="yzm">{!!captcha_img()!!}</div>
                </div>
                <input type="button" class="button" value="提交" id="apply_submit"/>
            </form>
        </div>
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