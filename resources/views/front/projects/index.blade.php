@extends('front.partial.base')

@section('css')
	<style>
		body{
			background-color: #f4f2f3;
		}
		#pull-diyu,#pull-style,#pull-money{
			margin:0 -0.75rem;
			padding:0.575rem 0.625rem;
			display: flex;
			justify-content: space-between;
			background-color:#fff;
			align-items: center;
		}
		#pull-diyu a,#pull-style a,#pull-money a{
			padding-left: 1.0rem;
			font-size: 0.6rem;
			color:#3583e8;
		}
		.arr_right{
			display: inline-block;
			width:0.35rem;
			height:0.5rem;
			background:url('{{asset('images/arrow_right.png')}}') no-repeat ;
			background-size:cover;
		}
		.sub{
			display: inline-block;
			width:0.5rem;
			height:0.35rem;
			background:url('{{asset('images/sub.png')}}') no-repeat ;
			background-size:cover;
		}
		
	</style>
@endsection

@section('seo')
	
@endsection
	
@section('content')
<div class="container">
	<div class="weui-tab">
        <div class="weui-navbar">
       		<a href="/projects/3/{!! $project_type !!}" class="weui-navbar__item @if($type==3) weui-bar__item_on @endif item_style" >
               	<div class="box">按类型</div>
            </a>
            <a href="/projects/1/{!! $project_type !!}" class="weui-navbar__item @if($type==1) weui-bar__item_on @endif">
            	<div class="box">按金额</div>
            </a>
            <a href="/projects/2/{!! $project_type !!}" class="weui-navbar__item @if($type==2) weui-bar__item_on @endif">
                <div class="box">按地域</div>
            </a>
        </div>
        <div class="weui-tab__panel">
        	@if($type==1)
				<!-- <a href="?sort=asc"  @if((array_key_exists('sort',$input) && $input['sort']=='asc') || (!array_key_exists('sort',$input)) ) class="active" @endif>
					升序
				</a>
				<a href="?sort=desc" @if((array_key_exists('sort',$input) && $input['sort']=='desc')) class="active" @endif>
					降序
				</a> -->
				<div id="pull-money">
					<a href="javascript:;" style="background:url('{{asset('images/money.png')}}') no-repeat left center; background-size: 0.8rem 0.8rem;">当前金额 : @if(!array_key_exists('sort',$input)) 全部 @else {!! $input['sort'] !!}万 @endif</a>
					<span class="arr_right" id="ctr_diyu"></span>
				</div>
				<div class="sel-money" style="display: none;">
					<a href="/projects/1/pro" class="sel-money_item @if(!array_key_exists('sort',$input)) active @endif">全部</a>
					@foreach($project_money_list as $item)
						<a href="?sort={!! $item !!}" class="sel-money_item @if((array_key_exists('sort',$input) && $input['sort']==$item)) active @endif">{!! $item !!}万以下</a>
					@endforeach
				</div>
				
			@endif

			@if($type==2)
				<div class="sel_area">
					<div id="pull-diyu">
						<a href="javascript:;" style="background:url('{{asset('images/ditu_color.png')}}') no-repeat left center; background-size: 0.8rem 0.8rem;">当前地区 : @if(array_key_exists('diyu',$input)) @foreach ($diyu as $k=>$v) @foreach ($v as $e) @if($input['diyu']==$e['id']) {!! $e['name'] !!}  @endif @endforeach @endforeach @else 未知 @endif</a>
						<span class="arr_right" id="ctr_diyu"></span>
					</div>
					@foreach ($diyu as $k=>$v)
		        		<div class="part" style="display: none;">
			        		<h4>{!! $k !!}：</h4>
			        		<ul class="areas">
			        			@foreach ($v as $e)
			        				<li @if(array_key_exists('diyu',$input) && $input['diyu']==$e['id']) class="active" @endif data-url="{{ $e['id'] }}" data-type="diyu">{!! $e['name'] !!}</li>
			        			@endforeach
			        		</ul>
		        		</div>
		      		@endforeach	
	        	</div>
			@endif

			@if($type==3)
				<div id="pull-style">
					<a href="javascript:;" style="background:url('{{asset('images/style.png')}}') no-repeat left center; background-size: 0.8rem 0.8rem;">当前类型 : @if(!array_key_exists('hangye',$input)) 全部 @else @foreach($hangye as $item) {!! $input['hangye']==$item->id ? $item->name : '' !!} @endforeach @endif</a>
					<span class="arr_right" id="ctr_diyu"></span>
				</div>
			 	<ul class="sel_stl" style="display: none;">
	        		<li @if(!array_key_exists('hangye',$input) || $input['hangye']=='0') class="active" @endif data-url="0" data-type="hangye">全部</li>
	        		@foreach($hangye as $item)
        				<li @if(array_key_exists('hangye',$input) && $input['hangye']==$item->id) class="active" @endif data-url="{!! $item->id !!}" data-type="hangye">{!! $item->name !!}</li>
	        		@endforeach
	        	</ul>
			@endif
			<div class="scroll-container">
				@foreach($projects as $item)
				<?php $limit=limit($amount,$item->money);$image=$item->images()->take(3)->get(); ?>
					<div class="project_item scroll-project">
						<div class="weui-panel__bd">
			                <a href="/project/{!! $item->id !!}/show" class="weui-media-box weui-media-box_appmsg">
			                    <div class="weui-media-box__hd">
			                        <img class="weui-media-box__thumb" src="{!! $item->ReleaseUserObj->head_image !!}" alt="">
			                    </div>	
			                    <div class="weui-media-box__bd">
			                        <h3 class="weui-media-box__title nowrap">{!! $item->name !!}</h3>
			                        <?php $company = app('user')->releasesCompany($item->user_id); ?>
			                        @if(!empty($company))<div class="num">{!!  $company->name !!}</div>@endif
			                    </div>
			                </a>
			                <a class="contact_me" href="@if($limit) /project/{!! $item->id !!}/show @else tel:{!! $item->mobile !!} @endif">
			                	<div class="contact_img">
			                		<img src="{{asset('images/contact.png')}}" alt="">
			                	</div>
			                	<div class="contact_des">联系我</div>
			                </a>
			            </div>
			            <a href="/project/{!! $item->id !!}/show" class="content">
			            	<ul class="feature">
				            	<li class="price">价格 : {!! $item->money !!}万元</li>
				            	<li>类型 : {!! $item->industriesText !!}</li>
				            	<li class="addr">地址 : @if($limit) ******  @else {!! $item->address !!} @endif</li>
			            	</ul>
			            	
			            	<div class="date">{!! $item->created_at !!}</div>
			            	<div class="desc">
			            		{!! sub_content($item->detail) !!}
			            	</div>
			            	@if(count($image))
			            	<div class="imgs">
			            		@foreach ($image as $k=>$v)
				            		@if(!empty($v->url))
					            		<div>
					            			<img src="{!!  $v->url !!}" class="lazy" />
					            		</div>
				            		@endif
			            		@endforeach
			            	</div>
			            	@endif
			            	<div class="expands">	
			            		<div class="evaluate">		
									<span class="collect " data-id="{!! $item->id !!}" style="background:url('{{asset('images/collect.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem">{!! $item->collections !!}</span>
									<span class="humancount" style="background:url('{{asset('images/yulan.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">{!! $item->view !!}</span>
									<span class="like" style="background:url('{{asset('images/like.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">{!! empty($item->dianzan)?0:$item->dianzan !!}</span>
									<span class="dislike" style="background:url('{{asset('images/dislike.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">{!! empty($item->cai)?0:$item->cai !!}</span>
								</div>
							</div>
			            </a>
		            </div>
		           @endforeach

	       		<div style="opacity: 0;display: none;">{!! $projects->appends($input)->links() !!}</div>
	       	</div>
        </div>

    </div>
   
</div>

@endsection

@section('js')
	<script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
	<script type="text/javascript">
        $('.weui-navbar__item').on('click', function () {
            $(this).addClass('weui-bar__item_on').siblings('.weui-bar__item_on').removeClass('weui-bar__item_on');
		});

		$('.areas > li , .sel_stl > li').click(function(){
			// console.log("a");
			location.href="?"+$(this).data('type')+"="+$(this).data('url');
		});
		$(document).ready(function () {
            $("#pull-diyu").on('click',function () {
            	$('#ctr_diyu').toggleClass('sub');
                $('.part').fadeToggle();
            });
            $("#pull-style").on('click',function () {
            	$('#ctr_diyu').toggleClass('sub');
                $('.sel_stl').fadeToggle();
            });
            $("#pull-money").on('click',function () {
            	$('#ctr_diyu').toggleClass('sub');
                $('.sel-money').fadeToggle();
            });
            
            $('.imgs>div').each(function(){
            	if(!$(this).find('img').attr('src')!=''){
            		$(this).remove();
            	}
            });
        });

	</script>

	@if($type=='2' && !array_key_exists('diyu',$input))
	<script type="text/javascript">  
         $.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js', function(_result) {  
             if (remote_ip_info.ret == '1') { 
             //省 remote_ip_info.country
             //市 remote_ip_info.city
           		$('#pull-diyu>a').text('当前地区 : '+remote_ip_info.country);
               
             }   
         });

 	</script>   
	@endif
 	
 	<!--滚动加载-->
 	<script type="text/javascript" src="{{ asset('vendor/infinite-scroll.pkgd.min.js') }}"></script>
 	<script type="text/javascript">

 	   if($('.scroll-project').length>=front_take){
	 		$('.scroll-container').infiniteScroll({
				 path: "a[rel='next']",
			 	append: '.scroll-project',
			 	history: false,
		   	 	extraScrollPx: 80,    
			});
 		}

 	</script>
@endsection