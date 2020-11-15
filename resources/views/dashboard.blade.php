@extends('layout.main')

@section('addscript')
<!-- link to the SqPaymentForm library -->
<script type="text/javascript" src="https://js.squareupsandbox.com/v2/paymentform"></script>
<link href="{{ URL::asset('css/mysqpaymentform.css')}}" rel="stylesheet" />
@stop

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
		  <div class="col-xxl-8 col-xl-12 mb-4">
				<div class="card h-100">
					 <div class="card-header">
						<i class="fas fa-info-circle"></i>
						Information
					 </div>
					 <div class="card-body">
						  Тут будет информация о том сколько и за что ему нужно заплатить
					 </div>
					 <div class="card-footer">
						
					 </div>
				</div>
		  </div>

		  <div class="col-xxl-4 col-xl-12 mb-4">
				<div class="card h-100">
					<div class="card-header">
						<i class="far fa-credit-card"></i>
						Make a payments
					</div>
					<div class="card-body">
						<div id="form-container">
							<div id="sq-card-number"></div>
							<div class="third" id="sq-expiration-date"></div>
							<div class="third" id="sq-cvv"></div>
							<div class="third" id="sq-postal-code"></div>
							<button id="sq-creditcard" class="button-credit-card" onclick="onGetCardNonce(event)">Pay $1.00</button>
						</div>
					</div>
				</div>
		  </div>
		  <script type="text/javascript" src="{{ URL::asset('js/squarejs.js')}}"></script>
	 </div>
</div>
@stop

