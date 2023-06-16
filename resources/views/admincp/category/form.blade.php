@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quản Lí Danh Mục Phim</div>

                <div class="card-body">
                    {!! Form::open(['route' => 'category.store','method'=>'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title', []) !!}
                        {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Tên Danh Mục', 'id' => 'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug', 'Slug', []) !!}
                        {!! Form::text('slug', null, ['class'=>'form-control', 'placeholder'=>'Tên Danh Mục' , 'id' => 'convert_slug']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description', []) !!}
                        {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder'=>'Mô tả', 'id' => 'description']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('active', 'Trạng Thái', []) !!}
                        {!! Form::select('status', ['1'=>'Hiển thị', '0'=>'Không hiển thị'], null, ['class'=>'form-control']) !!}
                    </div>
                    {!! Form::submit('Thêm danh mục', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
