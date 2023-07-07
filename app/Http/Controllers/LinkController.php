<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Episode;

use Illuminate\Support\Facades\Validator;



class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Link::all();
        return view('admincp.link.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.link.form');
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
            'status' => 'required',
            //'slug' => 'required|unique:categories'
        ],[
            'title.regex' => 'Nhập sai định dạng',
            'title.required' => 'Không được để trống tên',
            'title.unique' => 'Tên danh mục phim đã tồn tại',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $link = new Link();
        $link->name = $data['title'];
        $link->status = $data['status'];
        $link->description = $data['description'];
        $link->save();

        toastr()->success('Thêm dữ liệu thành công!', 'Chúc mừng');
        return redirect()->route('link.index');

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
        $link = Link::find($id);
        $list = Link::orderBy('id','ASC')->get();
        return view('admincp.link.edit',compact('link','list'));
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
            'title' => 'required|regex:/^[^0-9]*$/',
            'status' => 'required',
        ],[
            'title.regex' => 'Nhập sai định dạng',
            'title.required' => 'Không được để trống tên',
            'title.unique' => 'Tên danh mục phim đã tồn tại',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request -> all();
        $link = Link::find($id);
        $link -> name = $data['title'];
        $link -> description = $data['description'];
        $link -> status = $data['status'];
        $link -> save();
        toastr()->success('Cập nhật dữ liệu thành công!', 'Chúc mừng');
        return redirect()->route('link.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Link::find($id) -> delete();
        Episode::where('link',$id)->delete();
        toastr()->warning('Xóa dữ liệu thành công!', 'Chúc mừng');
        return redirect()->route('link.index');
    }
}
