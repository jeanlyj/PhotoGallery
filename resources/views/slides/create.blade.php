@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('slides.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        <input type="hidden" name="gallery-id" value="{{ $galleryId }}">
        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Upload New Image</h1>
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

                <div class="form-group row">
                    <label for="alt" class="col-md-4 col-form-label">Alt</label>

                    <input id="alt"
                           type="text"
                           class="form-control{{ $errors->has('alt') ? ' is-invalid' : '' }}"
                           name="alt"
                           value="{{ old('alt') }}"
                           autocomplete="alt" autofocus>
                </div>

                <div class="row">
                    <label for="slide" class="col-md-4 col-form-label">Add new Images</label>

                    <input type="file" class="form-control-file" id="slide" name="slide">
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Save Gallery</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection