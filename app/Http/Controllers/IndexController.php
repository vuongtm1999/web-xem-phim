<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Country;
use App\Models\Category;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function home()
    {
        $phimhot = Movie::where('phim_hot', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $category_home = Category::with('movie')->orderBy('id', 'DESC')->where('status', 1)->get();

        return view('pages.home', compact('category', 'category_home', 'genre', 'country', 'phimhot'));
    }
    public function category($slug)
    {
        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();

        $cate_slug = Category::where('slug', $slug)->first();
        $movies = Movie::where('category_id', $cate_slug->id)->paginate(8);

        return view('pages.category', compact('category', 'genre', 'country', 'cate_slug', 'movies'));
    }
    public function genre($slug)
    {
        $category = Category::orderBy('id', 'DESC')->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();

        $genre_slug = Genre::where('slug', $slug)->first();
        $movies = Movie::where('genre_id', $genre_slug->id)->paginate(8);


        return view('pages.genre', compact('genre', 'country', 'category', 'genre_slug', 'movies'));
    }

    public function country($slug)
    {
        $category = Category::orderBy('id', 'DESC')->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();

        $country_slug = Country::where('slug', $slug)->first();
        $movies = Movie::where('country_id', $country_slug->id)->paginate(8);

        return view('pages.country', compact('genre', 'country', 'category', 'country_slug', 'movies'));
    }
    public function movie($slug)
    {
        $category = Category::orderBy('id', 'DESC')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'DESC')->get();
        $country = Country::orderBy('id', 'DESC')->get();
        $movie = Movie::where('slug', $slug)->with('category', 'genre', 'country')->where('status', 1)->first();

        $related_movie = Movie::where('category_id', $movie->category_id)
        ->with('category', 'genre', 'country')->where('status', 1)->orderBy(DB::raw('RAND()'))
        ->whereNotIn('slug', [$slug])->get();

        return view('pages.movie', compact('category', 'genre', 'country', 'movie', 'related_movie'));
    }
    public function watch()
    {
        return view('pages.watch');
    }
    public function episode()
    {
        return view('pages.episode');
    }
}