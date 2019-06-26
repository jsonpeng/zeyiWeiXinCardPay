@extends('front.partial.base')

@section('css')
  
@endsection

@section('seo')

@endsection
  
@section('content')
<div class="container">
    <div class="about_title">
        <h3 class="about">
            企业介绍
            <div>ABOUT US</div>
        </h3>
    </div>
    <article class="weui-article">
      {!! $page->content !!}
    </article>
    
    <div class="about_title">
        <h3 class="about">
            联系我们
            <div>CONTACT US</div>
        </h3>
    </div>
    <div id="map">
    </div>
    <ul class="contact_intro">
    <li >
      <span style="background:url('{{asset('images/tel.png')}}') no-repeat left center;">电话:{!! getSettingValueByKeyCache('service_tel') !!}</span>
    </li>
    <li> 
      <span style="background:url('{{asset('images/loca.png')}}') no-repeat left center;">地点:{!! getSettingValueByKeyCache('address') !!}</span>
    </li>
    <li>
      <span style="background:url('{{asset('images/qq.png')}}') no-repeat left center;">QQ:{!! getSettingValueByKeyCache('qq') !!}</span>
    </li>
    <li>
      <span style="background:url('{{asset('images/weixin.png')}}') no-repeat 6px center;">微信:{!! getSettingValueByKeyCache('weixin') !!}</span>
    </li>
  </ul>
</div>
@endsection

@section('js')
  <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=TH8GrWEs5kQS76N2FeWOXIMs"></script>
  <script>
            // 百度地图API功能
            var map = new BMap.Map("map");
            var point = new BMap.Point(114.347521,30.512495);
            var marker = new BMap.Marker(point);// 创建标注
            map.centerAndZoom(point, 15);
            map.enableScrollWheelZoom(true);
            map.addOverlay(marker);               // 将标注添加到地图中
            marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
    </script>
@endsection