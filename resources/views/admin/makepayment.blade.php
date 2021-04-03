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
					<form method="post" action="/admin/save">
						@csrf
						<input type="hidden" name="user_id" value="{{$user->id}}">
						<!-- Begin make payment -->
		                @include('layout/makepayment')
		                <!-- end make payment -->
						<button class="btn btn-primary" type="submit" type="button">Save payment</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-4">
			@if(session()->has('successful'))
				<div class="alert alert-success" role="alert">
				    {{session()->get('successful')}}
				</div>
			@endif
			@if(session()->has('error'))
				<div class="alert alert-danger" role="alert">
				    {{session()->get('error')}}
				</div>
			@endif;
		</div>
	</div>
</div>						

@stop