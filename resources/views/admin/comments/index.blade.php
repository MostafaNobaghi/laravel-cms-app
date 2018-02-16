@extends('layouts.admin')
@section('content')
    <h4>Comments:</h4>
    @if(count($comments) > 0)
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Comment</th>
                    <th>Actions</th>
                    <th>Post</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    @if($comment->is_active == 1)
                        <?php
                        $ApproveBtnClass = 'btn-warning';
                        $approveBtnText = 'Disapprove';
                        $approveFormValue = 0;
                        ?>
                    @else
                        <?php
                        $ApproveBtnClass = 'btn-info';
                        $approveBtnText = 'Approve';
                        $approveFormValue = 1;
                        ?>
                    @endif
                    <h1>{{$ApproveBtnClass}}</h1>
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->shortBody()}}</td>
                    <td>
                        {!! Form::open(['method'=>'post', 'url' => route('comment.approve', $comment->id ), 'class'=>'']) !!}
                            <input type="hidden" name="is_active" value="{{$approveFormValue}}">
                            {!! Form::submit($approveBtnText,['class'=>"col-md-6 btn btn-sm $ApproveBtnClass"]) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['method'=>'DELETE', 'action' => ['CommentsController@destroy', $comment->id], 'class'=>'']) !!}
                            {!! Form::submit('delete',['class'=>'btn btn-sm btn-danger col-md-6']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td><a href="{{route('blog.post', $comment->post['id'])}}">Post Link</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection