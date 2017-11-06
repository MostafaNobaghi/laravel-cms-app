@extends('layouts.admin')
@section('content')

    <div class="modal fade" tabindex="-1" role="dialog" id="myModal" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">

                    {!! Form::open(['action' => 'AdminCategoriesController@store', 'class'=>'']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', '', ['class'=>'form-control', 'placeholder'=>'Category title']) !!}
                    </div>
                    {!! Form::submit('create',['class'=>'btn btn-success col-sm-12']) !!}
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    @include('includes.errors')
    <div class="col-md-5 col-sm-12">
        <h3>Create category</h3>
        {!! Form::open(['action' => 'AdminCategoriesController@store', 'class'=>'']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', '', ['class'=>'form-control', 'placeholder'=>'Category title']) !!}
            </div>
            {!! Form::submit('create',['class'=>'btn btn-success col-sm-12']) !!}
        {!! Form::close() !!}
    </div>
    <div class="col-md-7 col-sm-12">
        <h3>All categories:</h3>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>#posts</th>
                <th>created at</th>
                <th>updated at</th>
            </tr>
            </thead>
            <tbody>
            @if($categories)
                @foreach($categories as $category)
                    {{--{{dd($category)}}--}}
                    <tr>
                        <th>{{$category['id']}}</th>
                        <th><a href=""  data-toggle="modal" data-target="#myModal">{{$category['name']}}</a></th>
                        <th>{{$category['postsCount']}}</th>
                        <th>{{$category['created_at']}}</th>
                        <th>{{$category['updated_at']}}</th>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection

@section('page-script')
    <script>

    </script>
@endsection