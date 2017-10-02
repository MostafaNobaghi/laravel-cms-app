@if(count($errors)>0)
    <div class="alert alert-danger col-md-3 col-md-offset-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    <div class="clearfix"></div>
@endif