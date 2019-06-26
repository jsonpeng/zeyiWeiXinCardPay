@extends('layouts.app')


@section('content')
<section class="content pdall0-xs pt10-xs">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li>
                <a href="javascript:;">
                    <span style="font-weight: bold;">通用设置</span>
                </a>
            </li>
            <li class="active">
                <a href="#tab_1" data-toggle="tab">网站设置</a>
            </li>

            <li>
                <a href="#tab_2" data-toggle="tab">企业设置</a>
            </li>

            <li>
                <a href="#tab_6" data-toggle="tab">项目金额设置</a>
            </li>

            <li>
                <a href="#tab_8" data-toggle="tab">其他设置</a>
            </li>

             <li>
                <a href="#tab_9" data-toggle="tab">分享背景图片设置</a>
            </li>
   
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="box box-info form">
                <!-- form start -->
                <div class="box-body">
                    <form class="form-horizontal" id="form1">
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">网站名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" maxlength="60" placeholder="网站名称" value="{{ getSettingValueByKey('name') }}"></div>
                        </div>
                  {{--       <div class="form-group">
                            <label for="icp" class="col-sm-3 control-label">ICP备案信息</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="icp" maxlength="60" placeholder="ICP备案信息" value="{{ getSettingValueByKey('icp') }}">
                                <p class="help-block">网站备案号，将显示在前台底部欢迎信息等位置</p>
                            </div>

                        </div> 
                        <div class="form-group">
                            <label for="logo" class="col-sm-3 control-label">网站LOGO</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="image1" name="logo" placeholder="网站LOGO" value="{{ getSettingValueByKey('logo') }}">
                                <div class="input-append">
                                    <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button" onclick="changeImageId('image1')">选择图片</a>
                                    <img src="@if(getSettingValueByKey('logo')) {{ getSettingValueByKey('logo') }} @endif" style="max-width: 100%; max-height: 150px; display: block;">
                                </div>
                                <p class="help-block">默认网站首页LOGO,通用头部显示，最佳显示尺寸为240*60像素</p>
                            </div>
                        </div>--}}

                        <div class="form-group">
                            <label for="seo_title" class="col-sm-3 control-label">网站标题</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="seo_title" maxlength="60" placeholder="网站标题" value="{{ getSettingValueByKey('seo_title') }}"></div>
                        </div>
                        <div class="form-group">
                            <label for="seo_des" class="col-sm-3 control-label">网站描述</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="seo_des" maxlength="60" placeholder="网站描述" value="{{ getSettingValueByKey('seo_des') }}"></div>
                        </div>
                        <div class="form-group">
                            <label for="seo_keywords" class="col-sm-3 control-label">网站关键字</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="seo_keywords" maxlength="60" placeholder="网站关键字" value="{{ getSettingValueByKey('seo_keywords') }}"></div>
                        </div>
                        <div class="form-group">
                            <label for="service_tel" class="col-sm-3 control-label">服务电话</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="service_tel" maxlength="60" placeholder="服务电话" value="{{ getSettingValueByKey('service_tel') }}"></div>
                        </div>

                        <div class="form-group">
                            <label for="weixin" class="col-sm-3 control-label">微信公众号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="image2" name="weixin" placeholder="微信公众号二维码" value="{{ getSettingValueByKey('weixin') }}">
                           <div class="input-append">
                                    <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button" onclick="changeImageId('image2')">选择图片</a>
                                    <img src="@if(getSettingValueByKey('weixin')) {{ getSettingValueByKey('weixin') }} @endif" style="max-width: 100%; max-height: 150px; display: block;">
                                </div>
                            </div>
                        </div>

         

                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">QQ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  name="qq" placeholder="qq" value="{{ getSettingValueByKey('qq') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">微信</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  name="weixin" placeholder="微信" value="{{ getSettingValueByKey('weixin') }}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">地址</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  name="address" placeholder="地址" value="{{ getSettingValueByKey('address') }}">
                                 <a class="inline-block pd10" onclick="openMap('address')">在地图中设定</a>
                            </div>
                        </div>


                    </form>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-left" onclick="saveForm(1)">保存</button>
                </div>
                <!-- /.box-footer --> </div>
        </div>

        <!-- /.tab-pane -->
  
        <div class="tab-pane" id="tab_2">
            <div class="box box-info form">
                <!-- form start -->
                <div class="box-body">
                    <form class="form-horizontal" id="form2">


                   <div class="form-group">
                            <label for="weixin" class="col-sm-3 control-label">企业名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  name="company_name" placeholder="企业名称" value="{{ getSettingValueByKey('company_name') }}">
                            </div>
                    </div>
                        
                     <div class="form-group">
                            <label for="weixin" class="col-sm-3 control-label">加入会员介绍</label>
                            <div class="col-sm-9">
                                <textarea  class="form-control"  name="join_club" placeholder="加入会员介绍" value="">{{ getSettingValueByKey('join_club') }} </textarea>
                            </div>
                      </div>

                       <div class="form-group">
                            <label for="weixin" class="col-sm-3 control-label">会员特权描述</label>
                            <div class="col-sm-9">
                                <textarea  class="form-control"  name="member_des" placeholder="会员特权描述" value="">{{ getSettingValueByKey('member_des') }} </textarea>
                            </div>
                      </div>
               
                       <div class="form-group">
                            <label for="weixin" class="col-sm-3 control-label">佣金说明 :</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control"  name="distribute_shuoming" rows="4" placeholder="佣金说明">{{ getSettingValueByKey('distribute_shuoming') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="weixin" class="col-sm-3 control-label">企业纠错原因</label>
                            <div class="col-sm-9">
                                <textarea class="form-control"  id="error_info_list" name="error_info_list" placeholder="纠错信息列表(多个选择使用回车换行，一行一个选项)" rows="{!! count(getErrorList()) !!}">{!! getSettingValueByKey('error_info_list') !!}</textarea>
                                <p class="help-block">多个选择使用回车换行，一行一个选项</p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-left" onclick="saveForm(2)">保存</button>
                </div>
            </div>
        </div>

        
          <div class="tab-pane" id="tab_6">
            <div class="box box-info form">
                <!-- form start -->
                <div class="box-body">
                    <form class="form-horizontal" id="form6">

                        <div class="form-group">
                            <label for="weixin" class="col-sm-3 control-label">项目金额选项(单位:万元)</label>
                            <div class="col-sm-9">
                                <textarea class="form-control"  id="project_money_list" name="project_money_list" placeholder="项目金额选项(多个选择使用回车换行，一行一个选项)" rows="{!! count(projectMoneyList()) !!}">{!! getSettingValueByKey('project_money_list') !!}</textarea>
                                <p class="help-block">多个选择使用回车换行，一行一个选项</p>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-left" onclick="saveForm(6)">保存</button>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab_8">
            <div class="box box-info form">
                <!-- form start -->
                <div class="box-body">
                    <form class="form-horizontal" id="form8">

                        <div class="form-group">
                            <label for="feie_sn" class="col-sm-3 control-label">后台每页显示记录数量</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="records_per_page" value="{{ getSettingValueByKey('records_per_page') }}"></div>
                        </div>

                        <div class="form-group">
                            <label for="feie_sn" class="col-sm-3 control-label">前端列表每页显示数量</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="front_take" value="{{ getSettingValueByKey('front_take') }}"></div>
                        </div>

                    </form>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-left" onclick="saveForm(8)">保存</button>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="tab_9">
            <div class="box box-info form">
                <!-- form start -->
                <div class="box-body">
                    <form class="form-horizontal" id="form9">
                        <div class="form-group">
                            <label for="user_center_share_bg" class="col-sm-3 control-label">个人中心分享背景</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="image9" name="user_center_share_bg" placeholder="个人中心分享背景图片设置" value="{{ getSettingValueByKey('user_center_share_bg') }}">
                           <div class="input-append">
                                    <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn" type="button" onclick="changeImageId('image9')">选择图片</a>
                                    <img src="@if(getSettingValueByKey('user_center_share_bg')) {{ getSettingValueByKey('user_center_share_bg') }} @endif" style="max-width: 100%; max-height: 150px; display: block;">
                                </div>
                            </div>
                        </div>
                    
                    </form>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-left" onclick="saveForm(9)">保存</button>
                </div>
            </div>
        </div>

    </div>
    <!-- /.tab-content -->
</div>
</section>
@endsection

@include('admin.partials.imagemodel')

@section('scripts')
<script src="{{ asset('js/select.js') }}"> </script>
<script>
        function saveForm(index){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"/zcjy/settings/setting",
                type:"POST",
                data:$("#form"+index).serialize(),
                success: function(data) {
                  if (data.code == 0) {
                    layer.msg(data.message, {icon: 1});
                  }else{
                    layer.msg(data.message, {icon: 5});
                  }
                },
                error: function(data) {
                  //提示失败消息

                },
            });  
        }
        //纠错信息列表高度自适应
        // $("#error_info_list").height($("#error_info_list")[0].scrollHeight);
        // $("#error_info_list").on("keyup keydown", function(){
        //     console.log(this.scrollHeight);
        //     $(this).height(this.scrollHeight-10);
        // });

        $('#error_info_list,#project_money_list').keypress(function(e) {  
            var rows=parseInt($(this).attr('rows'));
            // 回车键事件  
           if(e.which == 13) {  
                rows +=1;
           }  
           $(this).attr('rows',rows);
       }); 
    </script>
@endsection