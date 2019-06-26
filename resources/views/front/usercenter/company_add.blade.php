@extends('front.partial.base')

@section('css')
    <style>
        body{
            background-color: #f4f2f3;
        }
    </style>
@endsection

@section('seo')
    
@endsection
    
@section('content')
    <div class="container" style="padding-bottom: 0">
        <form id="form_company_store">
            <h3 class="company_fill" >
                <span style="color:#fc6a6b">*</span> 请上传企业logo :
            </h3>
            <div class="onload">
                <a href="javascript:;" id="success_image_box_logo">
 
                </a>
                <a href="javascript:;" class="uploads_image" data-box="success_image_box_logo">
                    <img src="{{asset('images/onload.png')}}" alt="">
                </a>
               {{--   <input name="file" type="file" class="upload_input" id="uploadfile0" onchange="change(this,'company_images')" /> --}}
                <p>请上传企业logo图片,请尽量先拍好照片后，再从本地上传，使用过程中有任何异常，请咨询客服人员</p>
            </div>
            <h3 class="company_fill">
                <span style="color:#fc6a6b">*</span> 请填写企业名称 :
            </h3>
            <div class="weui-cell">
                
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" name="name" maxlength="32" placeholder="企业名称">
                </div>
            </div>
            <h3 class="contact_fill">
                <span style="padding-left: 0.4rem;">请填写联系方式</span>
            </h3>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label"><span style="color:#fc6a6b">*</span> 手机号码</label>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" name="mobile" maxlength="11" onkeyup="value=value.replace(/[^\d]/g,'')"  placeholder="请输入手机号">
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">微信/QQ</label>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" name="weixin" maxlength="20" onkeyup="value=value.replace(/[^\d]/g,'')"placeholder="请填写微信/QQ号">
                </div>
            </div>
            
            <h3 class="company_fill">
                <span style="color:#fc6a6b">*</span> 请填写企业地址
            </h3>
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">省</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="province" id="province">
                         <option value="0" selected="selected">请选择省份</option>
                          @foreach($cities_level1 as $item)
                            <option value="{!! $item->id !!}">{!! $item->name !!}</option>
                          @endforeach
                    </select>
                </div>
            </div>
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">市</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="city" id="city">
                          <option value="0" selected="selected">请选择城市</option>
                    </select>
                </div>
            </div>
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">区</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="district" id="district">
                        <option value="0"  selected="selected" >请选择区域</option>
                    </select>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">具体地址</label>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text"  name="detail" placeholder="请输入具体地址">
                </div>
            </div>
            <h3 class="contact_fill">
                <span style="padding-left: 0.4rem;">请填写企业信息 :</span>
            </h3>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <textarea class="weui-textarea" name="intro" placeholder="请输入文本（请勿填写联系方式）" maxlength="200" rows="5"></textarea>
                    <div class="weui-textarea-counter"><span>0</span>/200</div>
                </div>
            </div>
            <h3 class="company_fill">
                <span style="color:#fc6a6b">*</span> 请上传照片:
            </h3>
            <div class="onload">
                <a href="javascript:;" id="success_image_box">
 
                </a> 
                <a href="javascript:;" class="uploads_image" data-box="success_image_box" >
                <img src="{{asset('images/onload.png')}}" alt="">
                </a>
               {{--   <input name="file" type="file" class="upload_input" id="uploadfile0" onchange="change(this,'company_images')" /> --}}
                <p>请上传企业营业执照或名片，以证明企业资质使用，最多2张,请尽量先拍好照片后，再从本地上传，使用过程中有任何异常，请咨询客服人员</p>

            </div>
            <a class="submit_btn" data-formattr="form_company_store" data-url="/ajax/company/store" data-redirecturl="/usercenter/company" href="javascript:;">确认并提交</a>
        </form>
        <div class="shade"><p style="text-align:center;color:white;margin-top: 45%;">处理中...请再等会</p></div>
    </div>
@endsection

@section('js')
<script src="{!! asset('js/select.js') !!}"></script>
<script src="{{ asset('js/exif.js') }}"></script>
<script type="text/javascript">
  //提交
  $('.submit_btn').click(function(e) {
    /* Act on the event */
    //企业名称
    
    var name=$('input[name=name]').val();
    var tel=$('input[name=mobile]').val();
    var detail=$('input[name=detail]').val();

    var form_attr=$(this).data('formattr');
    var redirect_url=$(this).data('redirecturl');
    var url=$(this).data('url');
    console.log(tel.length);

    if(name=='' || name==null){
      layer.open({
          content: '请填写企业名称'
          ,skin: 'msg'
          ,time: 2 //2秒后自动关闭
      });
          return false;
    }

    if(detail=='' ||detail==null){
      layer.open({
          content: '请输入具体地址'
          ,skin: 'msg'
          ,time: 2 //2秒后自动关闭
      });
       return false;
    }

    console.log(tel);
    
    if(tel.length!=11){
      layer.open({
          content: '手机号码长度有误'
          ,skin: 'msg'
          ,time: 2 //2秒后自动关闭
      });
          return false;
    }
    
    var info=$('.weui-textarea').val();
    if(info==null || info==''){
      layer.open({
          content: '请填写企业信息'
          ,skin: 'msg'
          ,time: 2 //2秒后自动关闭
      });
          return false;
    }
    /*传了图片
    if($('.uploads_box').length>0){
    var _status=false;
     $('.uploads_box').each(function(){
      var status=$(this).find('.zhezhao').data('status');
      if(status=='none'){
        alert('图片还在上传中,请在等等');
        _status=true
        return false;
      }
     });

     if(_status){
      return false;
     }
     
    }*/
    $('.shade').css('display', 'block');
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:url,
                type:"GET",
                data:$(form_company_store).serialize(),
                success: function(data) {
                  if (data.code == 0) {
                    //layer.msg(data.message, {icon: 1});
                      layer.open({
                          content: data.message
                          ,skin: 'msg'
                          ,time: 2 //2秒后自动关闭
                      });
                      $('.shade').css('display', 'none');
                    setTimeout(function(){
                        location.href=redirect_url;
                    },500); 
                  }else{
                      layer.open({
                          content: data.message
                          ,skin: 'msg'
                          ,time: 2 //2秒后自动关闭
                      });
                    //layer.msg(data.message, {icon: 5});
                  }
                },
            }); 
  });


      var types='company_images';
          //统计字数
        $(".weui-textarea").on('blur keyup input',function(){  
            var text=$(this).val();  
            var counter=text.length;  
            $(this).parent().find('span').text(counter);  
        });
      var previewsContainer;
      $('.uploads_image').click(function(){
        previewsContainer='#'+$(this).data('box');
        console.log(previewsContainer);
      });

      var previewTemplate='<div class="dz-preview dz-file-preview uploads_box"><img class="success_img" data-dz-thumbnail/><input type="hidden" name="'+types+'[]" value=""><span class="dz-progress"></span><div class="zhezhao"  data-status="none"></div></div>';
      //上传的dom对象
      var progress_dom;
      
      var myDropzone = new Dropzone(document.body, {
        //这是负责处理上传的路径
        url:'/ajax/uploads',
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        addRemoveLinks:false,
        maxFiles:6,
        previewTemplate: previewTemplate,
        autoQueue: true, 
        previewsContainer: "#success_image_box", 
        clickable: ".uploads_image" 
      });
      myDropzone.on("addedfile", function(file){
        console.log(file);
        progress_dom=file.previewElement;
        console.log(progress_dom);

        if(previewsContainer=='#success_image_box_logo'){
            $(previewsContainer).append($('#success_image_box').html());
            $(previewsContainer).next().remove();
            $('#success_image_box').find('.uploads_box').remove();
            $(previewsContainer).find('.uploads_box').each(function(){
                  if($(this).index()>=1){
                      $(this).remove();
                      return false;
                    }
            });
        }

       $('#success_image_box').find('.uploads_box').each(function(){
          console.log($(this).index());
          if($(this).index()==1){
            $('#success_image_box').find('.uploads_image').remove();
          }
          if($(this).index()>=2){
             $(this).remove();
             return false;
          }
        });
      });
      //队列上传过程
      myDropzone.on("totaluploadprogress", function(progress) {

           progress=Math.round(progress);
           if(previewsContainer=='#success_image_box_logo'){
                console.log('图片上传中');
                $('.shade').css('display', 'block');
                $(previewsContainer).find('span').text(progress+'%');
            }else{
                $(progress_dom).find('span').text(progress+'%');
            }

      });
      //队列上传结束
      myDropzone.on("queuecomplete", function(progress) {

           if(previewsContainer=='#success_image_box_logo'){
                $(previewsContainer).find('span').text('');
            }else{
                $(progress_dom).find('span').text('');
            }

      });
      //上传成功触发的事件
      myDropzone.on("success",function(file,data){
          if(data.code==0){
              console.log('上传成功');
              var success_dom=file.previewElement;

              if(previewsContainer=='#success_image_box_logo'){
                  $(previewsContainer).find('img').attr('src',data.message.src);
                  $(previewsContainer).find('input').val(data.message.src);
                  $(previewsContainer).find('.zhezhao').css('display', 'none');
                  $(previewsContainer).find('.zhezhao').data('status', 'true');
                  $('.shade').css('display', 'none');
              }else{
                $(success_dom).find('img').attr('src',data.message.src); 
                $(success_dom).find('input').val(data.message.src); 
                $(success_dom).find('.zhezhao').css('display', 'none');
                $(success_dom).find('.zhezhao').data('status', 'true');
            }

          }else{
               layer.open({
              content: data.message
              ,skin: 'msg'
              ,time: 2 //2秒后自动关闭
            }); 
        }     
      });
</script>

@endsection