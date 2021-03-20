@extends('layout.main')

@section('content')

<div class="container mt-4">
    <!-- Account page navigation-->
    
   
    <div class="row">
    	<div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Price list</div>
                <div class="card-body">
                    
                    @foreach($services as $service)
                        <table class="table table-borderless mb-4 mouseover">
                            <thead>
                                <tr class="small text-uppercase text-muted">
                                    <th style="width: 75%">{{$service->title}}</th>
                                    <th style="width: 15%">price</th>
                                    <th style="width: 10%">action</th>
                                </tr>
                            </thead>
                            
                            @if($service->pod_services)
                            <tbody>
                                @foreach($service->pod_services as $pod_service)
                                    <tr class="border-bottom" data-id="{{$pod_service->id}}">
                                        <td><span style="margin-left: 20px">{{$pod_service->title}}</td>
                                        <td>{{$pod_service->price}}</td>
                                        <td>
                                            <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="fas fa-edit"></i></button>
                                            <a href="/admin/pricelist/remove/{{$pod_service->id}}" onclick="if(confirm('Are you sure you want to deactivate it')) return true; else return false;" class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @if($pod_service->pod_services)
                                        @foreach($pod_service->pod_services as 
                                        $dop_service)
                                        <tr>
                                            <td><span style="margin-left: 40px;"> {{$dop_service->title}}</span></td>
                                            <td>{{number_format($dop_service->price/100,2)}}</td>
                                            <td>
                                                <button class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i class="fas fa-edit"></i></button>
                                                <a href="/admin/pricelist/remove/{{$dop_service->id}}" onclick="if(confirm('Are you sure you want to deactivate it')) return true; else return false;" class="btn btn-datatable btn-icon btn-transparent-dark"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                                
                            </tbody>
                            @endif
                            
                        </table>
                        <script type="text/javascript">
                            window.onload = function(e){
                                $('.mouseover tr').mouseover(function(){
                                    $('.mouseover tr.over').removeClass('over');
                                    $(this).toggleClass('over');
                                });
                            }
                        </script>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@stop