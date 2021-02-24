@extends('layout.main')

@section('content')

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="far fa-user"></i></div>
                        Account Settings - Profile
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Main page content-->
<div class="container mt-4">
    <!-- Account page navigation-->
    
    <hr class="mt-0 mb-4" />
    <div class="row">
    	<div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    @if(session()->has('success_inf'))
                        <div class="alert alert-success" role="alert">{{session()->get('success_inf')}}</div>
                    @endif
                    @if(session()->has('error_inf'))
                        <div class="alert alert-danger" role="alert">Same thing went wrong</div>
                    @endif


                    <form method="post" action='/account/update'>
                        @csrf
                        @method('put')
                        <!-- <input type="hidden" name="event" value="update_info"> -->
                        <!-- Form Row-->
                        <div class="form-row">
                            <!-- Form Group (first name)-->
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="inputFirstName">First name</label>
                                <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" name="first_name" value="{{$user->first_name}}" />
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="inputLastName">Last name</label>
                                <input class="form-control" id="inputLastName" name="last_name" type="text" placeholder="Enter your last name" value="{{$user->last_name}}" />
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="form-row">
                            <!-- Form Group (organization name)-->
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="inputOrgName">Organization name</label>
                                <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" name="company_name" value="{{$user->company_name}}" />
                            </div>
                            <!-- Form Group (location)-->
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="inputLocation">Location</label>
                                <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location" name="location" value="{{$user->location}}" />
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="{{$user->email}}" />
                            </div>
                        
                            <!-- Form Group (phone number)-->
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" name="phone_number" value="{{$user->phone_number}}" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="small mb-1" for="text_description">Description</label>
                                <textarea class="form-control" id="text_description" name="description">{{$user->description}}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                
                                <label class="small mb-1" for="text_shops">Shops</label>
                                <textarea class="form-control" id="text_shops" name="shops">{{$user->shops}}</textarea>
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit" type="button">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4">   
            <div class="card mb-4">
                <div class="card-header">Change password</div>
                <div class="card-body">
                   @if(session()->has('success_pass'))
                        <div class="alert alert-success" role="alert">{{session()->get('success_pass')}}</div>
                    @endif
                    @if(session()->has('error_pass'))
                        <div class="alert alert-danger" role="alert">{{session()->get('error_pass')}}</div>
                    @endif

                    <form method="post" action="/account/update_pass">
                        @csrf
                        @method('put')
                        <!-- <input type="hidden" name="event" value="change_password"> -->
                        <div class="form-group">
                            <!-- Form Row-->
                            <div class="form-row">
                                
                                <label class="small mb-1" for="inputoldPassword">Old password</label>
                                <input class="form-control" id="inputoldPassword" type="password" placeholder="Enter your old password" name="old_password" />
                            </div>
                            <div class="form-row">
                                <label class="small mb-1" for="inputnewPassword">New password</label>
                                <input class="form-control" id="inputnewPassword" name="new_password" type="password" placeholder="Enter your new password" />
                            </div>
                            <div class="form-row">
                                <label class="small mb-1" for="inputnewPassword2">Confirm new password</label>
                                <input class="form-control" id="inputnewPassword2" name="new_password2" type="password" placeholder="Confirm your new password" />
                                
                            </div>
                        </div>
                        <div class="form-row ">
                            <!-- Save changes button-->
                            <button class="btn btn-primary" type="submit" type="button">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@stop