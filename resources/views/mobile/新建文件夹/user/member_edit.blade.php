@extends('mobile.layouts.app')
@section('style')
@parent
@endsection
@section('content')
<div class="login_box">
    <div class="infor">
        <ul>
            <li class="infor_tx bdb">
                <span class="left">头像</span>
                <div class="right">
                    <span class="tx avatar">
                        <img src="{{asset($user_info['pic'])}}" alt="">
                    </span>
                </div>
                <input onchange="updateAvatar()" type="file" name="image" id="image-file" style="display:none;">
            </li>
            <li>
                <a href="{{URL('user-name-edit')}}">
                    <span class="left">
                        昵称
                    </span>
                    <div class="right">
                        {{$user_info['name']}}
                    </div>
                </a>
            </li>

            <li class="phone">
                <a href="{{URL('user-phone-edit')}}">
                    <span class="left">手机</span>
                    <div class="right">
                        {{substr_replace($user_info['phone'],'****',3,4)}}
                    </div>
                </a>
            </li>
            <li class="password">
                <a href="{{URL('user-password-edit')}}">
                    <span class="left">密码</span>
                    <div class="right"></div>
                </a>
            </li>
            
        </ul>
    </div>
</div>
@endsection
@section('script')
@parent
<script type="text/javascript">
    updateAvatar = function(){
        var formData = new FormData(); 
        var v_this = $('#image-file');
        var fileObj = v_this.get(0).files;
        if (fileObj.length == 0) {
            return;
        };
        formData.append("image", fileObj[0]); 
        $.ajax({
            type: "POST",
            url:"{{URL('member-pic-save')}}",
            data:formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if(data.code==200){
                    $('.avatar img').attr('src',data.data);
                    layer.msg(data.message);
                }else{
                    layer.msg(data.message);
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
    $('.avatar').on('click', function (){
        $('#image-file').click();
    });
</script>
@endsection