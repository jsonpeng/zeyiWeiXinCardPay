<table class="table table-responsive" id="companyErrors-table">
    <thead>
        <tr>
        <th>纠错原因</th>
        <th>企业</th>
        <th colspan="3">操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($companyErrors as $companyError)
        @if(!empty($companyError->company))
        <tr>
            <td>{!! $companyError->reason !!}</td>
            <td><a href="{!! route('caompanies.edit', [$companyError->company->id]) !!}" target="_blank">{!! $companyError->company->name !!}</a></td>
            <td>
                {!! Form::open(['route' => ['companyErrors.destroy', $companyError->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                  {{--   <a href="{!! route('companyErrors.show', [$companyError->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('companyErrors.edit', [$companyError->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> --}}
                      
                        <a class='btn-group'>
                         <span class="btn btn-{!! !$companyError->status?'danger':'success' !!} btn-xs" onclick="actionList(this,{!! $companyError->id !!})">{!! !$companyError->status?'未读':'已读' !!}</span>
                        </a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('确定要删除吗?')"]) !!}
                      </div>
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>