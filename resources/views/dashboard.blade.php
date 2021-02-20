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
						Account
					</h1>
				</div>
			</div>
		</div>
	</div>
</header>
<div class="container mt-n10">
	
	@if(session()->get('isset_tr')!==null && session()->get('isset_tr'))
		@if(session()->get('status'))
			<div class="row">
				<div class="col-12 mb-4">
					<div class="card h-100">
						<div class="card-header">
							<i class="fas fa-info-circle"></i>
							Transaction status
						</div>
						<div class="card-body">
							<div class="alert alert-success" role="alert">
								Successful payment
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
	@endif
	@if(count($payments_peiding)>0)
	<div class="row">
		<div class="col-lg-8 col-md-12 mb-4">
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
									<th class="text-right" scope="col">Count</th>
									<th class="text-right" scope="col">Price per one</th>
									<th class="text-right" scope="col">Amount</th>
								</tr>
							</thead>
							<tbody>
								@foreach($payments_peiding as $payment)
								<!-- Invoice item 1-->
								@foreach($payment->userServices as $userService)
								<tr class="border-bottom">
									<td>
										<div class="font-weight-bold">{{$userService->service->parent->title}}</div>
										<div class="small text-muted d-none d-md-block" style="margin-left: 15px">
											{{$userService->service->title}}
										</div>
									</td>
									<td class="text-right font-weight-bold">
										{{$userService->count}}
									</td>
									<td class="text-right font-weight-bold">
										<div class="h5 mb-0 font-weight-200 text-green">${{number_format($userService->service->price/100,2)}}</div>
									</td>
									<td class="text-right font-weight-bold">
										<div class="h5 mb-0 font-weight-200 text-green">${{number_format(($userService->service->price*$userService->count)/100,2)}}</div>
									</td>
								</tr>
								@endforeach
								
								@endforeach
								<tr>
                                    <td class="text-right pb-0" colspan="2"></td>
                                    <td class="text-right pb-0"></td>
                                </tr>
                                <tr>
                                    <td class="text-right pb-0" colspan="2"></td>
                                    <td class="text-right pb-0"></td>
                                </tr>
								<tr>
                                    <td class="text-right pb-0" colspan="3"><div class="text-uppercase h4 font-weight-700 text-muted">Total Amount Due:</div></td>
                                    <td class="text-right pb-0"><div class="h4 mb-0 font-weight-700 text-green">${{number_format($total/100,2)}}</div></td>
                                </tr>
								<!-- Invoice item 2-->
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer">

				</div>
			</div>
		</div>

		<div class="col-lg-4 col-md-12 mb-4">
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
							<button  id="sq-creditcard" class="button-credit-card" onclick="onGetCardNonce(event);">Pay total ${{number_format($total/100,2)}}</button>
						</div>
						<input type="hidden" id="amount" name="amount" value="{{$total}}">
						<input type="hidden" id="cardnonce" value="def" name="cardnonce">
					</form>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="{{ URL::asset('js/squareID.js')}}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/squarejs.js')}}"></script>
	</div>
	@endif
	<div class="row">
		<div class="col-12">
			<div class="card mb-6">
				<div class="card-header">Transactions</div>
				<div class="card-body">
					<div class="datatable">
						<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>Desctription</th>
									<th>Date</th>									
									<th>Status</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Desctription</th>
									<th>Date</th>									
									<th>Status</th>
									<th>Amount</th>
								</tr>
							</tfoot>
							<tbody>
								
								@foreach($payments_paid as $p)
								<tr>
									<td>Надо будет как называть плотежи, тоесть за что они будут платить</td>
									<td>{{$p->updated_at}}</td>
									<td><span class="badge badge-{{(($p->status=='PAID') ? 'success' : 'light')}}">{{$p->status}}<span></td>
									<td>${{number_format($p->amount/100,2)}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

