<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Movie_Genre;
use App\Models\Info;
use App\Models\Publisher;
use App\Models\Bookmark;
use App\Models\Link;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;
use DB;

class IndexController extends Controller
{
    public function dang_ky(){
        return view('pages.users.dangky');
    }
    public function register_publisher(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:publishers',
            'email' => 'required|unique:publishers',
            'phone' => 'required|unique:publishers|regex:/^[0-9]{10}$/',
            'password' => 'required|max:100',
        ],[
            'password.required' => 'Không được để trống mật khẩu',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'phone.required' => 'Không được để trống số điện thoại',
            'phone.regex' => 'Nhập sai định dạng',
            'email.required' => 'Không được để trống email',
            'email.unique' => 'Email đã tồn tại',
            'name.required' => 'Không được để trống tên',
            'username.unique' => 'Username đã tồn tại',
            'username.required' => 'Username không được để trống',

        ]);
        $publisher = new Publisher();
        $publisher->name = $data['name'];
        $publisher->email = $data['email'];
        $publisher->username = $data['username'];
        $publisher->phone = $data['phone'];
        $publisher->password = md5($data['password']);
        $publisher->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $publisher->save();
        toastr()->success('Đăng kí thành công!', '');
        return redirect()->route('dang-nhap');
    }
    public function dang_nhap(){
        return view('pages.users.dangnhap');

    }
    public function login_publisher(Request $request){

        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            'password.required' => 'Không được để trống mật khẩu',
            'username.required' => 'Username không được để trống',

        ]);
        $publisher = Publisher::where('username',$data['username'])->where('password',md5($data['password']))->first();
        if ($publisher) {
            Session::put('login_publisher',true);
            Session::put('publisher_id',$publisher->id);
            Session::put('username',$publisher->username);
            Session::put('email',$publisher->email);
            Session::put('name',$publisher->name);
            return redirect()->to('/');
        }
        else {
            toastr()->error('Sai tên tài khoản hoặc mật khẩu!', 'Đăng nhập thất bại');
            return redirect()->back();
        }

    }
    public function dang_xuat(){
        Session::forget('login_publisher');
        Session::forget('publisher_id');
        Session::forget('username');
        Session::forget('email');
        Session::forget('name');
        return redirect()->back();
    }
    public function bookmark(Request $request){
        $data = $request->all();
        $check = Bookmark::where('movie_id',$data['movie_id'])->where('publisher_id',$data['publisher_id'])->first();
        if ($check) {
            echo 'Fail';
        }
        else {
            $bookmark= new Bookmark();
            $bookmark->publisher_id = $data['publisher_id'];
            $bookmark->movie_id = $data['movie_id'];
            $bookmark->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $bookmark->save();
            echo 'Done';
        }
    }

    public function delete_bookmark($bookmark_id)
        {
            try {
                $bookmark = Bookmark::findOrFail($bookmark_id);
                $bookmark->delete();
                return redirect()->back();
            } catch (\Exception $e) {
                return "An error occurred while deleting bookmark: " . $e->getMessage();
            }
        }

    public function delete_all_bookmark() {
        Bookmark::truncate();
    }
    public function search()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $category = Category::orderBy('id','ASC') ->where('status', 1)->get();
            $genre = Genre::orderBy('id','DESC') ->get();
            $country = Country::orderBy('id','DESC') ->get();

            $movie = Movie::where('title','LIKE','%'.$search.'%')->orderBy('update_movie_day','DESC')->paginate(40);
            $meta_title = 'Kết quả tìm kiếm cho: '.$search;
        $bookmark = Bookmark::with('publisher')->with('movie')->where('publisher_id',Session::get('publisher_id'))->get();

            // $meta_description = $movie ->description;
            return view('pages.search', compact('category','genre','country','search','movie','meta_title','bookmark'));
        } else {
            // return redirect()->to('/');
            return redirect()->to('/');
        }
    }


    public function home(){
        $hot_movie = Movie::where('hot_movie',1)->where('status',1)->orderBy('update_movie_day','DESC')->get();
        $category = Category::orderBy('id','ASC')->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->where('status', 1)->get();
        $country = Country::orderBy('id','DESC') ->where('status', 1)->get();
        // $category_home = Category::with(['movie'=> function($q){$q->withCount('episode');}])->orderBy('id','DESC')->where('status',1)->get();
        // return response()->json($episode_new);
        $category_home = Category::with(['movie' => function ($q) {
            $q->withCount('episode')->with(['episode' => function ($q) {
                $q->orderBy('episode', 'DESC')->get();
            }]);
        }])->orderBy('id', 'DESC')->where('status', 1)->get();
        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info ->description;
        // return response()->json($bookmark);
        $bookmark = Bookmark::with('publisher')->with('movie')->where('publisher_id',Session::get('publisher_id'))->get();

        return view('pages.home', compact('category','genre','country','category_home','hot_movie','meta_title','meta_description','bookmark'));
    }

    public function category($slug){
        $category = Category::orderBy('id','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->where('status', 1)->get();
        $country = Country::orderBy('id','DESC') ->where('status', 1)->get();
        $category_slug = Category::where('slug',$slug) ->first();
        $movie = Movie::withCount('episode')->with(['episode' => function($q) {
            $q->orderBy('episode','DESC')->get();
        }])->where('category_id',$category_slug->id)->orderBy('update_movie_day','DESC')->paginate(10);
        // return response()->json($movie);
        $meta_title = 'Danh Mục | '.$category_slug->title;
        $meta_description = $category_slug ->description;

        $bookmark = Bookmark::with('publisher')->with('movie')->where('publisher_id',Session::get('publisher_id'))->get();

        return view('pages.category', compact('category','genre','country','category_slug','movie','meta_title','meta_description','bookmark'));
    }

    public function year($year){
        $category = Category::orderBy('id','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->where('status', 1)->get();
        $country = Country::orderBy('id','DESC') ->where('status', 1)->get();
        $year = $year;
        $movie = Movie::withCount('episode')->with(['episode' => function($q) {
            $q->orderBy('episode','DESC')->get();
        }])->where('year',$year)->orderBy('update_movie_day','DESC')->paginate(10);
        $meta_title = 'Năm Sản Xuất | '.$year;
        $meta_description = $year;

        $bookmark = Bookmark::with('publisher')->with('movie')->where('publisher_id',Session::get('publisher_id'))->get();

        return view('pages.year', compact('category','genre','country','year','movie','meta_title','meta_description','bookmark'));
    }

    public function tags($tags){
        $category = Category::orderBy('id','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->where('status', 1)->get();
        $country = Country::orderBy('id','DESC') ->where('status', 1)->get();
        $tags = $tags;
        $movie = Movie::withCount('episode')->with(['episode' => function($q) {
            $q->orderBy('episode','DESC')->get();
        }])->where('tags','LIKE','%'.$tags.'%')->orderBy('update_movie_day','DESC')->paginate(10);
        $meta_title = 'Phim | '.$tag;
        $meta_description = $tag;

        $bookmark = Bookmark::with('publisher')->with('movie')->where('publisher_id',Session::get('publisher_id'))->get();

        return view('pages.tag', compact('category','genre','country','tags','movie','meta_title','meta_description','bookmark'));
    }

    public function genre($slug){
        $category = Category::orderBy('id','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->where('status', 1)->get();
        $country = Country::orderBy('id','DESC') ->where('status', 1)->get();
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
        }])->whereIn('id',$many_genre)->orderBy('update_movie_day','DESC')->paginate(10);
        $meta_title = 'Thể Loại | '.$genre_slug->title;
        $meta_description = $genre_slug ->description;

        $bookmark = Bookmark::with('publisher')->with('movie')->where('publisher_id',Session::get('publisher_id'))->get();

        return view('pages.genre', compact('category','genre','country','genre_slug','movie','meta_title','meta_description','bookmark'));
    }

    public function country($slug){
        $category = Category::orderBy('id','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->where('status', 1)->get();
        $country = Country::orderBy('id','DESC') ->where('status', 1)->get();
        $country_slug = Country::where('slug',$slug) ->first();
        $movie = Movie::withCount('episode')->with(['episode' => function($q) {
            $q->orderBy('episode','DESC')->get();
        }])->where('country_id',$country_slug->id)->orderBy('update_movie_day','DESC')->paginate(10);
        $meta_title = 'Quốc Gia | '.$country_slug->title;
        $meta_description = $country_slug ->description;

        $bookmark = Bookmark::with('publisher')->with('movie')->where('publisher_id',Session::get('publisher_id'))->get();

        return view('pages.country', compact('category','genre','country','country_slug','movie','meta_title','meta_description','bookmark'));
    }

    public function movie($slug){
        $category = Category::orderBy('id','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->where('status', 1)->get();
        $country = Country::orderBy('id','DESC') ->where('status', 1)->get();

        $movie= Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug) ->where('status',1)->first();
        $related= Movie::with('category','genre','country')->where('category_id',$movie->category->id) ->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();

        $episode_first = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode','ASC')->take(1)->first();


        // movie views sidebar
        $views = $movie->views;
        $views = $views + 1;
        $movie->views = $views;
        $movie->save();
        $meta_title = 'Phim | '.$movie->title;
        $meta_description = $movie ->description;

        $bookmark = Bookmark::with('publisher')->with('movie')->where('publisher_id',Session::get('publisher_id'))->get();

        return view('pages.movie', compact('category','genre','country','movie','related','episode_first','meta_title','meta_description','bookmark'));
    }

    public function watch($slug,$tap,$server_active){

        $category = Category::orderBy('id','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->where('status', 1)->get();
        $country = Country::orderBy('id','DESC') ->where('status', 1)->get();

        $movie= Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug) ->where('status',1)->first();
        $related= Movie::with('category','genre','country')->where('category_id',$movie->category->id) ->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();

        if (isset($tap)) {
            $tap_phim = $tap;
            $tap_phim = substr($tap, 4,20);
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tap_phim)->first();
            $episode_sapxep = Episode::where('movie_id',$movie->id)->orderBy('episode','ASC')->get();
        } else {
            $tap_phim = 1;
            $episode = Episode::where('movie_id', $movie->id)->where('episode', $tap_phim)->first();
        }
        $server = Link::orderBy('id','ASC')->get();
        $episode_movie = Episode::where('movie_id',$movie->id)->get()->unique('link');
        $episode_list = Episode::where('movie_id',$movie->id)->orderBy('episode','ASC')->get();
        // dd($episode);
        $meta_title = 'Xem Phim | '.$movie->title.' | Tập '.$tap_phim;
        $meta_description = $movie ->description;

        $bookmark = Bookmark::with('publisher')->with('movie')->where('publisher_id',Session::get('publisher_id'))->get();

        return view('pages.watch', compact('category','genre','country','movie','related','episode','tap_phim','episode_sapxep','meta_title','meta_description','bookmark','server','server_active','episode_movie','episode_list'));
    }

    public function episode(){
        $category = Category::orderBy('id','ASC') ->where('status', 1)->get();
        $genre = Genre::orderBy('id','DESC') ->where('status', 1)->get();
        $country = Country::orderBy('id','DESC') ->where('status', 1)->get();
        $movie= Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug) ->where('status',1)->first();
        $related= Movie::with('category','genre','country')->where('category_id',$movie->category->id) ->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();

        $bookmark = Bookmark::with('publisher')->with('movie')->where('publisher_id',Session::get('publisher_id'))->get();

        return view('pages.episode',compact('category','genre','country','movie','related','bookmark'));
    }

    public function loc_phim()
{
    $order_filter = $_GET['order'] ?? '';
    $genre_filter = $_GET['genre'] ?? '';
    $country_filter = $_GET['country'] ?? '';
    $year_filter = $_GET['year'] ?? '';

    if ($order_filter == '' && $genre_filter == '' && $country_filter == '' && $year_filter == '') {
        return redirect()->back();
    }

    $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
    $genre = Genre::orderBy('id', 'DESC')->get();
    $country = Country::orderBy('id', 'DESC')->get();

    $movie = Movie::withCount('episode')->with(['episode' => function ($q) {
        $q->orderBy('episode', 'DESC');
    }]);

    if ($genre_filter) {
        $movie = $movie->whereHas('movie_genre', function ($q) use ($genre_filter) {
            $q->where('genre_id', $genre_filter);
        });
    }

    if ($country_filter) {
        $movie = $movie->whereHas('country', function ($q) use ($country_filter) {
            $q->where('id', $country_filter);
        });
    }

    if ($year_filter) {
        $movie = $movie->where('year', $year_filter);
    }

    if ($order_filter == 'name_a_z') {
        $movie = $movie->orderBy('title', 'ASC');
    }

    $movie = $movie->orderBy('update_movie_day', 'DESC')->paginate(10);

    $meta_title = 'Kết quả lọc phim - Phimchill';

    $bookmark = Bookmark::with('publisher')->with('movie')->where('publisher_id',Session::get('publisher_id'))->get();

    // $meta_description = $movie ->description;
    return view('pages.filter-movie', compact('category', 'genre', 'country', 'movie','meta_title','bookmark'));
}

}
