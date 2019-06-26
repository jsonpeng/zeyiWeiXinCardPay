@extends('front.partial.base')

@section('css')
    <style>
        body{
            background-color:#5da2fd;
        }
        .man_contact{
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding:0 0.5rem;
          padding-bottom:1.5rem;
        }
        .man_contact .man_contact-fas .man-tel{
          font-size: 0.55rem;color:#333;
          text-align: center;
        }
        .man_contact .man_contact-fas .man_address{
          font-size: 0.55rem;color:#70768b;
          padding-left:0.75rem;
          margin-right: 0.25rem;
          text-align: center;
        }
        .man_contact .man-tel_img{
          display: flex;
          align-items: center;
        }
        .cut_line{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cut_line .weui-cell-fl{
            width:0.8rem;
            height:0.8rem;
            border-top-right-radius:50%;
            border-bottom-right-radius:50%;
            border-top-left-radius:0;
            border-bottom-left-radius: 0;
            transform: translateX(-50%);
            background-color: #5da2fd;
        }
        .cut_line .weui-cell-fr{
            width:0.8rem;
            height:0.8rem;
            border-top-left-radius:50%;
            border-bottom-left-radius:50%;
            border-top-right-radius:0;
            border-bottom-right-radius: 0;
            transform: translateX(50%);
            background-color: #5da2fd;
        }
        .cut_line .border{
            height:0.05rem;
            width:80%;
            border-top:0.05rem dotted #999;
        }
    </style>
@endsection

@section('seo')

@endsection
    
@section('content')
    <div class="container">
        <h4 class="generalize" >
            联系管理员
        </h4>
        <div class="user_erwei">
            <div class="user_name">
                <h4>
                    <span>{!! get_page_custom_value_by_key($page,'admin_name') !!}</span>
                </h4>
            </div>
            <div class=" cut_line">
                <div class="weui-cell-fl"></div>
                <div class="border" ></div>
                <div class="weui-cell-fr"></div>
            </div>
            <div class="img_erweima">
                <img src="{!! get_page_custom_value_by_key($page,'erweima') !!}" alt="">
                <p class="sao">长按识别二维码或微信扫一扫</p>
            </div>
            <div class="man_contact">
              <div class="man_contact-fas">
                <div class="man-tel">管理员电话 : {!! get_page_custom_value_by_key($page,'admin_tel') !!}</div>
                <div class="man_address" style="background:url('{{asset('images/didian.png')}}') no-repeat left center;background-size: 0.7rem 0.7rem;">{!! get_page_custom_value_by_key($page,'admin_address') !!}</div>
              </div>
              <a class="man-tel_img" href="tel:{!! get_page_custom_value_by_key($page,'admin_tel') !!}">
                <img src="{{asset('images/contact.png')}}" alt="" width:1rem; height:1rem;>
              </a>
            </div>
        </div>
        <ul class="erweima_nav">
            <li>
                <a href="/">主页</a>
            </li>
            <li>
                <a href="/usercenter">会员中心</a>
                
            </li>
            <li>
                <a href="/projects/1/pro">项目展示</a>
            </li>
            <li>
                <a href="/projects/1/com">需求展示</a>
            </li>
        </ul>
        <div class="copyright">
            <span style="background:url('{{asset('images/yunlai.png')}}') no-repeat left center;background-size: 0.775rem0.6rem;">芸来提供技术支持</span>
        </div>
    </div>
@endsection