@extends('layouts.admin')
@section('page-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css">
@endsection

@section('content')
        <h4>Uploads Photos</h4>
        <div class="row">
            {!! Form::open(['method'=>'POST', 'action' => 'AdminMediaController@store', 'files'=>'true', 'class'=>'dropzone']) !!}


            {!! Form::close() !!}
        </div>
@endsection

@section('page-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
@endsection