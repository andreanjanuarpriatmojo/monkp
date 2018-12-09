@extends('inside.template')
<meta name="csrf-token" content="{{ csrf_token() }}">
<?php $role = Auth::user()->role;
  if ($role == 'ADMIN' || $role == 'LECTURER' || $role == 'TU'){
    $id_dosen = Auth::user()->personable->nip;  
  }
  else $id_dosen=-1;
  if($id_dosen== '198407082010122004')
  {
    $role='ADMIN';
  }
?>
@section('css')
  <style>
    .hidden-row {
      padding: 0px !important; 
    }
    .hidden-row > div:first-child {
      padding: 8px;
    }
    .form-horizontal .control-text {
      padding-top: 7px;
    }
    .table tr:nth-of-type(even) {
      border-top: 1px solid #ddd;
    }
  </style>
  {{-- <script type="text/javascript" src="{{asset('sweetalert.min.js')}}"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('sweet.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
  {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
@endsection
@section('content')
  <div class="panel panel-default" style="margin-top: 3em;">
    <form role="form" method="POST" action="{{url('/progres/'.$id)}}" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token()}}">
      <div class="panel-heading"><h3><b>Progres Kerja Praktek</b></h3></div>
      <div class="panel-body">
      @if ($role == 'STUDENT')
        <p class="text-muted">Upload Laporan Progres KP dalam bentuk pdf</p>
        <div class="row">
          <div class="form-group col-md-3">
            <input type="file" name="file_progres" class="form-control" required>
          </div>
        </div>
        <p class="text-muted"">Jumlah Progres yang Harus dilakukan Mahasiswa :</p>
        <div class="row">
          <div class="col-md-1">
            <div class="form-group">
              <input type="text" name="jumlah_progres" class="form-control" value="{{$progres->jumlah_progres}}" disabled>
            </div>
          </div>
          <div class="col-md-12"></div>
          <div class="col-md-5">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th>Progres ke - </th>
                  <th></th>
              </thead>
              <tbody>
                @foreach($file_progres as $key => $file_progres)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>
                    <a href="{{url('/download_progres/'.$file_progres->id)}}" class="btn btn-primary">Lihat</a>
                    <a href="{{url('/hapus_progres/'.$file_progres->id)}}" method="get" class="btn btn-danger">Hapus</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endif
      @if ($role == 'LECTURER')
        <p class="text-muted">Masukan Jumlah Progres yang Harus dilakukan Mahasiswa :</p>
        <div class="row">
          <div class="col-md-1">
            <div class="form-group">
              <input type="text" name="jumlah_progres" class="form-control" value="{{$progres->jumlah_progres}}">
            </div>
          </div>
          <div class="col-md-12"></div>
          <div class="col-md-5">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th>Progres ke - </th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($file_progres as $key => $file_progres)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>
                    <a href="{{url('/download_progres/'.$file_progres->id)}}" class="btn btn-primary">Lihat</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endif
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <a href="/home" class="btn btn-default">Back</a>
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection