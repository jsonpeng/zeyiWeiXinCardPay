@extends('front.partial.base')

@section('css')
  
@endsection

@section('seo')

@endsection
  
@section('content')
<div class="container">
  <div class="detail_title">
        <h3 class="about">
            {!! $page->name !!}
        </h3>
    </div>
    <div class="detail_main">
      <div class="detail_info" style="display: flex;justify-content: space-between;align-items: center;">
        <div class="expand">    
          <span class="transpond" style="background:url('{{asset('images/yulan.png')}}') no-repeat left center; ">{!! $page->view !!}</span>
        </div>
        <div class="detail_date">
          {!! $page->created_at !!}
        </div>
      </div>
      <div class="detail_content">
        {!! $page->content !!}
      </div>
    </div>
</div>
@endsection