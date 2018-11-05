<!doctype html>
<html>
<head>
  <title>[Monitoring Kerja Praktik] Daftar</title>
  <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
  <script>
    function numberonly(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
      return true;
    }
  </script>
</head>
<body style="background-color:#555;">
  <div class="container" style="margin-top:6%;">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Daftar</div>
          <div class="panel-body">
            @if (count($errors) > 0)
              <div class="alert alert-warning">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form action="{{url('registerx')}}" method="post" class="form-horizontal">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <label class="col-md-4 control-label">Nama</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">
                  NRP
                  <i class="fa fa-info-circle text-primary" title="NRP akan digunakan sebagai username untuk login."></i>
                </label>
                <div class="col-md-6">
                  <input type="text" onkeypress="return numberonly(event)" class="form-control" name="nrp" value="{{ old('nrp') }}" required>
                </div>
                <div class="col-md-1">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">No HP</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" onkeypress="return hanyaAngka(event)"  name="nohp" value="{{ old('nohp') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Password</label>
                <div class="col-md-6">
                  <input type="password" class="form-control" name="password" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label">Konfirmasi Password</label>
                <div class="col-md-6">
                  <input type="password" class="form-control" name="password_confirmation" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <a href="{{url('/')}}" class="btn btn-default">Back</a>
                  <button type="submit" class="btn btn-primary">Register</button>
                  <button type="reset" class="btn btn-default">Reset</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
  <script type="text/javascript">
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))return false;
        return true;
    }
  </script>
</body>
</html>
