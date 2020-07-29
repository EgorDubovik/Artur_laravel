<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>feelqueen.by admin panel</title>
  <!-- Bootstrap core CSS-->
  <link href="{{ URL::asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{ URL::asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ URL::asset('css/sb-admin.css')}}" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  @extends('layout/top_left');
  <div class="content-wrapper">
    @yield('content')
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php //include ROOT.'/views/layout/footer.php'; ?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    @extends('layout/logoutmodel');
    <!-- Bootstrap core JavaScript-->
    <script src="{{ URL::asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ URL::asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{ URL::asset('vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ URL::asset('js/sb-admin.min.js')}}"></script>
    
    <!-- Custom scripts for this page-->
  </div>
</body>

</html>
