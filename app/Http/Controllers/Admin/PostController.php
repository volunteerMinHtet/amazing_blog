<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Post;
use App\Author;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();

        return view('admin.post.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'author_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'blog-image-' . date('d-m-Y') . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/blog-images/', $imageName);

            $data['image'] = $imageName;

            Post::Create($data);

            return redirect('admin/posts')->with('successMsg', 'Congratulation! You have successfully created.');
        }

        return back()->with('errorMsg', 'Opps!...Something went wrong.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrfail($id);
        $authors = Author::all();

        return view('admin.post.edit', compact('post', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'author_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = 'blog-images-' . date('m-d-Y') . '-' . time() . '.' . $image->getClientOriginalName();

            $post = Post::findOrFail($id);
            $deleteImageName = $post->image;
            File::delete('storage/blog-images/' . $deleteImageName);

            $image->storeAs('public/blog-images/', $imageName);
            $data['image'] = $imageName;

            Post::findOrfail($id)->Update($data);

            return redirect('admin/posts')->with('successMsg', 'You have successfully created.');
        }
        Post::findOrfail($id)->Update($data);

        return redirect('admin/posts')->with('successMsg', 'You have successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrfail($id);
        $deleteImageName = $post->image;

        File::delete('storage/blog-images/' . $deleteImageName);

        Post::findOrfail($id)->Delete();

        return back()->with('successMsg', 'You have successfully deleted');
    }
}
