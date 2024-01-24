<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kim-Fay Central | Staff Dashboard</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
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
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.csss')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<style>
  .document_links{
    color: #000;
  }
  a:hover{
    text-decoration: underline;
  }
  .hide{
    display: none;
  }
  .show{
    display: none;
  }
</style>
  <!-- styles for goalsheet steps -->
   </head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
    <!-- Left navbar links -->

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
          @guest
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              @if (Route::has('register'))
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @endif
          @else
              <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}">
                          {{ __('Profile') }}
                      </a>
                  </div>
              </li>
          @endguest
          
      </ul>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('dist/img/kimfay_logo.png')}}" alt="Company Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light"><strong>Kim-Fay Central</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('centralroot/public/Documents/'.auth::user()->imgurl)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
          <a href="{{ route('home')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-align-justify"></i>
                <p>
                  My job results
                </p>
              </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fa fa-cogs"></i>
                  <p>
                    Goal Setting
                  </p>
                </a>
              </li>
              <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="fa fa-file"></i>
                    <p>
                      Goalsheets
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fa fa-users"></i>
                      <p>
                        Team Performance
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="fa fa-list-ol"></i>
                        <p>
                         6K Scores
                        </p>
                      </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="fa fa-thumbs-up"></i>
                          <p>
                            My Evaluations
                          </p>
                        </a>
                      </li>
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                            <i class="fa fa-spinner"></i>
                            <p>
                              Waiting Evaluations
                            </p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#" class="nav-link">
                            <i class="fa fa-spinner"></i>
                            <p>
                              Annual Appraisal
                            </p>
                          </a>
                        </li> -->
          
          <li class="nav-header">ACTION</li>
          </li>
          @if(auth::user()->level == 0)
          <li class="nav-item">
              <a href="{{route('admin')}}" class="nav-link">
                 <i class="fa fa-lock"></i>
                <p>
                  Admin
                </p>
              </a>
           </li> 
           @endif
           @if(auth::user()->level == 9)
          <li class="nav-item">
              <a href="{{route('fleet')}}" class="nav-link">
                 <i class="fa fa-lock"></i>
                <p>
                  Fleet
                </p>
              </a>
           </li> 
           @endif
          <li class="nav-item">
              <a href="{{route('password_form')}}" class="nav-link">
                 <i class="fa fa-cogs"></i>
                <p>
                  Change Password
                </p>
              </a>
           </li> 
          <li class="nav-item">
            <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <p class="text">Logout</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  @include('sweetalert::alert')
      @yield('content')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    Copyright &copy; {{ date('Y')}} <a href="https://www.kimfay.com">Kim-Fay East Africa Limited</a>.
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery code for goalsheet tabs -->
<script src="{{ asset('js/app.js')}}"></script>
<script>
//code to dynamically fill dependent fields in budget approval
$(document).ready(function(){
    $(document).on('change','.category_id',function(){
        var cat_id = $(this).val();
        var div = $(this).parent().parent().parent();
        var op = "";
        var ap = "";
        var modal = $(this)
        $.ajax({
            type:'get',
            url:'{!!URL::to("findmtd")!!}',
            data:{'id':cat_id},
            success:function(data){
                op+='<option value="'+data.budget+'">'+data.budget+'</option>';
                div.find('#budget').html("");
                div.find('#budget').append(op);

                ap+='<option value="'+data.mtd+'">'+data.mtd+'</option>';
                div.find('#mtdbf').html("");
                div.find('#mtdbf').append(ap);
            },
            error:function(){
                console.log('big error');
            }
        });
    });
    $('.fuel-button').on('click', function(){
      var current_mileage = document.getElementById('current_mileage').value;
      var last_mileage = document.getElementById('previous_mileage').value;
      if(current_mileage <= last_mileage)
      {
        alert('Current Mileage can not be less than Previous Mileage')
        document.getElementById('current_mileage').value = '';
      }
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    $(document).on('change','.department_id',function(){
		    var department_id = $(this).val();
        var div = $(this).parent().parent().parent().parent();
        var op = "";
        var ap = "";
        var modal = $(this)
        
        $.ajax({
            type:'get',
            url:'{!!URL::to("finddivisions")!!}',
            data:{'id':department_id},
            success:function(data){
            op+='<option value="0" selected>Select Division</option>';
                for( var i=0; i<data.length;i++)
                {
                  op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                } 
                        div.find('#division').html("");
                        div.find('#division').append(op);
            },
            error:function(){
                console.log('failed');
            }
        });
        $.ajax({
            type:'get',
            url:'{!!URL::to("findhod")!!}',
            data:{'id':department_id},
            success:function(data2){
              console.log(data2);
                ap+='<option value="'+data2.hod_id+'">'+data2.hod_id+'</option>';
                div.find('#hod').html("");
                div.find('#hod').append(ap);
            },
            error:function(){
                console.log('failed');
            }
        });
		
	});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
    $(document).on('change','.casual_id',function(){
		    var casual_id = $(this).val();
        var div = $(this).parent().parent().parent().parent();
        var op = "";
        var ap = "";
        var modal = $(this)
        
        $.ajax({
            type:'get',
            url:'{!!URL::to("findcasual")!!}',
            data:{'id':casual_id},
            success:function(data4){
                      for( var i=0; i<data4.length;i++)
                        {
                          op+='<option value="'+data4[i].tax+'">'+data4[i].tax+'</option>';
                        } 
                        div.find('#tax').html("");
                        div.find('#tax').append(op);
            },
            error:function(){
                console.log('failed');
            }
        });
	});
});
</script>

<script type="text/javascript">
  function autoCheck(id)
  {

    alert(id)

  }
   
</script>
<script type="text/javascript">
function printApprovals(approvals)
     {
     var restorepage = document.body.innerHTML;
     var printcontent = document.getElementById(approvals).innerHTML;
     document.body.innerHTML = printcontent;
     window.print();
     document.body.innerHTML = restorepage;

     }
</script>
<script type="text/javascript">
function printContract(contract)
     {
     var restorepage = document.body.innerHTML;
     var printcontent = document.getElementById(contract).innerHTML;
     document.body.innerHTML = printcontent;
     window.print();
     document.body.innerHTML = restorepage;

     }
</script>
<script type="text/javascript">
  function numberValidator()
  {
    var div = $(this).parent().parent();
    if(frm.amount.value=="")
    {
      event.preventDefault()
      alert("Amount can not be empty");
      frm.amount.focus();
    }
    if(isNaN(frm.amount.value))
    {
      event.preventDefault()
      alert("Invalid Amount");
      frm.amount.focus();
      return false;
    }
    if(frm.amount.value < 1)
    {
      event.preventDefault()
      alert("Invalid Amount");
      frm.amount.focus();
      return false;
    }
    if(isNaN(frm.number.value))
    {
      event.preventDefault()
      alert("Invalid Phone Number");
      frm.number.focus();
      return false;
    }
    if(frm.number.value=="")
    {
      event.preventDefault()
      alert("Phone number can not be empty");
      frm.number.focus();
    }
    if((frm.number.value).length != 12)
    {
      event.preventDefault()
      alert("Phone number length does not meet criteria");
      frm.number.focus();
      return false;
    }
    $('#loader').show();
    return true;
  }
</script>
<script type="text/javascript">
function complete()
{
  var CheckoutID = document.getElementById('CheckoutRequestID').value;

        $.ajax({
            type:'get',
            url:'{!!URL::to("confirmpayment")!!}',
            data:{'id':CheckoutID},

            beforeSend: function(){
              $('#first').hide();
              $('#maq').hide();
              $('#loader').show();
            },
            complete: function(){
              $('#loader').hide();
            },
            success: function(data4){
             if(Object.keys(data4).length === 0)
             {
                  var output = ""; 
                      output += ` <div class="alert alert-warning alert-dismissible" >
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fas fa-info"></i> Alert</h5>
                                  No Payment received yet !
                                 </div>`;

                  $("#results").html(output);
             }
             else
             {
              if(data4.ResultCode == 0)
                {
                      var output = ""; 
                          output += ` <div class="alert alert-success alert-dismissible" >
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      <h5><i class="icon fas fa-check"></i> Success</h5>
                                      Payment received successfully
                                    </div>`;

                      $("#results").html(output);
                }
                else
                {
                      var output = ""; 
                          output += '<div class="alert alert-danger alert-dismissible">';
                          output += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                          output += '<h5><i class="icon fas fa-info"></i> Alert</h5>';
                          output +=  data4.ResultDesc;       
                          output +=  '</div>';

                      $("#results").html(output);
                }
             }
             
             
            },
            error:function()
            {
              $("#results").html("error");
            }
        });
  }
</script>

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
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js')}}"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/DataTables/bootstrap.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.min.css')}}">
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.jss')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>
 <script>
  $(function () {
    .buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
