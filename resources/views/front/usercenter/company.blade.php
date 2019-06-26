@extends('front.partial.base')

@section('css')
    <style>
        .company-name{
            display: flex;
            justify-content: space-between;
        }
    </style>
@endsection

@section('seo')
    
@endsection
    
@section('content')
    <div class="container">
        <div class="my-company_topic">
            <div></div>
            <div>
                共有<span style="color:#3583e8;">{!! $companys_num !!}</span>个企业
            </div>
        </div>
        <div class="line" style="height:6px;background-color:#f4f2f3; "></div>
        <div class="company-collect_list" style="padding:0;">
        @foreach ($companys as $item)
            <div class="collect_item">
                <div class="weui-panel__bd">
                    <a href="/{!! $item->id !!}/company_detail" class="weui-media-box weui-media-box_appmsg">
                        <div class="weui-media-box__hd">
                            <img class="weui-media-box__thumb" src="@if(count($item['images'])) {!! $item['images']['0']['url'] !!} @else {{asset('images/company_1.jpg')}} @endif" alt="">
                        </div>
                        <div class="weui-media-box__bd">
                            <h3 class="weui-media-box__title company-name">
                                <span class="nowrap">{!! $item->name !!} </span>
                                <span class="pass-state" style="color:red;">{!! empty($item->status) || $item->status=== 2 ?'(审核中)':'' !!} </span> 
                            </h3>
                            <div class="expand">        
                                
                                <span class="collect" style="background:url('{{asset('images/collect.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">{!! $item->collect !!}</span>
                                <span class="transpond" style="background:url('{{asset('images/yulan.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">{!! $item->view !!}</span>

                            </div>
                            <div class="address" style="background:url('{{asset('images/didian.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">
                               {!! $item->detail !!}

                            </div>
                        </div>
                    </a>
                </div>
            </div>
             
        @endforeach
        </div>
        <div style="display: none;text-align: center;" id="postinfo">
            别扯了,没有更多了
         </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.bootcss.com/jquery-weui/1.2.0/js/jquery-weui.min.js"></script>
@endsection