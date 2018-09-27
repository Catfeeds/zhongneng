@section('header')
    <div class="header">
        <div class="htop">
            <div class="layout clearfix">
                <span>{{ConfigGet('top_desc')}}</span>
                <a href="#" class="s_ic s_ic3"></a>
                <a href="#" class="s_ic s_ic2"></a>
                <a href="#" class="s_ic"></a>
                <p>{{ConfigGet('tel')}}</p>
            </div>
        </div>
        <div class="h_bot">
            <div class="layout clearfix">
                <a href="/" class="logo"><img src="{{asset(ConfigGet('logo'))}}" alt="{{ConfigGet('site_name')}}"></a>
                <ul class="menu clearfix">
                    @foreach(nav(1) as $k=>$v)
                    <li class=" @if(in_array($v['id'],$cate_tree_on)) on @endif ">
                        <p><a @if(!empty($v['url'])) href="{{$v['url']}}" @endif @if($v['is_blank']) target="_blank" @endif>{{$v['title']}}</a></p>
                        @if(count($v['child']))
                            <div class="submenu">
                                <dl>
                                    @foreach($v['child'] as $v2)
                                    <dd class=" @if(in_array($v2['id'],$cate_tree_on)) on @endif "><a @if(!empty($v2['url'])) href="{{$v2['url']}}" @endif @if($v2['is_blank']) target="_blank" @endif>{{$v2['title']}}</a></dd>
                                    @endforeach
                                </dl>
                            </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@show