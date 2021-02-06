<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pendaftaran Puskesmas | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('asset/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('asset/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Pendaftaran</b>Puskesmas</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Login</p>

        <form onsubmit="login();return false;">
        {{csrf_field()}}
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="NIK/Username" id="username" name="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" id="password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-8">
              <a href="{{route('register')}}" style="font-size: 12px;">Daftar Akun Pasien?</a>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <!-- /.social-auth-links -->
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('asset/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('asset/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('asset/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script>
  function show_loading() {
      Swal.fire({
        html: 'Loading . . .',
        allowOutsideClick:false,
        onBeforeOpen: function() {
          Swal.showLoading()
        }
      });
  }

  function login() {
    var username = $('#username').val();
    var password = $('#password').val();
    show_loading();
    $.ajax({
      url:'{{route('post_login')}}',
      headers: {
        'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
      },
      method:'POST',
      data:{username : username,password:password}
    }).done(function (data) {
      Swal.close();
      if (data == 'success') {
        location.href='dashboard';
      }else{
        Swal.fire(
          'Error',
          'Invalid Username/Password',
          'error'
          );
      }
    })
  }
  </script>
</body>
</html>
