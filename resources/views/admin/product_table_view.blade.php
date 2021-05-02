@extends('layout.main')

@section('content')

<div class="container-fuil">
	<div class="card">
		<div class="card-header">
			<div style="color:#616161">
				Таблица для пользователя: <a href="/admin/user/{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</a>
			</div>
		</div>
		<div class="card-body">
			@if(session()->has('success'))
				<div class="alert alert-success" role="alert">{{session()->get('success')}}</div>
			@endif
			<div class="datatable">
				@if($table)


				@else

					<div class="center" style="text-align: center;font-size: 22px;padding-top: 30px;">Таблица не создана</div>

					<div style="text-align: center;margin-top: 10px;">
						<a class="addNewUser" href="/admin/create/table/{{$user->id}}">Создать таблицу</a>
					</div>

				@endif	
			</div>
		</div>
	</div>	
</div>						

@stop