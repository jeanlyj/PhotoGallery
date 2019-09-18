@extends('layouts.app')

@section('content')
<div class="container">
    @if (count($galleries) > 0)
    <div class="row">
        @foreach ( $galleries as $gallery)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
            <img src="/storage/cover_images/{{ $gallery->cover_image }}" alt="{{ $gallery->cover_image }}" height="200px">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{ route('galleries.show', $gallery->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                        </div>
                        <p class="mb-0">{{ $gallery->title }}</p>
                    </div>
                </div>
            </div>
           
        </div>
        @endforeach   
    </div>
    @else
    <div class="container">
        <h3>No Gallery Yet</h3>
    </div>
    @endif

    <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $galleries->links() }}
            </div>
        </div>
</div>
@endsection