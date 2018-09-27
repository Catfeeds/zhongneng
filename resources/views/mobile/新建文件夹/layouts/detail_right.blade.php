<div class="detail_right">
    @foreach(ads_image(23,1) as $v)
    <div class="case_zx">
        <a class="bendi" @if(!empty($v['url'])) href="{{$v['url']}}" @endif ><img src="{{asset($v['image'])}}" alt="{{asset($v['alt'])}}"> </a>
        <a  class="kefu_btn zx" >立即咨询</a> 
        <a  class="apply_box_btn zx" data-channel="新笃爱_文章页" >免费申请</a> 
    </div>
    @endforeach
    <div class="tjzj">
        <h4>推荐导师</h4>
        @foreach($art_4 as $k=>$v)
        <dl>
            <a href="{{URL($cat_4['url']),$v['id']}}" >
                <dt>
                    <img src="{{asset($v['img'])}}" alt="{{$v['alt']}}">
                </dt>
                <dd>
                    <span>{{$v['title']}}</span>
                    <p>{{$v['title2']}}</p>                               
                </dd>
             </a>
        </dl>
        @endforeach
        
    </div>
    @if($cat_1)
    <div class="hot_ask">
        <h4>{{$cat_1['title']}}</h4>
        @if(isset($art_1['0']))
        <dl>
            <dt>
                <a href="{{URL($cat_1['url']),$art_1['0']['id']}}" target="_self">
                    <img src="{{asset($art_1['0']['img'])}}" alt="{{$art_1['0']['alt']}}">
                </a>
            </dt>
            <dd>
                <p><a hhref="{{URL($cat_1['url']),$art_1['0']['id']}}" target="_self">{{$art_1['0']['title']}}</a></p>
                <span class="artic_dot" style="word-wrap: break-word;">{!!$art_1['0']['desc']!!}<a href="{{URL($cat_1['url']),$art_1['0']['id']}}" class="readmore" target="_self">【详情】</a></span>
            </dd>
        </dl>
        @endif
        <ul class="ask_list">
            @foreach($art_1 as $k=>$v)
            @if($k>0)
            <li><a href="{{URL($cat_1['url']),$v['id']}}" target="_self">{{$v['title']}}</a></li>
            @endif
            @endforeach
       </ul>
    </div>
    @endif
    @if($cat_2)
    <div class="marry">
        <h4>{{$cat_2['title']}}</h4>
        <div class="marry_in">
            @foreach($art_2 as $k=>$v)
                @if($k==3)
                <p class="box4">
                    <a href="{{URL($cat_1['url']),$v['id']}}" >
                        <img src="{{asset($v['img'])}}" alt="{{$v['alt']}}" width="114" height="115">
                        <span class="ellipsis2">{{$v['title']}}</span>
                    </a>
                </p>
                @else
                <p class="@if($k==5) box5 @endif box{{$k+1}}"><a href="{{URL($cat_1['url']),$v['id']}}" class="ellipsis2" >{{$v['title']}}</a></p>
                @endif
            @endforeach
        </div>
    </div>
    @endif
    @if($cat_3)
    <div class="teacher">
        <h4>{{$cat_3['title']}}</h4>
        @if(isset($art_3['0']))
        <img src="{{asset($art_3['0']['img'])}}" alt="{{$art_3['0']['alt']}}">
        <p><a href="{{URL($cat_3['url']),$art_3['0']['id']}}" >{{$art_3['0']['title']}}</a></p>
        @endif
        @foreach($art_3 as $k=>$v)
        @if($k>0)
        <a href="{{URL($cat_3['url']),$v['id']}}" style="height: 31px;overflow: hidden;" >{{$v['title']}}</a>
        @endif
        @endforeach
    </div>
    @endif
</div>