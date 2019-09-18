@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <h3>{{ $slide->title }}</h3>
            <a href="{{ route('galleries.show', $slide->gallery->id) }}" class="btn btn-info">Go Back</a>
        </div>     
        <hr>
        <img src="/storage/galleries/{{ $slide->gallery_id }}/{{ $slide->slide }}" alt="{{ $slide->slide }}" width="100%">
        <hr>
    </div>
@endsection