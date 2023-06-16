<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_episode = Episode::with('movie')->orderBy('movie_id','DESC')->get();
        return view('admincp.episode.index',compact('list_episode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $default_movie_id = '<option>Chọn tập phim</option>';
        $list_movie = Movie::orderBy('id','DESC')->pluck('title','id');
        return view('admincp.episode.form',compact('list_movie','default_movie_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request -> all();
        $episode = new Episode();
        $episode -> movie_id = $data['movie_id'];
        $episode -> movie_link = $data['link'];
        $episode -> episode = $data['episode'];
        $episode -> save();

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
        $movies = \App\Models\Movie::pluck('title', 'id')->toArray();
        return view('admincp.episode.edit',compact('list_movie','default_movie_id','episode','movies'));
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
        $episode -> movie_link = $data['link'];
        $episode -> episode = $data['episode'];
        $episode -> save();

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
        return redirect()->back();
    }

    public function select_movie()
    {
        //lấy id
        $id = $_GET['id'];
        //tìm kiếm phim
        $movie_by_id = Movie::find($id);
        // tìm kiếm phim trong bang episode mà có movie_id bằng id tìm, lấy ra episode
        $movie_episode = Episode::where('movie_id',$movie_by_id->id)->pluck('episode');
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
}
