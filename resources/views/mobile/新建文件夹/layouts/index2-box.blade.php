@if($index2_box['template']=='index2-oem')
	<div class="ser_1">
		<div class="title2">{{$index2_box['en_title']}}<p>{{$index2_box['title']}}</p></div>
		<ul class="clearfix">
			@foreach($index2_box['article'] as $b_v)
		    <li>
		        <i><img src="{{asset($b_v['img'])}}" alt="{{$b_v['alt']}}"></i>
		        <p>{{$b_v['title']}}</p>
		    </li>
		    @endforeach
		</ul>
	</div>
@elseif($index2_box['template']=='index2-advantage')
	<div class="ser_2">
		<div class="title2">{{$index2_box['en_title']}}<p>{{$index2_box['title']}}</p></div>
		<ul>
			@foreach($index2_box['article'] as $b_v)
		    <li>
		        <h3>{{$b_v['title']}}</h3>
		        <p>{!!nl2br($b_v['desc'])!!}</p>
		    </li>
		    @endforeach
		</ul>
	</div>
@elseif($index2_box['template']=='index2-qualification')
	<div class="ser_3">
		<div class="title2">{{$index2_box['en_title']}}<p>{{$index2_box['title']}}</p></div>
		<div class="pic"><img src="{{asset($index2_box['img2'])}}" alt="{{$index2_box['alt2']}}"></div>
	</div>
@elseif($index2_box['template']=='index2-fsc1')
	<div class="intro_1">
		<div class="title2">{{$index2_box['en_title']}}<p>{{$index2_box['title']}}</p></div>
		<div class="w content_con">
			{!!$index2_box['content']!!}
		</div>
	</div>
@elseif($index2_box['template']=='index2-fsc2')
	<style type="text/css">
		.intro_2 .js2{display: none;}
	</style>
	<div class="intro_2">
		<div class="tit"><img src="{{asset($index2_box['img2'])}}" alt="{{$index2_box['alt2']}}"></div>
		{!!$index2_box['content']!!}
	</div>
@elseif($index2_box['template']=='index2-fsc3')
	<div class="intro_3">
		<div class="swiper-container intro_3con">
			<div class="swiper-wrapper">
				@foreach($index2_box['article'] as $b_v)
				<div class="swiper-slide">
					<div class="tit"><img src="{{asset($index2_box['img2'])}}" alt="{{$index2_box['alt2']}}"></div>
					<ul>
						<li>{!!nl2br($b_v['desc'])!!}</li>
					</ul>
				</div>
				@endforeach
			</div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			var intro_3con=new Swiper('.intro_3con',{
	            loop:true,
	            pagination : '.swiper-pagination',
	            autoHeight: true
	       	});
		});
	</script>
@elseif($index2_box['template']=='index2-fsc5')
	<div class="intro_4">
		<div class="tit">{{$index2_box['title']}}<em>{{$index2_box['en_title']}}</p></div>
		<h3>{!!nl2br($index2_box['cat_desc'])!!}</h3>
		<a>製品を表示する</a>
	</div>
@endif