@extends('layout/master')

@section('title', 'Blog')
@section('content')

<div class="card">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is another card with title and supporting text below. This card has some additional content to make it slightly taller overall.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>

<div class="container">
    <div class="row">
        <p>
            <span style="font-size:30px;" class="pb-0">Post</span>
            @if( isset($posts) )
                @if( count($posts) > 0 )
                <a href="{{ url('blog/index') }}" class="d-inline text-decoration-none text-secondary">&nbsp;&nbsp;All</a>
                @elseif( count($posts) == 0)
                <a href="{{ url('blog/index') }}" class="d-inline text-decoration-none text-secondary">
                    &nbsp;&nbsp;Sorry ! , There is nothing to show.
                </a>
                @endif
            @endif
        </p>
        @if (isset ($country))
            <a href="" class="d-inline text-decoration-none text-secondary">&nbsp;&nbsp;<i class="fas fa-caret-right"></i>&nbsp;{{ strtolower($country->name) }}</a>
        @endif

        @foreach ($posts as $post)
            <div class="col-md-6 mt-2 mb-5">
                <div class="row">
                    <div class="col-md-2">
                        <img class="rounded-circle" width="50px" height="50px" src="{{ asset('storage/authors/' . $post->author->image) }}" alt="Author Profile">
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                {{ $post->author->name }}
                            </div>
                            <div class="col-md-12">
                                Posted on {{ $post->created_at->format('Y-m-d') }} at {{ $post->created_at->format('H:i:s') }}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card" style="width: 300px;">
                    <img src="{{ asset('storage/blog-images/' . $post->image) }}" class="card-img-top" alt="Blog Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}
    </div>

</div>

@endsection

@section('sideBar')
    <div class="nav flex-column nav-pills jumbotron" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <form>
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        </form>

        <h4>Country Category</h4>
        @if ($countries)
            @foreach ($countries as $country)
                <a class="nav-link" id="v-pills-profile-tab" href="{{ url('blog/searchByCountry/' . $country->id) }}" role="tab">{{ $country->name }}</a>
            @endforeach
        @endif
    </div>
@endsection

