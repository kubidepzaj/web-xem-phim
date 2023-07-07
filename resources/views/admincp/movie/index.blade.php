@extends('layouts.app')

@section('content')
{{-- <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card-header">Quản Lí Phim</div>
            <a href="{{route('movie.create')}}">
                     Thêm Phim
             </a> --}}
<div class="table-responsive">
    <table class="table table-responsive" id="tableMovie">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Tên Phim</th>
          <th scope="col">Tên Tiếng Anh</th>
          <th scope="col">Mô Tả</th>
          <th scope="col">Tags</th>
          <th scope="col">Trạng Thái</th>
          <th scope="col">Chất lượng</th>
          <th scope="col">Phụ Đề</th>
          <th scope="col">Slug</th>
          <th scope="col">Thời lượng</th>
          <th scope="col">Danh Mục</th>
          <th scope="col">Số tập</th>
          <th scope="col">Thể Loại</th>
          <th scope="col">Phim Hot</th>
          <th scope="col">Ảnh</th>
          <th scope="col">Quốc Gia</th>

          <th scope="col">Năm Phim</th>
          <th scope="col">Top Views</th>
          <th scope="col">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($list as $key => $movie)
        <tr>
            <th scope="row">{{$key + 1}}</th>
            <td>{{$movie->title}}</td>
            <td>{{$movie->eng_name}}</td>
            <td>
              @if (strlen($movie->description)> 100)
                @php
                    $description = substr($movie->description,0,30);
                    echo $description.'...'
                @endphp
                @else
                {{$movie->description}}
              @endif
            </td>
            <td>
              @if (strlen($movie->tags)> 150)
              @php
                  $tags = substr($movie->tags,0,30);
                  echo $tags.'...'
              @endphp
              @elseif(!empty($movie->eng_name))
                {{$movie->title}}
              @else
                {{($movie->tags)}}
            @endif
            </td>
            <td>
                @if ($movie ->status)
                    Hoạt động
                @else
                    Ẩn
                @endif
            </td>
            <td>
              @if ($movie ->quality== 0)
                  HD
              @elseif($movie ->quality== 1)
                  FullHD
              @elseif($movie ->quality== 2)
                  Cam
              @endif
          </td>
          <td>
            @if ($movie ->subtitle)
              Thuyết Minh
            @else
              VietSub
            @endif
        </td>
            <td>{{$movie->slug}}</td>
            <td>{{$movie->time}}</td>
            <td>{{$movie->category->title}}</td>

            <td>{{$movie->episode_count}}/{{$movie->number_episode}} tập -
                @if ($movie->episode_count == $movie->number_episode)
                  Hoàn Thành
                @else
                  Chưa Hoàn Thành
                @endif
            </td>
            <td>
              @foreach ($movie->movie_genre as $item)
              <span class="badge badge-dark">
                {{$item->title}}
              </span>
              @endforeach
            </td>
            <td>
              @if ($movie ->hot_movie)
                Có
              @else
                Không
              @endif
            </td>
            <td><img width="100" src="{{asset('uploads/movies/' .$movie->image)}}" alt=""></td>
            <td>{{$movie->country->title}}</td>

            <td>
              {!!Form::selectYear('year',2000,2023,isset($movie->year) ? $movie->year : '',['class'=>'select-year','id'=>$movie->id,'placeholder' => 'Năm']) !!}
            </td>
            <td>
              {!! Form::select('topview', ['0'=>'Ngày', '1'=>'Tuần','2'=>'Tháng'],isset($movie->topview) ? $movie->topview : '', ['class'=>'select-topview','id'=>$movie->id, 'placeholder' => 'Topviews']) !!}
            </td>
            <td>
                {!! Form::open(['method' => 'DELETE','route'=>['movie.destroy', $movie -> id],'onsubmit'=> 'return confirm("Bạn có muốn xóa")']) !!}
                    {!! Form::submit('Xóa', ['class' => "btn btn-danger"]) !!}
                {!! Form::close() !!}
                <a href="{{route('movie.edit', $movie -> id)}}" class="btn btn-warning">Sửa</a>
                <a href="{{route('add-episode',[$movie->id])}}" class="btn btn-warning">
                  Thêm Tập Phim
          </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    </div>

        {{-- </div>
    </div>
</div> --}}
@endsection
