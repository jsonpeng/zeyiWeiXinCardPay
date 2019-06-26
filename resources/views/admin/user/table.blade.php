<table class="table table-responsive" id="users-table">
    <thead>
        <tr>
        <th>头像</th>
        <th>姓名</th>
        <th>微信昵称</th>
        <th>手机号</th>
        <th>会员等级</th>
        <th>提成金额</th>
        <th>注册时间</th>
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td><img src="{!! $user->head_image !!}"  style="max-width: 100%;height: 80px;"/></td>
            <td>{!! $user->name !!}</td>
            <td>{!! $user->nickname !!}</td>
            <td>{!! $user->mobile !!}</td>
            <td>{!! optional($user->userlevel)->name !!}</td>
        {{--     <td>{!! $user->openid !!}</td> --}}
            <td>{!! $user->distribut_money !!}</td>
            <td>{!! $user->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                  {{--   {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定要删除吗?')"]) !!} --}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>