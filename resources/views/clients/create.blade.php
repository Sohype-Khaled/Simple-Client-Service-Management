@extends('layouts.app')
@section('title')
  {{$title}}
  <div class="pull-right">
      <a href="{{url()->previous()}}" class="btn btn-primary btn-sm">Back</a>
  </div>
@endsection
@section('content')
    <form class="form-horizontal" name="createClient" action="{{route('clients.store')}}" method="post">
        {{csrf_field()}}
        <div class="form-group" id="titleGroup">
            <label for="title" class="col-md-4 control-label">Title</label>

            <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" placeholder="Title" autofocus>
            </div>
            <div id="titleMsg"></div>
        </div>

        <div class="form-group" id="statusGroup">
            <label for="status" class="col-md-4 control-label">Status</label>

            <div class="col-md-6">
                <input id="status" type="text" class="form-control" name="status" placeholder="Status" autofocus>
            </div>
            <div id="statusMsg"></div>
        </div>

        <div class="form-group" id="descriptionGroup">
            <label for="description" class="col-md-4 control-label">Description</label>

            <div class="col-md-6">
                <textarea id="description" class="form-control" name="description" placeholder="Description" rows="4" cols="80" autofocus></textarea>
            </div>
            <div id="descriptionMsg"></div>
        </div>

        <div class="form-group" id="phoneGroup">
            <label for="phone" class="col-md-4 control-label">Phone</label>

            <div class="col-md-6">
                <input id="phone" type="text" class="form-control" name="phone" placeholder="Phone" autofocus>
            </div>
            <div id="phoneMsg"></div>
        </div>

        <div class="form-group" id="startDateGroup">
            <label for="contract_start_date" class="col-md-4 control-label">Contract Start Date</label>

            <div class="col-md-6">
                <input type="datetime-local" name="contract_start_date" class="form-control" id="contract_start_date" autofocus>
            </div>
            <div id="startDateMsg"></div>
        </div>

        <div class="form-group" id="endDateGroup">
            <label for="contract_end_date" class="col-md-4 control-label">Contract End Date</label>

            <div class="col-md-6">
                <input type="datetime-local" name="contract_end_date" class="form-control" id="contract_end_date" autofocus>
            </div>
            <div id="endDateMsg"></div>
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
        $('Form[name="createClient"]').submit(function(e) {
            if ($('#title').val().length != 0 && $('#status').val().length != 0
                && $('#description').val().length != 0 && $('#phone').val().length != 0
                && $('#contract_start_date').val().length != 0 && $('#contract_end_date').val().length != 0) {
                return;
            }
            if ($('#title').val().length == 0) {
              $('#titleGroup').addClass('has-error').show();
              $("#titleMsg").html('<span class="help-block"><strong>Title Is Required!</strong></span>').show();
            }
            if ($('#status').val().length == 0) {
              $('#statusGroup').addClass('has-error').show();
              $("#statusMsg").html('<span class="help-block"><strong>Status Is Required!</strong></span>').show();
            }
            if ($('#description').val().length == 0) {
              $('#descriptionGroup').addClass('has-error').show();
              $("#descriptionMsg").html('<span class="help-block"><strong>Description Is Required!</strong></span>').show();
            }
            if ($('#phone').val().length == 0) {
              $('#phoneGroup').addClass('has-error').show();
              $("#phoneMsg").html('<span class="help-block"><strong>Phone Is Required!</strong></span>').show();
            }
            if ($('#contract_start_date').val().length == 0) {
              $('#startDateGroup').addClass('has-error').show();
              $("#startDateMsg").html('<span class="help-block"><strong>Cntract Start Date Is Required!</strong></span>').show();
            }
            if ($('#contract_end_date').val().length == 0) {
              $('#endDateGroup').addClass('has-error').show();
              $("#endDateMsg").html('<span class="help-block"><strong>Cntract End Date Is Required!</strong></span>').show();
            }
            e.preventDefault();
        });
    });
  </script>
@endsection
