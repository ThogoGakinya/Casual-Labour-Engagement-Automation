<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KIM-FAY | E-Poll</title>

  <link rel="stylesheet" href="{{ asset('css/goalsheet.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css')}}">
  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-light">
    <div class="container">
      <a href="../../index3.html" class="navbar-brand">
        <img src="{{ asset('dist/img/Kim-Fay awards logo-01_new.png')}}" height="80%" width="80%" alt="Kim-Fay Logo">
        <span class="brand-text font-weight-light"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
         
          <a class="nav-link" href="{{url ("poll/signin")}}">
            <i class="fa fa-user"></i>
           <span class="brand-text font-weight-light">Login</span>
          </a>
          <!--<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">-->
          <!--  <span class="dropdown-header">User Profile</span>-->
          <!--  <div class="dropdown-divider"></div>-->
          <!--  <a href="{{url('/poll')}}" class="dropdown-item">-->
          <!--    <i class="fas fa-sign-out-alt"></i> Logout-->
          <!--    <span class="float-right text-muted text-sm">Go back home</span>-->
          <!--  </a>-->
          <!--</div>-->
        </li>
        <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="{{url ("poll/signin")}}">
            <i class="fa fa-question"></i>
           <span class="brand-text font-weight-light">FAQs</span>
          </a>
        </li>
        <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="{{url ("poll/signin")}}">
            <i class="fa fa-file"></i>
           <span class="brand-text font-weight-light">Gallery</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

    <!-- Main content -->
    <div class="content">
        <div class="content-wrapper">
        @include('sweetalert::alert')
            @yield('content')
        </div>
     </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
 <footer class="main-footer">
    Copyright &copy; {{ date('Y')}} <a href="https://www.kimfay.com">Human Resources</a>.
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('js/dataFunctions.js')}}"></script>
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('change','#nominee',function(){
		var user_id = $(this).val();
        $.ajax({
            type:'get',
            url:'{!!URL::to("poll/nominee")!!}',
            data:{'id':user_id},

            beforeSend: function(){
              $('#nominee_user').hide();
              $('#loader').show();
            },
            complete: function(){
              $('#loader').hide();
              $('#nominee_user').show();
            },
            success: function(data){
            var output = ""; 
                output += '<div class="card card-primary card-outline">';
                output += '<div class="card-body box-profile">';
                output += '<div class="text-center">';
                
                output +='</div>';
                output += '<h3 class="profile-username text-center">'+data.name+'</h3>';
                output +='<p class="text-muted text-center">'+data.designation+'</p>';
                output +='<ul class="list-group list-group-unbordered mb-3">';
                output +='<li class="list-group-item">';
                output +='<b>Department</b> <a class="float-right">'+data.department+'</a>';
                output +='</li>';
                output +='<li class="list-group-item">';
                output +='<b>Designation</b> <a class="float-right">'+data.designation+'</a>';
                output +='</li>';
                            
                            
                output +='</ul>';
                output +='</div>';
                output +='</div>';
                output +='</div>';

                  $("#nominee_user").html(output);
             
            },
            error:function()
            {
              $("#results_2").html("error");
            }
        });
	});
});
</script>
<script type="text/javascript">
  function autoCheck(id)
  {
    document.getElementById(id).checked = true;
  }
</script>
<script type="text/javascript">
  function autoUnCheck(id)
  {
    document.getElementById(id).checked = false;
  }
</script>
<script type="text/javascript">
     var mytextarea = document.getElementById('mytextarea');
     var remaining_character = document.getElementById('remaining_character');
     var max_char = 250;
     
     mytextarea.addEventListener('input',() => {
         var remaining = max_char - mytextarea.value.length;
         var color = remaining < max_char*0.1 ? 'red' : null;
         remaining_character.textContent = `${remaining} Characters remaining`;
         remaining_character.style.color = color;
         
         if(remaining == 0)
         {
             alert('Maximum character reached')
         }
     });
</script>
<script type="text/javascript">
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#example2").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    $("#example3").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    $("#example4").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
    $("#example5").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example5_wrapper .col-md-6:eq(0)');
    $("#example6").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example6_wrapper .col-md-6:eq(0)');
    $("#example7").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example7_wrapper .col-md-6:eq(0)');
    $("#example9").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example9_wrapper .col-md-6:eq(0)');
    $("#example10").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example10_wrapper .col-md-6:eq(0)');
    $("#example11").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example11_wrapper .col-md-6:eq(0)');
    $("#example12").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example12_wrapper .col-md-6:eq(0)');
    $("#example14").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example14_wrapper .col-md-6:eq(0)');
    $("#example13").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example13_wrapper .col-md-6:eq(0)');
     $("#example17").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example17_wrapper .col-md-6:eq(0)');
    $('#example8').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>

</body>
</html>
