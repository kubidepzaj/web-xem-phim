<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Category::orderBy('id','ASC')->get();
        return view('admincp.category.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $data = $request -> all();
    //     $category = new Category();
    //     $category -> title = $data['title'];
    //     $category -> description = $data['description'];
    //     $category -> status = $data['status'];
    //     $category -> slug = $data['slug'];
    //     $category -> save();
    //     $list = Category::all();
    //     return view('admincp.category.index',compact('list')); ;
    // }
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
    $data = $request->all();
    $category = new Category();
    $category->fill($data);
    $category->save();

    $list = Category::all();
    toastr()->success('Thêm dữ liệu thành công!', 'Chúc mừng');
    return view('admincp.category.index', compact('list'));
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
        $category = Category::find($id);
        $list = Category::orderBy('id','ASC')->get();
        return view('admincp.category.edit',compact('category','list'));
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
            'slug' => 'required'
        ],[
            'title.regex' => 'Nhập sai định dạng',
            'title.required' => 'Không được để trống tên',
            'title.unique' => 'Tên danh mục phim đã tồn tại',
            'slug.required' => 'Không được để trống slug',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request -> all();
        $category = Category::find($id);
        $category -> title = $data['title'];
        $category -> description = $data['description'];
        $category -> status = $data['status'];
        $category -> slug = $data['slug'];
        $category -> save();
        toastr()->success('Cập nhật dữ liệu thành công!', 'Chúc mừng');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id) -> delete();
        toastr()->success('Xóa dữ liệu thành công!', 'Chúc mừng');
        return redirect()->route('category.index');
    }

    public function resorting_category(Request $request)
    {
        $data = $request->all();

        foreach($data['array_id'] as $key =>$value) {
            $category = Category::find($value);
            $category->position = $key;
            $category->save();
        }
    }
}
