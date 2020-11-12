@extends('layout.main')

@section('content')

<div class="container-fuil">
	<div class="card">
		<div class="card-header">
			Users <a class="addNewUser" href="/admin/addNewUser"><i class="fas fa-user-plus"></i> add new user</a>
		</div>
		<div class="card-body">
			<div class="datatable">
				<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Name</th>							
							<th>Start date</th>
							<th>Price</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Name</th>
							<th>Start date</th>
							<th>Price</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</tfoot>
					<tbody>
						@foreach($users as $auser)
						<tr>
							<td>{{$auser->first_name}} {{$auser->last_name}}</td>
							<td>{{$auser->created_at}}</td>
							<td>$0,0</td>
							<td>
								<div class="badge badge-primary badge-pill">Active</div>
							</td>
							<td>
								<button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="more-vertical"></i></button>
								<button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				
			</div>
		</div>
	</div>	
</div>						

@stop