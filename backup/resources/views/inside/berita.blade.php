@extends('inside.template')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('/css/jasny-bootstrap.css')}}">
@endsection
@section('content')
  	<h1>Berita</h1>
  	<hr>
  	@if (session('alert'))
    	<div class="alert alert-{{session('alert')['alert']}} alert-dismissible" role="alert">
	      	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	       		<span aria-hidden="true">&times;</span>
	      	</button>
	      	{{session('alert')['body']}}
    	</div>
  	@endif

  	@if (Auth::user()->role == 'ADMIN')
  		<div class="modal fade" id="editmodal" role="dialog" aria-hidden="true">
  			<form action="{{url('/berita/edit')}}" method="post" class="form">
  				<input type="hidden" name="_token" value="{{ csrf_token()}}">
	          	<div class="modal-dialog modal-lg">
	            	<div class="modal-content">
	              		<div class="modal-header">
	                		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                  			<span aria-hidden="true">&times;</span>
	                		</button>
	                		<h4 class="modal-title">Edit Berita</h4>
	              		</div>
	              		<div class="modal-body">
			                <div id="edit-nilai-body"></div>
			            </div>
		              	<div class="modal-footer">
		                	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                	@if (Auth::user()->role == 'ADMIN')
		                		<button class="btn btn-warning" id="save-nilai">Save changes</button>
		                	@endif
		              	</div>
	            	</div>
	          	</div>
          	</form>
        </div>

	  	<div class="modal fade" id="createModal" role="dialog" aria-hidden="true">
		    <form action="{{url('/berita/tambah')}}" enctype="multipart/form-data" method="post" class="form">
		    	<input type="hidden" name="_token" value="{{ csrf_token()}}">
		      	<div class="modal-dialog modal-lg">
		        	<div class="modal-content">
				        <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				            	<span aria-hidden="true">&times;</span>
				            </button>
				            <h4 class="modal-title" id="createModalLabel">Buat Berita</h4>
		          		</div>
		          		<div class="modal-body">
		            		<div class="form-group">
		              			<label>Judul</label>
		              			<input class="form-control" name="title">
		            		</div>
		            		<div class="form-group">
		              			<label>Isi</label>
		              			<textarea class="form-control ckeditor" name="post" id="post-create" rows="9"></textarea>
		            		</div>
		            		<div class="form-group">
		              			<label>Attach</label>
		              			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
		                			<div class="form-control" data-trigger="fileinput">
		                  				<i class="glyphicon glyphicon-file fileinput-exists"></i>
		                  				<span class="fileinput-filename"></span>
		                			</div>
		                			<span class="input-group-addon btn btn-default btn-file">
		                  			<span class="fileinput-new">Select file</span>
		                  			<span class="fileinput-exists">Change</span>
		                  				<input type="file" name="file">
		                			</span>
		                			<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
		              			</div>
		            		</div>
		          		</div>
		          		<div class="modal-footer">
		            		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		            		<button class="btn btn-primary">Save changes</button>
		          		</div>
		        	</div>
		      	</div>
		    </form>
		</div>
		<!-- /Modal -->
	    <div class="form-group">
	      	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah</button>
	    </div>
	@endif
	<div class="panel panel-default">
		@if (sizeof($posts) < 1)
			<div class="panel-body">Tidak ada berita.</div>
		@else
      		<table class="table">
        		@foreach ($posts as $post)
          			<tr>
            			<td>
              				<h4>
	                			<span class="id hidden">{{$post->id}}</span>
	                			<span class="title">{{$post->title}}</span>
	                			@if (Auth::user()->role == 'ADMIN')
	                  				<small>
	                    				<a class="pull-right text-danger" title="delete" href="{{url('berita/hapus/'.$post->id)}}">
	                      					<span class="glyphicon glyphicon-remove"></span>
	                    				</a>
	                    				<span class="pull-right text-info">&nbsp;</span>
	                    				<a href="#" class="pull-right edit-post" title="edit" onclick="open_edit({{$post->id}})" data-toggle="modal" data-target="#editmodal"><span class="glyphicon glyphicon-pencil"></span></a>
	                  				</small>

	                			@endif
              				</h4>
              				<div class="post">{!!$post->post!!}</div>
              				@if($post->file != null)
              					<p class="text-muted">Attachment: <a target="_blank" href="{{url('/post/download/'.$post->file->saved_name)}}">{{$post->file->name}}</a></p>
            				@endif
              				<br>
              				<i><small><span class="fa fa-clock-o"></span> Created at: {{strstr($post->created_at, ' ', true)}}</small></i>
              				&nbsp;
              				<i><small><span class="fa fa-clock-o"></span> Updated at: {{strstr($post->updated_at, ' ', true)}}</small></i>
            			</td>
          			</tr>
        		@endforeach
      		</table>
    	@endif
  	</div>
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
	function open_edit(id) {
		$.ajax({
        	type: "GET",
        	dataType: "json",
        	url: "{{url('/json/getpost')}}/" + id,
        	success: function(data){
          		console.log(data.post);
          		$table = $('<input type="hidden" name="id" value="'+ data.id+'"/><label>Judul</label><input class="form-control" name="title" required id="title-edit" value="'+data.title+'"/><br>');
          		$isi = $('<label>Isi</label><textarea required class="form-control" name="post" rows="9" id="post-edit" value="'+data.post+ '"></textarea><br>');
          		console.log($table);
          		console.log($isi);
          		$nilaiBody = $("#edit-nilai-body");
          		$nilaiBody.html('');
          		$nilaiBody.append($table);
          		$nilaiBody.append($isi);
          	},
          	error: function(data) {
          		niceAlert({alert: 'danger', body: 'Failed to fetch data via ajax.'});
          	}
		});
	}
</script>
@endsection