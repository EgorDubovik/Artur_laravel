@extends('layout.main')

@section('content')

<div class="container mt-4">
	<!-- Account page navigation-->
	<div class="row">
		<div class="col-xl-12">
			<!-- Account details card-->
			<div class="card mb-4">
				<div class="card-header">Link list</div>
				<div class="card-body">
					@if(session()->has('successful'))
						<div class="alert alert-success" role="alert">
							{{session()->get('successful')}}
						</div>
					@endif
					
					<table class="table table-bordered table-hover dataTable no-footer">
						<thead>
							<tr>
								<th>Title</th>
								<th width="10%">Chance</th>
								<th width="10%">Count to use</th>
								<th width="100">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($links as $link)
							<tr data-id = '{{$link->id}}'>
								<td data-tag='title' data-data = '{{$link->title}}'>{{$link->title}}</td>
								<td data-tag='chance' data-data = '{{$link->chance}}'>{{$link->chance}}%</td>
								<td>{{$link->count_use}}</td>
								<td><button class="btn btn-datatable btn-icon btn-transparent-dark mr-2" data-toggle="modal" data-target="#changeModel"><i class="fas fa-edit"></i></button>
									<a href="/admin/random/remove/{{$link->id}}" onclick="if(confirm('Are you sure you want to remove it')) return true; else return false;" class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fas fa-trash-alt"></i></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<button style="margin-top: 20px" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Add link</button>

					<hr>
					<div style="text-align: center;font-size: 18px;">Link: <a href="https://account.just-prep.com/random">https://account.just-prep.com/random</a></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add new link</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/admin/random/add" method="post">
				<div class="modal-body">
					@csrf
					<div class="form-row">
						<div class="col-md-8">
							<label class="small mb-1" for="inputTitle">Title</label>
							<input class="form-control" id="inpuTitle" type="text" placeholder="Enter title" name="title" value="">
						</div>
						<div class="col-md-4" id="price">
								<label class="small mb-1" for="inputPrice">Chance</label>
								<input class="form-control" id="inpuPrice" type="text" placeholder="Chance (1-100)%" name="chance" value="">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary gray" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="changeModel" tabindex="-1" role="dialog" aria-labelledby="changeModel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Eddit link</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/admin/random/edit" id="edit_link" method="post">
				<input type="hidden" name="link_id" value="">
				<div class="modal-body">
					@csrf
					<div class="form-row">
						<div class="col-md-8">
							<label class="small mb-1" for="inputTitle">Title</label>
							<input class="form-control" id="inpuTitle" type="text" placeholder="Enter title" name="title" value="">
						</div>
						<div class="col-md-4" id="price">
								<label class="small mb-1" for="inputPrice">Chance</label>
								<input class="form-control" id="inpuPrice" type="text" placeholder="Chance (1-100)%" name="chance" value="">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary gray" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	function model_init(){
		$('#changeModel').on('show.bs.modal', function (event) {
			console.log('show');
			var form = $("#edit_link");
	  		var button = $(event.relatedTarget);
	  		var parent = button.parent().parent();
	  		var linkId = parent.attr("data-id");
	  		var title_tag = parent.find('[data-tag="title"]');
	  		var chance_tag = parent.find('[data-tag="chance"]');
	  		form.find('input[name="title"]').val(title_tag.attr('data-data'));
	  		form.find('input[name="chance"]').val(chance_tag.attr('data-data'));
	  		form.find('input[name="link_id"]').val(linkId);
	  	});	
	}
</script>
<script type="text/javascript">
	window.onload = function(e){
		model_init();
	}
</script>
@stop