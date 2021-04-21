@extends('layout.main')

@section('content')

<div class="container mt-4">
    <!-- Account page navigation-->
    
   
    <div class="row">
    	<div class="col-xl-12">
            <!-- Transaction details card-->
            @if($transaction_inf)
            <div class="card mb-4">
                <div class="card-header">Transaction information</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="row" style="padding: 5px 20px;">
                            Transaction time: <b style="margin-left: 20px;">{{$transaction_inf->created_at}}</b>
                            </div>
                            <div class="row" style="padding: 5px 20px;">
                            Transaction status: <b style="margin-left: 20px;"><span class="badge badge-{{(($transaction_inf->status=='PAID') ? 'success' : 'light')}}">{{$transaction_inf->status}}<span></b>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" style="margin-top: 30px;">
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
                                
                                <!-- Invoice item 1-->
                                @foreach($payment as $parentService)
                                <tr class="border-bottom">
                                    <td>
                                        <div class="font-weight-bold">{{$parentService['parentTitle']}}</div>
                                    </td>
                                    <td class="text-right font-weight-bold">
                                    </td>
                                    <td class="text-right font-weight-bold">
                                    </td>
                                    <td class="text-right font-weight-bold">
                                    </td>
                                </tr>
                                    @foreach($parentService['services'] as $userService)
                                    <tr class="border-bottom">
                                        <td>
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
            </div>
            @else
                No transavtion found
            @endif
        </div>
    </div>
</div>
@stop