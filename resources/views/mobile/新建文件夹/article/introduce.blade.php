@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
	@if(!empty($top_category['img']))
	<div class="banner" style="background-image: url({{asset($top_category['img'])}}); height:482px;"></div>
	@endif
    <div class="layout">
        @include('home.layouts.location')
        @foreach($cate_list as $k=>$v)
			<div class="b_content">
				{!!$v['content']!!}
			</div>
			@if($v['MoreImageMany'])
				@if($k==0)
					<div class="hzpp_photo">
		                <div class="swiper-container int-container">
		                    <div class="swiper-wrapper">
		                    	@foreach($v['MoreImageMany'] as $k2=>$v2)
		                        <div class="swiper-slide"><img src="{{asset($v2['image'])}}" alt="{{$v2['alt']}}"></div>
       							@endforeach
		                    </div>
		                    <a class="arrow-left" ></a>
		                    <a class="arrow-right" ></a>
		                </div>
		            </div>
		        @else
		        	<div class="hzhd_more_img">
		        		<ul class='claerfix'>
		        			@foreach($v['MoreImageMany'] as $k2=>$v2)
		                        <li>
		                        	<div class="img"><img src="{{asset($v2['image'])}}" alt="{{$v2['alt']}}"></div>
		                        	<p>{{$v2['title']}}</p>
		                        </li>
   							@endforeach
		        		</ul>
		        	</div>
				@endif
			@endif
        @endforeach
		@if($daoshi)
			<div class="daoshi">
				<h3 class="t">笃爱导师</h3>
				<ul class="list clearfix">
					@foreach($daoshi as $k=>$v)
						<li>
							<a href="{{URL($daoshi_cate['url'],[$v['id']])}}">
								<div class="img"><img src="{{asset($v['img2'])}}" alt="{{$v['alt2']}}"></div>
								<div class="title">{{$v['title']}}</div>
								<div class="title2">{{$v['title2']}}</div>
								<div class="desc">{!!nl2br($v['desc'])!!}</div>
							</a>
						</li>
					@endforeach
				</ul>
			</div>
		@endif
    </div>
@endsection
@section('script')
    @parent
    <script type="text/javascript">
    	var appendNumber = 4;
	    var prependNumber = 1;
	    var myswiper = new Swiper('.int-container', {
	        nextButton: '.swiper-button-next',
	        prevButton: '.swiper-button-prev',
	        slidesPerView: 5,
	        // centeredSlides: true,
	        paginationClickable: true,
	        spaceBetween: 15,
	    });
		$('.arrow-left').on('click', function(e){
			e.preventDefault()
			myswiper.slidePrev();
		})
		$('.arrow-right').on('click', function(e){
			e.preventDefault()
			myswiper.slideNext();
		})
    </script>
@endsection