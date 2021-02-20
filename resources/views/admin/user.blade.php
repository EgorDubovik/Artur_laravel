@extends('layout.main')

@section('content')
<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="user"></i></div>
                        Account - Profile
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
	<div class="card mb-4">
		<div class="card-header">
			Account details
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-6">
					<div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="padding-left: 20px;">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>User Name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->first_name}} {{$user->last_name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->email}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Description</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->description}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Shops</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->shops}}</p>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
				</div>

				<div class="col-6">
					<div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="padding-left: 20px;">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Member since:</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{$user->created_at}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>

			</div>
		</div>
	</div>
	<div class="card card-header-actions mb-4">
        <div class="card-header">
        	Billing History
        	<a class="btn btn-sm btn-primary" href="/admin/makepayment/{{$user->id}}" style="color:#fff">Make new payment</a>
        </div>
        <div class="card-body p-0">
            <!-- Billing history table-->
            <div class="table-responsive table-billing-history">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($user->payments as $payment)

                        <tr>
                            <td>#{{$payment->id}}</td>
                            <td>{{$payment->created_at}}</td>
                            <td>${{number_format($payment->amount/100,2)}}</td>
                            <td><span class="badge badge-{{(($payment->status=='PAID') ? 'success' : 'light')}}">{{$payment->status}}</span></td>
                            <td>
                                <a href="/admin/user/removePayment/{{$user->id}}/{{$payment->id}}" onclick="if(confirm('Are you sure you want to deactivate it')) return true; else return false;" class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i>
                            </td>
                        </tr>
                        
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>	
</div>						

@stop