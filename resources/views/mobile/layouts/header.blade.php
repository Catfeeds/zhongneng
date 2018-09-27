@section('header')
    <div class="header">
        <a href="/" class="logo" style="background-image: url({{asset(ConfigGet('logo'))}});"></a>
        <div class="menubtn"></div>
    </div>
    <div class="menu">
        <div class="con">
            <ul>
                @foreach(nav(1) as $k=>$v)
                <li class=" @if(in_array($v['id'],$cate_tree_on)) on @endif ">
                    <p><a @if(!empty($v['url'])) href="{{$v['url']}}" @endif @if($v['is_blank']) target="_blank" @endif>@if(count($v['child']))<em></em>@endif{{$v['title']}}</a></p>
                    @if(count($v['child']))
                        <dl>
                            @foreach($v['child'] as $v2)
                            <dd class=" @if(in_array($v2['id'],$cate_tree_on)) on @endif "><a @if(!empty($v2['url'])) href="{{$v2['url']}}" @endif @if($v2['is_blank']) target="_blank" @endif>{{$v2['title']}}</a></dd>
                            @endforeach
                        </dl>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@show