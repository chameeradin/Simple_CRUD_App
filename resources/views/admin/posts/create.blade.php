@extends('admin.layouts.dashboard')

@section('admin_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="justify-content-center">{{__('Create Post')}}</h2>
            @if (session('status'))
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    </div>
                </div>
            @endif
            <div class="card my-4">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('status')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{route('posts.store')}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group mb-4">
                                <label for="title" class="col-form-label col-form-label-sm">Title</label>
                                <input type="text" value="{{old('title')}}" name="title" class="form-control form-control-sm  @error('title') is-invalid @enderror" id="title" placeholder="Title">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="description" class="col-form-label col-form-label-sm">Description</label>
                                <textarea name="description" class="form-control form-control-sm @error('description') is-invalid @enderror" aria-label="description">{{old('description')}}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="image" class="col-form-label col-form-label-sm">Image</label><br>
                                <input type="file" name="image" value="{{old('image')}}" id="image" class="form-control-file form-control-sm @error('image') is-invalid @enderror" width="300px">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
