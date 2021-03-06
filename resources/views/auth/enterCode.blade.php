<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin Pro</title>
        <link href="{{ URL::asset('css/styles.css')}}" rel="stylesheet" />
        <link href="{{ URL::asset('vendor/font-awesome/css/all.css')}}" rel="stylesheet" />

    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4">
                                <!-- Basic login form-->
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Enter Code</h3></div>
                                    <div class="card-body">
                                        <!-- Login form-->
                                        <p style="text-align: center;">
                                        We sent a verification code to your email address.<br>  </p>
                                        <form method="post">
                                          @csrf
                                            <input type="hidden" name="email" value="{{$email}}">
                                            <!-- Form Group (email address)-->
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Verification code for: {{$email}}</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" name="code" placeholder="Enter code" value="" />
                                            </div>
                                            <!-- Form Group (login box)-->
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary btn-block" > Login</button>
                                            </div>
                                        </form>
                                        <br>
                                        <p style="text-align: center;">Have not received? Check your spam folder or try <a href='/resendcode?email={{$email}}' >sending another</a></p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="footer mt-auto footer-dark">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 small">Copyright &copy; Your Website 2020</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ URL::asset('js/scripts.js')}}"></script>
    </body>
</html>
