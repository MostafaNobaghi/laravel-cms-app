@extends('layouts/admin')
@section('content')

    <h2>Posts</h2>

    {{--{{dd($rolesArray)}}--}}

    @include('includes.errors')

    <div class="col-md-5">
        as
    </div>

    {!! Form::model($post, ['method'=>'PATCH', 'action' => ['AdminPostsController@update', $post->id],'files'=>true, 'class'=>'col-md-6 col-md-offset-1']) !!}
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
        {!! Form::submit('Update',['class'=>'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}
@endsection