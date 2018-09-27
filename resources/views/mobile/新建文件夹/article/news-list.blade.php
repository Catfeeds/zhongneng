@foreach($article_list as $k=>$v)
<dl class="dl_list @if($k%2==1) nomargin @endif">
    <dt>
        <a href="{{URL($cate_info['url'],$v['id'])}}" >
            <img src="{{asset($v['img'])}}" alt="{{$v['alt']}}">
        </a>
    </dt>
    <dd>
        <a href="{{URL($cate_info['url'],$v['id'])}}" >
            <h3 class="ellipsis">{{$v['title']}}</h3>
            <p class="p_con ellipsis2">{!!nl2br($v['desc'])!!}</p>
        </a>
        <div class="dd_bottom">
            <span class="tag">
                {{date('Y-m-d',strtotime($v['add_time']))}}
            </span>
            <div class="btn">
                <span class="yy btn-contact apply_box_btn" data-channel="新笃爱_笃爱项目">马上预约</span>
                <span class="zx kefu_btn">在线咨询</span>
            </div>
        </div>
    </dd>
</dl>
@endforeach