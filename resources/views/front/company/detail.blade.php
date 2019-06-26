@extends('front.partial.base')
@section('css')


<style>

.member-card{flex:1;display: flex; padding: 10px 10px; align-items: center; font-size: 14px;}
.member-card .checker{
  width: 34px;
  height: 34px;
  background-image: url('{{ asset('images/check.png') }}');
  background-size: 25px 25px;
  background-repeat: no-repeat;
  background-position: center;
}
.member-card .option{
margin-left: 0.5rem;
font-size: 0.6rem;
}
.member-card.active .checker{
background-image: url('{{ asset('images/check-on.png') }}');
}

.submit_box{
padding:15px;
background-color: #f4f2f3;
}
#jiucuo{
width:100%;
bottom:0;
left:0;
position: fixed;
z-index:2000;
}

.result{position: fixed;top:0;left:0;background: rgba(0,0,0,0.5);z-index:1000;width:100%;height:100%;display: none;}    
.imgresult{border:5px solid #fff;}  
.indiv{position: absolute;}  
.imgresult img{
  display: block;
  width:100%;
  height:auto;
}

</style>
@endsection
@section('seo')
@endsection

@section('content')
<div class="container">
  <div class="company_title">
    <h3 class="about">
      企业展示
      <div>DISPLAY</div>
    </h3>
  </div>
  <?php $image=$company->images()->take(1)->get()->toArray();?>
  <!-- <div class="detail_banner">
    <img src="@if(count($image)) {!! $image[0]['url'] !!} @else {{asset('images/banner_company.jpg')}} @endif" alt="" style="display:block;max-width:100%;height:auto;">
  </div> -->
  <div class="main">
    <h3>{!! $company->name !!}</h3>
    <div class="info">
      <div class="left">
        <div class="like">
          <div class="expand">
            <?php $status=getCollectionStatus('company',$company->id);?>
            <span class="collect_permission collect"  data-id="{!! $company->id !!}" data-type="company" data-status="{!! $status  !!}" style="background:url('http://{!! $_SERVER['HTTP_HOST'] !!}/images/{!! $status?'collect_color':'collect' !!}.png') no-repeat left center; background-size: 0.7rem 0.7rem;">{!! $company->collect !!}</span>
            <span class="transpond" style="background:url('{{asset('images/yulan.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">{!! $company->view !!}</span>
          </div>
        </div>
        <div class="address" style="background:url('{{asset('images/didian.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">
          {!! $company->detail !!}
        </div>
      </div>
      <a class="right" href="tel:{!! $company->mobile !!}">
        <div class="contact_img">
          <img src="{{asset('images/contact.png')}}" alt="">
        </div>
      </a>
    </div>
    <div class="content">
      {!! $company->intro !!}
      <div class="company_imgs">
        @foreach ($images as $item)
        <div class="imgclass">
          <img src="{!! $item->url !!}" alt="" >
        </div>
        
        @endforeach
      </div>
    </div>
    <div class="error_box">
      <span class="error" style="background:url('{{asset('images/error.png')}}') no-repeat left center;">纠错</span>
    </div>
    <form id="jiucuo" style="display: none;">
      <h3 class="company_fill" style="background-color: #f4f2f3;text-align: center;font-size: 0.75rem; color:#333;font-weight: bold;">
      纠错
      </h3>
      @foreach ($list as $item)
      <div class="weui-cells weui-cells_radio" style="padding: 0.375rem; margin-top: 0; border-top: 0;">
        <div class="member-card " card-id=''>
          <div class="checker"></div>
          <div class="option">{!! $item !!}</div>
        </div>
      </div>
      @endforeach
      <div class="weui-cells weui-cells_radio" style="padding: 0.375rem;; margin-top: 0; border-top: 0;">
        <div class="member-card " card-id=''>
          <div class="checker"></div>
          <div class="option">其他</div>
        </div>
      </div>
      <div id="other" style="display: none;">
        <h3 class="contact_fill" style="background-color: #f4f2f3;">
        其他 :
        </h3>
        <div class="weui-cell">
          <div class="weui-cell__bd">
            <textarea class="weui-textarea" name="detail" id="other_detail" placeholder="请输入文本（请勿填写联系方式）" rows="3"></textarea>
            <div class="weui-textarea-counter"><span>0</span>/200</div>
          </div>
        </div>
      </div>
      <div class="submit_box">
        <a class="submit_btn" data-id="{!! $company->id !!}" href="javascript:;">确认并提交</a>
      </div>
    </form>
    <div class="shade" style="display: none;"></div>
    <div class="result" id="outdiv">  
      <div class="indiv">  
        <div id="bigimg" class="imgresult">
          <img src="" alt="">
        </div>
      </div>    
    </div>  
    
  </div>
</div>
  @endsection
  @section('js')
  <script src="{{asset('js/bigimg.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/xback.js') }}"></script>
  
  
  <script>
      var mark=false;
      $(document).ready(function() {
        //监听返回键
          XBack.listen(function(){
              if(mark){
                  $('.shade').click();
              }
          });
          $('.weui-cells_radio').on('click','.member-card', function() {
          /* Act on the event */
              if($(this).hasClass('active')){
                  $(this).removeClass('active');
              }else{
                  $(this).addClass('active');
                  $(this).parent().siblings('.weui-cells_radio').children('.active').removeClass('active');
              }
              //如果是其他原因 填写内容
              if($(this).find('.option').text()=='其他'){
                  $('#other').show();
              }else{
                  $('#other').hide();
              }
          });
          //提交
          //请求地址 /company/submitErrorInfo
          $('.submit_btn').click(function(){
              //先检测有没有选择原因
              var checked=$('.member-card').hasClass('active');
              //没有选择就跳出
              if(!checked){
                  layer.open({
                      content: '请选择纠错原因'
                      ,skin: 'msg'
                      ,time: 2 //2秒后自动关闭
                  });
                  return false;
              }
              var company_id=$(this).data('id');
              console.log($('.member-card.active'));
              // return;
              var reason=$('.member-card.active').find('.option').text();
              //如果是其他原因
              if(reason=='其他'){
                  reason=$('#other_detail').val();
                  if(reason=='' || reason==null){
                      layer.open({
                          content: '请输入纠错原因'
                          ,skin: 'msg'
                          ,time: 2 //2秒后自动关闭
                      });
                      return false;
                  }
              }
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  url:'/ajax/company/submitErrorInfo',
                  type:"GET",
                  data:{
                      reason:reason,
                      company_id:company_id
                  },
                  success: function(data) {
                      if (data.code == 0) {
                          $('#jiucuo,.shade').hide();
                          layer.open({
                              content: data.message
                              ,skin: 'msg'
                              ,time: 2 //2秒后自动关闭
                          });
                      }else{
                          layer.open({
                              content: data.message
                              ,skin: 'msg'
                              ,time: 2 //2秒后自动关闭
                          });
                      }
                  }
              });
          });
      });
      $(".error").on('click',function () {
          $('#jiucuo').fadeToggle();
          $('.shade').fadeToggle();
          mark=!mark;
          if(mark===true){
              window.history.pushState({}, "title", "#");
          }
      });
      $('.shade').click(function(){
          $('#jiucuo,.shade').hide();
          mark=false;
      });
      window.onbeforeunload=function(){
          if($('#jiucuo').css('display')=='block'){
              setTimeout(function(){
                  history.go(1);
              },500);
          }
      }
  </script>

    @if(Config::get('web.app_env') == 'online')
  <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" charset="utf-8">
      wx.config({!! $app->jssdk->buildConfig(array('onMenuShareTimeline', 'onMenuShareAppMessage'), false) !!});
      wx.ready(function(){
        wx.onMenuShareTimeline({
          title: '{{ $company->name }}', // 分享标题
          link: window.location.href, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
          imgUrl: '{{ !empty($images)?$images[0]['url']:'' }}', // 分享图标
          success: function () {
          // 用户确认分享后执行的回调函数
            layer.open({
                content: '分享成功！'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
          },
          cancel: function () {
          // 用户取消分享后执行的回调函数
          }
        });
        wx.onMenuShareAppMessage({
          title: '{{ $company->name }}', // 分享标题
          desc: '{{ $company->detail }}', // 分享描述
          link: window.location.href, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
          imgUrl: '{{ !empty($images)?$images[0]['url']:'' }}', // 分享图标
          success: function () {
          // 用户确认分享后执行的回调函数
          layer.open({
                content: '分享成功！'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
          },
          cancel: function () {
          // 用户取消分享后执行的回调函数
            
          }
        });
      });
  </script>
  @endif
  
  @endsection