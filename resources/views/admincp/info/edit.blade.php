@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chỉnh sửa thông tin website</div>
                <div class="card-body">
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
                    @if (isset($info))
                    {!! Form::open(['route' => ['info.update',$info -> id],'method'=>'PUT','enctype' =>'multipart/form-data']) !!}
                    @endif

                    <div class="form-group">
                        {!! Form::label('title', 'Title', []) !!}
                        {!! Form::text('title', isset($info) ? $info ->title : '', ['class'=>'form-control', 'placeholder'=>'Tên Danh Mục', 'id' => 'slug', 'onkeyup' => 'ChangeToSlug()']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Description', []) !!}
                        {!! Form::textarea('description', isset($info) ? $info ->description : '', ['class'=>'form-control', 'placeholder'=>'Mô tả', 'id' => 'description']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('logo', 'Hình ảnh', []) !!}
                        {!! Form::file('logo', ['class' =>'form-controll-file']) !!}
                        <img width="10%" src="{{asset('uploads/logos/' .$info->logo)}}" alt="">
                    </div>
                    {!! Form::submit('Cập nhật', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
