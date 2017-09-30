@extends('layouts/admin')
@section('content')

<h2>Users</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
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
                    <td>{{$user->name}}</td>
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
