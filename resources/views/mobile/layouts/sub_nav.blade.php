<div class="swiper-container nav">
	<div class="swiper-wrapper">
		@foreach($sub_category as $k=>$v)
		<div class="swiper-slide @if($cate_info['id'] == $v['id']) on @endif"><a href="{{URL('category',[$v['id']])}}">{{$v['title']}}</a></div>
		@endforeach
	</div>
</div>