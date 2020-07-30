@extends('layout.main');

@section('content')
<div class="container-fluid">
  	<div class="row">
    	<div class="col-12">
      		<div class="main-box no-header clearfix">
        		<div class="main-box-body clearfix">
          			<h1>Dashboard ({{Auth::id()}})</h1>
        		</div>
      		</div>
		</div>
	</div>
</div>	
@stop