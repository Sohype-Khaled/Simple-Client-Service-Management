@extends('layouts.app')

@section('title')
  {{$title}}
  <div class="pull-right">
      @if (\Route::has(strstr(\Route::currentRouteName(),'.',true).'.create'))
        <a href="{{route(strstr(\Route::currentRouteName(),'.',true).'.create')}}" class="btn btn-primary btn-sm">Add +</a>
      @endif
      <a href="{{url()->previous()}}" class="btn btn-primary btn-sm">Back</a>
  </div>
@endsection

@section('content')

  {{-- <div class="table-responsive"> --}}
      @if ($data->count() != 0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    @foreach ($data[0]->toArray() as $key => $value)
                      <th>{{$key}}</th>
                    @endforeach
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $record)
                    <tr>
                        @foreach ($record->toArray() as $key => $element)
                            <td>{{$element}}</td>
                        @endforeach
                        <td><a href="{{route(strstr(\Route::currentRouteName(),'.',true).'.edit',['id'=>$record->id])}}" class="btn btn-primary btn-block">Manage</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      @else
        no data available!
      @endif
  {{-- </div> --}}

@endsection
