@extends('front.partial.base')

@section('css')
	<style>
		
		
	</style>
@endsection

@section('seo')

@endsection
	
@section('content')
	<div class="container" style="background:url('{{ getSettingValueByKeyCache('user_center_share_bg') }}') no-repeat center center;
			background-size:cover;">
		<h4 class="generalize" >
			
		</h4>
		<div class="generalize-detail" >
			
		</div>
		<div class="user_erwei" style="margin:0;background: none;">
			<div class="user_name">
				<h4>
					<i style="background: #fff url('{!! $user->head_image !!}') no-repeat;background-size:cover;"></i><span style="color:#fff;">{!! $user->name !!}</span>
				</h4>
			</div>
			<!-- <div class=" cut_line">
                <div class="weui-cell-fl"></div>
                <div class="border" ></div>
                <div class="weui-cell-fr"></div>
            </div> -->
			<div class="img_erweima" style="padding:0;">
				<img src="{!! $erweima !!}" />
				<!-- <p class="tuijian">推荐你一个好项目~</p>
				<p class="sao">长按识别二维码或微信扫一扫</p> -->
			</div>
		</div>
		<div class="copyright" style="padding:0.5rem 0;">
			<span style="background:url('{{asset('images/yunlai.png')}}') no-repeat left center;background-size: 0.775rem 0.6rem;">芸来提供技术支持</span>
		</div>
	</div>
@endsection