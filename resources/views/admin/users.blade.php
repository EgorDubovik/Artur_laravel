@extends('layout.main')

@section('content')

<div class="container-fuil">
	<div class="card">
		<div class="card-header">
			Users <a class="addNewUser" href="/admin/addNewUser"><i class="fas fa-user-plus"></i> add new user</a>
		</div>
		<div class="card-body">
			@if(session()->has('success'))
				<div class="alert alert-success" role="alert">{{session()->get('success')}}</div>
			@endif
			<div class="datatable">
				<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Email</th>
							<th>Start date</th>
							<th>Full amount</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					
					<tbody>
						@foreach($users as $auser)
						<tr>
							<td>{{$auser->id}}</td>
							<td><a href="/admin/user/{{$auser->id}}" style="color: #585858;font-weight: bold"> {{$auser->first_name}} {{$auser->last_name}}</a></td>
							<td>{{$auser->email}}</td>
							<td>{{$auser->created_at}}</td>
							<td>${{number_format($auser->payments->sum('amount')/100,2)}}</td>
							<td>
								<div class="badge badge-primary badge-pill">Active</div>
							</td>
							<td>
								<div class="row">
									<div class="col-2">
										<form method="post"  action="/admin/users/remove/{{$auser->id}}" onsubmit="if(confirm('Are you sure you want to deactivate it')) return true; else return false;">
											@csrf
											@method("DELETE")
											<button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark mr-2">
												<i class="far fa-trash-alt"></i>
											</button>

										</form>
									</div>
									<div class="col-2">
										<a href="/admin/user/table/{{$auser->id}}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2">
											<i class="fas fa-table"></i>
										</a>
									</div>
								</div>

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