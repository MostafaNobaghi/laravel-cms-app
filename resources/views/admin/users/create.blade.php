@extends('layouts/admin')
@section('content')

    <h2>Users</h2>

{{--{{dd($rolesArray)}}--}}
    @if(count($errors)>0)
        <div class="alert alert-danger col-md-3 col-md-offset-4">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    {!! Form::open(['action' => 'AdminUsersController@store','files'=>true, 'class'=>'col-md-3 col-md-offset-4']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', '', ['class'=>'form-control', 'placeholder'=>'john smith']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', '', ['class'=>'form-control', 'placeholder'=>'example@xmail.com']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id', 'Role:') !!}
        {!! Form::select('role_id', $roles, 3, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_active', 'Set active:') !!}
        {!! Form::select('is_active', [0=>'Not active', 1=>'Active'],0, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('photo_id', 'Image:', ['class'=>'']) !!}
        {!! Form::file('photo_id', ['class'=>'']) !!}
    </div>
    <div class="form-group">
    {!! Form::submit('create',['class'=>'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}
    @endsection