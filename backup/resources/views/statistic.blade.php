@extends('inside.template')

@section('css')
  <link rel="stylesheet" type="text/css" href="{{asset('/css/morris.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
  <h1>
    Statistik
    <small>{{$all ? 'Semua Periode' : 'Periode ' . App\Semester::find($semester_id)->toString()}}</small>
  </h1>
  
  <div>
    
    <div>
      <form class="form" url="{{url('stats2/')}}" id="submit_periode">
        <input type="hidden" value="<?php echo $semester_id;?>" id="_semester_id">
          <select id="semester_dropdown" name="semester" class="form-control input-sm" onchange="submit()">
            <option value="0" selected>-- Pilih semester --</option>
            @foreach(App\Semester::orderBy('year')->orderBy('odd','desc')->get() as $semester)
              <option id="semester_{{$semester->id}}" value="{{$semester->id}}">{{$semester->toString()}}</option>
            @endforeach
            @if(isset ($aktif_tab))
              <input type="hidden" value="{{$aktif_tab}}" id="_tab_aktif" name="tab">
            @else
              <input type="hidden" value="0" id="_tab_aktif" name="tab">
            @endif
          </select>
      </form>
    </div>

    <div class="" role="tabpanel" data-example-id="togglable-tabs">
      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
        <li role="presentation" value="0" class=""><a value="0" href="#tab_content1" onclick="ganti_tab(0)" id="perusahaan-tab" role="tab" data-toggle="tab" aria-expanded="true">Perusahaan</a>
        </li>
        <li role="presentation" value="1" class=""><a value="1" href="#tab_content2" onclick="ganti_tab(1)" role="tab" id="dosen-tab" data-toggle="tab" aria-expanded="false">Dosen</a>
        </li>
      </ul>
      
      <div id="myTabContent" class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
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
              <div class="panel-heading">Perusahaan <small>(klik nama perusahaan untuk lihat detail)</small></div>
              @if ($corps->count() == 0)
                <div class="panel-body">Tidak ada data perusahaan.</div>
              @else
                <div class="panel-body">
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th class="col-md-5">Nama</th>
                          <th class="col-md-5">Kota</th>
                          <th class="text-center col-md-2">Peserta</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if($all==false)
                          @foreach ($corps as $corp)
                            <tr>
                              <td><a href="#" class="mainmodal n_perusahaan" data-url="{{url('/modal/perusahaan2/'.$corp->id.'/'.$semester_id)}}">{{$corp->name}}</a></td>
                              <td>{{$corp->city}}</td>
                              <?php
                                $jml=0;
                                $groupx=App\Group::where('semester_id',$semester_id)->where('corporation_id',$corp->id)->get();
                                foreach ($groupx as $group){
                                  foreach ($group->students as $student)
                                  {
                                    $jml++;
                                  }
                                }
                              ?>
                              <td>{{$jml}}</td>
                            </tr>
                          @endforeach
                        @else
                          @foreach ($corps as $corp)
                            <tr>
                              <td><a href="#" class="mainmodal n_perusahaan" data-url="{{url('/modal/perusahaan/'.$corp->id)}}">{{$corp->name}}</a></td>
                              <td>{{$corp->city}}</td>
                              <?php
                                $jml=0;
                                $corpx=App\Corporation::with('groups.students')->find($corp->id);
                                foreach ($corpx->groups as $group){
                                  foreach ($group->students as $student)
                                  {
                                    $jml++;
                                  }
                                }
                              ?>
                              <td>{{$jml}}</td>
                            </tr>
                          @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>

        <div role="tabpanel" class="tab-pane " id="tab_content2" aria-labelledby="profile-tab">
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
                @for($x=0;$x<10;$x++)
                  <tr>
                    <td>{{App\Lecturer::find($sort[$x])->name}} - {{App\Lecturer::find($sort[$x])->initial}}</td>
                    <td class="text-center">{{$jmlpeserta[$sort[$x]]}}</td>
                  </tr>
                @endfor
                @for($x=10;$x<count($sort);$x++)
                   <tr class="dsn collapse">
                    <td>{{App\Lecturer::find($sort[$x])->name}} - {{App\Lecturer::find($sort[$x])->initial}}</td>
                    <td class="text-center">{{$jmlpeserta[$sort[$x]]}}</td>
                  </tr>
                @endfor
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>

@endsection

@section('js')  
  <script type="text/javascript" src="{{asset('/js/raphael-min.js')}}"></script>
  <script type="text/javascript" src="{{asset('/js/morris.min.js')}}"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>


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
          @if ($groupCount[0] != 0)
            {label: "Created", value: {{$groupCount[0]}}},
          @endif
          @if($groupCount[-1] != 0)
            {label: "Denied", value: {{$groupCount[-1]}}},
          @endif
          @if ($groupCount[1] != 0)
            {label: "Confirmed", value: {{$groupCount[1]}}},
          @endif
          @if ($groupCount[-2] != 0)
            {label: "Rejected", value: {{$groupCount[-2]}}},
          @endif
          @if ($groupCount[2] != 0)
            {label: "Progress", value: {{$groupCount[2]}}},
          @endif
          @if ($groupCount[3] != 0)
            {label: "Finished", value: {{$groupCount[3]}}},
          @endif
        ],
      });
    </script>
  @endif
  <script>
    $(document).ready(function(){
      $('#datatable').dataTable();
      $('#datatable').on('click','.n_perusahaan',function(){
        //alert("test");
        $("#mainModal").modal('show');
        $.ajax({
          type: "GET",
          url: $(this).attr('data-url'),
          success: function(data) {
            $("#mainModalContent").html(data);
          },
          error: function(data) {
            $("#mainModalContent").html(data);
          }
        });
      });

      var aktif = $('#_tab_aktif').val();
      //alert(aktif);
      $("#myTab li[value="+aktif+"]").prop('class','active');

      if(aktif==0)
      {
        $("#tab_content1").addClass('active in');
        $("#tab_content2").removeClass('active in');
      }

      else
      {
        $("#tab_content2").addClass('active in');
        $("#tab_content1").removeClass('active in');
      }

      var id = $('#_semester_id').val();
      $("#semester_dropdown option[value="+id+"]").prop('selected',true);

      //alert($("#semester_dropdown[value='"+id+"']").val());
    
    });
  </script>
  <script>
    function ganti_tab(diklik)
    {
      //var diklik = $(that).val();
      var aktif = $('#myTab li.active').val();

      if(diklik != aktif)
      {
        $('#_tab_aktif').val(diklik);
      }
      //$('#_tab_aktif').val();
      //if( != aktif)
      //{
      //  alert("yang aktif "+ ($('#_tab_aktif').val());
      //}
    }

    function ganti_periode()
    {
      select = $('#submit_periode option:selected').val();
      action = $('#submit_periode').attr('url');
      url_to = action+'/'+select;

      aktif = $('#myTab li.active').val();
      //alert(aktif);


      $.ajax({
        type: "GET",
        url: url_to,
        dataType: 'json',
        data: {tab: aktif},
        success: function(data){
          //var data_parse = $.JSONparse(data);
          //alert(data.groups);
          alert('sukses');
          var count=0;
          //alert(count);
          $.each(data.groups,function(index){
            var dataItem = data.groups[index];
            $.each(dataItem,function(key,val){
              var id_group = dataItem.id;
              var id_corp = dataItem.corporation_id;
              //alert(id_group + ' ' + id_corp);
            });
            count++;
          });
          alert('total group = '+ count);
        },
        error:function(data){
          alert('error');
        }
      });
    }
  </script>
@endsection