@extends('layouts.app')

 @section('content')
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="card">
                 <div class="card-header">Thêm tập phim</div>
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
                     {!! Form::open(['route' => 'episode.store','method'=>'POST','enctype' =>'multipart/form-data','id' => 'form_episode']) !!}
                     <div class="form-group">
                        {!! Form::label('link', 'Link Sever', []) !!}
                        {!! Form::select('link_server', ['' => '---Chọn link server---'] + $link->toArray(), null, ['class' => 'form-control', 'id' => 'link_server']) !!}
                    </div>
                     <div class="form-group">
                         {!! Form::label('movie', 'Chọn Phim', []) !!}
                         {!! Form::select('movie_id', ['' => '---Chọn phim---'] + $list_movie->all(), null, ['class' => 'form-control select-movie']) !!}
                     </div>
                     <div class="form-group">
                         {!! Form::label('episode', 'Tập Phim', []) !!}
                         <select name="episode" id="show_episode" class="form-control" required>
                             <option>---Chọn tập phim---</option>
                         </select>
                     </div>
                     <div class="form-group">
                         {!! Form::label('link', 'Link Phim', []) !!}
                         {!! Form::text('link', null, ['class'=>'form-control', 'placeholder'=>'link', 'id' => 'link', 'autocomplete'=> 'off']) !!}
                     </div>
                     {!! Form::submit('Thêm Tập Phim', ['class'=>'btn btn-success']) !!}
                     {!! Form::close() !!}
                 </div>
             </div>
         </div>
     </div>
 </div>
 @endsection


