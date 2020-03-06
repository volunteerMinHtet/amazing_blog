@extends('admin.layout.master')

@section('title','Country')

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
                        <h4>Country List</h4>
                    </div>
                    <div class="col-md-3 pb-2 text-right">
                        <a href="{{ url('admin/countries/create') }}" class="btn btn-primary btn-sm">+ New Country</a>
                    </div>
                </div>

                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Country</th>
                        <th scope="col">Image</th>
                        <th scope="col">Option</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if ($countries)
                        @foreach ($countries as $country)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $country->name }}</td>
                            <td>
                                <img src="{{ asset('storage/flags/' . $country->image) }}" alt="flag" width="40px" height="40px" class="rounded-circle border border-light">
                            </td>
                            <td>
                                <form action="{{ url('admin/countries/' . $country->id) }}" method="POST">
                                    @csrf
                                    @method('Delete')
                                    <a href="{{ url('admin/countries/' . $country->id . '/edit') }}" class="btn btn-warning btn-sm text-light">Edit</a>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

@endsection
