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
					<div class="table-responsive">
						<table class="table table-borderless mb-0">
							<thead class="border-bottom">
								<tr class="small text-uppercase text-muted">
									<th scope="col">Description</th>
									<th class="text-right" scope="col">Sqfeet</th>
									<th class="text-right" scope="col">Amount</th>
								</tr>
							</thead>
							<tbody>
								@foreach($payments as $payment)
								<!-- Invoice item 1-->
								<tr class="border-bottom">
									<td>
										<div class="font-weight-bold">SB Admin Pro</div>
										<div class="small text-muted d-none d-md-block">A professional UI toolkit for designing admin dashboards and web applications</div>
									</td>
									<td class="text-right font-weight-bold">12</td>
									<td class="text-right font-weight-bold">
										<div class="h5 mb-0 font-weight-700 text-green">${{$payment->amount}}</div>
									</td>
								</tr>
								@endforeach
								<!-- Invoice item 2-->
							</tbody>
						</table>
					</div>
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
					<form method="post" id="pay-form" action="/getpayment">
						@csrf
						<div id="form-container">
							<div id="sq-card-number"></div>
							<div class="third" id="sq-expiration-date"></div>
							<div class="third" id="sq-cvv"></div>
							<div class="third" id="sq-postal-code"></div>
							<button id="sq-creditcard" class="button-credit-card" onclick="onGetCardNonce(event)">Pay total ${{$total}}.00</button>
						</div>
						<input type="hidden" id="amount" name="amount" value="{{$total*100}}">
						<input type="hidden" id="cardnonce" value="def" name="cardnonce">
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="{{ URL::asset('js/squareID.js')}}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/squarejs.js')}}"></script>
		<div class="col-12">
			<div class="card mb-6">
				<div class="card-header">Transactions</div>
				<div class="card-body">
					<div class="datatable">
						<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Name</th>
									<th>Position</th>
									<th>Office</th>
									<th>Age</th>
									<th>Start date</th>
									<th>Salary</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Name</th>
									<th>Position</th>
									<th>Office</th>
									<th>Age</th>
									<th>Start date</th>
									<th>Salary</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</tfoot>
							<tbody>
								<tr>
									<td>Tiger Nixon</td>
									<td>System Architect</td>
									<td>Edinburgh</td>
									<td>61</td>
									<td>2011/04/25</td>
									<td>$320,800</td>
									<td><div class="badge badge-primary badge-pill">Full-time</div></td>
									<td>
										<button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="more-vertical"></i></button>
										<button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
									</td>
								</tr>
								<tr>
									<td>Garrett Winters</td>
									<td>Accountant</td>
									<td>Tokyo</td>
									<td>63</td>
									<td>2011/07/25</td>
									<td>$170,750</td>
									<td><div class="badge badge-warning badge-pill">Pending</div></td>
									<td>
										<button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="more-vertical"></i></button>
										<button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

