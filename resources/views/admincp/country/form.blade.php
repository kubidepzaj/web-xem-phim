@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm Quốc Gia</div>
                <di class="card-body">
                    @if ($errors->any())
                        <div id="errorPopup" class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    {!! Form::open(['route' => 'country.store','method'=>'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title', []) !!}
                        {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Tên Quốc Gia', 'id' => 'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('slug', 'Slug', []) !!}
                        {!! Form::text('slug', null, ['class'=>'form-control', 'placeholder'=>'...' , 'id' => 'convert_slug']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description', []) !!}
                        {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder'=>'Mô tả', 'id' => 'description']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('active', 'Trạng Thái', []) !!}
                        {!! Form::select('status', ['1'=>'Hiển thị', '0'=>'Không hiển thị'], null, ['class'=>'form-control']) !!}
                    </div>
                    {!! Form::submit('Thêm quốc gia', ['class'=>'btn btn-success mr-2']) !!}
                    {!! Form::close() !!}
                        <button onclick="goBack()" class="btn btn-warning">Trở về</button>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
