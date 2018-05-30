@extends('layouts.app')
@section('title')
  {{$title}}
  <div class="pull-right">
    <a href="{{url()->previous()}}" class="btn btn-primary btn-sm">Back</a>
  </div>
@endsection
@section('content')
<form class="form-horizontal" name="editService" action="{{route('services.update',['id'=>$data->id])}}" method="post">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <div class="form-group" id="descriptionGroup">
        <label for="description" class="col-md-4 control-label">Description</label>

        <div class="col-md-6">
            <textarea id="description" class="form-control" name="description"  rows="4" cols="80" autofocus>{{$data->description}}</textarea>
        </div>
        <div id="descriptionMsg"></div>
    </div>

    <div class="form-group" id="linkGroup">
        <label for="link" class="col-md-4 control-label">link</label>
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-addon"><a href="{!!$data->link!=null?url("http://".$data->link):''!!}">GO!</a></span>
                <input id="link" type="text" class="form-control" name="link" value="{!!$data->link!!}" autofocus>
            </div>
        </div>
        <div id="linkMsg"></div>
    </div>

    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <input type="submit" class="btn btn-primary" value="Update">
        </div>
    </div>
</form>
@endsection
@section('scripts')
  <script>
    $(document).ready(function() {
        $('Form[name="editService"]').submit(function(e) {
            if ($('#description').val().length != 0 && $('#link').val().length != 0) {
                return;
            }
            if ($('#description').val().length == 0) {
              $('#descriptionGroup').addClass('has-error').show();
              $("#descriptionMsg").html('<span class="help-block"><strong>Description Is Required!</strong></span>').show();
            }
            if ($('#link').val().length == 0) {
              $('#linkGroup').addClass('has-error').show();
              $("#linkMsg").html('<span class="help-block"><strong>Link Is Required!</strong></span>').show();
            }
            e.preventDefault();
        });
    });
  </script>
@endsection
