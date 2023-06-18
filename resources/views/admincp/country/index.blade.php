@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">Quản Lí Quốc Gia</div>
            <a href="{{route('country.create')}}">
                     Thêm Quốc Gia
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
        @foreach ($list as $key => $country)
        <tr>
            <th scope="row">{{$key + 1}}</th>
            <td>{{$country->title}}</td>
            <td>{{$country->description}}</td>
            <td>
                @if ($country -> status)
                    Hoạt động
                @else
                    Ẩn
                @endif
            </td>
            <td>{{$country->slug}}</td>
            <td>
                {!! Form::open(['method' => 'DELETE','route'=>['country.destroy', $country -> id],'onsubmit'=> 'return confirm("Bạn có muốn xóa")']) !!}
                    {!! Form::submit('Xóa', ['class' => "btn btn-danger"]) !!}
                {!! Form::close() !!}
                <a href="{{route('country.edit', $country -> id)}}" class="btn btn-warning">Sửa</a>
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
