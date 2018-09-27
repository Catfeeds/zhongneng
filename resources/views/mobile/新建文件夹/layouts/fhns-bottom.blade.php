<div class="fhns-bottom">
    <ul>
        @foreach(nav(4) as $k=>$v)
        <li>
            <a @if(!empty($v['url'])) href="{{$v['url']}}" @endif @if($v['is_blank'])  @endif title="{{$v['title']}}"  @if(count($v['child'])) class="cur" @endif>{{$v['title']}}</a>
        </li>
        @endforeach
    </ul>
</div>