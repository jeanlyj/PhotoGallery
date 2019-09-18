@extends('layouts.app')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">{{ $gallery->title }}</h1>
            <img src="/storage/cover_images/{{ $gallery->cover_image }}" alt="{{ $gallery->cover_image }}" class="pt-2" height="600px">
            <div class="pt-2">
                @can('create', $gallery)
                <a href="{{ route('slides.create',$gallery->id) }}" class="btn btn-primary my-2">Add Image</a>   
                @elsecan('update', $gallery)
                <a href="/galleries/{{ $gallery->id }}/edit" class="btn btn-success my-2">Edit Gallery</a>
                @elsecan('destroy', $gallery)
                <a href="{{ route('galleries.destroy',$gallery->id) }}" class="btn btn-danger my-2">Delete Gallery</a>
                @endcan
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
                                @can('destroy', $gallery)
                                <form action="{{ route('slides.destroy', $slide->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit" name="button">Delete</button>
                                </form> 
                                @endcan
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

@endsection