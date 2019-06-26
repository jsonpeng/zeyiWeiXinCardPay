@extends('front.partial.base')

@section('css')
	
@endsection

@section('seo')
    
@endsection
    
@section('content')
<div class="container">
	<div class="weui-tab">
		<div class="weui-navbar">
	   		<a href="/usercenter/share/share" class="weui-navbar__item @if($type=='share') weui-bar__item_on @endif">
	           	<div class="box">分享成功</div>
	        </a>
	        <a href="/usercenter/share/buy" class="weui-navbar__item @if($type=='buy') weui-bar__item_on @endif">
	        	<div class="box">购买成功</div>
	        </a>
	    </div>
	    <div class="weui-tab__panel">
    		<div class="line" style="height:0.5rem;background-color: #f4f2f3;margin:0 -0.75rem;"></div>
    		<?php $distribute_shuoming=getSettingValueByKeyCache('distribute_shuoming'); ?>
		  	@if($type=='share')
		  	<div class="share_main">
		  		<div class="share_title">
		  			<span style="background:url('{{asset('images/buy_success.png')}}') no-repeat left center;">分享成功的朋友</span>
		  		</div>
		  		<div class="share_content">

		  			@if(count($users))
			  			<div class="shared_imgs">
			  				@foreach ($users as $item)
			  					<img src="{!! $item->head_image !!}" alt="" >
			  				@endforeach
			  			</div>
		  			@endif

		  			<div class="share_des">
			  			<h3>佣金说明 :</h3>
			  			<p>{!! $distribute_shuoming !!}</p>
		  			</div>
		  		</div>
		  	</div>
		  	
		  	@else
		    <div class="share_main">
		  		<div class="share_title">
	  				<p>提成总金额 : {!! $user->distribut_money !!}元</p>
		  			<span style="background:url('{{asset('images/happy.png')}}') no-repeat left center;">购买成功的朋友</span>
		  		</div>
		  		<div class="share_content">

		  			@if(count($users))
			  			<div class="shared_imgs">
			  				@foreach ($users as $item)
			  					<img src="{!! $item->head_image !!}" alt="">
			  				@endforeach
			  			</div>
			  		@endif

		  			<div class="share_des">
			  			<h3>佣金说明 :</h3>
			  			 <p>{!! $distribute_shuoming !!}</p>
		  			</div>
		  		</div>
		  	</div>
		  	@endif
  		</div>
  	</div>
</div>
@endsection


@section('js')
<script type="text/javascript">
	$('img').attr('onerror',"javascript:this.src='/images/user.png';");
</script>
@endsection