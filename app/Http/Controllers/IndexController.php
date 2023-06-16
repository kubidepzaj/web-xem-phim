<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Movie_Genre;
use DB;

class IndexController extends Controller
{
    public function search()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
            $genre = Genre::orderBy('id','DESC') ->get();
            $country = Country::orderBy('id','DESC') ->get();

            $movie = Movie::where('title','LIKE','%'.$search.'%')->orderBy('update_movie_day','DESC')->paginate(40);

            return view('pages.search', compact('category','genre','country','search','movie'));
        } else {
            return redirect()->to('/');
        }
    }


    public function home(){
        $hot_movie = Movie::where('hot_movie',1)->where('status',1)->orderBy('update_movie_day','DESC')->get();
        $category = Category::orderBy('position','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->get();
        $country = Country::orderBy('id','DESC') ->get();
        $category_home = Category::with('movie')->orderBy('id','DESC')->where('status',1)->get();
        return view('pages.home', compact('category','genre','country','category_home','hot_movie'));
    }

    public function category($slug){
        $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->get();
        $country = Country::orderBy('id','DESC') ->get();
        $category_slug = Category::where('slug',$slug) ->first();
        $movie = Movie::where('category_id',$category_slug->id)->orderBy('update_movie_day','DESC')->paginate(40);
        return view('pages.category', compact('category','genre','country','category_slug','movie'));
    }

    public function year($year){
        $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->get();
        $country = Country::orderBy('id','DESC') ->get();
        $year = $year;
        $movie = Movie::where('year',$year)->orderBy('update_movie_day','DESC')->paginate(40);
        return view('pages.year', compact('category','genre','country','year','movie'));
    }

    public function tags($tags){
        $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->get();
        $country = Country::orderBy('id','DESC') ->get();
        $tags = $tags;
        $movie = Movie::where('tags','LIKE','%'.$tags.'%')->orderBy('update_movie_day','DESC')->paginate(40);
        return view('pages.tag', compact('category','genre','country','tags','movie'));
    }

    public function genre($slug){
        $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->get();
        $country = Country::orderBy('id','DESC') ->get();
        $genre_slug = Genre::where('slug',$slug) ->first();
        // nhieu the loai
        $movie_genre = Movie_Genre::where('genre_id',$genre_slug->id)->get();
        $many_genre = [];
        foreach($movie_genre as $key => $movi) {
            $many_genre[] = $movi->movie_id;
        }
        // return response()->json($many_genre);
        $movie = Movie::whereIn('id',$many_genre)->orderBy('update_movie_day','DESC')->paginate(40);
        return view('pages.genre', compact('category','genre','country','genre_slug','movie'));
    }

    public function country($slug){
        $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->get();
        $country = Country::orderBy('id','DESC') ->get();
        $country_slug = Country::where('slug',$slug) ->first();
        $movie = Movie::where('country_id',$country_slug->id)->orderBy('update_movie_day','DESC')->paginate(40);
        return view('pages.country', compact('category','genre','country','country_slug','movie'));    }

    public function movie($slug){
        $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->get();
        $country = Country::orderBy('id','DESC') ->get();

        $movie= Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug) ->where('status',1)->first();
        $related= Movie::with('category','genre','country')->where('category_id',$movie->category->id) ->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();

        $episode_first = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode','ASC')->take(1)->first();

        return view('pages.movie', compact('category','genre','country','movie','related','episode_first'));
    }

    public function watch($slug,$tap){

        $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->get();
        $country = Country::orderBy('id','DESC') ->get();

        $movie= Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug) ->where('status',1)->first();
        $related= Movie::with('category','genre','country')->where('category_id',$movie->category->id) ->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();

        if (isset($tap)) {
            $tap_phim = $tap;
            $tap_phim = substr($tap, 4,1);
            $episode = Episode::where('movie_id',$movie->id)->where('episode',$tap_phim)->first();
        } else {
            $tap_phim = 1;
        }

        // return response()->json($movie->episode);
        return view('pages.watch', compact('category','genre','country','movie','related','episode','tap_phim'));
    }

    public function episode(){
        $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->get();
        $country = Country::orderBy('id','DESC') ->get();
        $movie= Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug) ->where('status',1)->first();
        $related= Movie::with('category','genre','country')->where('category_id',$movie->category->id) ->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        return view('pages.episode',compact('category','genre','country','movie','related'));
    }
}
