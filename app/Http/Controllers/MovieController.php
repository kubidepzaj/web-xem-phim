<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Movie_Genre;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;
use Carbon\Carbon;
use Storage;
use File;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function update_movie_year(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->year = $data['year'];
        $movie->save();
    }

    public function update_topview(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['movie_id']);
        $movie->topview = $data['topview'];
        $movie->save();
    }

    public function filter_topview(Request $request)
    {
        $data = $request->all();
        $movie = Movie::where('topview',$data['value'])->orderBy('update_movie_day','DESC')->take(15)->get();
        $output = '';
        foreach ($movie as $key => $mov) {
            $output.='<div class="item post-37176">
            <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
               <div class="item-link">
                  <img src="'.url('uploads/movies/'.$mov->image).'" class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                  <span class="is_trailer">Trailer</span>
               </div>
               <p class="title">'.$mov->title.'</p>
            </a>
            <div class="viewsCount" style="color: #9d9d9d;">';
            if ($mov->views > 0) {
                $output .= $mov->views.' lượt quan tâm';
            } else {
                $output .= rand(100, 99999).' lượt quan tâm';
            }
        $output .= '</div>
            <div style="float: left;">
               <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
               <span style="width: 0%"></span>
               </span>
            </div>
         </div>';
        }
        echo $output;
    }

    public function filter_topview_default(Request $request)
    {
        $data = $request->all();
        $movie = Movie::where('topview',0)->orderBy('update_movie_day','DESC')->take(15)->get();
        $output = '';
        foreach ($movie as $key => $mov) {
            $output.='<div class="item post-37176">
            <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
               <div class="item-link">
                  <img src="'.url('uploads/movies/'.$mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />
                  <span class="is_trailer">Trailer</span>
               </div>
               <p class="title">'.$mov->title.'</p>
            </a>
            <div class="viewsCount" style="color: #9d9d9d;">';
            if ($mov->views > 0) {
                $output .= $mov->views.' lượt quan tâm';
            } else {
                $output .= rand(100, 99999).' lượt quan tâm';
            }
        $output .= '</div>
            <div style="float: left;">
               <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
               <span style="width: 0%"></span>
               </span>
            </div>
         </div>';
        }
        echo $output;
    }

    public function index()
    {
        $list = Movie::with('category','movie_genre','country','genre')->withCount('episode')->orderBy('id','DESC')->get();

        // them phim vao file json cho search
        $path = public_path()."/json_file/";
        if (!is_dir($path)) {
            mkdir($path,0777,true);
        }

        File::put($path.'movies.json',json_encode($list));

        return view('admincp.movie.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        $list = Movie::with('category','country','genre')->orderBy('id','DESC')->get();

        $list_genre = Genre::pluck('title','id');
        return view('admincp.movie.form', compact('list','genre','category','country','list_genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:movies',
            'description' => 'required',
            'slug' => 'required',
        ],[
            'title.regex' => 'Nhập sai định dạng',
            'title.required' => 'Không được để trống tên',
            'title.unique' => 'Tên phim đã tồn tại',
            'slug.required' => 'Không được để trống slug',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request ->all();
        $movie = new Movie();
        // return response()->json($data['genre']);
        $movie->title = $data['title'];
        $movie->eng_name = $data['eng_name'];
        $movie->description = $data['description'];
        $movie->tags = $data['tags'];
        $movie->time = $data['time'];
        $movie->number_episode = $data['episode'];
        $movie->status = $data['status'];
        $movie->quality = $data['quality'];
        $movie->subtitle = $data['subtitle'];
        $movie->slug = $data['slug'];
        $movie->hot_movie = $data['hot_movie'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        $movie->views = rand(100,99999);
        $movie->date_created = Carbon::now('Asia/Ho_Chi_minh');
        $movie->update_movie_day = Carbon::now('Asia/Ho_Chi_minh');

        $get_image = $request->file('image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/movies',$new_image);
            $movie->image = $new_image;
        }
        $movie -> save();

        $movie->movie_genre()->sync($data['genre']);
        toastr()->success('Thêm dữ liệu thành công!', 'Chúc mừng');

        return redirect()->route('movie.index');
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
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        $list = Movie::with('category','country','genre')->orderBy('id','DESC')->get();
        $movie = Movie::find($id);
        $list_genre = Genre::pluck('title','id');
        $movie_genre = $movie->movie_genre;
        return view('admincp.movie.edit', compact('list','genre','category','country','movie','list_genre','movie_genre'));
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
        $data = $request ->all();
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->eng_name = $data['eng_name'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->time = $data['time'];
        $movie->number_episode = $data['episode'];
        $movie->tags = $data['tags'];
        $movie->subtitle = $data['subtitle'];
        $movie->quality = $data['quality'];
        $movie->slug = $data['slug'];
        $movie->hot_movie = $data['hot_movie'];
        $movie->category_id = $data['category_id'];
        // $movie->genre_id = $data['genre_id'];
        $movie->country_id = $data['country_id'];
        $movie->update_movie_day = Carbon::now('Asia/Ho_Chi_minh');


        $get_image = $request->file('image');

        if ($get_image) {
            if (!empty($movie->image) && file_exists('uploads/movies/'.$movie->image)) {
                unlink('uploads/movies/'.$movie->image);
            }

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/movies',$new_image);
            $movie->image = $new_image;
        }
        $movie -> save();

        $movie->movie_genre()->sync($data['genre']);
        toastr()->success('Cập nhật dữ liệu thành công!', 'Chúc mừng');
        return redirect()->route('movie.index');

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
        if (file_exists('uploads/movies/'.$movie->image)) {
            unlink('uploads/movies/'.$movie->image);
        }
        //xoa phim xoa luon the loai
        Movie_Genre::whereIn('movie_id',[$movie->id])->delete();
        Episode::whereIn('movie_id',[$movie->id])->delete();
        $movie->delete();
        toastr()->success('Xóa dữ liệu thành công!', 'Chúc mừng');
        return redirect()->back();
    }
}
