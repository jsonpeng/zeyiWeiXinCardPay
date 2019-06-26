@extends('front.partial.base')

@section('css')

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

        <div class="company-collect_list" id="company_box" style="padding-top: 0;">
        @foreach ($companys as $item)
            <div class="collect_item scroll-item">
                <div class="weui-panel__bd">
                    <a href="/{!! $item->id !!}/company_detail" class="weui-media-box weui-media-box_appmsg">
                        <div class="weui-media-box__hd">
                            <img class="weui-media-box__thumb" src="@if(count($item['images'])) {!! $item['images']['0']['url'] !!} @else {{asset('images/company_1.jpg')}} @endif" alt="">
                        </div>
                        <div class="weui-media-box__bd">
                            <h3 class="weui-media-box__title nowrap">{!! $item->name !!}</h3>
                            <div class="expand">        
                                
                                <span class="collect" style="background:url('{{asset('images/collect.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">{!! $item->collect !!}</span>
                                <span class="transpond" style="background:url('{{asset('images/yulan.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">{!! $item->view !!}</span>

                            </div>
                            <div class="address" style="background:url('{{asset('images/didian.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">
                               {!! $item->detail !!}

                            </div>
                        </div>
                    </a>
                    <a class="contact_me" href="tel:{!! $item->mobile!!}">
                        <img src="{{asset('images/contact.png')}}" alt="">
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
<script src="{{ asset('vendor/doT.min.js') }}"></script>
{{-- {{asset('images/company_1.jpg')}}  --}}
<script type="text/template" id="template">
@{{~it:value:index}}
        <div class="collect_item scroll-item">
                <div class="weui-panel__bd">
                    <a href="/@{{=value.id}}/company_detail" class="weui-media-box weui-media-box_appmsg">
                        <div class="weui-media-box__hd">
                            <img class="weui-media-box__thumb" src="@{{=value.images['0'].url}}" alt="">
                        </div>
                        <div class="weui-media-box__bd">
                            <h3 class="weui-media-box__title nowrap">@{{=value.name}}</h3>
                            <div class="expand">        
                                
                                <span class="collect" style="background:url('{{asset('images/collect.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">@{{=value.collect}}</span>
                                <span class="transpond" style="background:url('{{asset('images/yulan.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">@{{=value.view}}</span>

                            </div>
                            <div class="address" style="background:url('{{asset('images/didian.png')}}') no-repeat left center; background-size: 0.7rem 0.7rem;">
                                @{{=value.detail}}
                             
                            </div>
                        </div>
                    </a>
                    <a class="contact_me" href="tel: @{{=value.mobile}}">
                        <img src="{{asset('images/contact.png')}}" alt="">
                    </a>
                </div>
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
                url:"/ajax/paginage/company",
                data:{
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
                  var tempFn = doT.template($('#template').html());
                  // 使用模板函数生成HTML文本
                  var resultHTML = tempFn(all_posts);
                  console.log(resultHTML);
                  // 否则，直接替换list中的内容
                  $('#company_box').append(resultHTML);
                  }
              });
            }
        });
         
</script>

@endsection