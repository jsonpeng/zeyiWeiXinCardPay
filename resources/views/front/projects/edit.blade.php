@extends('front.partial.base')

@section('css')
    <style>
        body{
            background-color: #f4f2f3;
        }
        .weui-cells_radio{
            display: flex;
        }
        .weui-cells_radio .weui-icon-checked:before{
            content: '\EA01';
            color: #C9C9C9;
            font-size: 23px;
            display: block;
        }
        
        .weui-cells_radio .weui-check:checked + .weui-icon-checked:before{
            content: '\EA06';
            color: #09BB07;
            display: block;
            font-size: 23px;
        }
    </style>
@endsection

@section('seo')
    
@endsection
    
@section('content')
    <div class="container"  style="padding-bottom: 0">
        <form  id="form_project_update">
            <h3 class="company_fill">
                <span style="color:#fc6a6b">*</span> 请填写项目名称
            </h3>
            <div class="weui-cell">
                
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" name="name" value="{!! $project->name !!}" maxlength="32" placeholder="项目名称">
                </div>
            </div>
            <h3 class="contact_fill">
                请填写联系方式
            </h3>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label"><span style="color:#fc6a6b">*</span> 手机号码</label>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" name="mobile"  value="{!! $project->mobile !!}" onkeyup="value=value.replace(/[^\d]/g,'')" maxlength="11" placeholder="请输入手机号">
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">微信/QQ</label>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" name="weixin" value="{!! $project->weixin !!}"  onkeyup="value=value.replace(/[^\d]/g,'')" maxlength="20" placeholder="请填写微信/QQ号">
                </div>
            </div>
            <h3 class="company_fill">
                <span style="color:#fc6a6b">*</span> 请填写项目信息
            </h3>
            <div class="weui-cell">
                <div class="weui-cell__hd">
                    <label class="weui-label">项目金额</label>
                </div>
                <div class="weui-cell__bd item_price">
                    <input class="weui-input" type="text" name="money" value="{!! $project->money !!}" maxlength="8" onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="请填写项目金额">
                    <span style="width:1.5rem">万元</span>
                </div>
            </div>
            <h3 class="contact_fill">
                <span style="padding-left: 0.4rem;">项目类型</span>
            </h3>
            <div class="weui-cells weui-cells_radio">
                <label class="weui-cell weui-check__label" for="x11">
                    <div class="weui-cell__bd">
                        <p>项目</p>
                    </div>
                    <div class="weui-cell__ft">
                        <input type="radio" class="weui-check" name="type" id="x1" value="项目" @if($project->type=='项目') checked="checked" @endif>
                        <i class="weui-icon-checked"></i>
                    </div>
                </label>
                <label class="weui-cell weui-check__label" for="x12">
                    <div class="weui-cell__bd">
                        <p>需求</p>
                    </div>
                    <div class="weui-cell__ft">
                        <input type="radio" name="type" class="weui-check"  value="需求" id="x2" @if($project->type=='需求') checked="checked" @endif>
                        <i class="weui-icon-checked"></i>
                    </div>
                </label>
            </div>

           <h3 class="contact_fill">
                <span style="padding-left: 0.4rem;">项目所属行业</span>
            </h3>
            <div class="weui-cells weui-cells_radio">
                <?php $i=0;?>
                @foreach ($hangye as $item)
                <?php $i++;?>
                        <label class="weui-cell weui-check__label" for="xx{!! $item->id !!}">
                            <div class="weui-cell__bd">
                                <p>{!! $item->name !!}</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input type="radio" class="weui-check" name="industries" id="xx{!! $item->id !!}" value="{!! $item->id !!}" @if(!empty($project->industries()->first())) @if($project->industries()->first()->id==$item->id) checked="checked" @endif @endif>
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                @endforeach
            </div>
            <h3 class="company_fill">
                <span style="color:#fc6a6b">*</span> 请填写项目地址
            </h3>
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">省</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="province" id="province">
                         <option value="0" @if(empty($project->province)) selected="selected" @endif>请选择省份</option>
                          @foreach($cities_level1 as $item)
                            <option value="{!! $item->id !!}" @if($project->province==$item->id) selected="selected" @endif>{!! $item->name !!}</option>
                          @endforeach
                    </select>
                </div>
            </div>
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd" >
                    <label for="" class="weui-label">市</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="city" id="city">
                          <option value="0" @if(empty($project->city)) selected="selected" @endif>请选择城市</option>
                           @foreach($cities_level2 as $item)
                            <option value="{!! $item->id !!}" @if($project->city==$item->id) selected="selected" @endif>{!! $item->name !!}</option>
                           @endforeach
                    </select>
                </div>
            </div>
            <div class="weui-cell weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">区</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="district" id="district">
                        <option value="0"  @if(empty($project->district)) selected="selected" @endif>请选择区域</option>
                         @foreach($cities_level3 as $item)
                            <option value="{!! $item->id !!}" @if($project->district==$item->id) selected="selected" @endif>{!! $item->name !!}</option>
                         @endforeach
                    </select>
                </div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd" >
                    <label class="weui-label">具体地址</label>
                </div>
                <div class="weui-cell__bd">
                    <input class="weui-input" type="text" name="address" value="{!! $project->address !!}" placeholder="请输入具体地址">
                </div>
            </div>
            <h3 class="contact_fill">
                请填写项目信息 :
            </h3>
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <textarea class="weui-textarea" name="detail"  placeholder="请输入文本（请勿填写联系方式）" maxlength="200" rows="5">{{ $project->detail }}</textarea>
                    <div class="weui-textarea-counter"><span>{!! strlen($project->detail) !!}</span>/200</div>
                </div>
            </div>
            <h3 class="company_fill">
                <span style="color:#fc6a6b">*</span> 请上传照片:
            </h3>
            <div class="onload">
                <div  id="success_image_box">
                   @foreach ($images as $item)
                        <div class="uploads_box"><img class="success_img" src="{!! $item->url !!}"/><input type="hidden" name="project_images[]" value="{!! $item->url !!}"><span class="dz-progress"></span><div class="zhezhao" style="display: none;" data-status="none"></div><a onclick="del_image(this)">删除</a></div>
                   @endforeach
                </div> 
                <a href="javascript:;" id="uploads_image" style="display: {!! count($images)>=6?'none':'block' !!};">
                    <img src="{{asset('images/onload.png')}}" alt="">
                </a>
            {{--      <input name="file" type="file" class="upload_input" id="uploadfile0" onchange="change(this)"/> --}}
                <p>请尽量先拍好照片后，再从本地上传，使用过程中有任何异常，请咨询客服人员</p>
            </div>
            <a class="submit_btn" data-formattr="project_update" data-url="/ajax/project/{!! $project->id !!}/update" data-redirecturl="/usercenter" href="javascript:;" >确认并上传</a>
        </form>
        <div class="shade"></div>
    </div>
@endsection


@include('front.projects.js')