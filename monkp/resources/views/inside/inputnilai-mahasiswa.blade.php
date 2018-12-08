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
		<div class="panel-heading">Upload Penilain KP</div>
		<div class="panel-body">
		@if ($role == 'STUDENT')
			<p>Upload foto bukti penilaian perusahaan</p>
			<form>
				<div class="row">
					<div class="form-group col-md-4">
						<input type="file" name="buktinilai" class="form-control">
					</div>
					<div class="col-md-10">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>NRP</th>
		                          	<th>Nama Mahasiswa</th>
		                          	<th>Nilai</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>5115100001</td>
		                          	<td>Nama Mahasiswa 1</td>
		                          	<td class="col-md-3">
		                            	<div class="form-group">
		                                	<input type="text" name="nilai" class="form-control">
		                            	</div>
		                          </td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</form>
		@endif
		@if ($role == 'LECTURER')
			<p>Upload foto bukti penilaian perusahaan</p>
			<form>
				<div class="row">
					<div class="form-group col-md-4">
						<input type="file" name="buktinilai" class="form-control">
					</div>
					<div class="col-md-10">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>NRP</th>
		                          	<th>Nama Mahasiswa</th>
		                          	<th>Nilai</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>5115100001</td>
		                          	<td>Nama Mahasiswa 1</td>
		                          	<td class="col-md-3">
		                            	<div class="form-group">
		                                	<input type="text" name="nilai" class="form-control">
		                            	</div>
		                          </td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</form>
		@endif
		</div>
		<div class="">
			
		</div>
	</div>
@endsection