
@extends('layouts.blog')

@section('content')
    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo_id>0?$post->photo->file:'http://placehold.it/900x300'}}" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">{{$post->shortBody()}}</p>
    <p>{{$post->body}}</p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->

    <div class="well">
        <h4>Leave a Comment:</h4>
        <?php
        if ($user = Auth::user()){
            $commentFormClass = '';
            $loginFormClass = 'hidden';
        }else{
            $commentFormClass = 'hidden';
            $loginFormClass = '';
        }
        ?>

        {!! Form::open(['action' => 'CommentsController@store', 'class'=>' '.$commentFormClass, 'id'=>'comment-form']) !!}
            <div class="form-group">
            {!! Form::textarea('body', '', ['class'=>'form-control', 'placeholder'=>'Leave your Comment here...:', 'rows'=>4, 'required'=>'required']) !!}
            </div>
            {!! Form::hidden('post_id', $post->id) !!}
            {!! Form::submit('submit',['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}

        <!-------------------------------------------------------------------------------------------------->
        <!----------------------------------- Login form if user not logged in ----------------------------->
        <!-------------------------------------------------------------------------------------------------->
            <div class="alert alert-default">
                <form id="login-form" class="form-horizontal {{$loginFormClass}}" role="form" method="POST" action="{{ url('/login') }}">
                    <h5 class="">Please sign in : </h5>
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" >

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" >

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-5 ">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-sign-in"></i> Login
                            </button>

                            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                        </div>

                        <div class="col-md-5">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                    </div>
                </form>
            </div>
        <!-----------------------------------end login form------------------------------------------------->
    </div>

    <hr>

    <!-- Posted Comments -->

    @foreach($comments as $comment)

    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object comment-author-img" src="{{$comment->photo}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
            {{$comment->body}}
            @if(count($comment->replies)>0)
                @foreach($comment->replies as $reply)
                    <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object comment-author-img" src="{{$reply->photo}}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$reply->author}}
                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                </h4>
                                {{$reply->body}}
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    @endforeach
                @endif
        </div>
    </div>
    <div class="row" style="display: none">
        {!! Form::open(['action' => 'CommentRepliesController@createReply', 'class'=>'reply-form '.$commentFormClass, 'id'=>'reply-form']) !!}
        <div class="form-group">
            {!! Form::label('body', 'Reply') !!}
            {!! Form::textarea('body', '', ['class'=>'form-control', 'placeholder'=>'Leave your reply here...:', 'rows'=>2, 'required'=>'required']) !!}
        </div>
        {!! Form::hidden('comment_id', $comment->id) !!}
        {!! Form::submit('submit',['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
    <div class="row {{$commentFormClass}}">
        <a href="#" class="reply-toggle">reply <i class="fa fa-comment-o"></i></a>
    </div>


    <!-- Comment -->
    @endforeach
@endsection

@section('page-scripts')
    <script>
        $(document).ready(function(){
            $('#login-form').submit(function (event) {
                event.preventDefault();
                var form = $(this);
                var data = form.serializeArray();

                console.log(data);

                $.ajax({
                    method: 'POST',
                    url: '/ajaxlogin',
                    data: data,
                    beforeSend: function(){
                        form.slideUp(300);
                    }
                }).done(function (response) {
                    if(response.status == 'success'){
                        location.reload();
                        $('#comment-form').removeClass('hidden');
                        $('#comment-form').show(300);
                    }else{
                        form.fadeIn(300);
                        alert(response.message);
                    }
                    console.log(response);
                }).error(function (response) {
//                    window.location.replace("http://laravel.cms/blog/post/3");
//                    location.reload();
//                    console.log(response);
                    alert(response.message);
                });
            });

            $(document).on('click', '.reply-toggle', function (e) {
                e.preventDefault();
                $(this).parent('.row').prev('.row').slideToggle(300);
            });
        });
    </script>
@endsection
