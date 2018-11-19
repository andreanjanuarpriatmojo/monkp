@extends('inside.template')

@section('css')
  {!! HTML::style('public/css/morris.css') !!}
@endsection

@section('content')
  <h1>
    Statistik
    <small>{{$all ? 'Semua Periode' : 'Periode ' . App\Semester::find($semester_id)->toString()}}</small>
  </h1>
  <form class="form-inline">
    <select name="semester" class="form-control input-sm" onchange="$(this).parent().submit()">
      <option value="0">-- Pilih semester --</option>
      @foreach(App\Semester::get()->sortBy('year')->sortByDesc('odd') as $semester)
        <option value="{{$semester->id}}">{{$semester->toString()}}</option>
      @endforeach
    </select>
  </form>
  <hr>
  <div class="row">
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">Kelompok Kerja Praktik</div>
        <div class="panel-body">
          @if ($groups->count() == 0)
            Tidak ada kelompok KP
          @else
          <?php
          $status = [0, -1, 1, -2, 2, 3];
          foreach ($status as $val) {
            $groupCount[$val] = $groups->where('status.status', $val)->count();
          }
          ?>
            <div id="myfirstchart" style="height: 250px;"></div>
            <div class="col-md-10 col-md-offset-1">
              <a class="btn btn-default btn-block" role="button" data-toggle="collapse" href="#group-collapse" aria-expanded="false" aria-controls="group-collapse">
                Lihat Detil
              </a>
              <div class="collapse" id="group-collapse" style="padding-top: 7px;">
                <table class="table table-condensed table-bordered">
                  <tr>
                    <td class="text-right">Created</td>
                    <td>{{$groupCount[0]}}</td>
                  </tr>
                  <tr>
                    <td class="text-right">Denied</td>
                    <td>{{$groupCount[-1]}}</td>
                  </tr>
                  <tr>
                    <td class="text-right">Confirmed</td>
                    <td>{{$groupCount[1]}}</td>
                  </tr>
                  <tr>
                    <td class="text-right">Rejected</td>
                    <td>{{$groupCount[-2]}}</td>
                  </tr>
                  <tr>
                    <td class="text-right">Progress</td>
                    <td>{{$groupCount[2]}}</td>
                  </tr>
                  <tr>
                    <td class="text-right">Finished</td>
                    <td>{{$groupCount[3]}}</td>
                  </tr>
                  <tr class="active">
                    <td class="text-right"><strong>Total</strong></td>
                    <td><strong>{{$groups->count()}}</strong></td>
                  </tr>
                </table>
              </div>  
            </div>
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">Perusahaan <small>(klik untuk lihat detail)</small></div>
        @if ($corps->count() == 0)
          <div class="panel-body">Tidak ada data perusahaan.</div>
        @else
          <table class="table">
            <tr>
              <th class="col-md-5">Nama</th>
              <th class="col-md-5">Kota</th>
              <th class="text-center col-md-2">Peserta</th>
            </tr>
            @foreach ($corps as $corp)
              <tr>
                <td><a href="#" class="mainmodal" data-url="{{url('modal/perusahaan/'.$corp->id)}}">{{$corp->name}}</a></td>
                <td>{{$corp->city}}</td>
                <td class="text-center">{{$corp->corp_count}}</td>
              </tr>
            @endforeach
            <tr class="active">
              <td colspan="2"><strong>Total</strong></td>
              <td class="text-center"><strong>{{$corps->sum('corp_count')}}</strong></td>
            </tr>
          </table>
        @endif
      </div>
    </div>
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          Dosen Pembimbing
          <a class="btn btn-default btn-xs" role="button" data-toggle="collapse" href=".dsn" aria-expanded="false" aria-controls="dosen-collapse">
            Lihat Semua
          </a>
        </div>
        <table class="table">
          <tr>
            <th class="col-md-10">Nama</th>
            <th class="text-center col-md-2">Peserta</th>
          </tr>
          @foreach ($lects->take(10) as $dosen)
            <tr>
              <td>{{$dosen->initial}} - {{$dosen->name}}</td>
              <td class="text-center">{{$dosen->lect_count}}</td>
            </tr>
          @endforeach
          @foreach ($lects->slice(10) as $dosen)
            <tr class="dsn collapse">
              <td>{{$dosen->initial}} - {{$dosen->name}}</td>
              <td class="text-center">{{$dosen->lect_count}}</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
@endsection

@section('js')  
  {!! HTML::script('public/js/raphael-min.js') !!}
  {!! HTML::script('public/js/morris.min.js') !!}

  @if ($groups->count() == 0)
    Tidak ada kelompok KP
  @else
  <script>
    new Morris.Donut({
      // ID of the element in which to draw the chart.
      element: 'myfirstchart',
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.
      colors: ["#337ab7", "#5cb85c","#5bc0de","#f0ad4e","#d9534f", "#ff69b4"],
      formatter: function(y, data) {
        return y + ' | ' + Math.round(10000*y/{{$groups->count()}})/100+'%';
      },
      data: [
        @if (($c = $groupCount[0]) != 0)
          {label: "Created", value: {{$c}}},
        @endif
        @if (($c = $groupCount[-1]) != 0)
          {label: "Denied", value: {{$c}}},
        @endif
        @if (($c = $groupCount[1]) != 0)
          {label: "Confirmed", value: {{$c}}},
        @endif
        @if (($c = $groupCount[-2]) != 0)
          {label: "Rejected", value: {{$c}}},
        @endif
        @if (($c = $groupCount[2]) != 0)
          {label: "Progress", value: {{$c}}},
        @endif
        @if (($c = $groupCount[3]) != 0)
          {label: "Finished", value: {{$c}}},
        @endif
      ],
    });
  </script>
  @endif
@endsection