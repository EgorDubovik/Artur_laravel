@extends('layout.main')

@section('content')

<div class="container-fuil">
	<div class="card">
		<div class="card-header">
			<div style="color:#616161">
				Создание таблицы для пользователя: <a href="/admin/user/{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</a>
			</div>
		</div>
		<div class="card-body">
			@if(session()->has('error')) 
				<div class="alert alert-danger" role="alert">
					{{session()->get('error')}}
				</div>
			@endif

			@if($errors->any())
				<ul style="margin-bottom: 20px;color: #ff6d5f">
					@foreach($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			@endif
		</div>
	</div>

	<div class="container-md mt-4">
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						Поля:<span style='font-size:13px;color:#ccc;margin-left: 10px'>(пустые поля просто игнорируются)</span>
					</div>
					<div class="card-body">
					
						<form method="post" action="/admin/store/table">
							@csrf
							<input type="hidden" name="user_id" value="{{$user->id}}">
							<div class="row" style="margin-top: 20px;padding-left: 30px;">
								<div class="col-12" id="add_line">


								</div>
							</div>
							<div class="col-lg-12">
								<div class="row">
									<div class="col-md-4 mt-1">
										<button class="btn btn-primary btn-block" onclick="addNewField();return false">+ Добавить поле</button>
									</div>
									<div class="col-md-4">
										
									</div>
									<div class="col-md-4 text-right mt-1">
										<button type="submit" class="btn btn-success btn-block">Save</button>
									</div>
								</div>
							</div>
							
							
						</form> 
						
					</div>
				</div>
			</div>
		</div>
	</div>


	
</div>						
<script type="text/javascript">
	function addNewField(){
		let line = '<div class="form-row align-items-center">'+
							'<div class="form-group col-md-8">'+
								'<input type="text" name="fields[]" class="form-control" placeholder="Название столбца">'+
							'</div>'+
							'<div class="form-group col-md-4">'+
								'<div class="form-check ">'+
							      '<input class="form-check-input" type="checkbox" name="is_writeable[]">'+
							      '<label class="form-check-label">'+
							        'Is writeble'+
							      '</label>'+
							    '</div>'+
							'</div>'+
						'</div>';
		$('#add_line').append(line);
	}
</script>
@stop