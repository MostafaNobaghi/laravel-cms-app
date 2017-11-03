@extends('layouts/admin')
@section('content')

    <h2>Posts</h2>

    {{--{{dd($rolesArray)}}--}}

    @include('includes.errors')

    <div class="col-xs-12 col-md-4 col-md-offset-1">
        <h4>Image</h4>
        <a href="#" class="thumbnail">
            <img src="{{$post->photo?$post->photo->file:'/images/placeholder.svg'}}" alt="...">
        </a>
    </div>
    <div class="container col-xs-12  col-md-6">
        {!! Form::model($post, ['method'=>'PATCH', 'action' => ['AdminPostsController@update', $post->id],'files'=>true, 'class'=>'']) !!}
        {!! Form::hidden('user_id', Auth::user()->id) !!}
        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Post title']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'Text:') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control', 'placeholder'=>'body']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('category_id',[''=>'Choose a category'] + $categories, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Image:', ['class'=>'']) !!}
            {!! Form::file('photo_id', ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Update',['class'=>'btn btn-success col-sm-6 col-xs-12']) !!}
        </div>
        {!! Form::close() !!}

        {!! Form::open(['method'=>'DELETE', 'action' => ['AdminPostsController@destroy', $post->id], 'class'=>'']) !!}
            {!! Form::submit('Delete',['class'=>'btn btn-danger col-sm-6 col-xs-12']) !!}
        {!! Form::close() !!}
    </div>


@endsection