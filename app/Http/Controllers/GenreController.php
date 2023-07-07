<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Movie_Genre;
use App\Models\Episode;

class GenreController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Genre::all();
        return view('admincp.genre.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.genre.form');
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
        $genre = new Genre();
        $genre -> title = $data['title'];
        $genre -> description = $data['description'];
        $genre -> status = $data['status'];
        $genre -> slug = $data['slug'];
        $genre -> save();
        $list = Genre::all();
        toastr()->success('Thêm dữ liệu thành công!', 'Chúc mừng');
        return view('admincp.genre.index',compact('list'));
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
        $genre = Genre::find($id);
        $list = Genre::all();
        return view('admincp.genre.edit',compact('genre'));
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
        $genre = Genre::find($id);
        $genre -> title = $data['title'];
        $genre -> description = $data['description'];
        $genre -> status = $data['status'];
        $genre -> slug = $data['slug'];
        $genre -> save();
        $list = Genre::all();
        toastr()->success('Cập nhật dữ liệu thành công!', 'Chúc mừng');
        return view('admincp.genre.index',compact('list')); ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Genre::find($id);
        $genre->delete();
        toastr()->success('Xóa dữ liệu thành công!', 'Chúc mừng');
        return redirect()->route('genre.index');
    }
}
