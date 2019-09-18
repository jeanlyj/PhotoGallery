@extends('layouts.app')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">{{ $gallery->title }}</h1>
            <img src="/storage/cover_images/{{ $gallery->cover_image }}" alt="{{ $gallery->cover_image }}" class="pt-2" height="600px">
            <div class="d-flex justify-content-center pt-2">
                <a href="{{ route('slides.create',$gallery->id) }}" class="btn btn-primary my-2 mr-1">Add Image</a>   
                <a href="/galleries/{{ $gallery->id }}/edit" class="btn btn-success my-2 mr-1">Edit Gallery</a>
                <form action="{{ route('galleries.destroy', $gallery->id) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger my-2" type="submit" name="button">Delete</button>
                </form> 
                <a href="/galleries" class="btn btn-secondary my-2">Go Back</a>
            </div>
        </div>
    </section>

    @if (count($gallery->slides) > 0)
    <div class="container">
        <div class="row">
            @foreach ( $gallery->slides as $slide)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="/storage/galleries/{{ $gallery->id }}/{{ $slide->slide }}" alt="{{ $slide->slide}}" height="200px">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('slides.show', $slide->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                <form action="{{ route('slides.destroy', $slide->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit" name="button">Delete</button>
                                </form> 
                            </div>
                            <p class="mb-0">{{ $slide->title }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach   
        </div>
    </div>
    @else
    <div class="container">
        <h3>No Slides Yet</h3>
    </div>
    @endif

    <div class="container">

        <div class="card">
            <div class="card-body">
            <form action="/galleries/{{ $gallery->id }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-8 offset-2">
                        <div class="row">
                            <h1>Edit Gallery</h1>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label">Change Title</label>

                            <input id="title"
                                type="text"
                                class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                name="title"
                                value="{{ old('title') ?? $gallery->title }}"
                                autocomplete="title" autofocus>
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>  
                    <div class="row pb-3">
                        <label for="cover_image" class="col-md-4 col-form-label">Change Cover Image</label>
                        <input type="file" class="form-control-file" id="cover_image" name="cover_image">
                    </div>
                    <div class="row pb-3">
                        <button class="btn btn-primary">Save Gallery</button>
                    </div>          
                </div>
            </div>
        </form> 
    </div>
</div>   
    </div>
@endsection