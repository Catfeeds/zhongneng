<div class="loca layout">
	当前位置：<a href="/" target="_self">首页</a>
    @foreach($location as $k=>$v)
	    <em>&gt;</em>
	    <a @if(!empty($v['url'])) href="{{$v['url']}}" @endif>{{$v['title']}}</a>
    @endforeach
</div>