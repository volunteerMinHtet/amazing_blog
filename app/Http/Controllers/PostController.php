<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Country;

class PostController extends Controller
{
    public function index () {
        $posts = Post::paginate(10);
        $countries = Country::all();

        return view('blog.index', compact('posts', 'countries'));
    }

    public function searchByCountry ($id) {
        $postsByCountry = Country::findOrfail($id);
        $countries = Country::all();
        $country = Country::findOrfail($id);

        $posts = $postsByCountry->posts()->paginate(10);

        return view('blog.index', compact('posts', 'countries', 'country'));
    }
}
