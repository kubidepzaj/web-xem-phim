@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sửa Phim</div>

                <div class="card-body">
                    @if (isset($movie))
                    {!! Form::open(['route' => ['movie.update',$movie -> id],'method'=>'PUT','enctype' =>'multipart/form-data']) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('title', 'Title', []) !!}
                        {!! Form::text('title', $movie ->title, ['class'=>'form-control', 'placeholder'=>'Tên Phim', 'id' => 'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug', 'Slug', []) !!}
                        {!! Form::text('slug', $movie ->slug, ['class'=>'form-control', 'placeholder'=>'Tên Slug' , 'id' => 'convert_slug']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('time', 'Thời lượng phim', []) !!}
                        {!! Form::text('time', $movie ->time, ['class'=>'form-control', 'placeholder'=>'time']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('category', 'Danh Mục', []) !!}
                        {!! Form::select('category_id', $category, $movie ->category_id, ['class'=>'form-control','id'=>'category-select']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('episode', 'Số tập', []) !!}
                        {!! Form::text('episode', $movie->number_episode, ['class'=>'form-control', 'placeholder'=>'số tập','id'=>'episode-input']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('genre', 'Thể loại', []) !!}
                        <select name="genre[]" id="genre" multiple>
                            @foreach ($list_genre as $id => $title)
                                @if (isset($movie_genre) && $movie_genre->contains($id))
                                    <option value="{{ $id }}" selected>{{ $title }}</option>
                                @else
                                    <option value="{{ $id }}">{{ $title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description', []) !!}
                        {!! Form::textarea('description', $movie ->description, ['class'=>'form-control', 'placeholder'=>'Mô tả', 'id' => 'description']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('tags', 'Từ Khóa', []) !!}
                        {!! Form::textarea('tags', $movie ->tags, ['class'=>'form-control', 'placeholder'=>'Mô tả', 'id' => 'description']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('active', 'Trạng Thái', []) !!}
                        {!! Form::select('status', ['1'=>'Hiển thị', '0'=>'Không hiển thị'], $movie ->status, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('quality', 'Chất lượng', []) !!}
                        {!! Form::select('quality', ['0'=>'HD', '1'=>'FullHD','2'=>'Cam'], $movie ->quality, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('subtitle', 'Phụ Đề', []) !!}
                        {!! Form::select('subtitle', ['0'=>'VietSub', '1'=>'Thuyết Minh'], $movie ->subtitle, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('hot_movie', 'Phim Hot', []) !!}
                        {!! Form::select('hot_movie', ['1'=>'Có', '0'=>'Không'], $movie ->hot_movie, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('country', 'Quốc Gia', []) !!}
                        {!! Form::select('country_id', $country, $movie ->country_id, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('image', 'Hình ảnh', []) !!}
                        {!! Form::file('image', ['class' =>'form-controll-file']) !!}
                        <img width="10%" src="{{asset('uploads/movies/' .$movie->image)}}" alt="">
                    </div>
                    {!! Form::submit('Sửa Phim', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
