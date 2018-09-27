<div class="page2">
    <div class="dis">
        <a @if($prev_article) href="{{URL($cate_info['url'],[$prev_article['id']])}}" @endif>上一篇{{$prev_article['title'] or '无'}}</a>
        <a href="{{URL($cate_info['url'])}}">返回列表</a>
        <a @if($next_article) href="{{URL($cate_info['url'],[$next_article['id']])}}" @endif>下一篇{{$next_article['title'] or '无'}}</a>
    </div>
</div>