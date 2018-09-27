@extends('home.layouts.app')
@section('style')
@parent
@endsection
@section('content')
<div class="user_main">
    <div class="site_container">
        <div class="container_inner clearfix">
            @include('home.layouts.member-nav')
            <div class="user_right_content">
                <div class="panel_main">
                    <div class="my_img "  >
                        <span class="f-fl">当前头像：</span>
                        <div class="pal2_upImg">
                            <img src="{{asset($user_info['pic'])}}" alt="">
                        </div>
                    </div>
                    <div class="my_upimg">
                        <span>上传头像：</span>
                        <span class="sc-tp">本地上传</span>
                        <input type="file" id="select-image" style="display: none" />
                    </div>
                    <div class="my_txt">
                        <span>*仅支持JPG、GIF、PNG图片文件，且文件小于5M</span>
                    </div>
                    <div class="my_cj">
                        <div class="my_cj2">
                            <p>选择一张本地图片编辑后上传为图像</p>
                        </div>
                    </div>
                    <div class="my_bc">
                        <span>保存</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@parent
    <script type="text/javascript">
        //点击图片上传
        $(".sc-tp").click(function() {
            $("#select-image").click();
        })
            //图片上传
        var $image = $('.my_cj2');
        $image.cropper({
            preview: '.pal2_upImg', //不同尺寸预览区
            aspectRatio: 4 / 3, //裁剪比例，NaN-自由选择区域
            autoCropArea: 0.9, //初始裁剪区域占图片比例
            crop: function(data) { //裁剪操作回调
                console.log(data);
            }
        });
        $('.my_bc').on('click', function() {
            $image.cropper('getCroppedCanvas').toBlob(function(blob) {
                var formData = new FormData();
                formData.append('image', blob);
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
                            window.location.reload();
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
            });
        });

        var fileName; //选择上传的文件名
        $('#select-image').change(function() {
            var file = this.files[0];
            fileName = file.name;
            var reader = new FileReader();
            //reader回调，重新初始裁剪区
            reader.onload = function() {
                // 通过 reader.result 来访问生成的 DataURL
                var url = reader.result;
                //选择图片后重新初始裁剪区
                $('.my_cj2').attr('src', url);
                $image.cropper('reset', true).cropper('replace', url);
                //显示上传按钮
                //$('#upload-btn').show();
                //隐藏重新裁剪按钮
                //$('#enable-cropper').hide();
            };
            reader.readAsDataURL(file);
        });

        /*解除裁剪区锁定*/
        $('#enable-cropper').click(function() {
            $image.cropper('enable');
            $('#upload-btn').show();
            $(this).hide();
        });

        var handleClick = function() {
            $(".panel_content4 .btn-box button").on("click", function() {
                var btns = $(".panel_content4 .btn-box button"),
                    tables = $(".panel_content4 .table-list"),
                    index = $(this).index();

                $.each(btns, function(i, item) {
                    btns.eq(i).removeClass();
                    tables.eq(i).hide(300);
                });
                tables.eq(index).show(300);
                btns.eq(index).addClass("active");
            });
        };
    </script>
@endsection