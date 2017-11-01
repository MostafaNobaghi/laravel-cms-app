@extends('layouts/admin')
@section('content')
    @if(\Illuminate\Support\Facades\Session::has('post_created'))
        <div class="alert alert-success"><p>{{session('post_created')}}</p></div>
    @endif


    @if(\Illuminate\Support\Facades\Session::has('post_updated'))
        <div class="alert alert-info"><p>{{session('post_updated')}}</p></div>
    @endif


    @if(\Illuminate\Support\Facades\Session::has('post_deleted'))
        <div class="alert alert-danger"><p>{{session('post_deleted')}}</p></div>
    @endif
    <h2>Posts</h2>
    <table class="table table-responsive">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Title</th>
            <th>Description</th>
            <th>Author</th>
            <th>Category</th>
            <th>Create at</th>
            <th>Update at</th>
        </tr>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td><img style="height: 50px" src="{{$post->photo_id>0 ? $post->photo['file'] :'/images/post-placeholder.jpg'}}" alt="no image"></td>
                    <td>
                        {{$post->title}}

                    </td>
                    <td>
                        {{$post->shortBody()}}
                        <div class="">
                            {!! Form::open(['method'=>'DELETE','url' => "admin/posts/$post->id" , 'class'=>'S', 'id'=>"delete-$post->id" ]) !!}
                            <a href="/post/{{$post->id}}" class="text-success">Show</a>
                            <a href="{{route('admin.posts.edit',$post->id)}}" class="">edit</a>
                            {{--{!! Form::submit('delete',['class'=>'btn btn-default text-danger']) !!}--}}
                            {!! Form::label('delete'.$post->id,'Delete', ['class'=>'btn delete-links text-danger']) !!}
                            {!! Form::input('submit','delete'.$post->id,'Delete',['class'=>'hidden']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                    <td>{{$post->user['name']}}</td>
                    <td>{{$post->category ? $post->category['name'] : 'Uncategorized'}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
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
