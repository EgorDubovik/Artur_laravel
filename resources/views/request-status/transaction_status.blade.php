@if(session()->has('transaction_success') || session()->has('transaction_error'))
	<div class="row">
		<div class="col-12 mb-4">
			<div class="card h-100">
				<div class="card-header">
					<i class="fas fa-info-circle"></i>
					Transaction status
				</div>
				<div class="card-body">
					@if(session()->has('transaction_success'))
					<div class="alert alert-success" role="alert">
						Successful payment
					</div>
					@endif
					@if(session()->has('transaction_error'))
					<div class="alert alert-danger" role="alert">
						Same thing went wrong. Please try agian later
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endif