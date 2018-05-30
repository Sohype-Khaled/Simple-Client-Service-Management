@extends('layouts.app')
@section('title')
  {{$title}}
  <div class="pull-right">
    <a href="#" data-toggle="modal" data-target="#delete" class="btn btn-danger btn-sm">Delete</a>
    <a href="{{url()->previous()}}" class="btn btn-primary btn-sm">Back</a>
  </div>
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Delete "{{$data->title}}" Service Type!</h4>
      </div>
      <form action="{{route('service-types.destroy',['id'=>$data->id])}}" method="POST">
        <div class="modal-body">
          {{csrf_field()}}
          {{method_field('DELETE')}}
          <div class="alert alert-danger" role="alert">Are You Sure!</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('content')
<form class="form-horizontal" name="editServiceType" action="{{route('service-types.update',['id'=>$data->id])}}" method="post">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <div class="form-group" id="titleGroup">
        <label for="title" class="col-md-4 control-label">title</label>

        <div class="col-md-6">
            <input id="title" type="text" class="form-control" name="title" value="{{$data->title}}" autofocus>
        </div>
        <div id="titleMsg"></div>
    </div>

    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <input type="submit" id="submit" class="btn btn-primary" value="Edit">
        </div>
    </div>
</form>
@endsection
@section('scripts')
  <script>
    $(document).ready(function() {
        $('Form[name="editServiceType"]').submit(function(e) {
            if ($('#title').val().length != 0) {
                return;
            }
            $('#titleGroup').addClass('has-error').show();
            $("#titleMsg").html('<span class="help-block"><strong>Title Is Required!</strong></span>').show();
            e.preventDefault();
        });
    });
  </script>
@endsection
