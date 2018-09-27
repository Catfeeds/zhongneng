@extends('mobile.layouts.app')
@section('style')
<style type="text/css">
    body{background-color: #f8f8f8;}
</style>
@parent
@endsection
@section('content')
<div class="video_pay">
    <div class="payCourse">
        <div class="courseImg">
            <img src="{{asset($Video['img'])}}" alt="{{$Video['alt']}}">
        </div>
        <div class="courseInfo">
            <p class="courseTit">{{$Video['title']}}</p>
            <div class="pricesa">
                <p class="tag">
                    ￥
                    <span class="newPrice">{{$Video['price']}}</span>
                </p>
            </div>
        </div>
    </div>
    <form method="POST" id="passwordform" action="{{URL('video-pay-save')}}">
        @csrf
        <div class="payMethod">
            <p class="methTex">
                选择支付方式
            </p>
            <ul class="payUl">
                @if(is_weixin())
                <li tag="alipay" data-pay-type="1" class="on">
                    <a href="javascript:void(0)">
                        <img src="{{asset('resources/mobile/images/wx.jpg')}}">
                        微信支付
                    </a>
                </li>
                <input type="hidden" name="pay_type" value="1" id="pay_type">
                @else
                <!-- <li tag="alipay"  class="on">
                    <a href="javascript:void(0)">
                        <img src="http://a3.huazhen.com/huazhen_revision/mobile/paymentCourse/img/zfpay6.png">
                        支付宝支付
                    </a>
                </li> 
                <input type="hidden" name="pay_type" value="2" id="pay_type">-->
                @endif
                <div class="error">
                    @if ($errors->has('pay_type'))
                        {{ $errors->first('pay_type') }}
                    @endif
                </div>
            </ul>
            <input type="hidden" name="id" value="{{$Video['video_id']}}">
        </div>
        <a href="javascript:void(0)" class="topay">
            立即购买
        </a>
    </form>
</div>
@endsection
@section('script')
@parent
<script type="text/javascript">
    $(".topay").click(function(){
        $(this).parents("form").submit();
    })
</script>
@endsection