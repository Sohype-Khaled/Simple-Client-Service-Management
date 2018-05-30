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
          <h4 class="modal-title" id="exampleModalLabel">Delete Client "{{$data->title}}"!</h4>
        </div>
        <form action="{{route('clients.destroy',['id'=>$data->id])}}" method="POST">
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
    <ul class="nav nav-tabs" role="tablist">
      <li><a href="#data" role="tab" data-toggle="tab">Cleint Data</a></li>
      <li class="active"><a href="#services" role="tab" data-toggle="tab">Client Services</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane" id="data">
        <br>
        <form class="form-horizontal" name="editClientData" action="{{route('clients.update',['id'=>$data->id])}}" method="post">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group" id="titleGroup">
                <label for="title" class="col-md-4 control-label">Title</label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="title" value="{{$data->title}}" autofocus>
                </div>
                <div id="titleMsg"></div>
            </div>

            <div class="form-group" id="statusGroup">
                <label for="status" class="col-md-4 control-label">Status</label>

                <div class="col-md-6">
                    <input id="status" type="text" class="form-control" name="status" value="{{$data->status}}" autofocus>
                </div>
                <div id="statusMsg"></div>
            </div>

            <div class="form-group" id="descriptionGroup">
                <label for="description" class="col-md-4 control-label">Description</label>

                <div class="col-md-6">
                    <textarea id="description" class="form-control" name="description"  rows="4" cols="80" autofocus>{{$data->description}}</textarea>
                </div>
                <div id="descriptionMsg"></div>
            </div>

            <div class="form-group" id="phoneGroup">
                <label for="phone" class="col-md-4 control-label">Phone</label>

                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control" name="phone" value="{{$data->phone}}" autofocus>
                </div>
                <div id="phoneMsg"></div>
            </div>

            <div class="form-group" id="startDateGroup">
                <label for="contract_start_date" class="col-md-4 control-label">Contract Start Date</label>

                <div class="col-md-6">
                    <input type="datetime-local" name="contract_start_date" class="form-control"  value="{{$data->contract_start_date}}" id="contract_start_date" autofocus>
                </div>
                <div id="startDateMsg"></div>
            </div>

            <div class="form-group" id="endDateGroup">
                <label for="contract_end_date" class="col-md-4 control-label">Contract End Date</label>

                <div class="col-md-6">
                    <input type="datetime-local" name="contract_end_date" class="form-control" value="{{$data->contract_end_date}}" id="contract_end_date" autofocus>
                </div>
                <div id="endDateMsg"></div>
            </div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <input type="submit" id="submit" class="btn btn-primary" value="Edit">
                </div>
            </div>
        </form>
      </div>
      <di class="tab-pane active" id="services">
          <br>
          <form class="form-horizontal" name="clientServices" action="{{route('clients.update',['id'=>$data->id])}}" method="post">
              {{csrf_field()}}
              {{method_field('PUT')}}
              <input type="hidden" name="filter" value="manage">
              <ul class="list-group">
                @foreach ($services as $service)
                    <li class="list-group-item">
                        <span class="checkbox">
                            @if ($data->ServiceType->contains($service->id))
                                <label>
                                  <input type="checkbox" name="type_id[]" value="{{$service->id}}" checked> {{$service->title}}
                                </label>
                                <a href="{{route('services.edit',['id'=>$data->Services()->where('type_id',$service->id)->first()->id])}}" class="btn btn-primary btn-sm pull-right">Manage</a>
                            @else
                                <label>
                                    <input type="checkbox" name="type_id[]" value="{{$service->id}}"> {{$service->title}}
                                </label>
                            @endif
                        </span>
                    </li>
                @endforeach
              </ul>
              <div class="form-group">
                  <div class="col-md-2 pull-right">
                      <input type="submit" id="addServices" class="btn btn-primary" value="Add Services">
                  </div>
              </div>
          </form>
      </div>
    </div>
@endsection
@section('scripts')
  <script>
    $(document).ready(function() {
        $('Form[name="editClientData"]').submit(function(e) {
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
