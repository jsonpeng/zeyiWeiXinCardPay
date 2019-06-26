
@extends('front.partial.base')

@section('css')
	<link href="{{ asset('vendor/bootcss/css/swiper.min.css') }}" rel="stylesheet">
@endsection

@section('seo')

@endsection
	
@section('content')
<div class="container">
	<div class="index-banner">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				@foreach($top_banner as $item)

				<a class="swiper-slide" href="{!! $item->link !!}" target="_blank" style="width:100%;">  
					<img src="{!! $item->image !!}" class="lazy"  alt="" style="display:block;width:100%; height:auto;">
				</a>
				@endforeach
			</div>
		</div>
	</div>
	<div class="weui-grids">
		<a href="/page/about" class="weui-grid">
            <div class="weui-grid__icon">
                <img class="lazy" src="{{asset('images/class_1.png')}}" alt="">
            </div>
            <p class="weui-grid__label">企业介绍</p>
        </a>
        <a href="/cat/club" class="weui-grid">
            <div class="weui-grid__icon">
                <img  class="lazy" src="{{asset('images/class_2.png')}}" alt="">
            </div>
            <p class="weui-grid__label">俱乐部</p>
        </a>
        <a href="/page/join" class="weui-grid">
            <div class="weui-grid__icon">
                <img class="lazy" src="{{asset('images/class_3.png')}}" alt="">
            </div>
            <p class="weui-grid__label">入会指南</p>
        </a>
        <a href="/company/list" class="weui-grid">
            <div class="weui-grid__icon">
                <img class="lazy" src="{{asset('images/class_4.png')}}" alt="">
            </div>
            <p class="weui-grid__label">优秀企业</p>
        </a>
	</div>
	<div class="about_img">
		<?php $i=0;?>
		@foreach($about_banner as $item)
			@if($i==0)<img class="lazy" src="{!! $item->image !!}" alt="" >@endif 
		<?php $i++;?>
		@endforeach
	</div>

	@if(!empty($about))
	<div class="about_text">
		<h2 class="title">
			{!! $about->name !!}
			<span>ABOUT US</span>
		</h2>
		<div class="intro">

		{!! get_page_custom_value_by_key($about,'about_brief') !!}
		
		</div>
		<a class="more" href="/page/about">
			<span  style="background:url('images/arrow.png') no-repeat left center;">MORE</span>
		</a>
	</div> 
	@endif

	<div class="club">
		<div class="title">
			<div class="club_name">
				俱乐部 <span>CLUB</span>
			</div>
			<a href="/cat/club" class="link">More+</a>
		</div>
		<div class="line"></div>
	</div>
	<div class="club_show">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				@foreach ($clubs as $item)
					
					<a href="/post/{!! $item->id !!}" class="swiper-slide">
						@if(!empty($item->image)) 

							<img class="lazy" src="{!! $item->image !!}" alt="">

						@endif

					</a>

				@endforeach

			</div>
			<div class="swiper-pagination" style="bottom:-0.125rem;"></div>
		</div>
	</div>
	<div class="activity">
		<div class="title">
			<div class="club_name">
				优秀企业 <span>ACTIVITIES</span>
			</div>
			<a href="/company/list" class="link">More+</a>
		</div>
		<div class="line"></div>
	</div>
	<div class="company_show">

		@foreach($companys as $item)
			<?php $images=$item->images()->take(1)->get()->toArray();?>
			<div class="company_item">
				<a href="/{!! $item->id !!}/company_detail" class="item_box">
					<img class="lazy" src=" @if(count($images)) {{ $images[0]['url'] }} @else {{asset('images/company_1.jpg')}} @endif" alt="">
					<div class="bottom">
						<span class="nowrap">{!! $item->name !!}</span>
					</div>
				</a>
				<div class="expand">		
					<a href="javascript:;" class="collect" style="background:url('{{asset('images/collect.png')}}') no-repeat left center;background-size: 0.8rem 0.8rem;">{!! $item->collect !!}</a>
					<a href="javascript:;" class="transpond" style="background:url('{{asset('images/yulan.png')}}') no-repeat left center; background-size: 0.8rem 0.8rem;">{!! $item->view !!}</a>

				</div>
			</div>
		@endforeach

	</div>
	
	<div class="contact">
		<h2 class="title">
			联系我们
			<span>CONTACT US</span>
		</h2>
		<div class="short-line"></div>
		<div class="contact_detail">
			<div class="contact_ad">
				<h3>{!! getSettingValueByKeyCache('company_name') !!}</h3>
				<p>{!! getSettingValueByKeyCache('join_club') !!}</p>
				<div class="btn"><a  href="/usercenter/member">立即加入</a></div>
			</div>
			<ul class="contact_info">
				<li style="background:url('images/tel.png') no-repeat left center;background-size: 1.05rem 1.05rem;">
					电话 : {!! getSettingValueByKeyCache('service_tel') !!}
				</li>
				<li style="background:url('images/loca.png') no-repeat left center;background-size: 1.05rem 1.05rem;">地址 : {!! getSettingValueByKeyCache('address') !!}</li>
				<li style="background:url('images/qq.png') no-repeat left center;background-size: 1.05rem 1.05rem;">
					QQ : {!! getSettingValueByKeyCache('qq') !!}
				</li>
			</ul>
		</div>
	</div>
</div>
@endsection
	
@section('js')
	<script src="{{ asset('vendor/bootcss/js/swiper.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			
			var bannerSwiper=new Swiper('.index-banner .swiper-container',{
				loop:true,
				autoplay:true,
				autoplay: {
				    delay: 2000,
				},
			});
			var clubSwiper=new Swiper('.club_show .swiper-container',{
				loop:true,
				autoplay:true,
				autoplay: {
				    delay: 1500,
				},
        		slidesPerView: 'auto',
        		centeredSlides:true,
        		spaceBetween: 20,
        		pagination:{
        			el:'.swiper-pagination',
        			clickable:true
        		}
	     
			})
			
		});
	</script>
@endsection

