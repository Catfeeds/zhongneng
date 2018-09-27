<div class="page2 clearfix">
    <ul>
        <li><a @if($prev_article) href="{{URL('article',[$prev_article['id']])}}" @endif ><i>上一条</i>{{$prev_article['title'] or '无'}}</a></li>
        <li><a @if($next_article) href="{{URL('article',[$next_article['id']])}}" @endif ><i>下一条</i>{{$next_article['title'] or '无'}}</a></li>
    </ul>
    <a href="{{URL('category',$cate_info['id'])}}" class="backbtn">返回列表</a>
</div>