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
    <form>
      <div class="panel-heading"><h3><b>Progres Kerja Praktek</b></h3></div>
      <div class="panel-body">
      @if ($role == 'STUDENT')
        <p class="text-muted">Upload Laporan Progres KP dalam bentuk pdf</p>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Progres 1</th>
                  <th>Progres 2</th>
                  <th>Progres 3</th>
                  <th>Progres 4</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="col-md-3">
                    <div class="form-group">
                      <input type="file" name="progres" class="form-control">
                    </div>
                  </td>
                  <td class="col-md-3">
                    <div class="form-group">
                      <input type="file" name="progres" class="form-control">
                    </div>
                  </td>
                  <td class="col-md-3">
                    <div class="form-group">
                      <input type="file" name="progres" class="form-control">
                    </div>
                  </td>
                  <td class="col-md-3">
                    <div class="form-group">
                      <input type="file" name="progres" class="form-control">
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      @endif
      @if ($role == 'LECTURER')
        <p class="text-muted">Masukan Jumlah Progress Mahasiswa :</p>
        <div class="row">
          <div class="col-md-1">
            <div class="form-group">
              <input type="text" name="" class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th>Progres 1</th>
                  <th>Progres 2</th>
                  <th>Progres 3</th>
                  <th>Progres 4</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="col-md-2">
                    <button class="btn btn-default">Lihat</button>
                  </td>
                  <td class="col-md-2">
                    <button class="btn btn-default">Lihat</button>
                  </td>
                  <td class="col-md-2">
                    <button class="btn btn-default">Lihat</button>
                  </td>
                  <td class="col-md-2">
                    <button class="btn btn-default">Lihat</button>
                  </td>
                </tr>
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
            <button class="btn btn-default">Back</button>
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection