@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-between pb-3">
                        <h3>Welcome <strong>{{ Auth::user()->login }} </strong> to PhotoGallery! </h3>
                        <a href="/galleries/create" class="btn btn-primary">Create Gallery</a>
                    </div>
                    @if(count($galleries) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($galleries as $gallery)
                                <tr class="pt-0 pb-0">
                                    <td><a href="{{ route('galleries.show', $gallery->id) }}" class="mt-1"> {{$gallery->title}} </a></td>
                                    <td><a href="/galleries/{{$gallery->id}}/edit" class="btn btn-default">Edit</a></td>
                                    <td><a href="{{ route('slides.create',$gallery->id) }}" class="btn btn-default">Add Images</a></td>
                                    <td>
                                    <form action="{{ route('galleries.destroy', $gallery->id) }}" method="post">
                                       @csrf
                                       @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit" name="button">Delete</button>
                                     </form> 
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have no galleries</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
