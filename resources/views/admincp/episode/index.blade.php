@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">Quản Lí Tập Phim</div>
            <a href="{{route('episode.create')}}">
                     Thêm Tập Phim
             </a>
<div class="container table-responsive py-5">
    <table class="table table-bordered table-hover" id="tableMovie">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Tên Phim</th>
          <th scope="col">Tập Phim</th>
          <th scope="col">Link Phim</th>
          {{-- <th scope="col">Trạng Thái</th> --}}
          <th scope="col">Hành Động</th>
        </tr>
      </thead>
      <tbody class="order_position">
        @foreach ($list_episode as $key => $episode)
        <tr id="{{$episode->id}}">
            <th scope="row">{{$key + 1}}</th>
            <td>{{$episode->movie->title}}</td>
            <td>{{$episode->episode}}</td>
            <td>{!! $episode->movie_link !!}</td>
            {{-- <td>
                @if ($cate -> status)
                    Hoạt động
                @else
                    Ẩn
                @endif
            </td> --}}
            <td>
                {!! Form::open(['method' => 'DELETE','route'=>['episode.destroy', $episode->id],'onsubmit'=> 'return confirm("Bạn có muốn xóa")']) !!}
                    {!! Form::submit('Xóa', ['class' => "btn btn-danger"]) !!}
                {!! Form::close() !!}
                <a href="{{route('episode.edit', $episode->id)}}" class="btn btn-warning">Sửa</a>
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
