@extends('front.partial.base')

@section('css')
	
@endsection

@section('seo')

@endsection
	
@section('content')
<div class="container">
	
  	<div class="detail_main">
      <h3 class="detail-title">
            {!! $post->name !!}
      </h3>
  		<div class="detail_info" style="display: flex;justify-content: space-between;align-items: center;">
  			<div class="expand">		
  				<span class="transpond" style="background:url('{{asset('images/yulan.png')}}') no-repeat left center; ">{!! $post->view !!}</span>
  			</div>
  			<div class="detail_date">
  				{!! $post->created_at !!}
  			</div>
  	  </div>
  		<div class="detail_content">
  		  {!! $post->content !!}
  		</div>
      <div class="fenye">

        @if(!empty($prePost))
        <a href="/post/{!! $prePost->id !!}" class="shang">上一页</a>
        @endif

        @if(!empty($nextPost))
        <a href="/post/{!! $nextPost->id !!}" class="xia">下一页</a>
        @endif
      </div>
  	</div>
</div>
@endsection