@extends('layout.main')

@section('content')

<div class="container-fuil">
	<div class="card">
		<div class="card-header">
			
		</div>
		<div class="card-body">
			@if(session()->has('success'))
				<div class="alert alert-success" role="alert">{{session()->get('success')}}</div>
			@endif
			<div class="datatable">
				@if($table)
					<div class="datatable">
						<table class="table table-bordered table-hover userTable" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									@foreach($table->fields as $field)
									<th data-f="{{$field->id}}">{{$field->title}} 									
									</th>
									@endforeach
									
								</tr>
							</thead>
							<tbody>

								@foreach($table->lines as $line)
									<tr>
									@foreach($table->fields as $field)
										<td data-w="{{$field->is_writeable}}" data-r="{{$line->id}}" data-f="{{$field->id}}" class="inf-field">{{$line->cells->firstWhere('field_id',$field->id)->title}}</td>
									@endforeach
									</tr>
								@endforeach
									
							</tbody>
						</table>
					</div>
				@else
					Таблицы нет
				@endif	
			</div>
		</div>
	</div>	
</div>
@if($table)
<script type="text/javascript">
	

</script>					
<script type="text/javascript">
	$(document).ready(function(){
		var is_a = $('#dataTable').hasClass('admin');

		$('#dataTable ').find('.inf-field').each(function(){
			is_writeable = $(this).attr('data-w');
			if(is_a || is_writeable==1){
			 	$(this).addClass('is_writeable');
			 	var text = $(this).html();

			 	$(this).html('<div class="span-edit" onclick="edit(this)">'+text+'</div>');
			}
		})

	});
	var old_text;
	function edit(d){
		var text = $(d).text();
		old_text = text;
		var parent = $(d).parent();
		parent.addClass('td-select');
		parent.html(
			'<input class="form-input" type="text" onblur ="blurc(this)">'
			);
		parent.find('input').focus().val(text);
	}

	function blurc(d) {
		
		var v = $(d).val();
		if(v!=old_text){
			var parent = $(d).parent();
			var line_id = parent.attr('data-r');
			var field_id = parent.attr('data-f');
			console.log(line_id,field_id);
			$.ajax({
				url:"/table/cell/edit",
				type: 'POST',
				data : {
					_token : '{{csrf_token()}}',
					line_id : line_id,
					field_id : field_id,
					title : v,
				}
			}).
			done(function(response){
				console.log(response);
				if(!response.status){
					alert(response.messange);
				}
			}).fail(function(){
				alert('fail');
			});
		}
		$(d).parent().removeClass("td-select");
		$(d).parent().html('<div class="span-edit" onclick="edit(this)">'+v+'</div>');
	}
		
</script>
@endif
@stop