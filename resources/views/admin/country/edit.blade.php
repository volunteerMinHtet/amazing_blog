@extends('admin.layout.master')

@section('title', 'Country - Edit')
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
                        <h4>Create Country</h4>
                    </div>
                </div>

                <form action="{{ url('admin/countries/' . $country->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">name</label>
                        <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $country->name }}">
                    </div>

                    <div class="form-group">
                        <label for="image">Flag</label><br>
                        <input type="file" name="image" id="" class="">
                    </div>
                    <button class="btn btn-success">Create</button>
                </form>
            </div>
        </div>

    </div>

@endsection
