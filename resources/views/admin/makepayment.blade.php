@extends('layout.main')

@section('content')

<div class="container mt-4">
	<div class="row">
		<div class="col-8">
			<div class="card mb-4">
				<div class="card-header">
					Make new payment for <a href="/admin/user/{{$user->id}}" style="color: #404040">{{$user->first_name}} {{$user->last_name}}</a>
				</div>
				<div class="card-body">
					<form method="post">
						<!-- Begin make payment -->
		                @include('layout/makepayment')
		                <!-- end make payment -->
						<button class="btn btn-primary" type="submit" type="button">Save payment</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-4">
			Dop information
		</div>
	</div>
</div>						

@stop