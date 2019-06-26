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
      <div class="detail_info">
        
      </div>
      <div class="detail_content">
        {!! $page->content !!}
      </div>
    </div>
</div>
@endsection