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
							<tr class="border-bottom" data-tag="id" data-id="{{$pod_service->id}}" data-child = 'true'>
								<td data-tag='title' data-data='{{$pod_service->title}}'>
									<span style="margin-left: 20px">{{$pod_service->title}}</span>
								</td>
								<td data-tag='price' data-data='{{$pod_service->price}}'>
									{{number_format($pod_service->price/100,2)}}
								</td>
								<td>
									<button class="btn btn-datatable btn-icon btn-transparent-dark mr-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit"></i></button>
									<a href="/admin/pricelist/remove/{{$pod_service->id}}" onclick="if(confirm('Are you sure you want to deactivate it')) return true; else return false;" class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fas fa-trash-alt"></i></a>
								</td>
							</tr>
							@if($pod_service->pod_services)
								@foreach($pod_service->pod_services as 
								$dop_service)
								<tr>
									<td><span style="margin-left: 40px;"> {{$dop_service->title}}</span></td>
									<td>{{number_format($dop_service->price/100,2)}}</td>
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
						window.onload = function(e){
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
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="data"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary gray" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.onload = function(e){
		$('#exampleModal').on('show.bs.modal', function (event) {
	  		var button = $(event.relatedTarget);
	  		var parent = button.parent().parent();
	  		var price_tag = parent.find('[data-tag="price"]');
	  		$("#data").html(price_tag.attr('data-data'));
	  	});	
	}
</script>
@stop