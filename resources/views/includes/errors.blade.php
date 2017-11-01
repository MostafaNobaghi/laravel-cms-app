@if(count($errors)>0)
    <div class="alert alert-danger col-md-6 col-md-offset-2">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    <div class="clearfix"></div>
@endif