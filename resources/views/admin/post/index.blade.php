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
                    <div class="col-md-9">
                        <h4>Post Lists</h4>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="{{ url('admin/posts/create') }}" class="btn btn-primary btn-sm">+ New Post</a>
                    </div>
                </div>

                <div class="row">

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Author</th>
                                <th scope="col">Image</th>
                                <th scope="col">Operation</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($posts as $post)

                            {{-- <div class="col-md-12 mx-auto">
                                <div class="card mb-3" style="width: 300px;">
                                    <img src="{{ asset('storage/blog-images/' . $post->image) }} " class="card-img-top" alt="image">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">{{ $post->content }}</p>
                                    <a href="#" class="btn btn-primary btn-sm">Go somewhere</a>
                                    </div>
                                </div>
                            </div> --}}

                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <textarea rows="3" cols="50" disabled>
                                    {{ $post->content }}
                                    </textarea>
                                </td>
                                <td>{{ $post->author->name }}</td>
                                <td>
                                    <img src="{{ asset('/storage/blog-images/' . $post->image) }}" style="width:85px; height:85px;">
                                </td>
                                <td>

                                    <form action="{{ url('admin/posts/' . $post->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ url('/admin/posts/'. $post->id .'/edit') }}" class="btn btn-warning text-light btn-sm">Edit</a>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                  </table>

            </div>
        </div>
    </div>

@endsection
