<!-- Name Field -->

<div class="form-group col-sm-12">
    {!! Form::label('name', '姓名:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('nickname', '昵称:') !!}
    {!! Form::text('nickname', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-12">
    {!! Form::label('mobile', '手机号:') !!}
    {!! Form::number('mobile', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-12">
    {!! Form::label('user_level', '会员等级:') !!}
    <select class="form-control" name="user_level"> 
    	@foreach ($user_levels as $item)
    		<option value="{!! $item->id !!}" @if($item->id==$users->user_level) selected="selected" @endif>{!! $item->name !!}</option>
    	@endforeach
    </select>
</div>


<div class="form-group col-sm-12">
    {!! Form::label('distribut_money', '提成金额:') !!}
    {!! Form::number('distribut_money', null, ['class' => 'form-control']) !!}
</div>




<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('保存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">返回</a>
</div>





