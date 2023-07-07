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
          <th scope="col">Hành Động</th>
        </tr>
      </thead>
      <tbody class="order_position">
        @foreach ($list as $key => $link)
        <tr id="{{$link->id}}">
            <th scope="row">{{$key + 1}}</th>
            <td>{{$link->name}}</td>
            <td>{{$link->description}}</td>
            <td>
                @if ($link -> status)
                    Hoạt động
                @else
                    Ẩn
                @endif
            </td>
            <td>
                {!! Form::open(['method' => 'DELETE','route'=>['link.destroy', $link ->id],'onsubmit'=> 'return confirm("Bạn có muốn xóa")']) !!}
                    {!! Form::submit('Xóa', ['class' => "btn btn-danger"]) !!}
                {!! Form::close() !!}
                <a href="{{route('link.edit', $link ->id)}}" class="btn btn-warning">Sửa</a>
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
