@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm Phim</div>

                <div class="card-body">
                    {!! Form::open(['route' => 'movie.store','method'=>'POST','enctype' =>'multipart/form-data']) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title', []) !!}
                        {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Tên Phim', 'id' => 'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug', 'Slug', []) !!}
                        {!! Form::text('slug', null, ['class'=>'form-control', 'placeholder'=>'Tên Slug' , 'id' => 'convert_slug']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('time', 'Thời lượng', []) !!}
                        {!! Form::text('time', null, ['class'=>'form-control', 'placeholder'=>'time']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('category', 'Danh Mục', ['for' => 'category-select']) !!}
                        {{-- {!! Form::hidden('slug', $category->slug) !!} --}}
                        {!! Form::select('category_id', $category, null, ['class'=>'form-control', 'id'=>'category-select']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('episode', 'Số tập', ['for' => 'episode-input']) !!}
                        {!! Form::text('episode', null, ['class'=>'form-control', 'placeholder'=>'số tập', 'id'=>'episode-input']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('genre', 'Thể loại', []) !!}</br>
                        {{-- {!! Form::select('genre[]', $list_genre, null, ['multiple'=>'multiple','genre'=>'id']) !!} --}}

                        {{-- @foreach ($list_genre as $key =>$genre)
                            {!! Form::checkbox('genre[]',$genre->id) !!}
                            {!! Form::label('genre', $genre->title) !!}
                        @endforeach --}}
                        <select name="genre[]" id="genre" multiple>
                            @foreach ($list_genre as $id =>$title)
                            <option value="{{$id}}">{{$title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description', []) !!}
                        {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder'=>'Mô tả', 'id' => 'description']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('tags', 'Từ Khóa', []) !!}
                        {!! Form::textarea('tags', null, ['class'=>'form-control', 'placeholder'=>'Mô tả', 'id' => 'description']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('active', 'Trạng Thái', []) !!}
                        {!! Form::select('status', ['1'=>'Hiển thị', '0'=>'Không hiển thị'], null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('quality', 'Chất lượng', []) !!}
                        {!! Form::select('quality', ['0'=>'HD', '1'=>'FullHD','2'=>'Cam'], null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('subtitle', 'Phụ Đề', []) !!}
                        {!! Form::select('subtitle', ['0'=>'VietSub', '1'=>'Thuyết Minh'], null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('hot_movie', 'Phim Hot', []) !!}
                        {!! Form::select('hot_movie', ['1'=>'Có', '0'=>'Không'], null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('country', 'Quốc Gia', []) !!}
                        {!! Form::select('country_id', $country, null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('image', 'Hình ảnh', []) !!}
                        {!! Form::file('image', ['class' =>'form-controll-file']) !!}
                    </div>
                    {!! Form::submit('Thêm phim', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
