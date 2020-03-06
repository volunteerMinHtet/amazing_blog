@extends('admin.layout.master')

@section('title','author index')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Upate Author</h4>
                @if(Session('successMsg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Hey Congrats!</strong> {{Session('successMsg')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                <form action="{{route('authors.update',$author->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" placeholder="Enter author name" value="{{old('name') ?? $author->name}}">
                        @error('name')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror" placeholder="Enter author email" value="{{$author->email}}">
                        @error('email')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" name="phone" id="" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter author phone" value="{{$author->phone}}">
                        @error('phone')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Enter author address">{{$author->address}}</textarea>
                        @error('address')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Country</label>
                       <select name="country_id" id="" class="form-control @error('country_id') is-invalid @enderror">
                            <option value="">  --- select country ---</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}"
                                    {{$country->id == $author->country_id ? 'selected' : ''}}
                                    >{{$country->name}}</option>
                            @endforeach
                       </select>
                       @error('country_id')
                       <span class="invalid-feedback">{{$message}}</span>
                       @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Image</label> <br>
                        <input type="file" name="image" id="" class="@error('image') is-invalid @enderror">
                        @error('image')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
