<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Country::all();
        return view('admincp.country.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.country.form');
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
            'title' => 'required|unique:categories|regex:/^[^0-9]*$/',
            // 'status' => 'required',
            //'slug' => 'required|unique:categories'
        ],[
            'title.regex' => 'Nhập sai định dạng',
            'title.required' => 'Không được để trống tên',
            'title.unique' => 'Tên danh mục phim đã tồn tại',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request -> all();
        $country = new Country();
        $country -> title = $data['title'];
        $country -> description = $data['description'];
        $country -> status = $data['status'];
        $country -> slug = $data['slug'];
        $country -> save();
        $list = Country::all();
        toastr()->success('Thêm dữ liệu thành công!', 'Chúc mừng');
        return view('admincp.country.index',compact('list')); ;
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
        $country = Country::find($id);
        $list = Country::all();
        return view('admincp.country.edit',compact('country'));
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:categories|regex:/^[^0-9]*$/',
            // 'status' => 'required',
            //'slug' => 'required|unique:categories'
        ],[
            'title.regex' => 'Nhập sai định dạng',
            'title.required' => 'Không được để trống tên',
            'title.unique' => 'Tên danh mục phim đã tồn tại',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request -> all();
        $country = country::find($id);
        $country -> title = $data['title'];
        $country -> description = $data['description'];
        $country -> status = $data['status'];
        $country -> slug = $data['slug'];
        $country -> save();
        $list = Country::all();
        toastr()->success('Cập nhật dữ liệu thành công!', 'Chúc mừng');
        return view('admincp.country.index',compact('list')); ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        $movie = Movie::whereIn('country_id',[$country->id])->delete();
        Episode::whereIn('movie_id',[$movie->id])->delete();
        $country->delete();
        toastr()->success('Xóa dữ liệu thành công!', 'Chúc mừng');
        return redirect()->route('country.index');
    }
}
