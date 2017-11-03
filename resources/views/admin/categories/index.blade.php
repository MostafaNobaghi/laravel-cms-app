@extends('layouts.admin')
@section('content')
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
                        <th>{{$category['name']}}</th>
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