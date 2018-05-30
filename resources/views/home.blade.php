@extends('layouts.app')
@section('title')
  {{$title}}
@endsection
@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    Welcome, {{auth()->user()->name}}!

@endsection
