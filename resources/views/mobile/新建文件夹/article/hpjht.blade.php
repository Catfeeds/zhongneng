@extends('home.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
    @if(!empty($cate_info['img']))
    <div class="banner" style="background-image: url({{asset($cate_info['img'])}}); height: 572px;"></div>
    @endif
    <div class="hpjht-content">
    <div class="con01 no">
        <div class="left">

        </div>
        <div class="right">

        </div>
        <div class="con-in">
            <div class="title">
                <img src="{{asset('resources/home/images/h_img_01.png')}}" alt="">
            </div>
            <div class="time-l ">
                <img src="{{asset('resources/home/images/h_img_02.png')}}" alt="">
                <p>
                    <b>普通机构咨询师成长时间</b>
                    *其他机构咨询师成长时间可能需要十年才能达到高级咨询师
                </p>
            </div>
            <div class="time-r">
                <img src="{{asset('resources/home/images/h_img_03.png')}}" alt="">
                <p>
                    <b>笃爱咨询师成长时间</b>
                    *因为笃爱培训咨询师有丰富的实战经验，<br>
                    及资深情感咨询师指导培训，仅需2年即可达到高级咨询
                </p>
            </div>
            <div class="btn buy">
                <img src="{{asset('resources/home/images/h_img_06.png')}}" alt="">
            </div>
        </div>

    </div>

    <div class="con02">
        <div class="con-in">
            <div class="title">
                <img src="{{asset('resources/home/picture/img_07.png')}}" alt="">
            </div>
            <ul  class="no">
                <li>
                    <p>实战经验 直接接触真实案例</p><br>
                    <span>我们要求所有学员每天回访数量不得少于5个，咨询个案时长必须不低于2小时。</span>
                </li>
                <li>
                    <p>名师指导 著名情感导师专业督导</p><br>
                    <span>黄埔计划所有导师都是行业内战斗在第一线的专业人员，包括大家所熟知的冷爱，娃娃导师</span>
                </li>
                <li>
                    <p>就业挂钩 笃爱提供高薪工作机会</p><br>
                    <span>作为笃爱情感咨询师，每天会有大量的来访咨询且月薪不低于20k。</span>
                </li>
                <li>
                    <p>优秀团队 打造属于你的超强战队</p><br>
                    <span>优秀的团队离不开优秀的队友，只要你足够好学我们将为你打造一支超强战队！</span>
                </li>
            </ul>
            <div class="btn  buy">
                <img src="{{asset('resources/home/picture/img_06.png')}}" alt="">
            </div>
        </div>
    </div>
    <div class="con03">
        <div class="con-in">
            <div class="title">
                <img src="{{asset('resources/home/picture/img_10.png')}}" alt="">
            </div>
            <ul>
                <li>
                    <img src="{{asset('resources/home/images/h2_img_11.png')}}" alt="">
                </li>
                <li>
                    <img src="{{asset('resources/home/picture/img_12.png')}}" alt="">
                </li>
                <li>
                    <img src="{{asset('resources/home/picture/img_13.png')}}" alt="">
                </li>
                <li class="nomargin">
                    <img src="{{asset('resources/home/images/h_img_14.png')}}" alt="">
                </li>

            </ul>
            <p>
                实战经验 直接接触真实案例
            </p>
            <div class="btn  buy">
                <img src="{{asset('resources/home/picture/img_06.png')}}" alt="">
            </div>
        </div>
    </div>
    <div class="con04">
        <div class="con-in">
            <div class="title">
                <img src="{{asset('resources/home/picture/img_43.png')}}" alt="">
                <p>
                    情感咨询也能成为铁饭碗
                </p>
                <img src="{{asset('resources/home/images/h_img_15.png')}}" alt="">
            </div>
            <ul>
                <li class="animated ">
                    <img src="{{asset('resources/home/picture/img_16.png')}}" alt="">
                    <p>
                        平均每天有5000多个家庭解体，每分钟在办理三个离婚手续，仅离婚前咨询就构成巨大的市场！
                    </p>
                </li>
                <li class="animated ">
                    <img src="{{asset('resources/home/picture/img_17.png')}}" alt="">
                    <p>
                        笃爱是目前全国专业的情感咨询公司，汇集国内知名情感咨询师和导师数百人，累计服务会员过百万！
                    </p>
                </li>
                <li class="animated ">
                    <img src="{{asset('resources/home/images/h_img_18.png')}}" alt="">
                    <p>
                        笃爱情感咨询师每小时咨询费用100-1500/小时，月收入10k-20k不等，你担心的底薪低工作不稳定完全不存在！
                    </p>
                </li>
                <li class="nomargin animated">
                    <img src="{{asset('resources/home/picture/img_19.png')}}" alt="">
                    <p>
                        情感顾问--储备主管--主管--经理--区长--总监--合伙人情感顾问--见习咨询师--初级咨询师--情感咨询师--高级咨询师 
                    </li>
                </ul>
            </div>
        </div>
        <div class="con05">
            <div class="con-in">
                <div class="title">
                    <img src="{{asset('resources/home/images/h_img_20.png')}}" alt="">
                    <p>全面提升个人魅力</p>
                </div>
                <ul>
                    <li class="l">
                        <p>轻松应对职场关系</p><br>
                        <span>你无需再为各种人际关系而发愁，课堂提供大量真实案例，教你轻松应对各种人际关系！</span>
                    </li>
                    <li class="r">
                        <p>自我提升摆脱单身</p><br>
                        <span>有趣的灵魂总会被人欣赏，自我提升除了能有助于脱单还能提高你的眼界，你将脱胎换骨！</span>
                    </li>
                    <li class="l">
                        <p>改善家庭矛盾关系</p><br>
                        <span>面对家庭矛盾，不再盲目处理，而是使用专业的方法妥善应对，避免矛盾激化。</span>
                    </li>
                    <li class="r">
                        <p>增进恋爱甜蜜指数</p><br>
                        <span>恋爱是一门学问，只有用对了方法，你才能把你想留住的人留住。这门学问，笃爱会教会你！</span>
                    </li>
                </ul>
                <div class="btn  buy">
                    <img src="{{asset('resources/home/picture/img_06.png')}}" alt="">
                </div>
            </div>
        </div>
        <div class="con06">
            <div class="con-in">
                <div class="title">
                    <img src="{{asset('resources/home/picture/img_22.png')}}" alt="">
                    <p>专业导师团队通过大量真实案例 苦心钻研<br>打造出 最适合现在情感咨询师培训的课程</p>
                </div>
                <div class="kc">
                    <img src="{{asset('resources/home/picture/imgke__01.jpg')}}" alt="">
                    <img src="{{asset('resources/home/picture/imgke__02.jpg')}}" alt="">
                    <img src="{{asset('resources/home/picture/imgke__03.jpg')}}" alt="">
                    <img src="{{asset('resources/home/picture/imgke__04.jpg')}}" alt="">
                    <img src="{{asset('resources/home/picture/imgke__05.jpg')}}" alt="">
                    <img src="{{asset('resources/home/picture/imgke__06.jpg')}}" alt="">
                    <img src="{{asset('resources/home/picture/imgke__07.jpg')}}" alt="">
                    <p>
                        *合计天数：20天 / 合计时间：120小时
                    </p>
                </div>
                <div class="btn  buy">
                    <img src="{{asset('resources/home/picture/img_06.png')}}" alt="">
                </div>
            </div>
        </div>
        <div class="con07">
            <div class="con-in">
                <div class="title">
                    <img src="{{asset('resources/home/images/h_img_23.png')}}" alt="">
                    <p>黄埔计划所有导师都是行业内战斗在第一线的专业人员，前沿的情感理念，<br>先进的教练技术，保障学员不走弯路，用最快的速度成长。</p>
                </div>
                <div class="ds">
                    <div class="la">
                        <img src="{{asset('resources/home/picture/img_24.png')}}" alt="">
                    </div>
                    <div class="wawa">
                        <img src="{{asset('resources/home/picture/img_25.png')}}" alt="">
                    </div>
                    <div class="by">
                        <img src="{{asset('resources/home/images/h_img_26.png')}}" alt="">
                    </div>
                    <!-- <div class="ls">
                        <img src="{{asset('resources/home/picture/img_27.png')}}" alt="">
                    </div> -->
                </div>
                <ul>
                    <li class="cur">
                        <div class="ds-con">
                            <span><img src="{{asset('resources/home/picture/img_29.png')}}" alt=""></span>
                            <b></b>
                            <p>笃爱联合创始人、深度情感维系导师、中国情感学习先驱、中国男性情感解读导师、理性爱情经营导师；<br>他是国家二级婚姻咨询师，国家二级心理咨询师，从2008年以来，他专注于从事婚恋咨询与培训行业，开创了挽回修复、告别单身、自我提升、长期关系等原创理论体系和实战技巧。著有《冷眼观爱》、《一切情感问题的答案》等畅销书籍。</p>
                        </div>
                        <i></i>
                    </li>
                    <li>
                        <div class="ds-con">
                            <span><img src="{{asset('resources/home/picture/img_30.png')}}" alt=""></span>
                            <b></b>
                            <p>两性贴身择偶及情感咨询首席顾问<br>中国“爱情风险”咨询第一人、爱情风险预控导师中国情感资讯类图书畅销榜长期霸占者，著有《聪明爱》、《完美关系的秘密》、《爱的十万个为什么》等情感畅销书，为广大婚姻家庭的情感维系提供理论依据。</p>
                        </div>
                        <i></i>
                    </li>
                    <li>
                        <div class="ds-con">
                            <span><img src="{{asset('resources/home/picture/img_31.png')}}" alt=""></span>
                            <b></b>
                            <p>笃爱情感高级咨询导师、婚姻家庭咨询师、笃爱形象导师。<br>一个年轻帅气的情感导师，同时他是笃爱情感导师、笃爱形象导师，冷爱第一期《情感咨询师弟子班》优秀学员。一开始因为他的年轻和帅气，来访者有些怀疑他是否能够帮助自己专业应对情感问题，但他用事实证明了自己的实力。在学员眼里，他亦师亦友，专业耐心，能够一阵见血地指出她们情感上的问题，而且还能够指导她们穿衣打扮，提升自我形象。</p>
                        </div>
                        <i></i>
                    </li>
                    <li>
                        <div class="ds-con">
                            <span><img src="{{asset('resources/home/picture/img_32.png')}}" alt=""></span>
                            <b></b>
                            <p>笃爱女性脱单成长导师，是中国两性搭讪首倡者、中国约会学先行者、全职搭讪恋爱约会顾问，《南方人物周刊》、《Vista看天下》情感专栏作者，提倡一种勇敢走出去与社会接触的态度，找到真爱，发现自己。他的咨询风格是非常接地气的，在学员眼里，他就像一个可以尽情倾诉心事朋友，风趣幽默，说话慢吞吞地、别有一番风格，针对很多沟通上的问题有独特的见解和解决办法。</p>
                        </div>
                        <i></i>
                    </li>
                </ul>
                <div class="btn  buy">
                    <img src="{{asset('resources/home/picture/img_06.png')}}" alt="">
                </div>
            </div>
        </div>
        <!-- <div class="con08">
            <div class="con-in">
                <div class="title">
                    <img src="{{asset('resources/home/picture/img_34.png')}}" alt="">
                </div>
                <div class="tu">
                    <img src="{{asset('resources/home/picture/img_35.png')}}" alt="">
                </div>
                <p>资格证是专业的敲门砖</p>
                <div class="btn  buy">
                    <img src="{{asset('resources/home/picture/img_06.png')}}" alt="">
                </div>
            </div>
        </div> -->
        <div class="con09">
            <div class="con-in">
                <div class="title">
                    <img src="{{asset('resources/home/picture/img_36.png')}}" alt="">
                </div>
                <div class="price">
                    <div class="left" style="overflow:hidden">
                        <img src="{{asset('resources/home/picture/image003.png')}}" alt="">
                        <!-- <p>
                            国家婚姻家庭咨询师培训以及考前辅导费用（含教材）：<span>3600元</span><br>
                            鉴定费：<span>260元</span><br>
                            督导费：<span>2000元</span><br>
                            实战培训费：<span>18000元</span><br>
                            <span>总价：</span><b>23860元</b>
                        </p> -->
                    </div>
                    <div class="right">
                        <img src="{{asset('resources/home/picture/img_37.png')}}" alt="">
                        <p>
                            笃爱为黄埔计划学员提供高额奖学金<b>18000元</b>，<br>
                            现在报名<br>
                            <span>只需支付5860元!</span>
                        </p>
                        <div class="buy buy">
                            立即购买
                        </div>
                    </div>
                </div>
                <dl>
                    <dt><img src="{{asset('resources/home/picture/img_38.png')}}" alt=""></dt>
                    <dd>
                        <ul>
                            <li>陈先生 138****5512 报名成功</li>
                            <li>黄先生 137****3352 报名成功</li>
                            <li>王先生 137****5741 报名成功</li>
                            <li>张小姐 135****8874 报名成功</li>
                            <li>何先生 135****3542 报名成功</li>
                            <li>黄小姐 134****6874 报名成功</li>
                            <li>梁小姐 137****6647 报名成功</li>
                            <li>谢先生 138****7845 报名成功</li>
                            <li>林小姐 136****6954 报名成功</li>
                        </ul>

                    </dd>
                </dl>
                <div class="title">
                    <img src="{{asset('resources/home/picture/img_39.png')}}" alt="">
                </div>
                <div class="join">
                    <p>
                        黄埔计划第十三期正式开始招生<br>
                        时间：2018年3月12日—2018年4月6日<br>
                        地点：广州市越秀区麓景路7号老干大厦东楼 三楼笃爱公司
                    </p>
                    
                </div>

            </div>
        </div>
        <!-- <div class="con10">
            <div class="con-in">
                <div class="title">
                    <img src="{{asset('resources/home/picture/img_41.png')}}" alt="">
                    <p>在这里，每一个都能得到成长，提升自己</p>
                </div>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide item">
                            <div class="item_top">
                                <span>姓名：高某</span>
                                <span>职位：酒店服务员</span>
                                <span>年龄：23</span>
                            </div>
                            <div class="line">
                                <span></span>
                            </div>
                            <p>
                                我今年23岁，已经毕业一年，做着酒店服务员的工作，之前学的是心理学专业，前几天因为家庭条件的原因被女友抛弃，顿时觉得自己一无是处。后来冷大来到了我们公司讲课，主要讲的是亲密关系，我当时感觉拨云见日，因为没想到爱情这个东西是可以学习的。课程结束后，我开始提问。冷大也耐心的解决了我的问题。因为自己有专业背景，于是，我做出了大胆的决定：辞掉现在的工作，从事情感行业。在加入了黄埔计划之后，我耐心的跟老师学习，感情观发生了翻天覆地的变化，开始学习爱的能力，并且和身边人好朋友分享，我也很愿意帮助一些曾经和我一样特别无助的人。终于2个月之后，我顺利的成为了笃爱的情感咨询师，并且有了人生第一笔5位数的收入。谢谢冷大，谢谢笃爱，也感谢那个不放弃的自己。

                            </p>
                        </div>
                        <div class="swiper-slide item">
                            <div class="item_top">
                                <span>姓名：刘某</span>
                                <span>职位：自由职业</span>
                                <span>年龄：25</span>
                            </div>
                            <div class="line">
                                <span></span>
                            </div>
                            <p>
                                在国外读书的时候有涉及到一些婚姻家庭咨询师的内容，比国内的先进了几百年，那个时候，我们经常在宿舍里讨论情感话题。回国后，我打算从事这个行业，在百度上搜索 国内情感行业 就找到了笃爱，来应聘之后，我发现笃爱的服务体系很先进，因为他们主张实战而不是鸡汤，于是，我开始潜心实习，在老师的带领下，我的专业能力渐渐提高。可喜的是，我发现周围人的人际关系渐渐变好了，我国外的朋友问我现在过的怎么样，我很愿意和她们分享这个事情，更加庆幸能在笃爱工作，3个月后，我顺利的成为情感咨询师，中国情感行业与培训行业领导品牌，果然名不虚传。

                            </p>
                        </div>
                        <div class="swiper-slide item">
                            <div class="item_top">
                                <span>姓名：李某</span>
                                <span>职位：化妆品销售</span>
                                <span>年龄：27</span>
                            </div>
                            <div class="line">
                                <span></span>
                            </div>
                            <p>
                                我之前从事化妆品销售的工作，一个月的收入7000+左右，在深圳这个工资很难维持下去，平时很喜欢玩手机，早上起床后，晚上入睡前，都是看一些心灵鸡汤的内容，感觉这一天下来都是上班，下班，平平淡淡。男友也劝我多去参加一些活动，还说我身材不好，我当时觉得她是不爱我的，于是我们俩争吵起来，后来他提出了分手，我几次挽回无效，整天以泪洗面，后来在百度上搜索挽回的时候，看到了笃爱。挽回成功后，我开始跟周围人分享我的喜悦，大家也问我是怎么做到的，我就说是笃爱帮助的我。后来很多人开始请教我情感问题，后来，我发现自己的能力很难帮助别人解决实际问题。于是为了突破自己，我决定用心学习，加入了黄埔计划，3个月后，现在的我已经是一名情感咨询师了，谢谢笃爱，谢谢自己，而且现在的工资是以前的数倍不止。

                            </p>
                        </div>
                        <div class="swiper-slide item">
                            <div class="item_top">
                                <span>姓名：张某</span>
                                <span>职位：销售</span>
                                <span>年龄：31岁</span>
                            </div>
                            <div class="line">
                                <span></span>
                            </div>
                            <p>
                                半年前，我爸妈经常争吵，爷爷奶奶年龄大了，也劝不动，我在外地工作做销售，也加班加点，连打电话的时间都很奢侈，我不愿意看到他们这样子。之前邻居有来劝过，也有请过居委会大妈来劝，但是，只能好一阵子，事后又会争吵，后来经过导师的点播才知道，妈妈的爱的表达方式是语言，爸爸希望得到的方式是实际行动。所以妈妈其实一直很爱他，而他却感受不到。后来被笃爱的咨询师调节了之后，他们俩的问题得到了解决。后来我对这个行业产生了好奇，于是开始着手学习。当知道了黄埔计划的时候，我毫不犹豫的来参加了，刚开始是实习生，几个月后，我被转正了，成为了标准的情感咨询师，收入嘛，哈哈，翻了几倍不说，而且，自己也有很多粉丝了呢，谢谢笃爱。

                            </p>
                        </div>
                        <div class="swiper-slide item">
                            <div class="item_top">
                                <span>姓名：summer</span>
                                <span>职位：主播</span>
                                <span>年龄：25</span>
                            </div>
                            <div class="line">
                                <span></span>
                            </div>
                            <p>
                                我不方便透漏自己的名字，因为我是网络红人，在我们网红的圈子里，有很多很多的规则，我们姐妹之间虽然表面很好，但是实际上也是勾心斗角的，有时候为了争取到一个好的主播的黄金时段，彼此之间都很不愉快的。我有点累了，觉得自己的情商很低，打算退出，当意识到自己的这个问题的时候，我开始百度搜索如何学习社交，当我接到笃爱的电话的时候，才发现原来是跟自己的原生家庭是有关系的，孩子是父母的影子，确实不假。因为辞掉了网红的工作，于是，我开始着手学习情感能力，也帮助过很多其他的姐妹，现在呢，我是一名情感咨询师了。而且也有了自己的艺名，收入也不低，虽然离开了唱歌跳舞，但是感觉挺好的。

                            </p>
                        </div>
                        <div class="swiper-slide item">
                            <div class="item_top">
                                <span>姓名：陈某</span>
                                <span>职位：网络文案编辑（其实是wawa粉啦）</span>
                                <span>年龄：24</span>
                            </div>
                            <div class="line">
                                <span></span>
                            </div>
                            <p>
                                我关注wawa两年了，一直有在学习MV 和PU的理论，我身边很多闺蜜有问题就会找到我，会认为我很专业，我很有成就感，后来发现自己始终很难解决自己的问题，人家甚至会调侃我：医者不自治。确确实实让我陷入了很深的思考，后来我开始减少了对别人的帮助，开始观察自己，调整自己，当我接到笃爱的电话的时候，才发现别有洞天。原来我们每个人都存在角色扮演的状态，就好比一个警察，在岗位上是很严肃的，回到家里是很温柔的。当我知道有黄埔计划这个项目的时候，我暗爽，因为可以wawa更近一步了，于是我开始报名，被录入实习，因为我的底子好，表现优异，所以就给我提前转正了，现在已经是一名情感咨询师了。
                            </p>
                        </div>
                        <div class="swiper-slide item">
                            <div class="item_top">
                                <span>姓名：钟恒</span>
                                <span>职位：黄埔计划班主任</span>
                                <span>年龄：26岁</span>
                            </div>
                            <div class="line">
                                <span></span>
                            </div>
                            <p>
                                我来自东北，之前在14年的时候，听了wawa和冷大的YY公开课，当初上麦提问过，想成为情感导师，于是他们俩给了我很多的意见，因为我在电视里看多了情感导师的影子，也希望自己能上媒体，上电视，能出人头地。于是我和父母商量此事，但是父母本身不认可这个事情，一是家远；二来是广州那边不熟悉。在我的劝说下，父母终于认可了我，于是，我就从东北飞到了广州。我很兴奋，此时此刻，我已经是黄埔计划的班主任了，我叫钟恒，不但有了丰厚的收入，也开始带学员了，谢谢笃爱的小伙伴，谢谢校长，副校长。
                            </p>
                        </div>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div> -->
        <div class="con11">
            <div class="con-in">
                <div class="title">
                    <img src="{{asset('resources/home/picture/img_42.png')}}" alt="">
                    <p>见证部分学员的收获与精彩截图</p>
                </div>
                <div class="tu">
                    <img src="{{asset('resources/home/picture/img_8.jpg')}}" alt="">
                    <p>在国内优秀情感咨询师的队伍里我们会相遇吗？</p>
                </div>
                <div class="btn  buy">
                    <img src="{{asset('resources/home/picture/img_06.png')}}" alt="">
                </div>
            </div>
        </div>

        <div class="hpjhewm">

            <div class="ewm-in">
                <div class="close"></div>
                <img src="{{asset('resources/home/picture/left-wechat.png')}}" alt="">
                <p>1736631384</p>
            </div>
        </div>
    </div>
    <!-- <div class="wx-contact">
            <div class="wx-in">
                <div class="wx-tt">扫描二维码咨询报名<div class="close"> <img src="{{asset('resources/home/picture/gb_01.png')}}" alt=""></div></div>
                <div class="wx-text">
                    <p>关注「笃爱职业培训学校」<br>公众号马上咨询报名</p>
                    <div class="ewm-img">
                        <img src="{{asset('resources/home/picture/ewm.jpg')}}" alt="">
                    </div>
                    <div class="wx-bottom">微信扫一扫二维码进行关注</div>
                </div>
            </div>
            
        </div> -->
        <div class="hpjhewm">
            <div class="ewm-in">
                <div class="close"></div>
                <img src="{{asset('resources/home/picture/left-wechat.png')}}" alt="">
            </div>
        </div>
        <script>var _hmt = _hmt || [];(function() {var hm = document.createElement("script");hm.src = "https://hm.baidu.com/hm.js?f47943735acae5e0af98eaffa6472fb6";var s = document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm, s);})();</script></body>
        </html>
        

@endsection
@section('script')
    @parent
        <script>
            var $offsetTOP =$(".con01").offset().top;
            $(window).scroll(function(event) {
                if($(window).scrollTop()> $offsetTOP-100){
                    $(".con01").removeClass("no");
                }
            });
            var $offsetTOP2 =$(".con02").offset().top;
            $(window).scroll(function(event) {
                if($(window).scrollTop()> $offsetTOP2-200){
                    $(".con02 ul").removeClass("no");
                }
            });
            var $offsetTOP3 =$(".con04").offset().top;
            $(window).scroll(function(event) {
                if($(window).scrollTop()> $offsetTOP3-100){
                    $(".con04 ul li").addClass('flipInY');
                }
            });
            var $offsetTOP4 =$(".con05").offset().top;
            $(window).scroll(function(event) {
                if($(window).scrollTop()> $offsetTOP4-100){
                    $(".con05 ul li").addClass('flipInY');
                }
            });


            $('.con07 .ds div img').hover(function() {
                $(this).parent('div').addClass('big').siblings().removeClass('big')

                var num = $(this).parent('div').index();
                $('.con07 ul li').eq(num).show().siblings().hide();
            });

            $('.btn').hover(function() {
                $(this).children('img').attr('src', '{{asset('resources/home/images/h_img_05.png')}}');
            }, function() {
                $(this).children('img').attr('src', '{{asset('resources/home/images/h_img_06.png')}}');
            });

            $('.btn,.buy').click(function(event) {
            // $('.wx-contact').show();
            // $('.hpjhewm .close').click(function(event) {
            //     $('.hpjhewm').hide();
            // });
        });
            $('.wx-contact .close').click(function(event) {
                $('.wx-contact').hide();
            });
            jQuery(".con09").slide({mainCell:"dl ul",autoPlay:true,effect:"leftMarquee",interTime:50,pnLoop:false,trigger:"click"});

            $('.btn,.buy').click(function(event) {
               $('.hpjhewm').show();
               $('.hpjhewm .close').click(function(event) {
                  $('.hpjhewm').hide();
              });
           });


       </script>
       <script>
        var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            autoplay : 4000,
            loop : true,
            paginationClickable: true
        });
    </script>
@endsection