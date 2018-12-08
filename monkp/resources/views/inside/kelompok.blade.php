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
@if($role=='STUDENT'&&Auth::user()->nohp==null)
  <script>
    window.onload = openWin;
    function openWin(){
      $("#mainModal2").modal('show');
    };
  </script>
  <script>
    function numberonly(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
      return true;
    }
  </script>
  <div class="modal fade" id="mainModal2" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Silahkan Mengisikan No HP anda</h4>
        </div>
        <form method="get" action={{url('/pengajuan/nohp/')}}>
          <div class="modal-body">
            No HP anda
            <input type="text" required onkeypress="return numberonly(event)" name="nohp">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endif
@section('content')
  <h1>
      List Kelompok
      <small>
      @if (isset($semester_id) && $semester_id != 'null')
        Periode {{App\Semester::find($semester_id)->toString()}}
      @endif
      @if (isset($stat) && $stat != 'null')
        status={{(new App\Group(['status' => $stat]))->status['name']}}
      @endif
      @if (isset($search) && $search != '' && $search != null)
        search='{{$search}}'
      @endif
      </small>
    </h1>
    <form class="form-inline text-muted">
      <select name="semester" class="form-control input-sm">
          <option value="0">-- Pilih semester --</option>
            @foreach(App\Semester::orderBy('year')->orderBy('odd','desc')->get() as $semester)
              <option value="{{$semester->id}}">{{$semester->toString()}}</option>
            @endforeach
      </select>
      @if ($role != 'STUDENT')
        <select name="status" class="form-control input-sm">
            <option value="null">-- Pilih filter --</option>
            @foreach(App\Group::statusAll() as $status)
              <option value="{{$status['status']}}">{{$status['name']}}</option>
            @endforeach
        </select>
        &nbsp;
        <input name="search" class="form-control input-sm" placeholder="NRP/Nama/Perusahaan" value="{{$search}}">
      @endif
      <button type="submit">Submit</button>
    </form>
    <hr>
    <div id="alert-container"></div>
    <div class="panel panel-default">
      @if ($groups->count()==0)
      <div class="panel-body">TIDAK ADA KELOMPOK KP</div>
      @elseif($groups->count()!=0)
        <table class="table table-striped table-hover borderless">
          <tr>
            <th>Status</th>
            <th>Peserta</th>
            <th>Perusahaan</th>
          </tr>
          @foreach ($groups->slice(($groups->currentPage() - 1) * $groups->perPage(), $groups->perPage()) as $group)
            <?php $status = $group->status; ?>
            <tr data-toggle="collapse" data-target="#clps{{$group->id}}" class="accordion-toggle" title="klik untuk lihat detail">
              <td>
                <span title="{{$status['desc']}}">{{strtoupper($status['name'])}}</span>
              </td>
              <td>
                {{$group->students->get(0)['name']}}
                @if (sizeof($group->students) > 1)
                  -  {{$group->students->get(1)->name}}
                @endif
              </td>
              <td>{{$group->corporation->name_city}}</td>
            </tr>
            <tr>
              <td colspan="3" class="hidden-row">
                <div class="accordion-body collapse" id="clps{{$group->id}}">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-horizontal"></div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <label class="col-md-4 control-label">Mahasiswa</label>
                          <div class="col-md-8 control-text">
                            {{$group->students->get(0)['nrp']}} {{$group->students->get(0)['name']}}
                            @for ($i = 1; $i < $group->students->count(); $i++)
                              <br>{{$group->students->get($i)->nrp}} {{$group->students->get($i)->name}}
                            @endfor
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Status KP</label>
                          <div class="col-md-6">
                            <select class="form-control input-sm" id="status{{$group->id}}" onchange="change({{$group->id}})">
                              <option value="{{$status['status']}}">
                                {{strtoupper($status['name'])}}
                                ({{$status['desc']}})
                              </option>
                              @if ($role == 'ADMIN')
                                @foreach ($status['changeto'] as $s)
                                  <option value="{{$group->getStatusAttribute($s)['status']}}">
                                    {{strtoupper($group->getStatusAttribute($s)['name'])}}
                                    ({{$group->getStatusAttribute($s)['desc']}})
                                  </option>
                                @endforeach
                              @endif
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Dosen Pembimbing</label>
                          <div class="col-md-6 control-text" id="dosentext{{$group->id}}">
                            {{$group->lecturer == null ? '-' : $group->lecturer->full_name}}
                          </div>
                          @if ($role == 'ADMIN')
                            <div class="col-md-6" id="dosenselect{{$group->id}}">
                              <select class="form-control input-sm" id="dosen{{$group->id}}">
                                <option value="-">-- PILIH DOSEN PEMBIMBING --</option>
                                @foreach ($lecturers as $l)
                                  <option value="{{$l->id}}">
                                    {{$l->initial}} - {{$l->name}} ({{$l->GroupByPeriod($group->semester->id)->count()}})
                                  </option>
                                @endforeach
                              </select>
                            </div>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Pembimbing Lapangan</label>
                          @if ($role == 'STUDENT')
                            <div class="col-md-4">
                              <input type="text" id="mentor{{$group->id}}" class="form-control input-sm" value="{{$group->mentor == null ? '' : $group->mentor->name}}" onchange="mentor({{$group->id}})">
                            </div>
                          @else
                            <div class="col-md-8 control-text">
                              {{$group->mentor == null ? '-' : $group->mentor->name}}
                            </div>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Komentar</label>
                          @if($role=='ADMIN')
                            <div class="col-md-8">
                              <textarea type="text" rows="10" cols="40" name="comment" id="comment{{$group->id}}" class="form-control input-sm" onchange="comment({{$group->id}})">{{$group->comment}}</textarea>
                            </div>
                          @endif
                        </div>
                        @if($role=='ADMIN')
                          <div class="form-group">
                            <label class="col-md-4 control-label">No HP {{$group->students->get(0)['name']}}</label>
                            <div class="col-md-8 control-text">
                              {{App\User::where('username',$group->students->get(0)['nrp'])->first()['nohp']==null ?'-':App\User::where('username',$group->students->get(0)['nrp'])->first()['nohp']}}
                            </div>
                          </div>
                          @if (sizeof($group->students) > 1)
                            <div class="form-group">
                              <label class="col-md-4 control-label">No HP {{$group->students->get(1)['name']}}</label>
                              <div class="col-md-8 control-text">
                                {{App\User::where('username',$group->students->get(1)->nrp)->first()['nohp']==null ?'-':App\User::where('username',$group->students->get(1)->nrp)->first()['nohp']}}
                              </div>
                            </div>
                          @endif
                        @endif
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-horizontal">
                      <!-- ******* Tanggal ******* -->
                        <div class="form-group">
                          <label class="col-md-4 control-label">Tanggal Mulai</label>
                          @if ($role == 'STUDENT' || $role == 'TU' || $role == 'LECTURER')
                            <div class="col-md-6 control-text">
                              {{$group->start_date}}
                            </div>
                          @else
                            <div class="col-md-6">
                              <input type="date" class="form-control datepicker input-sm" data-provide="datepicker" id="start_date{{$group->id}}" value="{{$group->start_date}}">
                            </div>
                          @endif
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Tanggal Selesai</label>
                          @if ($role == 'STUDENT' || $role == 'TU' || $role == 'LECTURER')
                            <div class="col-md-6 control-text">
                              {{$group->end_date}}
                            </div>
                          @else
                            <div class="col-md-6">
                              <input type="date" class="form-control datepicker input-sm" data-provide="datepicker" id="end_date{{$group->id}}" value="{{$group->end_date}}">
                            </div>
                          @endif
                        </div>
                        <!-- ******* Nilai ******* -->
                        @if ($role == 'ADMIN')
                          <div class="form-group">
                            <div class="col-md-offset-4 col-md-6">
                              <a href="#" class="btn btn-warning" onclick="open_nilai({{$group->id}})" data-toggle="modal" data-target="#nilaiModal">Nilai</a>
                              <!--a href="#" class="btn btn-warning" onclick="open_log({{$group->id}})" data-toggle="modal" data-target="#logModal">Log Nilai</a-->
                            </div>
                          </div>
                        @endif
                        @if ($role == 'LECTURER')
                          <div class="form-group">
                            <div class="col-md-offset-4 col-md-6">
                              <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#nilaiModalDospem">Nilai</a>
                              <!--a href="#" class="btn btn-warning" onclick="open_log({{$group->id}})" data-toggle="modal" data-target="#logModal">Log Nilai</a-->
                            </div>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-offset-7">
                    <div class="row">
                      <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#clps{{$group->id}}" class="accordion-toggle">Close</button>
                        @if ($role == 'ADMIN')
                          <button type="button" class="btn btn-primary" onclick="save({{$group->id}})">Save</button>
                          <a href="{{url('/pengajuan/destroy/'.$group->id)}}" class="btn btn-danger">
                            Hapus
                          </a>
                          @if($status['status']==1)
                            <button type="button" class="btn btn-default"  data-toggle="modal" data-target="#image">Bukti Penerimaan</button>
                          @endif                      
                        @else
                          @if ($role == 'STUDENT')
                            <button type="button" class="btn btn-default"  data-toggle="modal" data-target="#image">Bukti Penerimaan</button> 
                          @endif
                          @if ($status['status'] == 0)
                            <a href="{{url('/pengajuan/destroy/'.$group->id)}}" class="btn btn-danger">
                            Hapus
                            </a>
                          @endif
                          @if ($status['status'] == 0 || $status['status'] == 1)
                            <button type="button" class="btn btn-default"  data-toggle="modal" data-target="#upload">Upload</button>                          
                          @endif
                          @if ($status['status'] == 2)
                            <a href="{{url('/group/nilaiPerusahaan/'.$group->id)}}" class="btn btn-default">Upload Nilai</a>                         
                          @endif
                          <!--TAMBAH TOMBOL UPLOAD GAMBAR-->
                        @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
          </table>
          {!!$groups->appends(['status' => $stat, 'search' => $search, 'semester' => $SemesterId])->render()!!}
      @endif
    </div>
    @if ($groups->count()!=0)
      @if($role!='STUDENT')
        <div class="modal fade" id="nilaiModal" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Edit Nilai</h4>
              </div>
              <div class="modal-body">
                <div id="edit-nilai-body"></div>
                <p class="text-muted">Range Nilai antara 0 - 100.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                @if ($role == 'ADMIN')
                <button class="btn btn-warning" id="save-nilai" data-dismiss="modal">Save changes</button>
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="logModal" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width:120%;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Log Nilai</h4>
              </div>
              <div class="modal-body">
                <div id="edit-log-body"></div>
                <p class="text-muted">Range Nilai antara 0 - 100.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      @endif
    <div class="modal fade" id="upload" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Upload bukti Penerimaan KP</h4>
          </div>
          <div class="modal-body">
            <form method="POST" role="form" action="{{url('/pengajuan/upload/'.$group->id)}}" enctype="multipart/form-data" name="upload" id="upload_img">
              Select image(jpg/jpeg) or pdf to upload (Max Size : 500kb):
              <input type="hidden" name="_token" value="{{ csrf_token()}}">
              <input type="hidden" value="{{url('/pengajuan/upload/'.$group->id)}}" id="baseurl1">
              <input type="file" name="image" id="fileToUpload">
              <input type="button" id="submitform" value="Upload" name="submit">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            @if ($role == 'ADMIN')
              <button class="btn btn-warning" id="save-bukti" data-dismiss="modal">Save changes</button>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="image" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Bukti Penerimaan KP</h4>
          </div>
          <div class="modal-body ">
            @if($group->status!=0)
              @if($group->nama_file!=null)
                <a href="{{asset('/surat_keterangan')}}/{{$group->nama_file}}" download>Download Berkas</a>
              @else
                <label>SILAHKAN UPLOAD ULANG BUKTI PENERIMAAN KP</label>   
              @endif           
            @else
              <label>BELUM UPLOAD BUKTI PENERIMAAN KP</label>
            @endif
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    @endif
@endsection

@section('js')
  <script>
    function niceAlert(msg) {
      $("#alert-container").html(
        '<div class="alert alert-'+ msg.alert +' alert-dismissible" role="alert">'
          + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
          + msg.body + '</div>'
      );
    }

    function mentor(id) {
      var mentor_name = $("#mentor" + id).val();
      console.log(mentor_name);
      $.ajax({
        type: "GET",
        dataType: "json",
        data: {
          mentor: mentor_name,
        },
        url: "{{url('/pengajuan/mentor')}}/" + id,
        success: function(data){
          niceAlert(data);
        },
        error: function(data) {
          niceAlert({alert: 'danger', body: 'Failed to fetch data via ajax.'});
        }
      });
    }

    function comment(id) {
      var comment_x = $("#comment" + id).val();
      console.log(comment_x);
      $.ajax({
        type: "GET",
        dataType: "json",
        data: {
          comment: comment_x,
        },
        url: "{{url('/pengajuan/comment')}}/" + id,
        success: function(data){
          niceAlert(data);
        },
        error: function(data) {
          niceAlert({alert: 'danger', body: 'Failed to fetch data via ajax.'});
        }
      });
    }

    function open_nilai(id) {
      $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('/json/groupgrade')}}/" + id,
        success: function(group){
          console.log(group);
          
          $table = $('<table nowrap class="table table-striped table-bordered">')
            .append('<tr><th>Nama</th><th>NRP</th><th>Internal</th><th>Eksternal</th><th>Displin</th><th>Laporan</th><th></th></tr>');
          @if ($role != 'LECTURER' && $role != 'ADMIN')
          for (member of group.members) {
            console.log(member);
            $table.append($("<tr>").append(
              "<td nowrap>" + member.student.name + "</td>" +
              "<td nowrap>" + member.student.nrp + "</td>" + (
                member.grade == null ? (
                  '<td class="col-xs-1">-></td>'+
                  '<td class="col-xs-1">-></td>'+
                  '<td class="col-xs-1">-></td>'+
                  '<td class="col-xs-1">-></td>'
                ) : (
                  '<td class="col-xs-1">' + member.grade.lecturer_grade+ ' </td>'+
                  '<td class="col-xs-1">' + member.grade.mentor_grade+ ' </td>'+
                  '<td class="col-xs-1">' + member.grade.discipline_grade+ ' </td>'+
                  '<td class="col-xs-1">' + member.grade.report_status+ ' </td>'
                )
              )
            ));
          }          
          @else
          for (member of group.members) {
            console.log(member);
            $table.append($("<tr>").append(
              "<td nowrap>" + member.student.name + "</td>" +
              "<td nowrap>" + member.student.nrp + "</td>" + (
                member.grade == null ? (
                  '<td class="col-xs-1"><input type="text" class="form-control input-sm" id="lecturer_grade' + member.id + '" value="0"></td>'+
                  '<td class="col-xs-1"><input type="text" class="form-control input-sm" id="mentor_grade' + member.id + '" value="0"></td>'+
                  '<td class="col-xs-1"><input type="text" class="form-control input-sm" id="discipline_grade' + member.id + '" value="0"></td>'+
                  '<td class="col-xs-1"><input type="text" class="form-control input-sm" id="report_status' + member.id + '" value="0"></td>' +
                  '<td class="col-xs-1"><button class="btn btn-default">Lihat Bukti</button></td>'
                ) : (
                  '<td class="col-xs-1"><input type="text" class="form-control input-sm" id="lecturer_grade' + member.id + '" value="'+member.grade.lecturer_grade+'"></td>'+
                  '<td class="col-xs-1"><input type="text" class="form-control input-sm" id="mentor_grade' + member.id + '" value="'+member.grade.mentor_grade+'"></td>'+
                  '<td class="col-xs-1"><input type="text" class="form-control input-sm" id="discipline_grade' + member.id + '" value="'+member.grade.discipline_grade+'"></td>'+
                  '<td class="col-xs-1"><input type="text" class="form-control input-sm" id="report_status' + member.id + '" value="'+member.grade.report_status+'"></td>' +
                  '<td class="col-xs-1"><button class="btn btn-default">Lihat Bukti</button></td>'
                )
              )
            ));
          }

          $("#save-nilai").unbind().click(function() {
            console.log(group);
            requestInput = [];
            for (member of group.members) {
              requestInput.push({
                id: member.id,
                lecturer_grade: + $("#lecturer_grade" + member.id).val(),
                mentor_grade: + $("#mentor_grade" + member.id).val(),
                discipline_grade: + $("#discipline_grade" + member.id).val(),
                report_status: + $("#report_status" + member.id).val(),
              });
            }
            console.log(requestInput);
            $.ajax({
              type: "POST",
              dataType: "json",
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              data: {input: requestInput},
              url: "{{url('/pengajuan/nilai')}}",
              success: function(data){
                niceAlert(data);
              },
              error: function(data) {
                console.log(data.responseText);
                niceAlert({alert: 'danger', body: 'Failed to fetch data via ajax.'});
              }
            });
          });
          @endif

          $nilaiBody = $("#edit-nilai-body");
          $nilaiBody.html('');
          $nilaiBody.append($table);
        },
        error: function(group) {
          niceAlert({alert: 'danger', body: 'Failed to fetch data via ajax.'});
        }
      });
    }

    function open_log(id) {
      $.ajax({
        type: "GET",
        dataType: "json",
        url: "{{url('/json/grouploggrade')}}/" + id,
        success: function(group){
          console.log(group);
          
          $table = $('<table nowrap class="table table-striped table-bordered">')
          .append('<tr><th>NRP</th><th>Nama</th><th>Internal</th><th>Eksternal</th><th>Displin</th><th>Laporan</th><th>Editor</th><th>Tanggal</th></tr>');

          $.each(group,function(i,item)
          {
            $table.append($("<tr>").append(
              '<td nowrap>' + item.nrp + "</td>" +
              '<td nowrap>' + item.student_name + "</td>"+ 
                  '<td class="col-xs-1">' + item.lecturer_grade +' </td>'+
                  '<td class="col-xs-1">' + item.mentor_grade + ' </td>'+
                  '<td class="col-xs-1">' + item.discipline_grade + ' </td>'+
                  '<td class="col-xs-1">' + item.report_status + ' </td>'+
                  '<td nowrap>' + item.name + ' </td>' +
                  '<td nowrap>' + item.updated_at + ' </td>'       
            ));
          });     
          $nilaiBody = $("#edit-log-body");
          $nilaiBody.html('');
          $nilaiBody.append($table);
        },
        error: function(group) {
          niceAlert({alert: 'danger', body: 'Failed to fetch data via ajax.'});
        }
      });
    }

    $(function(){
      $("#submitform").click(function(){
        var base_url = $("#baseurl1").val();

        var fd = new FormData($("form#upload_img")[0]);

        $.ajax({
            type :"POST",
            url :base_url,
            dataType : 'json',
            async :false,
            data : fd,
            processData : false,
            contentType : false,
            success :function(response)
            {
                var err = response.error;
                alert(err);  
                window.location.reload();
            }
        })
      })
    })

  @if ($role == 'ADMIN')
    function change(id) {
      if ($("#status" + id).val() == 2) { // jika statusnya 'progress'
        $("#dosenselect" + id).removeClass("hidden");
        $("#dosentext" + id).addClass("hidden");
      } else {
        $("#dosenselect" + id).addClass("hidden");
        $("#dosentext" + id).removeClass("hidden");
      }
    }

    function save(id) {
      var status = $("#status"+id).val();
      var dosen = $("#dosen"+id).val();
      $.ajax({
        type: "GET",
        dataType: "json",
        data: {
          dosen: $("#dosen"+id).val(),
          status: $("#status"+id).val(),
          comment:$("#comment"+id).val(),
          start_date: $("#start_date"+id).val(),
          end_date: $("#end_date"+id).val(),
        },
        url: "{{url('/pengajuan/update')}}/" + id,
        success: function(data){
          niceAlert(data);
        },
        error: function(data) {
          niceAlert({alert: 'danger', body: 'Failed to fetch data via ajax.'});
        }
      });
    }

    $(document).ready(function() {
      @if (sizeof($groups) >= 1)
        @foreach ($groups as $group)
          // kalau status group itu 2, maka tampilkan dropdown dosen.
          @if ($group->status['status'] != 2)
            $("#dosenselect{{$group->id}}").addClass("hidden");
          @else
            $("#dosentext{{$group->id}}").addClass("hidden");
          @endif
          // default isi dosen nya
          @if ($group->lecturer != null)
            $("#dosen{{$group->id}}").val({{$group->lecturer->id}});
          @endif
        @endforeach
      @endif
    });
  @endif
  </script>
@endsection