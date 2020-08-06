@extends('layout.main')

@section('content')

<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
	 <div class="container">
		  <div class="page-header-content pt-4">
				<div class="row align-items-center justify-content-between">
					 <div class="col-auto mt-4">
						  <h1 class="page-header-title">
								<div class="page-header-icon"><i class="fas fa-align-center"></i></div>
								Dashboard
						  </h1>
					 </div>
				</div>
		  </div>
	 </div>
</header>
<div class="container mt-n10">
	 <div class="row">
		  <div class="col-xxl-4 col-xl-12 mb-4">
				<div class="card h-100">
					 <div class="card-header">
						 <i class="fab fa-amazon"></i>
						 FBA current orders
					 </div>
					 <div class="card-body">
						  <div class="alert alert-primary alert-icon" role="alert">
								<div class="alert-icon-aside">
									 <i class="fas fa-question"></i>
								</div>
								<div class="alert-icon-content">
									 <h6 class="alert-heading">Почему тут пусто ?</h6>
									 <a href="#">Узнай как начать</a>
								</div>
						  </div>
					 </div>
					 <div class="card-footer">
						<a href="/fba/create" class="btn btn-success btn-block">Создать Новый заказ ФБА</a>
						<a href=#>
						  <div class="d-flex align-items-center justify-content-between small text-body pd-dash-footer" style="padding-top: 10px; ">
							 Посмотреть все заказы ФБА
							 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
						  </div>
						</a>
						<a href=#>
						  <div class="d-flex align-items-center justify-content-between small text-body pd-dash-footer">
							 Менеджер отгурзок
							 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
						  </div>
						</a>
					 </div>
				</div>
		  </div>

		  <div class="col-xxl-4 col-xl-12 mb-4">
				<div class="card h-100">
					 <div class="card-header">
						 <i class="fas fa-warehouse"></i>
						 FBM
					 </div>
					 <div class="card-body">
						  same text here...
					 </div>
				</div>
		  </div>
	 </div>
</div>
								

@stop