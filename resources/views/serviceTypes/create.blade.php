@extends('layouts.app')
@section('title')
  {{$title}}
@endsection
@section('content')
    <form class="form-horizontal" name="createServiceType" action="{{route('service-types.store')}}" method="post">
        {{csrf_field()}}
        <div class="form-group" id="titleGroup">
            <label for="title" class="col-md-4 control-label">title</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" placeholder="Title" autofocus>
            </div>
            <div id="titleMsg"></div>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <input type="submit" id="submit" class="btn btn-primary" value="Create">
            </div>
        </div>
    </form>

@endsection
@section('scripts')
  <script>
    $(document).ready(function() {
        $('Form[name="createServiceType"]').submit(function(e) {
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
