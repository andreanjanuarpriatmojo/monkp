@extends('inside.template')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
		<div class="panel-heading"><h1>Konfirmasi Buku Kerja Praktik</h1></div>
		<div class="panel-body">
			<form>
				<div class="row">
					<div class="col-md-10">
						<table class="table table-bordered">
							<thead>
								<tr >
									<th style="text-align: center">NRP</th>
		                          	<th style="text-align: center">Nama Mahasiswa</th>
		                          	<th style="text-align: center">Status</th>
		                          	<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>5115100001</td>
		                          	<td>Nama Mahasiswa 1</td>
		                          	<td class="col-sm-3">
		                          		<div class="col-sm-3"></div>
		                            	<div class="form-group">
		                                	 "<button type="button" class="btn btn-primary active">Active Primary</button>"
		                            	</div>
		                          	</td>
		                          	<td class="col-sm-3">
		                          		<div class="col-sm-4"></div>
		                            	<div class="form-group">
		                                	 <button type="button" class="btn btn-info">Button</button>
		                            	</div>
		                          	</td>
								</tr>
								<tr>
									<td>5115100001</td>
		                          	<td>Nama Mahasiswa 1</td>
		                          	<td class="col-sm-3">
		                          		<div class="col-sm-3"></div>
		                            	<div class="form-group">
		                                	 <button type="button" class="btn btn-primary active">Active Primary</button>
		                            	</div>
		                          	</td>
		                          	<td class="col-sm-3">
		                          		<div class="col-sm-4"></div>
		                            	<div class="form-group">
		                                	 <button type="button" class="btn btn-info">Button</button>
		                            	</div>
		                          	</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection