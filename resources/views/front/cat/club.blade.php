@extends('front.partial.base')

@section('css')
  	<style>

    </style>
@endsection

@section('seo')

@endsection
  
@section('content')
<div class="container">
	<div class="detail_title">
        <h3 class="about">
            俱乐部
            <div>CLUB</div>
        </h3>
  	</div>
  	<div class="detail_main scroll-container" id="post_box">
  		
  	{{-- 	posts --}}
  			@foreach($posts as $post)
	  			<div class="detail_info scroll-item">
		  			<a href="/post/{!! $post->id !!}" class="weui-media-box" style="padding:0;">
		            	<div class="weui-media-box__hd">
			                <img class="weui-media-box__thumb" src="{!! $post->image !!}" alt="">
			            </div>
			            <div class="weui-media-box__bd" >
			                <h3 class="weui-media-box__title " style="max-width:8rem;">{!! $post->name !!}</h3>
			                <div class="expand">        
			                    <span class="collect" style="background:url('{{asset('images/clock.png')}}') no-repeat left center;">{!! $post->created_at->format('Y-m-d') !!}</span>
			                    <span class="transpond" style="background:url('{{asset('images/yulan.png')}}') no-repeat left center;">{!! $post->view !!}</span>
			                </div>
			                <div class="weui-media-box__desc" >
			                 {!! $post->brief !!}
							
			                </div>
			            </div>
			        </a>
	        	</div>
	        @endforeach

  	</div>
  	    <div style="display: none;text-align: center;" id="postinfo">
	         	别扯了,没有更多了
	     </div>
    </div>
@endsection


@section('js')
<script src="{{ asset('vendor/doT.min.js') }}"></script>

<script type="text/template" id="template">
@{{~it:value:index}}
	<div class="detail_info scroll-item">
		<a href="/post/@{{=value.id}}" class="weui-media-box">
    	<div class="weui-media-box__hd">
            <img class="weui-media-box__thumb" src="@{{=value.image}}" alt="">
        </div>
        <div class="weui-media-box__bd" >
            <h3 class="weui-media-box__title" style="max-width:9rem;">@{{=value.name}}</h3>
            <div class="expand">        
                <span class="collect" style="background:url('{{asset('images/clock.png')}}') no-repeat left center;">@{{=value.created_at}}</span>
                <span class="transpond" style="background:url('{{asset('images/yulan.png')}}') no-repeat left center;">@{{=value.view}}</span>
            </div>
            <div class="weui-media-box__desc" >
            @{{=value.brief}}
            </div>
        </div>
    </a>
</div>
@{{~}}
</script>

<script type="text/javascript">
	    //无限加载
        var fireEvent = true;
        var working = false;

         $(document).endlessScroll({

            bottomPixels: 250,

            fireDelay: 10,

            ceaseFire: function(){
              if (!fireEvent) {
                return true;
              }
            },

            callback: function(p){

              if(!fireEvent || working){return;}

              working = true;

              //加载函数
              $.ajaxSetup({ 
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                url:"/ajax/paginage/post",
                data:{
                	slug:'club',
                	skip:$('.scroll-item').length,
                	take:front_take
                },
                type:"GET",
                success:function(data){
                  working = false;
                  var all_posts=data.message;
                  console.log(all_posts.length);
                  if (all_posts.length == 0) {
                    fireEvent = false;
                    console.log('没有更多了');
                    $('#postinfo').show();
                    return;
                  }
                // 编译模板函数
                  var tempFn = doT.template( $('#template').html() );

                  // 使用模板函数生成HTML文本
                  var resultHTML = tempFn(all_posts);
                  console.log(resultHTML);
                  // 否则，直接替换list中的内容
                  $('#post_box').append(resultHTML);
              	
                  for (var i = all_posts.length - 1; i >= 0; i--) {
           			
                  }

                  }
              });
            }
        });
</script>

@endsection