@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left"><strong>{!! $customPostType->name !!}</strong>字段列表</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('customPostTypeItems.create',[$customPostType->id ]) !!}">添加一个新的字段</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('admin.common.custom_post_type_items.table')
            </div>
        </div>
    </div>
@endsection

