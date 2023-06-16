@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm tập phim</div>
                <div class="card-body">
                    {!! Form::open(['route' => 'episode.store','method'=>'POST','enctype' =>'multipart/form-data','id' => 'form_episode']) !!}

                    <div class="form-group">
                        {!! Form::label('movie', 'Chọn Phim', []) !!}
                        {!! Form::select('movie_id', ['' => 'Chọn phim'] + $list_movie->all(), null, ['class' => 'form-control select-movie']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('episode', 'Tập Phim', []) !!}
                        <select name="episode" id="show_episode" class="form-control" required>
                        </select>
                    </div>
                    <div class="form-group">
                        {!! Form::label('link', 'Link Phim', []) !!}
                        {!! Form::text('link', null, ['class'=>'form-control', 'placeholder'=>'link', 'id' => 'link']) !!}
                    </div>
                    {!! Form::submit('Thêm Tập Phim', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
