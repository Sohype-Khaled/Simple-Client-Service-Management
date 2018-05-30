@extends('layouts.app')
@section('title')
  {{$title}}
  <div class="pull-right">
      <a href="{{url()->previous()}}" class="btn btn-primary btn-sm">Back</a>
  </div>
@endsection
@section('content')
  <ul class="list-group">
    @foreach ($data->toArray() as $infoKey => $info)
        <li class="list-group-item">
          <strong>{{$infoKey}}:</strong> {{$info}}
        </li>
    @endforeach
  </ul>
@endsection
