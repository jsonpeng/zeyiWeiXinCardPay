
<div class="form-group col-sm-8">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">项目详情</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <!-- Name Field -->
            <div class="form-group">
                {!! Form::label('name', '项目名称:') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
               {!! Form::hidden('user_id',null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group" style="overflow: hidden;">
            {{--  {!! Form::label('industry_id', '所属行业:') !!} --}}
                    @foreach ($industries as $category)
                    <div style="float: left; margin-right: 20px; ">
                        <label>
                            {!! Form::checkbox('industries[]', $category->id, in_array($category->id, $selectedIndustries), ['class' => 'select_cat']) !!}
                                {!! $category->name !!}
                        </label>
                    </br>
                    </div>
                    @endforeach

                    @if(count($industries)==0)
                    <a href="{!! route('industries.create') !!}">添加行业</a>
                    @endif
            </div>

            <!-- Money Field -->
            <div class="form-group">
                {!! Form::label('money', '项目金额(万元):') !!}
                {!! Form::text('money', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Type Field -->
            <div class="form-group">
                {!! Form::label('type', '供给 需求:') !!}
             {{--    {!! Form::text('type', null, ['class' => 'form-control']) !!} --}}
                   <select class="form-control"  name="type">
                    <option  value="项目" @if(!empty($project)) {!! $project->type=='项目'?'selected':'' !!} @endif>项目</option>
                    <option  value="需求" @if(!empty($project)) {!! $project->type=='需求'?'selected':'' !!} @endif>需求</option>
                   </select>
            </div>

            <!-- Detail Field -->
            <div class="form-group">
                {!! Form::label('detail', '项目信息:') !!}
                {!! Form::textarea('detail', null, ['class' => 'form-control']) !!}
            </div>

           <div class="form-group">

                      <section class="content-header" style="height: 50px; padding: 0; padding-top: 15px;">
                      <h1 class="pull-left" style="font-size: 14px; font-weight: bold; line-height: 34px;padding-bottom: 0px;">项目展示图片</h1>

                       <h3 class="pull-right" style="margin: 0">
                                <input type="hidden" name="addimage" value="" id="project_image">
                                <div class="pull-right" style="margin: 0">
                                    <a data-toggle="modal" href="javascript:;" data-target="#myModal" class="btn btn-primary" type="button" onclick="projectImage('project_image')">添加项目展示图片</a>
                                </div>
                        </h3>
                    </section>

                    <div class="images" style="display:@if(count($images)) block @else none @endif;">
                            <?php $i=0;?>
                            @foreach ($images as $image)
                            <div class="image-item" id="project_image_{{ $i }}">
                                <img src="{!! $image->
                                url !!}" alt="" style="max-width: 100%;">
                                <div class="tr">
                                    <div class="btn btn-danger btn-xs" onclick="deletePic({{ $i }})">删除</div>
                                </div>
                                 <input type='hidden' name='project_images[]' value='{!! $image->
                                url !!}'>
                            </div>
                            <?php $i++;?>
                            @endforeach
                    </div>

            </div>

            <div class="form-group group">
                <select name="province" id="province" >
                    <option value="0" @if(empty($project)) selected="selected" @endif>请选择省份</option>
                    @foreach($cities_level1 as $item)
                        <option value="{!! $item->id !!}" @if(!empty($project)) @if($project->province==$item->id) selected="selected" @endif @endif>{!! $item->name !!}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group group">
                <select  name="city" id="city">
                        <option value="0" @if(empty($project)) selected="selected" @endif>请选择城市</option>
                        @foreach ($cities_level2 as $item)
                            <option value="{!! $item->id !!}" @if(!empty($project)) @if($project->city==$item->id) selected="selected" @endif @endif>{!! $item->name !!}</option>
                        @endforeach
                </select>
            </div>

            <div class="form-group group">
                <select  name="district"  id="district"  data-type="project">
                        <option value="0" @if(empty($project)) selected="selected" @endif>请选择区域</option>
                        @foreach ($cities_level3 as $item)
                            <option value="{!! $item->id !!}" @if(!empty($project)) @if($project->district==$item->id) selected="selected" @endif @endif>{!! $item->name !!}</option>
                        @endforeach
                </select>
            </div>

            <!-- Address Field -->
            <div class="form-group">
                {!! Form::label('address', '地址:') !!}
                {!! Form::text('address', null, ['class' => 'form-control']) !!}
                 <a class="inline-block pd10" onclick="openMap(1)">在地图中设定</a>
            </div>

        </div>

    </div>
</div>

<div class="form-group col-sm-4">
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">发布设置</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
            <a href="{!! route('projects.index') !!}" class="btn btn-default">返回</a>
        </div>

    </div>

    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">状态设置</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
                 <!-- Auth Status Field -->
            <div class="form-group">
                {!! Form::label('status', '项目状态:') !!}
           {{--      {!! Form::text('status', null, ['class' => 'form-control']) !!} --}}
                  <select class="form-control"  name="status">
                    <option  value="正常" @if(!empty($project)) {!! $project->status=='正常'?'selected':'' !!} @endif>正常</option>
                    <option  value="暂停" @if(!empty($project)) {!! $project->status=='暂停'?'selected':'' !!} @endif>暂停</option>
                   </select>
            </div>

            <div class="form-group">
                {!! Form::label('auth_status', '审核状态:') !!}
               {{--  {!! Form::text('auth_status', null, ['class' => 'form-control']) !!} --}}
                   <select class="form-control"  name="auth_status">
                    <option  value="审核中" @if(!empty($project)) {!! $project->auth_status=='审核中'?'selected':'' !!} @endif>审核中</option>
                    <option  value="通过" @if(!empty($project)) {!! $project->auth_status=='通过'?'selected':'' !!} @endif>通过</option>
                    <option  value="不通过" @if(!empty($project)) {!! $project->auth_status=='不通过'?'selected':'' !!} @endif>不通过</option>
                   </select>
            </div>
        </div>

    </div>

    <div class="box box-solid">
         <div class="box-header with-border">
            <h3 class="box-title">其他设置</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <!-- Mobile Field -->
            <div class="form-group">
                {!! Form::label('mobile', '电话:') !!}
                {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Weixin Field -->
            <div class="form-group">
                {!! Form::label('weixin', '微信或QQ:') !!}
                {!! Form::text('weixin', null, ['class' => 'form-control']) !!}
            </div>

                    <!-- Auth Result Field -->
            <div class="form-group">
                {!! Form::label('auth_result', '审核评论:') !!}
                {!! Form::text('auth_result', null, ['class' => 'form-control']) !!}
            </div>

            <!-- View Field -->
            <div class="form-group">
                {!! Form::label('view', '浏览量:') !!}
                {!! Form::number('view', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Collections Field -->
            <div class="form-group">
                {!! Form::label('collections', '收藏量:') !!}
                {!! Form::number('collections', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('dianzan', '点赞数:') !!}
                {!! Form::number('dianzan', null, ['class' => 'form-control']) !!}
            </div>

                <div class="form-group">
                {!! Form::label('cai', '踩:') !!}
                {!! Form::number('cai', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
</div>
