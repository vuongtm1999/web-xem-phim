<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Movie::with('category', 'genre', 'country')->orderBy('id', 'DESC')->get();

        return view('admincp.movie.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');

        return view('admincp.movie.form', compact('category', 'country', 'genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];
        $movie->eng_title = $data['eng_title'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        $movie->genre_id = $data['genre_id'];
        $movie->phim_hot = $data['phim_hot'];

        $get_img = $request->file('image');

        // Them hinh anh
        if ($get_img) {
            $get_name_image = $get_img->getClientOriginalName(); // hinhanh.jpg
            $name_image = current(explode('.', $get_name_image)); // hinhanh
            $new_image = $name_image . rand(0, 9999) . '.' . $get_img->getClientOriginalExtension(); // hinhanh1234.jpg

            $get_img->move('uploads/movie/', $new_image);

            $movie->image = $new_image;
        }

        $movie->save();

        return redirect()->back();
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
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $movie = Movie::find($id);

        return view('admincp.movie.form', compact('movie', 'category', 'country', 'genre'));
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
        $data = $request->all();
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->slug = $data['slug'];
        $movie->description = $data['description'];
        $movie->category_id = $data['category_id'];
        $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        $movie->phim_hot = $data['phim_hot'];

        $get_img = $request->file('image');

        // Them hinh anh
        if ($get_img) {
            if (!empty($movie->image)) {
                unlink('uploads/movie/' . $movie->image);
            }

            $get_name_image = $get_img->getClientOriginalName(); // hinhanh.jpg
            $name_image = current(explode('.', $get_name_image)); // hinhanh
            $new_image = $name_image . rand(0, 9999) . '.' . $get_img->getClientOriginalExtension(); // hinhanh1234.jpg

            $get_img->move('uploads/movie/', $new_image);

            $movie->image = $new_image;
        }

        $movie->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        if (!empty($movie->image)) {
            unlink('uploads/movie/' . $movie->image);
        }

        $movie->delete();

        return redirect()->back();
    }
}