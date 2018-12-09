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
        <input type="file" name="file_progres" class="form-control col-md-3" required>
        <div class="row">
        <p class="text-muted">Jumlah Progres yang Harus dilakukan Mahasiswa :</p>
          <div class="col-md-1">
            <div class="form-group">
              <input type="text" name="jumlah_progres" class="form-control" value="{{$progres->jumlah_progres}}" disabled>
            </div>
          </div>
          <div class="col-md-12">
            <table class="table table-bordered text-center">
            <!-- {{$a = 0}} -->
              @foreach($file_progres as $key => $file_progres)
              <!-- {{$a = $a + 1}} -->
              <thead>
                <tr>
                  <th>Progres {{$key+1}}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="col-md-2">
                    <a href="{{url('/download_progres/'.$file_progres->id)}}" class="btn btn-default">Lihat</a>
                    <a href="{{url('/hapus_progres/'.$file_progres->id)}}" method="get" class="btn btn-default">Hapus</a>
                  </td>
                </tr>
              </tbody>
              @endforeach
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
          <div class="col-md-12">
            <table class="table table-bordered text-center">
              @foreach($file_progres as $file_progres)
              <thead>
                <tr>
                  <th>Progres {{$file_progres->id}}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="col-md-2">
                    <a href="{{url('/download_progres/'.$file_progres->id)}}" class="btn btn-default">Lihat</a>
                  </td>
                </tr>
              </tbody>
              @endforeach
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