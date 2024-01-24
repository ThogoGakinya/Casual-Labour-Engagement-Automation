@extends('layouts.staff')
    @section('content')
    @php
     if(auth::user()->level == 1)
     {
      $route = route('user_requisitions');
     }
     elseif(auth::user()->level == 2)
     {
      $route = route('hod_requisitions');
     }
     elseif(auth::user()->level == 3)
     {
       $route = route('budget_owner_requisitions');
     }
     elseif(auth::user()->level == 4)
     {
       $route = route('budget_requisitions');
     }
     elseif(auth::user()->level == 5)
     {
        $route = route('cfo_requisitions');
     }
     elseif(auth::user()->level == 6)
     {
        $route = route('ia_requisitions');
     }
     elseif(auth::user()->level == 7)
     {
        $route = route('admin_requisitions');
     }
    @endphp
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Dashboard</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <section class="content">
        <div class="container-fluid winbox-white">
            <!-- Small boxes (Stat box) -->
            <div class="row">
             
              @if(auth::user()->level == 6 || auth::user()->level == 7)
              <div class="col-lg-3 col-6">
              <a href="{{route('voucher_requisitions')}}">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h5>Cash Requisition</h5>
    
                    <p>Petty Cash</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="{{route('voucher_requisitions')}}" class="small-box-footer">Click here to request <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </a>
              </div>
              @else
               <div class="col-lg-3 col-6">
               <a href="{{$route}}">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h5>Cash Requisition</h5>
    
                    <p>Petty Cash</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="{{$route}}" class="small-box-footer">Click here to request <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </a>
              </div>
              @endif
            <div class="row">
             
              
            </div>
            <!-- /.row (main row) -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
 @endsection