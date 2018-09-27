@extends('mobile.layouts.app')
@section('style')
<style type="text/css">
    body{background-color: #f8f8f8;}
</style>
@parent
@endsection
@section('content')

@endsection
@section('script')
@parent
<script type="text/javascript">
    //调用微信JS api 支付
    //在线充值
    function jsApiCall(){
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            {
                "appId":'{{$Pay['appId']}}',
                "nonceStr":'{{$Pay['nonceStr']}}',
                "package":'{{$Pay['package']}}',
                "paySign":'{{$Pay['paySign']}}',
                "signType":'{{$Pay['signType']}}',
                "timeStamp":'{{$Pay['timeStamp']}}'
            },
            function(res){
                if(res.err_msg == 'get_brand_wcpay_request:ok'){
                    window.location.replace("{{$url_ok}}");
                }else{
                    window.location.replace("{{$url_no}}");
                }
            }
        );
    }
    function callpay(){
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', jsApiCall,false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        }else{
            jsApiCall();
        }
    }
</script>
<input type="button" class="done_btn mt1" style="display:none;"  id="paynow" value="立即支付" onclick="callpay()"/>
<script type="text/javascript">
    $(function(){
        $('#paynow').click();
    })
</script>
@endsection