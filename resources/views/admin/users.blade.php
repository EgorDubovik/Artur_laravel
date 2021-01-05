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
							<th>Email</th>
							<th>Start date</th>
							<th>Full amount</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Start date</th>
							<th>Full amount</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</tfoot>
					<tbody>
						@foreach($users as $auser)
						<tr>
							<td><a href="/admin/user/{{$auser->id}}" style="color: #585858;font-weight: bold"> {{$auser->first_name}} {{$auser->last_name}}</a></td>
							<td>{{$auser->email}}</td>
							<td>{{$auser->created_at}}</td>
							<td>$0,0</td>
							<td>
								<div class="badge badge-primary badge-pill">Active</div>
							</td>
							<td>
								<button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="more-vertical"></i></button>
								<a href="/admin/users/remove/{{$auser->id}}" onclick="if(confirm('Are you sure you want to deactivate it')) return true; else return false;" class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></a>
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