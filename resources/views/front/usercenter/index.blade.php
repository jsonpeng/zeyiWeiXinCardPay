@extends('front.partial.base')

@section('css')
	<style>
		body{
			background-color: #f4f2f3;
		}
		.arr_right{
			display: inline-block;
			width:0.35rem;
			height:0.5rem;
			background:url('images/arrow_right.png') no-repeat ;
			background-size:cover;
		}
		.sub{
			display: inline-block;
			width:0.5rem;
			height:0.35rem;
			background:url('images/sub.png') no-repeat ;
			background-size:cover;
		}
		
        
        .member-card .checker{
            width: 0.85rem; 
            height: 0.85rem; 
            background-image: url('{{ asset('images/check.png') }}'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .member-card.active .checker{
            background-image: url('{{ asset('images/check-on.png') }}'); 
        }
        
	</style>
@endsection

@section('seo')
	
@endsection
	
@section('content')
	<div class="container">
		<div class="banner_user" style="background:url('{{asset('images/banner_user.jpg')}}') no-repeat;background-size:cover">
  			@if($userlevel->name !='注册会员')

  			<div class="indate">{!! $userlevel->name !!}有效期至:<?php $time_end=strtotime($user->member_end_time);?>{!! date("Y/m/d",$time_end) !!}</div>

  			@endif
  			<div class="close">
	  			{{-- <span>注销</span> / <span>修改密码</span> --}}
	  		</div>
	  		<div class="cen_img" style="background:url('{{asset('images/usercenter.jpg')}}') no-repeat center center;background-size: cover;">
	  			<div class="img-box">
	  				<img src="{!! $user->head_image !!}" alt="">
	  			</div>
	  		</div>
	  		<div class="user_name">
	  			<p>尊敬的{!! $userlevel->name !!}</p>
	  			<h3>{!! $user->nickname !!}</h3>
	  			<h3>NO:{!! 10000+$user->id !!}</h3>
	  		</div>
	  	</div>
	  	<div class="weui-grids" style="background-color:#fff;">
			<a href="/usercenter/member" class="weui-grid">
	            <div class="weui-grid__icon">
	                <img src="{{asset('images/huiyuan.png')}}" alt="">
	            </div>
	            <p class="weui-grid__label">购买会员</p>
	        </a>
	        <a href="/usercenter/company" class="weui-grid">
	            <div class="weui-grid__icon">
	                <img src="{{asset('images/qiye.png')}}" alt="">
	            </div>
	            <p class="weui-grid__label">我的企业</p>
	        </a>
	        <a href="/usercenter/promote/{!! $user->id !!}" class="weui-grid">
	            <div class="weui-grid__icon">
	                <img src="{{asset('images/tuiguang.png')}}" alt="">
	            </div>
	            <p class="weui-grid__label">我要推广</p>
	        </a>
	        <a href="/usercenter/collections/caompanys" class="weui-grid">
	            <div class="weui-grid__icon">
	                <img src="{{asset('images/xihuan.png')}}" alt="">
	            </div>
	            <p class="weui-grid__label">我的收藏</p>
	        </a>
		</div>
		<div class="item_info">
			<h3 id="pull">
				项目信息
				<span class="arr_right" id="ctr"></span>
			</h3>
			<div id="project_list" style="display:none">
			{{-- projects  zanting  play--}}
			@foreach($projects as $item)
				<div class="item_hb" >
					<div class="left">
						<div class="item_name-box">
							<span style="@if($item->type=='项目')background:url('{{asset('images/gong.png')}}')@else background:url('{{asset('images/qiu.png')}}') @endif no-repeat left center;background-size: 0.85rem 0.675rem;" class="item_name">{!! $item->name !!}</span>
						</div>
						<div class="new_status">最新状态:{!! $item->auth_status !!}</div>
					</div>
					<div class="right">
						<a href="javascript:;" class="project_refresh" data-id="{!! $item->id !!}">
							<img src="{{asset('images/shuaxin.png')}}" alt="">
						</a>
						<a href="javascript:;" class="project_status" data-id="{!! $item->id !!}" data-status="{!! $item->status=='正常'?'true':'false' !!}">
							<img src="@if($item->status=='正常') {{asset('images/play.png')}} @else {{asset('images/zanting.png')}} @endif" alt="">
						</a>
						<a href="/project/{!! $item->id !!}/edit">
							<img src="{{asset('images/bianji.png')}}" alt="">
						</a>
						<a href="javascript:;" class="project_delete" data-id="{!! $item->id !!}">
							<img src="{{asset('images/delete.png')}}" alt="">
						</a>
					</div>
				</div>
			@endforeach
				<div class="add_item">
					<a href="javascript:;" id="sel" style="background:url('images/tianjia.png') no-repeat left center;">添加新项目</a>
				</div>
			</div>
		</div>
		<div class="shade" style="display: none;"></div>
		<div class="sel" style="display: none">
			<h3 class="sel_class">选择分类</h3>
			
	        <div class="member-card" data-type='需求'>
	            <div class="checker"></div>
	            <div class="sel_option">
	            	<div>发布需求</div>
	            	<div>例如 : 我需要获取XXX产品/项目</div>
	            </div>
	        </div>
	        <div class="member-card" data-type='项目'>
	            <div class="checker"></div>
	            <div class="sel_option">
	            	<div>发布供应</div>
	            	<div>例如 : 我需要出售XXX产品/项目</div>
	        	</div>
	        </div>
	        <div class="btn_box">
	        	<a class="next_btn" data-url="/project/create">下一步</a>
	        </div>
		</div>
		<div class="contact_man">
			<a href="/page/contact">联系管理员
				<span style="background:url('{{asset('images/arrow_right.png')}}') no-repeat left center;background-size: cover;"></span>
			</a>
		</div>

		<div class="contact_man">
			<a href="/usercenter/share/share">分享记录
				<span style="background:url('{{asset('images/arrow_right.png')}}') no-repeat left center;background-size: cover;"></span>
			</a>
		</div>

		<div class="contact_man">
			<a href="/auth/mobile">{!! !empty($user->mobile)?'更改':'' !!}绑定手机号
				<span style="background:url('{{asset('images/arrow_right.png')}}') no-repeat left center;background-size: cover;"></span>
			</a>
		</div>
		
	</div>
	
@endsection


@section('js')
	<script>
		$(document).ready(function () {
            $("#pull").on('click',function () {
            	$('#ctr').toggleClass('sub');
                $('#project_list').fadeToggle();

            });
            $('.member-card').eq(0).addClass('active');
            $('.member-card').on('click', function() {
                /* Act on the event */
                if($(this).hasClass('active')){
                   $(this).removeClass('active');
                }else{
                   $(this).addClass('active');
                   $(this).siblings().removeClass('active');
                }
            });
            $("#sel").on('click',function () {
			    $('.sel').fadeToggle();
			    $('.shade').fadeToggle();
			});
			$('.shade').click(function(){
		  		$('.sel, .shade').hide();
		  	})

		  	$('.next_btn').click(function(){
		  		var url=$(this).data('url');
		  		var type='项目';
		  		$('.member-card').each(function(){
		  			if($(this).hasClass('active')){
		  				type=$(this).data('type');
		  			}
		  		});
		  		location.href=url+'?type='+type;
		  	});
        });
	</script>
@endsection

