@extends('front.partial.base')

@section('css')
    <style>
        body{
            background-color:#5da2fd;
        }
    </style>
@endsection

@section('seo')

@endsection
    
@section('content')
    <div class="app-wrapper">
            <div class="nav_tip">
      <div class="img">
        <a href="javascript:history.back(-1)"><img src="http://127.0.0.6/images/default/white_left.png" alt=""></a></div>
      <p class="titile">分享二维码</p>
      <div class="userSet">
          <a href="javascript:;">
                <img src="http://127.0.0.6/images/default/share.png" alt="">
          </a>
      </div>
    </div>
    <div style="text-align: center;">
        <img src="{{asset('images/erweima.png')}}" style="width: 80%; margin-top: 30px; margin-bottom: 15px;">
    </div>

    <div class="weui-planel ">
    <div class="weui-panel__hd store-info">
        <p><a href="/">店铺主页</a></p>
        <p>|</p>
        <p><a href="/usercenter">会员中心</a></p>
        <p>|</p>
        <p><a href="/page/weixin">关注我们</a></p>
        <p>|</p>
        <p><a href="/page/shopinfo">店铺信息</a></p>
    </div>
</div>
<div class="weui-planel store-text">
    <div class="weui-planel__hd">
        <p class="storeName">芸来商城</p>
    </div>
        <div class="weui-planel__bd">
        <a href="tel:13971217270">芸来软件技术支持 tel:13971217270</a>
    </div>
    </div>
    </div>

@endsection