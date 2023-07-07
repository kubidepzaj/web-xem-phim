@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}}
    <div class="row justify-content-center">
        {{-- <div class="col-md-12"> --}}
{{-- <div class="container table-responsive py-5"> --}}
    <table class="table table-bordered table-hover" id="tableMovie">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Tên Danh Mục</th>
          <th scope="col">Mô Tả</th>
          <th scope="col">Trạng Thái</th>
          <th scope="col">Slug</th>
          <th scope="col">Hành Động</th>
        </tr>
      </thead>
      <tbody class="order_position">
        @foreach ($list as $key => $cate)
        <tr id="{{$cate->id}}">
            <th scope="row">{{$key + 1}}</th>
            <td>{{$cate->title}}</td>
            <td>{{$cate->description}}</td>
            <td>
                @if ($cate -> status)
                    Hoạt động
                @else
                    Ẩn
                @endif
            </td>
            <td>{{$cate->slug}}</td>
            <td>
                {!! Form::open(['method' => 'DELETE','route'=>['category.destroy', $cate -> id],'onsubmit'=> 'return confirm("Bạn có muốn xóa")']) !!}
                    {!! Form::submit('Xóa', ['class' => "btn btn-danger"]) !!}
                {!! Form::close() !!}
                <a href="{{route('category.edit', $cate -> id)}}" class="btn btn-warning">Sửa</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{-- </div> --}}
        {{-- </div> --}}
    </div>
{{-- </div> --}}
@endsection
