@extends('front.partial.base')

@section('css')
	<style>
		

	</style>
@endsection

@section('seo')
	
@endsection
	
@section('content')
	<div class="container">
		<div class="weui-tab">
			<div class="weui-navbar">
		   		<a href="/usercenter/collections/caompanys" class="weui-navbar__item  @if($type=='caompanys') weui-bar__item_on @endif">
		           	<div class="box">企业收藏</div>
		        </a>
		        <a href="/usercenter/collections/project" class="weui-navbar__item @if($type=='project') weui-bar__item_on @endif">
		        	<div class="box">项目收藏</div>
		        </a>
		    </div>
			@if($type=='caompanys')
			<div class="collect_list">
				<div class="line" style="height:12px;background-color:#f4f2f3; "></div>
				<div class="my-company_topic" style="padding:0.05rem 0.75rem;">
					<img src="{{asset('images/collect_color.png')}}" alt="">
					<div>
						共有<span style="color:#3583e8;" id="num">{!! $num !!}</span>个企业
					</div>
				</div>
				@foreach($list as $item)
				<div class="weui-cell weui-cell_swiped">
		            <div class="weui-cell__bd" >
		                <div class="weui-cell">
		                    <div class="weui-cell__bd">
		                        <a href="/{!! $item->id !!}/company_detail" class="weui-media-box weui-media-box_appmsg">
				                    <div class="weui-media-box__hd">
				                        <img class="weui-media-box__thumb" style="border-radius:0;" src="@if(count($item['images'])) {!! $item['images']['0']['url'] !!} @else {{asset('images/company_1.jpg')}} @endif" alt="">
				                    </div>
				                    <div class="weui-media-box__bd">
				                        <h3 class="weui-media-box__title nowrap">{!! $item->name !!}</h3>
				                        <div class="expand">		
											<span class="collect" style="background:url('{{asset('images/collect.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">{!! $item->collect !!}</span>
											<span class="transpond" style="background:url('{{asset('images/yulan.png')}}') no-repeat left center; background-size:  0.7rem 0.7rem;">{!! $item->view !!}</span>
										</div>
										<div class="address" style="background:url('{{asset('images/didian.png')}}') no-repeat left center; background-size:  0.7rem 0.7rem;">
											{!! $item->detail !!}

										</div>
				                    </div>
				                </a>
		                    </div>
	                    	<a class="contact_me" href="tel:{!! $item->mobile !!}">
	                    		<div class="contact_img">
	                    			<img src="{{asset('images/contact.png')}}" alt="">
	                    		</div>
	                		</a>
		                	
		                </div>
		            </div>
		            <div class="weui-cell__ft collect_cancle" data-type="company" data-id="{!! $item->id !!}">
		                <a class="cancles weui-swiped-btn"  href="javascript:">取消收藏</a>
		            </div>
		        </div>
		        <div class="line" style="height:2px;background-color:#f4f2f3; "></div>
	         	@endforeach

			</div>
			@else
				
					<div class="collect_list">
						<div class="line" style="height:12px;background-color:#f4f2f3; "></div>

						<div class="my-company_topic" style="padding:0.05rem 0.75rem;">
							<img src="{{asset('images/collect_color.png')}}" alt="">
							<div>
								共有<span style="color:#3583e8;" id="num">{!! $num !!}</span>个项目
							</div>
						</div>
						@foreach($list as $item)
						<div class="weui-cell weui-cell_swiped">
				            <div class="weui-cell__bd">
				                <div class="weui-cell">
				                    <div class="weui-cell__bd">
				                        <a href="/project/{!! $item->id !!}/show" class="weui-media-box weui-media-box_appmsg">
						                    <div class="weui-media-box__hd">
						                        <img class="weui-media-box__thumb" src="{!! $item->ReleaseUserObj->head_image !!}" alt="">
						                    </div>
						                    <div class="weui-media-box__bd">
						                        <h3 class="weui-media-box__title  item_style">
						                        	<p class="nowrap">{!! $item->name !!}</p>
						                        	@if($item->type=='项目')
						                        	<img src="{{asset('images/gong.png')}}" alt="">
						                        	@else
													<img src="{{asset('images/qiu.png')}}" alt="">
						                        	@endif
						                    	</h3>
						                        <div class="expand">		
													<span class="collect" style="background:url('{{asset('images/collect.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">{!! $item->collections !!}</span>
													<span class="transpond" style="background:url('{{asset('images/yulan.png')}}') no-repeat left center; background-size:  0.7rem 0.7rem;">{!! $item->view !!}</span>
												</div>
												<div class="num">会员编号:{!! $item->UserNumber !!}</div>
						                    </div>
						                </a>
				                    </div>
			                    	<a class="contact_me" href="tel:{!! $item->mobile !!}">
			                    		<div class="contact_img">
			                    			<img src="{{asset('images/contact.png')}}" alt="">
			                    		</div>
			                		</a>
				                	
				                </div>
				            </div>
				            <div class="weui-cell__ft collect_cancle" data-type="project" data-id="{!! $item->id !!}">
				                <a class="cancles weui-swiped-btn"  href="javascript:">取消收藏</a>
				            </div>
				        </div>
				        <div class="line" style="height:2px;background-color:#f4f2f3; "></div>
				       @endforeach
				    </div>
			   
			@endif
			<div style="display: none;text-align: center;" id="postinfo">
	         	别扯了,没有更多了
	         </div>
	    </div>
	</div>
@endsection

@section('js')
	<script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
	<script>
		$('.weui-cell_swiped').swipeout();
	</script>
@endsection