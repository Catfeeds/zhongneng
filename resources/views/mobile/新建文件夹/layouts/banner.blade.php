@if(isset($banner)&&$banner->count())
<div class="banner">
    @foreach($banner as $v)
    <div><a @if(!empty($v['url']))href="{{$v['url']}}"@endif ><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></a></div>
    @endforeach
</div>
@endif