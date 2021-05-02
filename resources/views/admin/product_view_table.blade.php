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
				
			</div>
		</div>
	</div>	
</div>						

@stop