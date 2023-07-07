@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sửa tập phim</div>

                <div class="card-body">
                    {!! Form::open(['route'=>['episode.update',$episode->id],'method'=>'PUT','enctype' =>'multipart/form-data']) !!}

                    <div class="form-group">
                        {!! Form::label('movie', 'Phim', []) !!}
                        {!! Form::hidden('movie_id', $episode->movie->id) !!}
                        {!! Form::text(null, $episode->movie->title, ['class'=>'form-control', 'readonly']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('link_server', 'Link Sever', []) !!}
                        {!! Form::select('link_server',$link,$episode->link, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('episode', 'Tập Phim', []) !!}
                        {!! Form::text('episode', $episode->episode, ['class'=>'form-control','readonly']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('link', 'Link Phim', []) !!}
                        {!! Form::text('link', $src, ['class'=>'form-control', 'placeholder'=>'link']) !!}
                    </div>
                    {!! Form::submit('Sửa', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
