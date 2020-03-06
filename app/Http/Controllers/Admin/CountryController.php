<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return view('admin.country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.create');
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
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = 'flag-image-' . time () . '-' . $request->name . '.' . $image->getClientOriginalExtension();

            $image->storeAs('public/flags', $imageName);
            $data['image'] = $imageName;

            Country::create($data);

            return redirect('admin/countries')->with('successMsg', 'Success!');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::findOrFail($id);

        return view('admin.country.edit', compact('country'));
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
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {

            $image = $request->image;
            $imageName = 'flag-image-' . time() . '-' . $request->name . '.' . $image->getClientOriginalExtension();

            $deleteImageName = Country::findOrfail($id)->image;
            File::delete('storage/flags/', $deleteImageName);
            $image->storeAs('public/flags/', $imageName);

            $data['image'] = $imageName;
            Country::findOrfail($id)->update($data);

            return redirect('/admin/countries')->with('successMsg', 'You have successfully updated!');
        }

        Country::findOrfail($id)->update($data);

        return redirect('/admin/countries')->with('successMsg', 'You have successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::findOrfail($id);
        $deleteImageName = $country->image;

        File::delete('storage/flags/' . $deleteImageName);

        Country::findOrfail($id)->delete();

        return back()->with('successMsg', 'Success!');
    }
}
