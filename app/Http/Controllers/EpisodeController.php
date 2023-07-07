<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Link;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use DOMDocument;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_server = Link::orderBy('id','DESC')->get();
        $list_episode = Episode::with('movie')->orderBy('movie_id','DESC')->get();
        return view('admincp.episode.index',compact('list_episode','list_server'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $link = Link::orderBy('id','DESC')->pluck('name','id');
        $list_movie = Movie::orderBy('id','DESC')->pluck('title','id');
        return view('admincp.episode.form',compact('list_movie','link'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'link_sever' => 'required',
        // ],[
        //     'title.regex' => 'Link Sever Phải điền',

        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $data = $request -> all();
        $episode = new Episode();
        $episode -> movie_id = $data['movie_id'];
        $episode -> link = $data['link_server'];
        $episode -> movie_link ='<iframe width="100%" height="100%" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" src="'.$data['link'].'"></iframe>';
        $episode -> episode = $data['episode'];
        $episode -> save();
        toastr()->success('Thêm dữ liệu thành công!', 'Chúc mừng');
        return redirect()->route('episode.index');
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
        $default_movie_id = '<option>Chọn tập phim</option>';
        $list_movie = Movie::orderBy('id','DESC')->pluck('title','id');
        $episode = Episode::find($id);
        $html = $episode->movie_link;
        // Sử dụng DOMDocument để phân tích cú pháp HTML
        $dom = new DOMDocument();
        $dom->loadHTML($html);

        // Tìm thẻ iframe và lấy thuộc tính "src"
        $iframe = $dom->getElementsByTagName('iframe')->item(0);
        $src = $iframe->getAttribute('src');
        $link = Link::orderBy('id','DESC')->pluck('name','id');
        $movies = \App\Models\Movie::pluck('title', 'id')->toArray();
        return view('admincp.episode.edit',compact('list_movie','default_movie_id','episode','movies','link','src'));
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
        $data = $request -> all();
        $episode = Episode::find($id);
        $episode -> movie_id = $data['movie_id'];
        $episode -> movie_link ='<iframe width="100%" height="100%" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" src="'.$data['link'].'"></iframe>';
        $episode -> link = $data['link_server'];
        $episode -> episode = $data['episode'];
        $episode -> save();
        toastr()->success('Cập nhật dữ liệu thành công!', 'Chúc mừng');
        return redirect()->route('episode.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Episode::find($id) -> delete();
        toastr()->success('Xóa dữ liệu thành công!', 'Chúc mừng');
        return redirect()->back();
    }

    public function select_movie()
    {
        //lấy id
        $id = $_GET['id'];
        //tìm kiếm phim
        $link_server = $_GET['link_server'];
        $movie_by_id = Movie::find($id);
        // tìm kiếm phim trong bang episode mà có movie_id bằng id tìm, lấy ra episode
        $movie_episode = Episode::where('link',$link_server)->where('movie_id',$movie_by_id->id)->pluck('episode');
        // đếm số phim đã điền
       // Tạo mảng chứa danh sách tập phim chưa có trong bảng episode
       $missing_episodes = [];
        for ($i = 1; $i <= $movie_by_id->number_episode; $i++) {
            $episode_miss = $i;
            if (!$movie_episode->contains($episode_miss)) {
                $missing_episodes[] = $i;
            }
        }
        if (count($missing_episodes) == 0) {
            return null;
        }
        // return response()->json($missing_episodes);
            $output = '<option>---Chọn tập phim---</option>';
            foreach ($missing_episodes as $epi) {
                $output .= '<option value="'.$epi.'">'.$epi.'</option>';
            }
        echo $output;
    }

    //add tap phim tu trang phim
    public function add_episode($id) {
        $link = Link::orderBy('id','DESC')->pluck('name','id');
        $list_movie = Movie::with('episode')->where('id',$id)->pluck('title','id');
        return view('admincp.episode.add-episode',compact('list_movie','link'));
    }
}
