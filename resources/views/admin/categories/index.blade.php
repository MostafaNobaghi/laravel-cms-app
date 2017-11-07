
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

                    {!! Form::open(['method'=>'PATCH', 'action' => ['AdminCategoriesController@update', ''], 'class'=>'', 'id'=>'edit-form']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', '', ['class'=>'form-control', 'placeholder'=>'Category title']) !!}
                    </div>
                    {!! Form::submit('Edit',['class'=>'btn btn-info col-sm-6']) !!}
                    {!! Form::close() !!}
                    {!! Form::open(['method'=>'DELETE', 'action' => ['AdminCategoriesController@destroy', ''], 'class'=>'', 'id'=>'delete-form']) !!}
                    {!! Form::submit('Delete',['class'=>'btn btn-danger col-sm-6']) !!}
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    @include('includes.errors')
    @if(\Illuminate\Support\Facades\Session::has('category_update'))
        <div class="alert alert-info"><p>{{session('category_update')}}</p></div>
    @endif

    @if(\Illuminate\Support\Facades\Session::has('category_create'))
        <div class="alert alert-success"><p>{{session('category_create')}}</p></div>
    @endif

    @if(\Illuminate\Support\Facades\Session::has('category_delete'))
        <div class="alert alert-info"><p>{{session('category_delete')}}</p></div>
    @endif
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
                        <td>{{$category['id']}}</td>
                        <td><a class="category-link" href=""  data-toggle="modal" data-target="#myModal" cat-id="{{$category['id']}}">{{$category['name']}}</a></td>
                        <td>{{$category['postsCount']}}</td>
                        <td>{{$category['created_at']}}</td>
                        <td>{{$category['updated_at']}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection

@section('page-script')
    <script>
        var update_url = $('#edit-form').attr('action');
        $('.category-link').click(function () {
            var cat_id = $(this).attr('cat-id');
            var text_value = $(this).html();

            $('#edit-form').attr('action', update_url+'/'+cat_id);
            $('#delete-form').attr('action', update_url+'/'+cat_id);

            $('#edit-form input:text').val(text_value);
        });
    </script>
@endsection