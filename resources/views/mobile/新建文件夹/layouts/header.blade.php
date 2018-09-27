@section('header')
    <div class="header">
        <a href="/" class="logo" style="background-image: url({{asset(ConfigGet('logo'))}});"></a>
        <a class="menubtn"></a>
    </div>
    <div class="menu">
        <div class="menucon">
            <ul>
                @foreach(nav(1) as $k=>$v)
                <li class="new_list @if(isset($url)&&in_array(trim($v['url'],"/"),$cate_tree_on)) on @endif ">
                    <p ><a @if(!empty($v['url'])) href="{{$v['url']}}" @endif @if($v['is_blank']) target="_blank" @endif title="{{$v['title']}}"  >{{$v['title']}}</a></p>
                    @if(count($v['child']))
                        <dl class="submenu">
                            @foreach($v['child'] as $v2)
                            <dd @if(isset($url)&&in_array(trim($v2['url'],"/"),$cate_tree_on)) class="on" @endif><a @if(!empty($v2['url'])) href="{{$v2['url']}}" @endif @if($v2['is_blank']) target="_blank" @endif title="{{$v2['title']}}">{{$v2['title']}}</a></dd>
                            @endforeach
                        </dl>
                    @endif
                </li>
                @endforeach
            </ul>
            <div class="other_login clearfix">
                <dl class="clearfix">
                    <dd><a href="{{ConfigGet('jd_url')}}"><img src="{{asset('resources/mobile/images/jd.png')}}"></a></dd>
                </dl>
            </div>
        </div>
    </div>
@show