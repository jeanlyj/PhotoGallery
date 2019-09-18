@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('galleries.store') }}" enctype="multipart/form-data" method="post">
        @csrf

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Create New Gallery</h1>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">Title</label>

                    <input id="title"
                           type="text"
                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                           name="title"
                           value="{{ old('title') }}"
                           autocomplete="title" autofocus>
                </div>

                <div class="row">
                    <label for="cover_image" class="col-md-4 col-form-label">Add Cover Image</label>

                    <input type="file" class="form-control-file" id="cover_image" name="cover_image">
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Save Gallery</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection