@extends('front.partial.base')

@section('css')
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <style>
        body{
            background-color: #f4f2f3;
        }
         html, body {
      height: 100%;
    }
    #actions {
      margin: 2em 0;
    }
    div.table {
      display: table;
    }
    div.table .file-row {
      display: table-row;
    }
    div.table .file-row > div {
      display: table-cell;
      vertical-align: top;
      border-top: 1px solid #ddd;
      padding: 8px;
    }
    div.table .file-row:nth-child(odd) {
      background: #f9f9f9;
    }
    #total-progress {
      opacity: 0;
      transition: opacity 0.3s linear;
    }
    #previews .file-row.dz-success .progress {
      opacity: 0;
      transition: opacity 0.3s linear;
    }
    #previews .file-row .delete {
      display: none;
    }
    #previews .file-row.dz-success .start,
    #previews .file-row.dz-success .cancel {
      display: none;
    }
    #previews .file-row.dz-success .delete {
      display: block;
    }
    .test{
        display:inline-block;
    }
    </style>
@endsection

@section('seo')

@endsection
    
@section('content')
  
  <div class="container" id="container">
    <div id="actions" class="row">
      <div class="col-lg-7">

        <span class="btn btn-success fileinput-button dz-clickable" id="fileinput">
            <i class="glyphicon glyphicon-plus"></i>
            <span>Add files...</span>
        </span>
        <button type="submit" class="btn btn-primary start">
            <i class="glyphicon glyphicon-upload"></i>
            <span>Start upload</span>
        </button>
        <button type="reset" class="btn btn-warning cancel">
            <i class="glyphicon glyphicon-ban-circle"></i>
            <span>Cancel upload</span>
        </button>
      </div>
      <div class="col-lg-5">
        <!-- The global file processing state -->
        <span class="fileupload-process">
          <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
          </div>
        </span>
      </div>
    </div>
    <div class="table table-striped files" id="previews">
    </div>
    
  </div>
  <input type="file" multiple="multiple" class="dz-hidden-input" style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">

  @endsection


@section('js')
<script>
    var types="project_images"; 

    var previewTemplate='<div class="dz-preview dz-file-preview test" style="display:inline"><img class="success_img" data-dz-thumbnail/><input type="hidden" name="'+types+'[]" value=""><span class="dz-progress"></span></div>';
  
      //上传的dom对象
      var progress_dom;
      //var fileinput = document.querySelector('#fileinput');
      var myDropzone = new Dropzone(document.body, {
        //这是负责处理上传的路径
        url:'/ajax/uploads',
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        addRemoveLinks:false,
        previewTemplate: previewTemplate,
        //不自动提交图片，直到手动提交
        autoQueue: true, 
        //预览图片的容器
        previewsContainer: "#previews", 
        clickable: ".fileinput-button" 
      });
      myDropzone.on("addedfile", function(file) {
        progress_dom=file.previewElement;
        console.log(progress_dom);
        if($('.success_img').length>6){
          alert('已达到最大上传数量');
          //myDropzone.removeFiles(file);
          return false;
        }
      });
      // Update the total progress bar
      myDropzone.on("totaluploadprogress", function(progress) {
        $(progress_dom).find('span').text(progress+'%');
        //$('.dz-progress').parent().css('opacity',100);
 
      });
      myDropzone.on("queuecomplete", function(progress) {
        $(progress_dom).find('span').text('');
     
      });
      myDropzone.on("success",function(file,data){
                //上传成功触发的事件
                console.log('上传成功');
               $(progress_dom).find('input').val(data.message.src);
      });
 
</script>
@endsection