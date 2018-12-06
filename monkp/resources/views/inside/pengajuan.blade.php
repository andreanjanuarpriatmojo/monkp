@extends('inside.template')

@section('content')
  <h1>Pengajuan</h1>
  <hr>
  @if (count($errors) > 0)
    <div class="alert alert-warning">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>Whoops!</strong> Lengkapi apa yang harus dilengkapi.
      <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
      </ul>
    </div>
  @endif
  @if (session('you'))
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <strong>Whoops!</strong> Selesaikan apa yang harus diselesaikan.
    </div>
  @endif
  @if (($semester = App\Semester::current()) == null))
    <div class="panel panel-default">
      <div class="panel-body">
        Tidak dapat membuat kelompok karena periode semester belum dibuat. Silahkan hubungi koordinator kp.
      </div>
    </div>
  @else
    <form method="post" action="{{url('/pengajuan')}}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Perusahaan</label>
                <select class="form-control" id="corporation">
                  <option value="0">-</option>
                </select>
              </div>
              <div class="form-group">
                <label>Nama Perusahaan</label>
                <input type="text" class="form-control" id="corpname" name="corporation[name]" value="{{old('corporation.name')}}">
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" id="corpaddress" name="corporation[address]" value="{{old('corporation.address')}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Kota</label>
                <input type="text" class="form-control" id="corpcity" name="corporation[city]" value="{{old('corporation.city')}}">
              </div>
              <div class="form-group">
                <label>Kode Pos</label>
                <input type="text" class="form-control" id="corppost_code" name="corporation[post_code]" value="{{old('corporation.post_code')}}">
              </div>
              <div class="form-group">
                <label>Telp Kantor</label>
                <input type="text" class="form-control" id="corptelp" name="corporation[telp]" value="{{old('corporation.telp')}}">
              </div>
              <div class="form-group hidden">
                <label>Fax Kantor</label>
                <input type="text" class="form-control" id="corpfax" name="corporation[fax]" value="{{old('corporation.fax')}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Jenis Bisnis</label>
                <input type="text" class="form-control" id="corpbusiness_type" name="corporation[business_type]" value="{{old('corporation.business_type')}}">
              </div>
              <div class="form-group">
                <label>Profil</label>
                <textarea class="form-control" rows="4" id="corpdescription" name="corporation[description]">{{old('corporation.description')}}</textarea>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Tanggal Mulai</label>
                <!-- <input type="date" data-provide="datepicker" class="datepicker form-control" name="group[start_date]" value="{{old('group.start_date')}}" required> -->
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" name="group[start_date]" class="form-control pull-right" id="reservation" value="{{old('group.start_date')}}" required>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Tanggal Selesai</label>
                <!-- <input type="date" data-provide="datepicker" class="datepicker form-control" name="group[end_date]" value="{{old('group.end_date')}}" required> -->
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" name="group[end_date]" class="form-control pull-right" id="reservation" value="{{old('group.end_date')}}" required>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Kelompok</label>
                <select class="form-control" name="friend">
                  <option value="0">-</option>
                    @foreach ($students as $student)
                      <option value="{{$student->id}}">{{$student->name}}</option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Dosen Pembimbing</label>
                <select class="form-control" name="lecturer">
                  <option value="0">-</option>
                    @foreach ($lects as $l)
                      <!-- <option value="{{$student->id}}">{{$student->name}}</option> -->
                      <option value="{{$l->id}}">
                        {{$l->initial}} - {{$l->name}}
                      </option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
          </div>
        </div>
        <div class="panel-footer text-right">
          <button class="btn btn-success">Submit</button>
        </div>
      </div>
    </form>
  @endif
@endsection

@section('js')
  @if ($semester != null)
    <script>
      var corps = {!!$corps!!};
      $(document).ready(function(){
        // fill corporation dropdown
        for (var i = corps.length - 1; i >= 0; i--) {
          c = corps[i];
          $("#corporation").append('<option value="'+c.id+'">'+c.name_city+'</option>');
        };
        // add onChange event
        $("#corporation").change(function(){
          if ($(this).val() != 0) {
            var c;
            for (var i = 0; i < corps.length; i++) {
              if (corps[i].id == $(this).val()) {
                c = corps[i];
              }
            };
            $("#corpname").val(c.name);
            $("#corpaddress").val(c.address);
            $("#corpcity").val(c.city);
            $("#corppost_code").val(c.post_code);
            $("#corptelp").val(c.telp);
            $("#corpfax").val(c.fax);
            $("#corpbusiness_type").val(c.business_type);
            $("#corpdescription").val(c.description);
          } else {
            $("#corpname").val("");
            $("#corpaddress").val("");
            $("#corpcity").val("");
            $("#corppost_code").val("");
            $("#corptelp").val("");
            $("#corpfax").val("");
            $("#corpbusiness_type").val("");
            $("#corpdescription").val("");
          }
        });
      });
    </script>
  @endif
@endsection