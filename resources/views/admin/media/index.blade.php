@extends('layouts.admin')

@section('content')
    @if(\Illuminate\Support\Facades\Session::has('media_delete'))
        <div class="alert alert-info"><p>{{session('media_delete')}}</p></div>
    @endif

    @if(\Illuminate\Support\Facades\Session::has('media_delete_error'))
        <div class="alert alert-danger"><p>{{session('media_delete_error')}}</p></div>
    @endif
        <h4>All Photos</h4>
        <div class="row">
            @if($photos)
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>image</th>
                        <th>create at</th>
                    </tr>
                    <tbody>
                            @foreach($photos as $photo)
                            <tr>
                                <td>{{$photo->id}}</td>
                                <td><img src="{{$photo->file}}" alt=""></td>
                                <td>{{$photo->create_at}}</td>
                                <td>
                                    {!! Form::open(['method'=>'DELETE', 'action' => ['AdminMediaController@destroy', $photo->id], 'class'=>'col-md-3 col-md-offset-4']) !!}
                                        {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </td>
                                <td>{{$photo->post['title']}}</td>
                            </tr>
                            @endforeach
                    </tbody>
                </thead>
            </table>
                @endif
        </div>
@endsection