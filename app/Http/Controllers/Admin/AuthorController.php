<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;
use File;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::paginate(10);
        return view('admin.author.index',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.author.create')->with('countries',$countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datas = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'country_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
       if($request->hasFile('image')){
          $image = $request->image;
          $imageName = uniqid()."_".$image->getClientOriginalName();

          $image->storeAs('public/authors',$imageName);
        $datas['image'] = $imageName;
          Author::create($datas);
          return redirect('admin/authors')->with('successMsg','You have successfully create an author!');
       }
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
        $countries = Country::all();
        $author = Author::findOrFail($id);
        return view('admin.author.edit',compact('countries','author'));
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
        $datas = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'country_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($request->hasFile('image')){
            $image = $request->image;
            $imageName = uniqid()."_".$image->getClientOriginalName();

            $author = Author::findOrFail($id);
            $imgNmae = $author->image;
            File::delete('storage/authors/'.$imgNmae);

            $image->storeAs('public/authors',$imageName);

            $datas['image'] = $imageName;
        }

        Author::findOrFail($id)->update($datas);
        return redirect('admin/authors')->with('successMsg','You have successfullu updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::findOrfail($id);
        $deleteImageName = $author->image;

        File::delete('storage/authors/' . $deleteImageName);

        Author::findOrFail($id)->delete();

        return back()->with('successMsg','You have successfully deleted an author!');
    }
}
