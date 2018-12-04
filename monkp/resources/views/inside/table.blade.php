@extends('inside.template')

@section('content')
  <h1>
    Tabel
    <small>{{$all ? 'Semua Periode' : 'Periode ' . App\Semester::find($SemesterId)->toString()}}</small>
  </h1>
  <form class="form-inline">
    <select name="semester" class="form-control input-sm" onchange="$(this).parent().submit()">
      <option value="0">-- Pilih semester --</option>
      @foreach(App\Semester::orderBy('year')->orderBy('odd','desc')->get() as $semester)
        <option value="{{$semester->id}}">{{$semester->toString()}}</option>
      @endforeach
    </select>
  </form>
  <hr>
  <div id="alert-container"></div>
  @if (sizeof($members) < 1)
    <div class="panel panel-default">
      <div class="panel-body">Tidak ada kelompok KP.</div>
    </div>
  @else
    <p class="">
      <a href="{{url('table/export') . ($all ? '' : '/' . $SemesterId)}}" class="btn btn-success" target="_blank">
        Export to Excel
      </a>
    </p>
    <div class="panel panel-default">
      <div class="table-responsive">
        <table class="table table-bordered">
          <tr>
            <th nowrap>NRP</th>
            <th nowrap>Nama</th>
            <th nowrap>Kelompok</th>
            <th nowrap>Semester</th>
            <th nowrap>Mulai</th>
            <th nowrap>Selesai</th>
            <th nowrap>Dosen Pembimbing</th>
            <th nowrap>Perusahaan</th>
            <th nowrap>Pembimbing Lapangan</th>
            <th nowrap class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NI&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th nowrap class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;NE&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th nowrap class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;ND&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th nowrap class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;NB&nbsp;&nbsp;&nbsp;&nbsp;</th>
          </tr>
          @foreach ($members->slice(($members->currentPage() - 1) * $members->perPage(), $members->perPage()) as $member)
            <tr>
              <td nowrap>{{$member->student->nrp}}</td>
              <td nowrap>{{$member->student->name}}</td>
              <td nowrap>{{$member->group->id}} ({{$member->group->status['name']}})</td>
              <?php
                $idx=$member->group->semester;
                $ids=$idx['id'];
              ?>
              <td nowrap>{{App\Semester::find($ids)->toString()}}</td>
              <td nowrap>{{$member->group->start_date}}</td>
              <td nowrap>{{$member->group->end_date}}</td>
              <td nowrap>{{$member->group->lecturer == null ? '-' : $member->group->lecturer->name}}</td>
              <td nowrap>{{$member->group->corporation->name_city}}</td>
              <td nowrap>{{$member->group->mentor == null ? '-' : $member->group->mentor->name}}</td>
              <td class="text-center">
                {{$member->grade == null ? '-' : $member->grade->lecturer_grade}}
              </td>
              <td class="text-center">
                {{$member->grade == null ? '-' : $member->grade->mentor_grade}}
              </td>
              <td class="text-center">
                {{$member->grade == null ? '-' : $member->grade->discipline_grade}}
              </td>
              <td class="text-center">
                {{$member->grade == null ? '-' : $member->grade->report_status}}
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
    {!!$members->appends(['semester' => $SemesterId])->render()!!}
  @endif
@endsection