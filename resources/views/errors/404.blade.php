@extends('layouts.app')
@section('title') Page not found @endsection





    @section('style')
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .container {
            text-align: center;
            {{--display: table-cell;--}}
            vertical-align: middle;
        }

        .content {
            text-align: center;
            {{--display: inline-block;--}}
        }

        .title {
        padding-top: 15%;
        {{--padding-bottom: auto;--}}
            {{--vertical-align: middle;--}}
            font-weight: 100;
            font-family: 'Lato';
            color: #B0BEC5;
            font-size: 72px;
            margin-bottom: 40px;
        }
    @endsection
@section('content')
<div class="container">
    <div class="content">
        <div class="title">Page not found 404</div>
    </div>
</div>
@endsection
