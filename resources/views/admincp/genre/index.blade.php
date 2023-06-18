@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">Quản Lí Thể Loại</div>
            <a href="{{route('genre.create')}}">
                     Thêm Thể Loại
             </a>
<div class="container table-responsive py-5">
    <table class="table table-bordered table-hover" id="tableMovie">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Tên Quốc Gia</th>
          <th scope="col">Mô Tả</th>
          <th scope="col">Trạng Thái</th>
          <th scope="col">Slug</th>
          <th scope="col">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($list as $key => $genre)
        <tr>
            <th scope="row">{{$key + 1}}</th>
            <td>{{$genre->title}}</td>
            <td>{{$genre->description}}</td>
            <td>
                @if ($genre -> status)
                    Hoạt động
                @else
                    Ẩn
                @endif
            </td>
            <td>{{$genre->slug}}</td>
            <td>
                {!! Form::open(['method' => 'DELETE','route'=>['genre.destroy', $genre -> id],'onsubmit'=> 'return confirm("Bạn có muốn xóa")']) !!}
                    {!! Form::submit('Xóa', ['class' => "btn btn-danger"]) !!}
                {!! Form::close() !!}
                <a href="{{route('genre.edit', $genre -> id)}}" class="btn btn-warning">Sửa</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    </div>

        </div>
    </div>
</div>
@endsection
