<div class="page page2">
    <div class="dis">
        <a @if($prev_article) href="{{URL('article',[$prev_article['id']])}}" @endif class="a2">{{$prev_article?'上一篇':'没了'}}</a>
        <a href="{{URL('category',$cate_info['id'])}}">返回列表</a>
        <a @if($next_article) href="{{URL('article',[$next_article['id']])}}" @endif class="a2">{{$next_article?'下一篇':'没了'}}</a>
    </div>
</div>