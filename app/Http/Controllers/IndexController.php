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
        // $category_home = Category::with(['movie'=> function($q){$q->withCount('episode');}])->orderBy('id','DESC')->where('status',1)->get();
        // return response()->json($episode_new);
        $category_home = Category::with(['movie' => function ($q) {
            $q->withCount('episode')->with(['episode' => function ($q) {
                $q->orderBy('episode', 'DESC')->get();
            }]);
        }])->orderBy('id', 'DESC')->where('status', 1)->get();

        return view('pages.home', compact('category','genre','country','category_home','hot_movie'));
    }

    public function category($slug){
        $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->get();
        $country = Country::orderBy('id','DESC') ->get();
        $category_slug = Category::where('slug',$slug) ->first();
        $movie = Movie::withCount('episode')->with(['episode' => function($q) {
            $q->orderBy('episode','DESC')->get();
        }])->where('category_id',$category_slug->id)->orderBy('update_movie_day','DESC')->paginate(40);
        // return response()->json($movie);
        return view('pages.category', compact('category','genre','country','category_slug','movie'));
    }

    public function year($year){
        $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->get();
        $country = Country::orderBy('id','DESC') ->get();
        $year = $year;
        $movie = Movie::withCount('episode')->with(['episode' => function($q) {
            $q->orderBy('episode','DESC')->get();
        }])->where('year',$year)->orderBy('update_movie_day','DESC')->paginate(40);
        return view('pages.year', compact('category','genre','country','year','movie'));
    }

    public function tags($tags){
        $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->get();
        $country = Country::orderBy('id','DESC') ->get();
        $tags = $tags;
        $movie = Movie::withCount('episode')->with(['episode' => function($q) {
            $q->orderBy('episode','DESC')->get();
        }])->where('tags','LIKE','%'.$tags.'%')->orderBy('update_movie_day','DESC')->paginate(40);
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
        $movie = Movie::withCount('episode')->with(['episode' => function($q) {
            $q->orderBy('episode','DESC')->get();
        }])->whereIn('id',$many_genre)->orderBy('update_movie_day','DESC')->paginate(40);
        return view('pages.genre', compact('category','genre','country','genre_slug','movie'));
    }

    public function country($slug){
        $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->get();
        $country = Country::orderBy('id','DESC') ->get();
        $country_slug = Country::where('slug',$slug) ->first();
        $movie = Movie::withCount('episode')->with(['episode' => function($q) {
            $q->orderBy('episode','DESC')->get();
        }])->where('country_id',$country_slug->id)->orderBy('update_movie_day','DESC')->paginate(40);
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
            $tap_phim = substr($tap, 4,20);
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tap_phim)->first();
            $episode_sapxep = Episode::where('movie_id',$movie->id)->orderBy('episode','ASC')->get();
        } else {
            $tap_phim = 1;
        }

        // dd($episode);
        return view('pages.watch', compact('category','genre','country','movie','related','episode','tap_phim','episode_sapxep'));
    }

    public function episode(){
        $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->get();
        $country = Country::orderBy('id','DESC') ->get();
        $movie= Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug) ->where('status',1)->first();
        $related= Movie::with('category','genre','country')->where('category_id',$movie->category->id) ->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        return view('pages.episode',compact('category','genre','country','movie','related'));
    }
    public function loc_phim(){
        $order_filter = $_GET['order'];
        $genre_filter = $_GET['genre'];
        $country_filter = $_GET['country'];
        $year_filter = $_GET['year'];

        // $movie= Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug) ->where('status',1)->first();

        if ($order_filter==''&& $genre_filter==''&& $country_filter==''&& $year_filter=='') {
            return redirect()->back();
        }
        else {
            $category = Category::orderBy('position','ASC') ->where('status', 1)->get();
            $genre = Genre::orderBy('id','DESC') ->get();
            $country = Country::orderBy('id','DESC') ->get();


            $movie = Movie::withCount('episode')->with(['episode' => function($q) {
                $q->orderBy('episode','DESC')->get();
            }]);
            
            if ($genre_filter) {
                $movie_genre = Movie_Genre::where('genre_id', $genre_filter)->get();
                $many_genre = [];
                    foreach($movie_genre as $key => $movi) {
                        $many_genre[] = $movi->movie_id;
                    }
                $movie = $movie->whereIn('id',$many_genre);
            }elseif($country_filter) {
                $movie = $movie->where('country_id','=',$country_filter);
            }elseif($year_filter) {
                $movie = $movie->where('year','=',$year_filter);
            }elseif($order_filter == 'name_a_z') {
                $movie = $movie->orderBy('title','ASC');
            }
            $movie = $movie->orderBy('update_movie_day','DESC')->paginate(40);

            return view('pages.filter-movie', compact('category','genre','country','movie'));
        }
    }
}
