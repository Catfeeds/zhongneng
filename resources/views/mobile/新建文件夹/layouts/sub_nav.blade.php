<div class="swiper-container nav">
    <div class="swiper-wrapper">
		@foreach($sub_category as $k=>$v)
        <div class="swiper-slide @if(isset($url)&&in_array(trim($v['url'],"/"),$cate_tree_on)) on @endif "><a href="{{url($v['url'])}}" title="{{$v['title']}}">{{$v['title']}}</a></div>
	    @endforeach
    </div>
</div>