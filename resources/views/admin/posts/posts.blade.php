@extends('admin.layouts.dashboard')

@section('admin_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="justify-content-center">{{__('Posts')}}</h2>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="card-header-title">
                        <h4 class="justify-content-center">{{__('Posts List')}}</h4>
                    </div>
                    <div class="card-header-actions">
                        <a class="btn btn-success" href="{{route('posts.create')}}">Create Post</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col-2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post )
                        <tr>
                            <th scope="row">{{$post->id}}</th>
                            <td>{{$post->title}}</td>
                            <td>{{$post->description}}</td>
                            <td><img class="img-thumbnail" src="/storage/{{$post->image}}"  width="100px"></td>
                            <td>
                                <form action="{{ route('posts.destroy', $post) }}" method="post">
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-primary">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
