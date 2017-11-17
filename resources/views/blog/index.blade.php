@extends('layouts.blog')

@section('content')
    @if($posts)
        @foreach($posts as $post)

            <!-- First Blog Post -->
            <div class="col-md-4 col-sm-6">


                <div class="row posts-container">
                    <div class="">
                        <div class="">
                            <a href="#" class="thumbnail">
                                <img class="img-responsive img-post-thumbnail " src="{{$post->photo_id >0?$post->photo['file']:"http://placehold.it/900x300"}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h3>
                            <a href="{{route('blog.post', ['id'=>$post->id])}}">{{$post['title']}}</a>
                        </h3>

                        <p class="lead">
                            by <a href="index.php">{{$post->user['name']}}</a>
                        </p>
                        <p><span class="glyphicon glyphicon-time text-success"></span> Posted on {{$post->created_at}}</p>
                        <p>
                            {{$post->shortBody()}}
                        </p>
                        <a class="btn btn-primary" href="{{route('blog.post', ['id'=>$post->id])}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                    </div>
                </div>
            </div>


        @endforeach
    @endif
@endsection