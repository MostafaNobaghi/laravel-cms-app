@extends('layouts/admin')
@section('content')
    @if(\Illuminate\Support\Facades\Session::has('user_created'))
        <div class="alert alert-success"><p>{{session('user_created')}}</p></div>
    @endif


    @if(\Illuminate\Support\Facades\Session::has('user_updated'))
        <div class="alert alert-info"><p>{{session('user_updated')}}</p></div>
    @endif


    @if(\Illuminate\Support\Facades\Session::has('user_deleted'))
        <div class="alert alert-danger"><p>{{session('user_deleted')}}</p></div>
    @endif
<h2>Users</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Creat at</th>
            <th>Update at</th>
        </tr>
        <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><img style="height: 50px" src="{{$user->photo_id>0 ? $user->photo['file'] :'/images/placeholder.svg'}}" alt="no image"></td>
                    <td>
                        {{$user->name}}
                        <div class="btn-default">


                            {!! Form::open(['method'=>'DELETE','url' => "admin/users/$user->id" , 'class'=>'', 'id'=>"delete-$user->id" ]) !!}
                            <a href="{{route('admin.users.edit',$user->id)}}" class="">edit</a>
                            {{--{!! Form::submit('delete',['class'=>'btn btn-default text-danger']) !!}--}}
                            {!! Form::label('delete','Delete', ['class'=>'delete-links text-danger']) !!}
                            {!! Form::input('submit','delete','Delete',['class'=>'hidden']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role['name']}}</td>
                    <td>{{$user->is_active? 'Active': 'disable'}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </thead>
</table>
    @endsection

@section('footer')
    <script>
        $()
    </script>
    @endsection
