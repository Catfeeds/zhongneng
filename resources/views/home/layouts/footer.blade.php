@section('footer')
    <div class="foot">
        <div class="layout">
            <div class="f_menu">
                <div class="tit">Directory navigation</div>
                <dl class="clearfix">
                    <dt><em>·</em>快捷导航</dt>
                    @foreach(nav(2) as $k=>$v)
                    <dd><a  @if(!empty($v['url']))href="{{$v['url']}}"@endif @if($v['is_blank']) target="_blank" @endif>{{$v['title']}}</a></dd>
                    @endforeach
                </dl>
            </div>
            <div class="f_mid clearfix">
                <div class="fl">
                    <h3>广州中能电力建设工程有限公司</h3>
                    <p>
                        公司地址：{{ConfigGet('address')}}<br />
                        邮箱：{{ConfigGet('email')}}<br />
                        邮编：{{ConfigGet('zip_code')}}
                    </p>
                </div>
                <div class="ewm"><img src="{{asset(ConfigGet('ewm'))}}" alt="{{ConfigGet('site_name')}}"></div>
                <div class="fr">
                    <div class="clearfix"><a href="{{URL(ConfigGet('zx_url'))}}" class="but"></a></div>
                    <p>统 一 服 务 热 线<em>{{ConfigGet('tel')}}</em></p>
                </div>
            </div>
            <div class="links clearfix">
                <span>友情链接：</span>
                @foreach(link_get() as $v)
                <a href="{{$v['url']}}" target="_blank">{{$v['title']}}</a>
                @endforeach
            </div>
        </div>
        <div class="copyright">
            <div class="layout clearfix">
                <div class="fl">广州中能电力建设工程有限公司 {{ConfigGet('copyright')}}</div>
                <div class="fr">案号：{{ConfigGet('beian')}}</div>
            </div>
        </div>
    </div>
@show