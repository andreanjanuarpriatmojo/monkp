<!doctype html>
<html>
<head>
  <title>
    [Monitoring Kerja Praktik] Home
  </title>
  <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
</head>
<body>
  <div class="jumbotron" style="background-color:#428bca;">
    <div class="container">
      <h2 style="color:#fff;">
        Monitoring Kerja Praktik
        <small style="color:#ddd;">Institut Teknologi Sepuluh Nopember</small>
      </h2>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-offset-4 col-md-4">
        <form action="{{url('/loginx')}}" method="post">
          <h4>Login</h4>
          @if (count($errors) > 0)
            <div class="alert alert-info">
              <strong>Whoops!</strong> {{$errors->first()}}
            </div>
          @endif
          <div class="form-group form-group-lg">
            <input class="form-control" placeholder="Username / NRP" name="username" type="text" value="{{old('username')}}" autofocus>
          </div>
          <div class="form-group form-group-lg">
            <input class="form-control" placeholder="Password" name="password" type="password" value="">
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <p>Silakan <a href="{{url('/register')}}">register</a> jika belum punya akun.</p>
          <p><a href="{{asset('/PanduanMONKP.pdf')}}">Download</a> Panduan Kerja Praktik.</p>  
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
