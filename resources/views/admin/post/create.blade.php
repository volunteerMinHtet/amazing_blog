@extends('admin.layout.master')

@section('title', 'Blog - Admin')
@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                @if (session('errorMsg'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Error</strong> {{ session('errorMsg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif (session('successMsg'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Success</strong> {{ session('successMsg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <h4>Create Post</h4>
                    </div>
                </div>
                <form action="{{ url('admin/posts') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="author_id">Author</label>
                        <select id="author_id" class="form-control" type="text" name="author_id">
                            @foreach ($authors as $author)
                            <option class="" value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" class="form-control @error('title') is-invalid @enderror" type="text" name="title">
                        @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" type="text" name="content" rows="5"></textarea>
                        @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label><br>
                        <input id="image" type="file" name="image">
                    </div>

                    <button class="btn btn-primary btn-sm">Create</button>
                </form>
            </div>
        </div>
    </div>

@endsection
