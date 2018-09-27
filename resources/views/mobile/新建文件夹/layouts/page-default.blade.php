@if ($paginator->hasPages())
    <?php 
    // $previousPageUrl = $paginator->previousPageUrl();
    // preg_match('/page\=(\d+)/i',$previousPageUrl,$next_page);
    // $previousPageUrl= preg_replace("/(.*)-(\d+)-(\d+).html(.*)/","$1-$2-".$next_page[1].".html",$previousPageUrl);

    // $nextPageUrl = $paginator->nextPageUrl();
    // preg_match('/page\=(\d+)/i',$nextPageUrl,$next_page);
    // $nextPageUrl= preg_replace("/(.*)-(\d+)-(\d+).html(.*)/","$1-$2-".$next_page[1].".html",$nextPageUrl);
    
    // foreach ($elements as &$element){
    //     foreach($element as &$v){
    //         $url = $v;
    //         preg_match('/page\=(\d+)/i',$url,$page);
    //         $v = preg_replace("/(.*)-(\d+)-(\d+).html(.*)/","$1-$2-".$page[1].".html",$v);
    //     }
    // }
    // 
    // $paginator->currentPage()
    $previousPageUrl = $paginator->previousPageUrl();
    $start_url = preg_replace('/page\=(\d+)/i',"page=1",$previousPageUrl);

    $nextPageUrl = $paginator->nextPageUrl();
    $end_url = preg_replace('/page\=(\d+)/i',"page=".$paginator->lastPage(),$nextPageUrl);

    $path = $previousPageUrl?$previousPageUrl:$nextPageUrl;
    $path = preg_replace('/\&page\=(\d+)/i',"",$path);
    $path = preg_replace('/page\=(\d+)/i',"",$path);
    ?>
    <a @if($paginator->currentPage()>1) href="{{$start_url}}" @endif class="first @if($paginator->currentPage()==1) disabled @endif" data-action="first" >«</a>
    @if ($paginator->onFirstPage())
        <a class="previous disabled" data-action="previous" >上一页</a>
    @else
        <a href="{{ $previousPageUrl }}" class="previous" data-action="previous" >上一页</a>
    @endif
    <input type="text" data-max-page="{{$paginator->lastPage()}}" data-path="{{$path}}">
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="next" data-action="next" >下一页</a>
    @else
        <a class="next disabled" data-action="next" >下一页</a>
    @endif
    <a @if($paginator->currentPage()!=$paginator->lastPage()) href="{{$end_url}}" @endif class="last @if($paginator->currentPage()==$paginator->lastPage()) disabled @endif" data-action="last" >»</a>
    <!-- <ul class="pagination clearfix">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&lsaquo;</span></li>
        @else
            <li><a href="{{ $previousPageUrl }}" rel="prev">&lsaquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $nextPageUrl }}" rel="next">&rsaquo;</a></li>
        @else
            <li class="disabled"><span>&rsaquo;</span></li>
        @endif
    </ul> -->
    <script>
        $(function(){
            $('.pagination').jqPagination({
                max_page: {{$paginator->lastPage()}},
                paged: function(page) {
                    PageCallback(page);
                }
            });
            //翻页调用
            function PageCallback(page) {           
                InitTable(page);
            }
            //请求数据
            function InitTable(page) {                                
                $.ajax({ 
                    type: "get",
                    dataType: "text",
                    url: window.location.href,
                    data: {page:page},
                    success: function(data) {  
                        var result = $.parseJSON(data);  
                        $("#pageDiv").empty();
                        $("#pageDiv").append(result.html);//将返回的数据追加到表格
                    }
                });            
            }
        });
    </script>
@endif