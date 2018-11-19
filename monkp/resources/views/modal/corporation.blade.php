@extends('modal.template')

@section('title') Perusahaan @endsection

@section('body')
  @if ($corp == null)
    <p>Tidak ada data perusahaan.</p>
  @else
    <h4>Detail</h4>
    <div class="row">
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-4 text-right"><strong>Name</strong></div>
          <div class="col-md-8">{{$corp->name}}</div>
        </div>
        <div class="row">
          <div class="col-md-4 text-right"><strong>Telp</strong></div>
          <div class="col-md-8">{{$corp->telp}}</div>
        </div>
        <div class="row">
          <div class="col-md-4 text-right"><strong>Fax</strong></div>
          <div class="col-md-8">{{$corp->fax}}</div>
        </div>
        <div class="row">
          <div class="col-md-4 text-right"><strong>Post Code</strong></div>
          <div class="col-md-8">{{$corp->post_code}}</div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-4 text-right"><strong>Address</strong></div>
          <div class="col-md-8">{{$corp->address}}</div>
        </div>
        <div class="row">
          <div class="col-md-4 text-right"><strong>City</strong></div>
          <div class="col-md-8">{{$corp->city}}</div>
        </div>
        <div class="row">
          <div class="col-md-4 text-right"><strong>Business Type</strong></div>
          <div class="col-md-8">{{$corp->business_type}}</div>
        </div>
        <div class="row">
          <div class="col-md-4 text-right"><strong>Description</strong></div>
          <div class="col-md-8">{{$corp->description}}</div>
        </div>
      </div>
    </div>
    <br>
    <h4>Peserta</h4>
    <table class="table table-bordered">
      <tr>
        <th>Nama</th>
        <th>NRP</th>
        <th>Semester</th>
      </tr>
      @foreach ($corp->groups as $group)
        <?php
          $idx=$x->semester;
          $ids=$idx['id'];
        ?>
        @foreach ($group->students as $student)
        <tr>
          <td>{{$student->name}}</td>
          <td>{{$student->nrp}}</td>
          <td>{{App\Semester::find($ids)->toString()}}</td>
        </tr>
        @endforeach
      @endforeach
    </table>
  @endif
@endsection