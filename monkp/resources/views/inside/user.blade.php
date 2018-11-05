@extends('inside.template')

@section('content')
  <h1>Buat Akun</h1>
  <hr>
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
  @if (session('alert'))
    <div class="alert alert-{{session('alert')['alert']}} alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      {{session('alert')['body']}}
    </div>
  @endif
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">Tambah Mahasiswa</div>
        <div class="panel-body">
          <form action="{{url('/users/mahasiswa')}}" method="post" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="col-md-4 control-label">Nama</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="student[name]" value="{{old('student.name')}}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">NRP</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="student[nrp]" value="{{old('student.nrp')}}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Password</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="student[password]">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
            </div>
          </form>
        </div>
      </div>    
    </div>
        <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">Tambah Dosen</div>
        <div class="panel-body">
          <form action="{{url('/users/dosen')}}" method="post" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="col-md-4 control-label">Nama</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="lecturer[name]" value="{{old('lecturer.name')}}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Nama Lengkap</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="lecturer[full_name]" value="{{old('lecturer.full_name')}}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">NIP</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="lecturer[nip]" value="{{old('lecturer.nip')}}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Inisial</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="lecturer[initial]" value="{{old('lecturer.initial')}}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Password</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="lecturer[password]">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
            </div>
          </form>
        </div>
      </div>    
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">Restore Password Mahasiswa</div>
        <div class="panel-body">
          <form action="{{url('/users/reset')}}" method="post" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="col-md-4 control-label">NRP</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="student[nrp]" value="{{old('student.nrp')}}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Password</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="student[password]">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">Restore</button>
              </div>
            </div>
          </form>
        </div>
      </div>    
    </div>
        <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">Restore Password Dosen</div>
        <div class="panel-body">
          <form action="{{url('/users/reset')}}" method="post" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="col-md-4 control-label">NIP</label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="lecturer[nip]" value="{{old('lecturer.nip')}}">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label">Password</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="lecturer[password]">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">Restore</button>
              </div>
            </div>
          </form>
        </div>
      </div>    
    </div>
  </div>
@endsection