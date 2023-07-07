@extends('layouts.app')

@section('content')
    <table class="table table-bordered table-hover" id="tableMovie">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Tên</th>
          <th scope="col">Mô Tả</th>
          <th scope="col">Logo</th>
        </tr>
      </thead>
      <tbody class="order_position">
        @foreach ($list as $key => $info)
        <tr id="{{$info->id}}">
            <th scope="row">{{$key + 1}}</th>
            <td>{{$info->title}}</td>
            <td>{{$info->description}}</td>
            <td><img width="100" src="{{asset('uploads/logos/' .$info->logo)}}" alt=""></td>
          </tr>
        @endforeach
      </tbody>
    </table>
@endsection
