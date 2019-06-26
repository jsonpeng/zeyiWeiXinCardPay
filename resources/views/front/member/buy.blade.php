@extends('front.partial.base')

@section('css')
    <style>
        .member-card{display: flex; padding: 10px 10px; align-items: center; font-size: 0.6rem;}
        .member-card.active{color: #fff; background-color: #3583e8;}
        .member-card .checker{
            width: 34px; 
            height: 34px; 
            background-image: url('{{ asset('images/check.png') }}'); 
            background-size: 25px 25px;
            background-repeat: no-repeat;
            background-position: center;
        }
        .member-card.active .checker{
            background-image: url('{{ asset('images/check-on.png') }}'); 
        }
        .member-card .price{
            -webkit-box-flex: 1; 
            flex: 1; 
            -webkit-flex: 1; 
            padding-left: 0.25rem;
            font-size: 0.55rem;
        }
        .member-card .name{
            -webkit-box-flex: 2; flex: 2; -webkit-flex: 2; text-align: right; padding-right: 0.4rem;
        }
        .member-card .name .des{
           font-size: 0.6rem;
            
        }
        .member-card .timer{
            width: 34px; 
            height: 34px; 
            background-image: url('{{ asset('images/time-on.png') }}'); 
            background-size: 25px 25px;
            background-repeat: no-repeat;
            background-position: center;
        }
        .member-card.active .timer{
            background-image: url('{{ asset('images/time.png') }}'); 
        }
    </style>
@endsection

@section('seo')
    
@endsection
    
@section('content')
    <div class="container">
        <div class="user_info">
            <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
                <div class="weui-media-box__hd">
                    <img class="weui-media-box__thumb" src="{!! $user->head_image !!}" alt="">
                </div>
                <div class="weui-media-box__bd">
                    <h4 class="weui-media-box__title">{!! $user->nickname !!}</h4>
                </div>
            </a>
        </div>
        <div class="line" style="height:6px;background-color: #f4f2f3;"></div>
   
        @foreach($members as $item)
        <div class="weui-cells weui-cells_radio" style="padding: 15px; margin-top: 0; border-top: 0;">
            <div class="member-card" data-id="{!! $item->id !!}" data-price="{!! $item->price !!}">
                <div class="checker"></div>
                <div class="price">¥{!! $item->price !!}</div>
                <div class="name">
                    <div class="des">{!! $item->name !!}</div>
                </div>
                <div class="timer"></div>
            </div>
        </div>
     
        @endforeach

        <div class="member_tequ">
            <h5>会员特权:</h5>
            <div class="content">
              {!! getSettingValueByKeyCache('member_des') !!}
            </div>
        </div>
        <div class="agree">
            <input type="checkbox" class="service" /><span>同意</span><a href="/page/service">《VIP会员服务条例》</a>
        </div>
        <a class="buy_btn" href="javascript:;" data-type="buy">立即购买</a>
    </div>
    
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.member-card').eq(0).addClass('active');
            $('.weui-cells_radio').on('click','.member-card', function() {
                /* Act on the event */
                if($(this).hasClass('active')){
                   $(this).removeClass('active');
                }else{
                   $(this).addClass('active');
                   $(this).parent().siblings('.weui-cells_radio').children('.active').removeClass('active');
                }
            });
        });
    </script>
@endsection