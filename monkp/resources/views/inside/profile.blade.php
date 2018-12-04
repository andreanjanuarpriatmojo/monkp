@extends('inside.template')

@section('content')
  <h1>Profile</h1>
  <hr>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-6">
          @if (count($errors) > 0)
            <div class="alert alert-info">{{$errors->first()}}</div>
          @endif
          <h4><strong>Ganti password:</strong></h4>
          <form action="{{url('/profilex')}}" method="post" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="control-label col-md-4">Old Password</label>
              <div class="col-md-8">
                <input type="password" name="old_password" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">New Password</label>
              <div class="col-md-8">
                <input type="password" name="password" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4">Confirm Password</label>
              <div class="col-md-8">
                <input type="password" name="password_confirmation" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-3 col-md-offset-4">
                <input type="submit" value="Submit" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
