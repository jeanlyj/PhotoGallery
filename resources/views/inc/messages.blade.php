@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger col-8 offset-2">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success col-8 offset-2">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger col-8 offset-2">
        {{session('error')}}
    </div>
@endif