@extends('front.partial.base')

@section('css')
	
	
	<link rel="stylesheet" href="{{asset('css/jquery.fancybox.css')}}">
	<style>
		body{
			font-size: 1rem;
		}
		#fancybox-thumbs{
			display: none;
		}
		img{
			vertical-align: baseline;
		}
		.am-icon-chevron-left:before {
		    content: "\f053";
		    margin-top: 15px;
		    font-size: 40px;
		}
		.am-pureview-bar{
			font-size: 0.6rem;
		}
		.am-pureview-bar .am-pureview-total{
			font-size: 0.35rem;
		}
		@keyframes mypraise{
			0% {
			    top: -15px;
			    opacity: 0;
			    filter: Alpha(opacity=0);
			    -moz-opacity: 0;
			}
			25% {
			    top: -20px;
			    opacity: 0.5;
			    filter: Alpha(opacity=50);
			    -moz-opacity: 0.5;
			}
			50% {
			    top: -25px;
			    opacity: 1;
			    filter: Alpha(opacity=100);
			    -moz-opacity: 1;
			}
			75% {
			    top: -30px;
			    opacity: 0.5;
			    filter: Alpha(opacity=50);
			    -moz-opacity: 0.5;
			}
			100% {
			    top: -35px;
			    opacity: 0;
			    filter: Alpha(opacity=0);
			    -moz-opacity: 0;
			}
		}
		@keyframes myfirst{
			0% {
			    width: 30px;
			    height: 30px;
			}
			50% {
			    width: 40px;
			    height: 40px;
			}
			100% {
			    width: 30px;
			    height: 30px;
			}
		}
	</style>
@endsection

@section('seo')
	
@endsection
	
@section('content')
	<div class="container">
		<div class="project_item-show">
			<div class="weui-panel__bd">
	            <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
	                <div class="weui-media-box__hd">
	                    <img class="weui-media-box__thumb" src="{!! $user->head_image !!}" alt="">
	                </div>

	                <div class="weui-media-box__bd">
	                    <h3 class="weui-media-box__title">{!! $project->name !!}</h3>
	                    <div class="num">会员编号:{!! $project->UserNumber !!}</div>
	                </div>
	            </a>												
	            <a class="contact_me" href="@if($limit) javascript:layer.open({
	              content: @if($update) '分享成功' @else '您还不是VIP会员，加入VIP查看全部内容' @endif,skin: 'msg',time: 2}); @else tel:{!! $project->mobile !!} @endif">
	            	<div class="contact_img">
	            		<img src="{{asset('images/contact.png')}}" alt="" id="showImg">
	            	</div>
	            	<div class="contact_des">联系我</div>
	            </a>
	        </div>
	        <div class="content">
	        	<ul class="feature">
	            	<li>类型 : {!! $project->industriesText !!}</li>
	            	<li>{!! $project->created_at !!}</li>
	        	</ul>
	        	<div class="price">价格 : {!! $project->money !!}万元</div>
	        	<div class="address">地址 :   @if($limit) ****** @else {!! $project->address !!} @endif</div>
	        	<div class="desc">
	        		@if($limit) {!! sub_content($project->detail) !!} @else {!! $project->detail !!} @endif
	        	</div>
	        	<!-- <div class="imgs am-gallery am-gallery-default" data-am-widget="gallery" data-am-gallery="{pureview:{weChatImagePreview: false}}">

	        		@foreach ($images as $item)
			    	
        			<div class="list imgclass am-gallery-item">
        				@if(!empty($item->url))
        				<img src="{!! $item->url !!}" alt="" >
        				@endif
        			</div>
	        		@endforeach
	        	</div> -->
	        	<div class="imgs">
	        		@foreach ($images as $item)
			    	
        			<div class="list imgclass ">
        				@if(!empty($item->url))
        				<a class="fancybox-thumbs"  data-fancybox-group="thumb" href="{!! $item->url !!}">
        					<img src="{!! $item->url !!}" alt="" >
        				</a>
        				@endif
        			</div>
	        		@endforeach
	        	</div>
	        	<div class="expands">	
                <?php $status=getCollectionStatus('project',$project->id); ?>
                	<div class="evaluate">	
						<span class="collect_permission collect" data-id="{!! $project->id !!}" data-type="project" data-status="{!! $status !!}" style="background:url('http://{!! $_SERVER['HTTP_HOST'] !!}/images/{!! $status?'collect_color':'collect' !!}.png') no-repeat left center; background-size: 0.7rem 0.7rem;">{!! $project->collections !!}</span>
						<span class="humancount" style="background:url('{{asset('images/yulan.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">{!! $project->view !!}</span>
			
						<div class="praise" onclick="project_action('dianzan',{!! $project->id !!},this)">
							<span id="praise">
								<img src="{{asset('images/like.png')}}" id="praise-img" class="animation">
							</span>
							<span class="praise-txt">{!! empty($project->dianzan)?0:$project->dianzan !!}</span>
							<span id="add-num" style="display: inline;">
								<em class="add-animation hover"></em>
							</span>
						</div>
						<div class="dispraise" onclick="project_action('cai',{!! $project->id !!},this)">
							<span id="dispraise">
								<img src="{{asset('images/dislike.png')}}" id="dispraise-img" class="animation">
							</span>
							<span class="praise-txt">{!! empty($project->cai)?0:$project->cai !!}</span>
							<span id="disadd-num" style="display: inline;">
								<em class="add-animation hover"></em>
							</span>
						</div>
					</div>
					<div class="transpond-box">
						<span class="transpond" style="background:url('{{asset('images/transpond.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">转发</span>
					</div>
				</div>
	        </div>
			
	        @if($limit)
			
	        	@if($update)
	    	     	<div class="join">
			        	<div class="join_arrow">
			        		<a style="background:url('{{asset('images/arrow.png')}}') no-repeat left center;background-size: 1.175rem 0.275rem;">您的会员等级受到限制,无法查阅详情,请升级</a>
			        	</div>
			        	<div class="join_link">
			        		<a href="/usercenter/memberLevelup">立即升级</a>
			        	</div>
			        </div>
	        	@else
			        <div class="join">
			        	<div class="join_arrow">
			        		<a style="background:url('{{asset('images/arrow.png')}}') no-repeat left center;background-size: 1.175rem 0.275rem;">您还不是VIP会员，加入VIP查看全部内容</a>
			        	</div>
			        	<div class="join_link">
			        		<a href="/usercenter/member">立即加入</a>
			        	</div>
			        </div>
		        @endif

	        @endif

	    </div>
	    <!-- <div class="result" id="outdiv">  
	      <div class="indiv">
	      	<div class="imgresult" id="bigimg">
	          <img  src="">  
	        </div>  
	      </div>    
	    </div>  -->
	    
	    

	    <div class="shade"></div>
	    <div class="pointto" style="display: none;">
	    	<img src="{{asset('images/pointto.png')}}" alt="">
	    </div>
	</div>
@endsection


@section('js')
<script src="{{asset('js/xback.js')}}"></script>
<!-- <script src="{{asset('js/jquery.imgbox.pack.js')}}"></script> -->
<script src="{{asset('js/jquery.fancybox.js')}}"></script>
<script src="{{asset('js/jquery.fancybox-thumbs.js')}}"></script>
<script type="text/javascript">
	// var storage = window.localStorage; 
	// var project_item_times;
	var type='{!! $project->type !!}';
	
	var project_id='{!! $project->id !!}';
	type=type=='项目'?1:2;
	$(function(){
		$('.weui-tabbar__item').eq(type).addClass('weui-bar__item_on');
		
		var src=$('.weui-bar__item_on img').attr('src');
        if(src==undefined){
            return false;
        }
        else{
            var a=src.lastIndexOf('/')+1;
            var b=src.slice(a, src.length);
           
            src=src.replace(b,'light_'+b);
            $('.weui-bar__item_on img').attr('src',src);
        }
        $('.fancybox-thumbs').fancybox({
			prevEffect : 'none',
			nextEffect : 'none',

			closeBtn  : false,
			arrows    : false,
			nextClick : true,

			helpers : {
				thumbs : {
					width  : 50,
					height : 50
				}
			}
		});

        // $('a.zoom').imgbox({
        // 	'hideOnContentClick':true,'allowMultiple': false
        // });
		$(".transpond-box").on('click',function () {
		    $('.pointto').fadeToggle();
		    $('.shade').fadeToggle();
		});

		$('.shade').click(function(){
	  		$('.pointto, .shade').hide();
	  	})
		$('.list').each(function() {
			if(!$(this).find('img').length){
				$(this).remove();
			}
		});
		$('.am-img-loaded').click(function() {
			/* Act on the event */
			$(this).hide();
		});
	});
	


</script>

  @if(Config::get('web.app_env') == 'online')
  <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" charset="utf-8">
      wx.config({!! $app->jssdk->buildConfig(array('onMenuShareTimeline', 'onMenuShareAppMessage'), false) !!});
      wx.ready(function(){
        wx.onMenuShareTimeline({
          title: '{{ $project->name }}', // 分享标题
          link: window.location.href, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
          imgUrl: '{{ !empty($images)?$images[0]['url']:'' }}', // 分享图标
          success: function () {
          // 用户确认分享后执行的回调函数
          	layer.open({
              content: '分享成功'
              ,skin: 'msg'
              ,time: 2 //2秒后自动关闭
          });
          },
          cancel: function () {
          // 用户取消分享后执行的回调函数
          }
        });
        wx.onMenuShareAppMessage({
          title: '{{ $project->name }}', // 分享标题
          desc: '{{ $project->detail }}', // 分享描述
          link: window.location.href, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
          imgUrl: '{{ !empty($images)?$images[0]['url']:'' }}', // 分享图标
          success: function () {
          // 用户确认分享后执行的回调函数
      		layer.open({
	              content: '分享成功'
	              ,skin: 'msg'
	              ,time: 2 //2秒后自动关闭
	          });
          },
          cancel: function () {
          // 用户取消分享后执行的回调函数
          	
          }
        });
      });
  </script>
  @endif

@endsection