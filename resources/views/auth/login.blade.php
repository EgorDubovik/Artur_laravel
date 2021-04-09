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
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        @if($errors->any())
                                            <ul style="margin-bottom: 20px;color: #ff6d5f">
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                            </ul>
                                        @endif
                                        @if(session()->has('error'))
                                            <ul style="margin-bottom: 20px;color: #ff6d5f">
                                                <li>{{session()->get('error')}}</li>
                                            </ul>

                                        @endif
                                        <!-- Login form-->
                                        <form method="post" action="/actionLogin">
                                          @csrf
                                            <!-- Form Group (email address)-->
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" name="email" placeholder="Enter email" value="{{old('email')}}" />
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input type="password" class="form-control py-4" id="inputPassword" type="text" name="password" placeholder="Enter your password" />
                                            </div>

                                            <!-- Form Group (remember password checkbox)-->
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" name="remember_me" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <!-- Form Group (login box)-->
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                
                                                <button type="submit" class="btn btn-primary btn-block" > Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="/signup">Need an account? Sign up!</a></div>

                                        <div class="small" style="margin-top: 20px;"><a href="/forgotpassword">Forgot Password?</a></div>
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
