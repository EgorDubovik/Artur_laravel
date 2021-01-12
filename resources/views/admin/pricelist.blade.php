@extends('layout.main')

@section('content')

<div class="container mt-4">
    <!-- Account page navigation-->
    
   
    <div class="row">
    	<div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <ul>
                    @foreach($services as $service)
                        <li>
                            {{$service->title}}
                        </li>

                    @endforeach
                    <ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4">   
            <div class="card mb-4">
                <div class="card-header">Information</div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@stop