<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Artur</title>
  <!-- Bootstrap core CSS-->
  <link href="{{ URL::asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{ URL::asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="{{ URL::asset('css/sb-admin.css') }}" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Вход в панель администратора</div>
      <div class="card-body">
        <form method="post" action="enterCode">
        	@csrf
          <div class="form-group">
            <label for="loginAdminPassword">Enter code</label>
            <input type="hidden" name="phone_number" value="{{$phone_number}}">
            <input class="form-control" type="text" name="code" placeholder="Enter code" value="{{$code}}">
          </div>
          <button type="submit" class="btn btn-primary btn-block" >Enter</button>
        </form>
        <!-- <div class="alert alert-danger mt-2">Ошибка входа! Попробуйте еще раз.</div> -->
        
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="{{ URL::asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
  <script src="{{ URL::asset('/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
</body>

</html>
