@extends('admin.layout.master')

@section('title','author index')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="row mb-2">
               <div class="col-md-9"> <h4>Author List</h4></div>
               <div class="col-md-3">
                   <a href="{{route('authors.create')}}" class="btn btn-success float-right">+ Add </a>
               </div>
           </div>


           @if(Session('successMsg'))
           <div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Hey Congrats!</strong> {{Session('successMsg')}}
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
           @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        @foreach($authors as $author)
                            <tr>
                                <td>{{$author->id}}</td>
                                <td>
                                   <img src="{{ asset('storage/authors/'.$author->image) }}" alt="image1" width="100px">
                                </td>
                                <td>{{$author->name}}</td>
                                <td>{{$author->email}}</td>
                                <td>{{$author->phone}}</td>
                                <td>{{$author->address}}</td>
                                <td>{{$author->country->name}}</td>
                                <td>

                                    <form action="{{route('authors.destroy',$author->id)}}" method="POST">
                                        @csrf @method('DELETE')
                                        <a href="{{url('admin/authors/'.$author->id.'/edit')}}" class="btn btn-success btn-sm">Edit</a>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete!')">Delete</button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
</div>





















@endsection
