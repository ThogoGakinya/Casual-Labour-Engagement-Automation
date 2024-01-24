@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Fleet Dashboard</h5>
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
                <div class="col-lg-3 col-6">
                    <a href="{{route('vehicles')}}">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4 align="center">Vehicles Management</h4>
                                <p align="center">Manage Vehicles</p>
                            </div>
                            <div class="icon">
                                <i class="ion"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </a>
                    </div>
                <div class="col-lg-3 col-6">
                <a href="{{route('drivers')}}">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4 align="center">Drivers</h4>
                            <p align="center">Manage Drivers</p>
                        </div>
                        <div class="icon">
                            <i class="ion"></i>
                        </div>
                        <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="{{route('access_levels')}}">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4 align="center">Fuel Requisitions</h4>
                                <p align="center">Click to view fuel requisitions</p>
                            </div>
                            <div class="icon">
                                <i class="ion"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </a>
                    </div>
                </div> 
                </div> 
            </div>
            <!-- /.row (main row) -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
 @endsection