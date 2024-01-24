<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kim-Fay | Poll Portal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    
  </style>
</head>
<body class="hold-transition login-page" style="background-image: url('{{asset('dist/img/faykenya.png')}}');">
<div class="login-box">
  
  <!-- /.login-logo -->
  
    <div class="card-body login-card-body" id="cover" style="border-radius:5%;">
      <!--<h4>Starts on 4th March,2023</h4>-->

      <form method="POST" action="{{ route('pollauth') }}">
          @csrf
          @if (\Session::has('success'))
                <div class="alert alert-danger">
                       <i class="fa fa-exclamation"></i> {!! \Session::get('success') !!}
                </div>
            @endif
        <div class="input-group mb-3">
            
          <input id="email" type="text" placeholder="Employee ID Number" class="form-control @error('email') is-invalid @enderror" name="pnumber" value="{{ old('pnumber') }}" required autocomplete="pnumber" autofocus>
          <span class="invalid-feedback" role="alert">
              
              <strong>Employee Number not found</strong>
          </span>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
            
          </div>
        </div>
         <div class="input-group mb-3">
            
          <input id="password" type="password" placeholder="Password" class="form-control @error('email') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
          <span class="invalid-feedback" role="alert">
              
              <strong>Employee Number not found</strong>
          </span>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
            
          </div>
        </div>
        <div class="row" align="center">
          
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
         
        </div>
      </form>
      @if (Route::has('password.request'))
          <a class="btn btn-link" href="{{ route('password.request') }}">
              
          </a><br/>
      @endif
      <div align="center"><small><i>Kim-Fay Awards</i></small></div>
       </div>
       
  </div>
<!-- /.login-box -->

<!-- jQuery -->

<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>


<div class="modal fade" id="wrong">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Small Modal</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<p>One fine body&hellip;</p>
</div>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary">Save changes</button>
</div>
</div>

</div>

</div>
</body>
</html>
