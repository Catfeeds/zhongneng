@if ($paginator->hasPages())
    @if ($paginator->onFirstPage())
        <a class="prve iconfont no">上一页</a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="prve iconfont">上一页</a>
    @endif

    {{--@foreach ($elements as $element)
        @if (is_string($element))
            <a>{{ $element }}</a>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a class="on">{{$page}}</a>
                @else
                    <a href="{{$url}}">{{$page}}</a>
                @endif
            @endforeach
        @endif
    @endforeach--}}

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="next iconfont">下一页</a>
    @else
        <a class="next iconfont no">下一页</a>
    @endif
@endif