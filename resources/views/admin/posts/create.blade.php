@extends('layouts/admin')
@section('content')

    <h2>Posts</h2>

    {{--{{dd($rolesArray)}}--}}

    @include('includes.errors')

    {!! Form::open(['action' => 'AdminPostsController@store','files'=>true, 'class'=>'col-md-6 col-md-offset-2']) !!}
    {!! Form::hidden('user_id', Auth::user()->id) !!}
    <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Post title']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('body', 'Text:') !!}
        {!! Form::textarea('body', '', ['class'=>'form-control', 'placeholder'=>'body']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('category_id', 'Category:') !!}
        {!! Form::select('category_id', [''=>'Choose category']+$categories, '', ['class'=>'form-control']) !!}
    </div>
    {{--<div class="form-group">--}}
        {{--{!! Form::label('is_active', 'Set active:') !!}--}}
        {{--{!! Form::select('is_active', [0=>'Not active', 1=>'Active'],0, ['class'=>'form-control']) !!}--}}
    {{--</div>--}}
    <div class="form-group">
        {!! Form::label('photo_id', 'Image:', ['class'=>'']) !!}
        {!! Form::file('photo_id', ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('create',['class'=>'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}
@endsection