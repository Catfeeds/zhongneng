@extends('mobile.layouts.app')
@section('style')
    @parent
@endsection
@section('content')
<?php 
$banner = ads_image(36);
 ?>
@if(isset($banner)&&$banner->count())
<div class="swiper-container banner">
    <div class="swiper-wrapper">
        @foreach($banner as $v)
        <div><a @if(!empty($v['url']))href="{{URL($v['url'])}}"@endif><img src="{{asset($v['image'])}}" alt="{{$v['alt']}}"></a></div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>
@endif
<?php 
    //获取推荐文章
    $index_1 = \App\Models\ArticleCategory::find(5);
    $index_1['article'] = \App\Models\Article::ArticleList([
        'cate_id_in' => sub_cate_in(5),
        'take'=>9,
        'is_top'=>1,
    ]);
?>
<div class="index_1">
    <div class="title">{{$index_1['title']}}<p>{{$index_1['en_title']}}</p></div>
    <ul class="ser_list">
        @foreach($index_1['article'] as $v)
        <li><a href="{{url('article',[$v['id']])}}" class="clearfix">
            <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"><span></span></div>
            <div class="w">
                <h3>{{$v['title']}}</h3>
                <p class="dot">{!!nl2br($v['desc'])!!}</p>
            </div>
        </a></li>
        @endforeach
    </ul>
    <a href="{{URL('category',[$index_1['id']])}}" class="more">more</a>
</div>
<?php 
    //获取推荐文章
    $index_2 = \App\Models\ArticleCategory::find(1);
    $index_2['article'] = \App\Models\Article::ArticleList([
        'cate_id_in' => sub_cate_in(1),
        'take'=>6,
        'is_top'=>1,
    ]);
?>
<div class="index_2">
    <div class="title">{{$index_2['title']}}<p>{{$index_2['en_title']}}</p></div>
    <ul class="clearfix case_list">
        @foreach($index_2['article'] as $v)
        <li><a href="{{url('article',[$v['id']])}}">
            <div class="pic"><img src="{{asset($v['img'])}}" alt="{{$v['alt']}}"></div>
            <h3>{{$v['title']}}</h3>
            <p>{{$v['ArticleCategoryTo']['title']}}</p>
        </a></li>
        @endforeach
    </ul>
    <a href="{{URL('category',[$index_2['id']])}}" class="more">more</a>
</div>
<?php 
    //获取推荐文章
    $index_3 = \App\Models\ArticleCategory::find(6);
    $index_3_i1 = ads_image(37);
?>
<div class="index_3">
    <div class="title">{{$index_3['title']}}<p>{{$index_3['en_title']}}</p></div>
    <div class="w">
        {!!nl2br($index_3['cat_desc'])!!}
    </div>
    <a href="{{URL('category/8')}}" class="more">more</a>
    <ul class="clearfix">
        <li><a href="{{url('category/7')}}"><img src="images/ic1.png"></a></li>
        <li><img src="images/ic2.png"></li>
        <li><img src="images/ic3.png"></li>
        <li><img src="images/ic4.png"></li>
    </ul>
</div>
<?php 
    //获取推荐文章
    $index_4 = \App\Models\ArticleCategory::find(3);
    $index_4['article'] = \App\Models\Article::ArticleList([
        'cate_id_in' => sub_cate_in(3),
        'take'=>9,
        'is_top'=>1,
    ]);
?>
<div class="index_4">
    <div class="title">{{$index_4['title']}}<p>{{$index_4['en_title']}}</p></div>
    <ul class="news_list">
        @foreach($index_5['article'] as $v)
        <li><a href="{{url('article',[$v['id']])}}">
            <h3>{{$v['title']}}</h3>
            <h4>{{date("Y-m-d",strtotime($v['add_time']))}}</h4>
            <p class="dot">{!!nl2br($v['desc'])!!}</p>
        </a></li>
        @endforeach
    </ul>
    <a href="{{URL('category',[$index_4['id']])}}" class="more">more</a>
</div>
@endsection
@section('script')
    @parent
    <script type="text/javascript">
        $(document).ready(function(){
            $('.banner').slick({
                infinite: true,
                dots: true,
                autoplay:true,
                arrows:false
            });
            $('.pic_show1').slick({
                infinite: true,
                dots: false,
                arrows:true,
                slidesToShow: 3
            });
            $('.pic_show2').slick({
                infinite: true,
                dots: false,
                arrows:true,
                slidesToShow: 3
            });
            $('.index_2 .hd li').click(function(){
                $('.pic_show2').slick('unslick');
                var i =$(this).index();
                $(this).addClass('on').siblings('li').removeClass('on');
    
                $('.bd>div').removeClass('on');
                $('.bd>div').eq(i).addClass('on');
    
                $('.pic_show2').eq(i).slick({
                    infinite: true,
                    dots: false,
                    arrows:true,
                    slidesToShow: 3
                });
           });
            $('.three').slick({
                infinite: true,
                dots: false,
                arrows:true,
                slidesToShow: 3,
                autoplay:true
            });
        });
    </script>
    <script type="text/javascript">
        var initPhotoSwipeFromDOM = function(gallerySelector) {
    
        // parse slide data (url, title, size ...) from DOM elements 
        // (children of gallerySelector)
        var parseThumbnailElements = function(el) {
            var thumbElements = el.childNodes,
                numNodes = thumbElements.length,
                items = [],
                figureEl,
                linkEl,
                size,
                item;
    
            for(var i = 0; i < numNodes; i++) {
    
                figureEl = thumbElements[i]; // <figure> element
    
                // include only element nodes 
                if(figureEl.nodeType !== 1) {
                    continue;
                }
    
                linkEl = figureEl.children[0]; // <a> element
    
                size = linkEl.getAttribute('data-size').split('x');
    
                // create slide object
                item = {
                    src: linkEl.getAttribute('href'),
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10)
                };
    
    
    
                if(figureEl.children.length > 1) {
                    // <figcaption> content
                    item.title = figureEl.children[1].innerHTML; 
                }
    
                if(linkEl.children.length > 0) {
                    // <img> thumbnail element, retrieving thumbnail url
                    item.msrc = linkEl.children[0].getAttribute('src');
                } 
    
                item.el = figureEl; // save link to element for getThumbBoundsFn
                items.push(item);
            }
    
            return items;
        };
    
        // find nearest parent element
        var closest = function closest(el, fn) {
            return el && ( fn(el) ? el : closest(el.parentNode, fn) );
        };
    
        // triggers when user clicks on thumbnail
        var onThumbnailsClick = function(e) {
            e = e || window.event;
            e.preventDefault ? e.preventDefault() : e.returnValue = false;
    
            var eTarget = e.target || e.srcElement;
    
            // find root element of slide
            var clickedListItem = closest(eTarget, function(el) {
                return (el.tagName && el.tagName.toUpperCase() === 'LI');
            });
    
            if(!clickedListItem) {
                return;
            }
    
            // find index of clicked item by looping through all child nodes
            // alternatively, you may define index via data- attribute
            var clickedGallery = clickedListItem.parentNode,
                childNodes = clickedListItem.parentNode.childNodes,
                numChildNodes = childNodes.length,
                nodeIndex = 0,
                index;
    
            for (var i = 0; i < numChildNodes; i++) {
                if(childNodes[i].nodeType !== 1) { 
                    continue; 
                }
    
                if(childNodes[i] === clickedListItem) {
                    index = nodeIndex;
                    break;
                }
                nodeIndex++;
            }
    
    
    
            if(index >= 0) {
                // open PhotoSwipe if valid index found
                openPhotoSwipe( index, clickedGallery );
            }
            return false;
        };
    
        // parse picture index and gallery index from URL (#&pid=1&gid=2)
        var photoswipeParseHash = function() {
            var hash = window.location.hash.substring(1),
            params = {};
    
            if(hash.length < 5) {
                return params;
            }
    
            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
                if(!vars[i]) {
                    continue;
                }
                var pair = vars[i].split('=');  
                if(pair.length < 2) {
                    continue;
                }           
                params[pair[0]] = pair[1];
            }
    
            if(params.gid) {
                params.gid = parseInt(params.gid, 10);
            }
    
            return params;
        };
    
        var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
            var pswpElement = document.querySelectorAll('.pswp')[0],
                gallery,
                options,
                items;
    
            items = parseThumbnailElements(galleryElement);
    
            // define options (if needed)
            options = {
    
                // define gallery index (for URL)
                galleryUID: galleryElement.getAttribute('data-pswp-uid'),
    
                getThumbBoundsFn: function(index) {
                    // See Options -> getThumbBoundsFn section of documentation for more info
                    var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                        pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                        rect = thumbnail.getBoundingClientRect(); 
    
                    return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
                }
    
            };
    
            // PhotoSwipe opened from URL
            if(fromURL) {
                if(options.galleryPIDs) {
                    // parse real index when custom PIDs are used 
                    // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                    for(var j = 0; j < items.length; j++) {
                        if(items[j].pid == index) {
                            options.index = j;
                            break;
                        }
                    }
                } else {
                    // in URL indexes start from 1
                    options.index = parseInt(index, 10) - 1;
                }
            } else {
                options.index = parseInt(index, 10);
            }
    
            // exit if index not found
            if( isNaN(options.index) ) {
                return;
            }
    
            if(disableAnimation) {
                options.showAnimationDuration = 0;
            }
    
            // Pass data to PhotoSwipe and initialize it
            gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
        };
    
        // loop through all gallery elements and bind events
        var galleryElements = document.querySelectorAll( gallerySelector );
    
        for(var i = 0, l = galleryElements.length; i < l; i++) {
            galleryElements[i].setAttribute('data-pswp-uid', i+1);
            galleryElements[i].onclick = onThumbnailsClick;
        }
    
        // Parse URL and open gallery if it contains #&pid=3&gid=1
        var hashData = photoswipeParseHash();
        if(hashData.pid && hashData.gid) {
            openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
        }
    };
    
    // execute above function
    initPhotoSwipeFromDOM('.index_4 ul');
    </script>
@endsection