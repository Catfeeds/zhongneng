<div class="location clearfix">
    <span>{{$top_category['title']}}<em>{{$top_category['en_title']}}</em></span>
    @if($sub_category->count())
    <ul class="clearfix">
        <li class="@if($cate_info['id'] == $top_category['id']) on @endif"><a href="{{URL('category',[$top_category['id']])}}">全部</a></li>
        @foreach($sub_category as $k=>$v)
        <li class="@if($cate_info['id'] == $v['id']) on @endif"><a href="{{URL('category',[$v['id']])}}">{{$v['title']}}</a></li>
        @endforeach
    </ul>
    @endif
</div>