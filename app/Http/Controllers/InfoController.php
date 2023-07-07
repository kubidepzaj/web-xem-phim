<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;
use Illuminate\Support\Facades\Validator;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Info::orderBy('id','ASC')->get();
        return view('admincp.info.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Info::find(1);
        return view('admin.info.edit',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $info = Info::find(1);
        $list = Info::orderBy('id','ASC')->get();
        return view('admincp.info.edit',compact('info','list'));
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
            // 'status' => 'required',
            'description' => 'required',
        ],[
            'title.regex' => 'Nhập sai định dạng',
            'title.required' => 'Không được để trống tên',
            'description.required' => 'Không được để trống mô tả',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request -> all();
        $info = Info::find(1);
        $info -> title = $data['title'];
        $info -> description = $data['description'];
        $get_image = $request->file('logo');

        if ($get_image) {
            if (!empty($info->logo) && file_exists('uploads/logos/'.$info->logo)) {
                unlink('uploads/logos/'.$info->logo);
            }

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/logos',$new_image);
            $info->logo = $new_image;
        }
        $info -> save();
        toastr()->success('Cập nhật dữ liệu thành công!', 'Chúc mừng');
        return redirect()->route('info.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
