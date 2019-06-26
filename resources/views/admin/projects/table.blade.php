<table class="table table-responsive" id="projects-table">
    <thead>
        <tr>
        <th>项目名称</th>
        <th>电话</th>
        <th>微信或QQ</th>
        <th>项目金额(万元)</th>
        <th>供给需求</th>
        <th>省</th>
        <th>市</th>
        <th>区</th>
        <th>地址</th>
  {{--       <th>项目信息</th> --}}
        <th>项目状态</th>
        <th>审核状态</th>
       {{--  <th>审核评论</th> --}}
        <th>浏览量</th>
        <th>收藏量</th>
        <th>行业</th>
        <th>发布人</th>
        <th>发布人会员等级</th>
        <th>点赞数</th>
        <th>踩</th>
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($projects as $project)
        <tr>
            <td>{!! $project->name !!}</td>
            <td>{!! $project->mobile !!}</td>
            <td>{!! $project->weixin !!}</td>
            <td>{!! $project->money !!}万元</td>
            <td>{!! $project->type !!}</td>
            <td>{!! getCitiesNameById($project->province) !!}</td>
            <td>{!! getCitiesNameById($project->city) !!}</td>
            <td>{!! getCitiesNameById($project->district) !!}</td>
            <td>{!! $project->address !!}</td>
         {{--    <td>{!! $project->detail !!}</td> --}}
            <td><span class="btn btn-{!! $project->status=='正常'?'success':'danger' !!} btn-xs">{!! $project->status !!}</span></td>
            <td><span class="btn btn-{!! $project->auth_status=='审核中' || $project->auth_status=='不通过' ?'danger':'success' !!} btn-xs">{!! $project->auth_status !!}</span></td>
  {{--           <td>{!! $project->auth_result !!}</td> --}}
            <td>{!! $project->view !!}</td>
            <td>{!! $project->collections !!}</td>
            <td>{!! $project->industriesShow !!}</td>
            <td>{!! $project->ReleaseUser !!}</td>
            <td>{!! $project->ReleaseUserLevel !!}</td>
            <td>{!! $project->dianzan !!}</td>
            <td>{!! $project->cai !!}</td>
            <td>
                {!! Form::open(['route' => ['projects.destroy', $project->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                   {{--  <a href="{!! route('projects.show', [$project->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> --}}
                    <a href="{!! route('projects.edit', [$project->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定删除吗?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>