@extends('layout.main')

@section('content')

<div class="container mt-4">
	<!-- Account page navigation-->
	<div class="row">
		<div class="col-xl-12">
			<!-- Account details card-->
			<div class="card mb-4">
				<div class="card-header">Price list</div>
				<div class="card-body">
					@if(session()->has('successful'))
						<div class="alert alert-success" role="alert">
							{{session()->get('successful')}}
						</div>
					@endif
					@foreach($services as $service)
					<table class="table table-borderless mb-4 mouseover">
						<thead>
							<tr class="small text-uppercase text-muted">
								<th style="width: 75%">{{$service->title}}</th>
								<th style="width: 15%">price</th>
								<th style="width: 10%">action</th>
							</tr>
						</thead>

						@if($service->pod_services)
						<tbody>
							@foreach($service->pod_services as $pod_service)
							<tr class="border-bottom" data-id="{{$pod_service->id}}" data-child = '{{$pod_service->hasChild()}}'>
								<td data-tag='title' data-data='{{$pod_service->title}}'>
									<span style="margin-left: 20px">{{$pod_service->title}}</span>
								</td>
								<td data-tag='price' data-data='{{$pod_service->price}}'>
									@if(!$pod_service->hasChild())
										{{number_format($pod_service->price/100,2)}}
									@endif
								</td>
								<td>
									<button class="btn btn-datatable btn-icon btn-transparent-dark mr-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit"></i></button>
									<a href="/admin/pricelist/remove/{{$pod_service->id}}" onclick="if(confirm('Are you sure you want to deactivate it')) return true; else return false;" class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fas fa-trash-alt"></i></a>
								</td>
							</tr>
							@if($pod_service->hasChild())
								@foreach($pod_service->pod_services as 
								$dop_service)
								<tr data-id="{{$dop_service->id}}" data-child = '{{$dop_service->hasChild()}}'>
									<td data-tag='title' data-data='{{$dop_service->title}}'>
										<span style="margin-left: 40px;"> {{$dop_service->title}}</span>
									</td>
									<td data-tag='price' data-data='{{$dop_service->price}}'>
										{{number_format($dop_service->price/100,2)}}
									</td>
									<td>
										<button class="btn btn-datatable btn-icon btn-transparent-dark mr-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit"></i></button>
										<a href="/admin/pricelist/remove/{{$dop_service->id}}" onclick="if(confirm('Are you sure you want to deactivate it')) return true; else return false;" class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fas fa-trash-alt"></i></a>
									</td>
								</tr>
								@endforeach
							@endif
							@endforeach
							
						</tbody>
						@endif
						
					</table>
					<script type="text/javascript">
						function over_init(){
							$('.mouseover tr').mouseover(function(){
								$('.mouseover tr.over').removeClass('over');
								$(this).toggleClass('over');
							});
						}
					</script>
					@endforeach

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
				<h5 class="modal-title" id="exampleModalLabel">Modal changes</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="/admin/pricelist/edit" id="service_form" method="post">
				<div class="modal-body">
						@csrf
						
						<input type="hidden" name="serviceId" value="">
						<div class="form-row">
							<div class="col-md-8">
								<label class="small mb-1" for="inputTitle">Title</label>
								<input class="form-control" id="inpuTitle" type="text" placeholder="Enter title" name="title" value="">
							</div>
							<div class="col-md-4" id="price" style="display: none">
									<label class="small mb-1" for="inputPrice">Price *100</label>
									<input class="form-control" id="inpuPrice" type="text" placeholder="Enter price*100" name="price" value="">
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
		$('#exampleModal').on('show.bs.modal', function (event) {
			var form = $("#service_form");
	  		var button = $(event.relatedTarget);
	  		var parent = button.parent().parent();
	  		var serviceId = parent.attr("data-id");
	  		var hasChild = parseInt(parent.attr("data-child"));
	  		var price_tag = parent.find('[data-tag="price"]');
	  		var title_tag = parent.find('[data-tag="title"]');
	  		form.find('input[name="title"]').val(title_tag.attr('data-data'));
	  		form.find('input[name="serviceId"]').val(serviceId);
	  		if(!hasChild){
	  			form.find("#price").show();
	  			form.find('input[name="price"]').val(price_tag.attr("data-data"));
	  		}
	  	});	
	}
</script>
<script type="text/javascript">
	window.onload = function(e){
		model_init();
		over_init();
	}
</script>
@stop