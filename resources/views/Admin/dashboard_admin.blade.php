@extends('layouts.staff')
    @section('content')
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
                <div class="col-lg-3 col-6">
                    <a href="{{route('users')}}">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h4 align="center">Users Management</h4>
                                <p align="center">Manage Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </a>
                    </div>
                <div class="col-lg-3 col-6">
                <a href="{{route('departments')}}">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4 align="center">Departments</h4>
                            <p align="center">Manage Company Departments</p>
                        </div>
                        <div class="icon">
                            <i class="ion"></i>
                        </div>
                        <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </a>
                </div>
                <div class="col-lg-3 col-6">
                <a href="{{route('divisions')}}">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4 align="center">Divisions</h4>
                            <p align="center">Manage Company Divisions</p>
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
                                <h4 align="center">Access Levels</h4>
                                <p align="center">Manage System Access Levels</p>
                            </div>
                            <div class="icon">
                                <i class="ion"></i>
                            </div>
                            <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </a>
                    </div>
                    <div class="col-lg-3 col-6">
                        <a href="{{route('pay')}}">
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h4 align="center">Make Payment</h4>
                                    <p align="center">Pay your premiums</p>
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