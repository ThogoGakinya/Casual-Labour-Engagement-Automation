@extends('layouts.staff')
    @section('content')
    @php
     if(auth::user()->level == 1)
     {
      $route = route('user_requisitions');
      $dce_route = route('user_applications');
     }
     elseif(auth::user()->level == 2)
     {
      $route = route('hod_requisitions');
      $dce_route = route('hod_applications');
     }
     elseif(auth::user()->level == 3)
     {
       $route = route('budget_owner_requisitions');
       $dce_route = route('hr_manager_applications');
     }
     elseif(auth::user()->level == 4)
     {
       $route = route('budget_requisitions');
       $dce_route = route('budget_applications');
     }
     elseif(auth::user()->level == 5)
     {
        $route = route('voucher_requisitions');
        $dce_route = route('hod_applications');
     }
     elseif(auth::user()->level == 6)
     {
        $route = route('ia_requisitions');
        $dce_route = route('user_applications');
     }
     elseif(auth::user()->level == 7)
     {
        $route = route('admin_requisitions');
        $dce_route = route('wages_applications');
     }
     else
     {
        $route = route('user_requisitions'); 
        $dce_route = route('user_applications');
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
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('Documents/'.auth::user()->imgurl)}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{auth::user()->name}}</h3>

                <p class="text-muted text-center">{{auth::user()->title}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{auth::user()->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone</b> <a class="float-right">{{auth::user()->phone}}</a>
                  </li>
                  <!-- <li class="list-group-item">
                    <b>Extension</b> <a class="float-right">{{auth::user()->ext}}</a>
                  </li> -->
              
                </ul>

                <a class="btn btn-primary nav-link" href="#timeline" data-toggle="tab"><b>Edit Profile</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Apps</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Change Password</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                    <div class="row">
                        <div class="col-lg-4 col-6">
                            @if(auth::user()->level == 6 || auth::user()->level == 7)
                            <a href="{{route('voucher_requisitions')}}">
                            @else
                            <a href="{{$route}}">
                            @endif
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h4 align="center">Petty Cash</h4>
                                        <p align="center">Cash Requisition</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion"></i>
                                    </div>
                                    <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-lg-4 col-6">
                        <a href="{{$dce_route}}">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h4 align="center">Casuals</h4>
                                    <p align="center">Daily Casuals Engagement</p>
                                </div>
                                <div class="icon">
                                    <i class="ion "></i>
                                </div>
                                <a href="{{$dce_route}}" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </a>
                        </div>
                        <div class="col-lg-4 col-6">
                        <a href="http://193.168.0.29/kimfayitcentral">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h4 align="center">Stationaries</h4>
                                    <p align="center">Order Stationaries</p>
                                </div>
                                <div class="icon">
                                    <i class="ion"></i>
                                </div>
                                <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </a>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-lg-4 col-6">
                        <a href="#" data-toggle="modal" data-target="#coming_soon">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h4 align="center">Contacts</h4>
                                    <p align="center">Internal/External staff contacts</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion"></i>
                                </div>
                                <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </a>
                        </div>
                        <div class="col-lg-4 col-6">
                        <a href="#" data-toggle="modal" data-target="#coming_soon">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h4 align="center">Meeting Rooms</h4>
                                    <p align="center">Book Meeting Rooms</p>
                                </div>
                                <div class="icon">
                                    <i class="ion "></i>
                                </div>
                                <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </a>
                        </div>
                        <div class="col-lg-4 col-6">
                        <a href="#" data-toggle="modal" data-target="#coming_soon">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h4 align="center">Leaves</h4>
                                    <p align="center">Apply for a leave</p>
                                </div>
                                <div class="icon">
                                    <i class="ion"></i>
                                </div>
                                <a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </a>
                        </div>
                    </div>
                    <br/>
                    <!-- <div class="row">
                        <div class="col-lg-4 col-6">
                        <a href="#">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h4>Contacts</h4>

                                    <p>Internal/External staff contacts</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">Click to view <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </a>
                        </div>
                        <div class="col-lg-4 col-6">
                        <a href="#">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h4>Meeting Rooms</h4>

                                    <p>Book Meeting Rooms</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">Click to book<i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </a>
                        </div>
                        <div class="col-lg-4 col-6">
                        <a href="#">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h4>Leaves</h4>

                                    <p>Apply for a leave</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">Click to apply <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </a>
                        </div>
                    </div> -->
                        
                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The profile -->
                    <form method="post"  class="form-horizontal" action="{{route('change_profile','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                   <div class="row">
                        <div class="col-md-4">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('storage/Documents/'.auth::user()->imgurl)}}"
                                alt="User profile picture">
                            </div>
                            <label for="password">{{ __('Change Profile Picture') }}</label>
                            
                                <input  type="file" class="form-control" name="profile_picture" required><br/>
                                <input  type="hidden" class="form-control" name="user_id" value="{{auth::user()->id}}"><br/>
                                <button  type="submit" class="btn btn-success">Change Photo</button>
                   </form>  
                   <form method="post"  class="form-horizontal" action="{{route('update_user','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 
                        </div>
                        <div class="col-md-8">
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 Name: 
                             </div>
                             <div class="col-md-8">
                                <input  type="text" class="form-control" name="name" value="{{auth::user()->name}}">
                                <input  type="hidden" class="form-control" name="user_id" value="{{auth::user()->id}}">
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 Email: 
                             </div>
                             <div class="col-md-8">
                                <input  type="text" class="form-control" name="email" value="{{auth::user()->email}}">
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 Tel: 
                             </div>
                             <div class="col-md-8">
                                <input  type="text" class="form-control" name="phone" value="{{auth::user()->phone}}">
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 Title: 
                             </div>
                             <div class="col-md-8">
                                <input  type="text" class="form-control" name="title" value="{{auth::user()->title}}">
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-8" align="right">
                                <button  type="submit" class="btn btn-success">Update</button>
                             </div>
                          </div>
                        </div>
                    </form>
                   </div>
                   <!-- end profile -->
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                  <div class="panel-body">
                   <form method="POST" action="{{ route('change_password') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="current_password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-default">
                                    {{ __('Change Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                   </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
        <!-- /.content -->
<!-- Modal for Not closed alert-->
<div class="modal fade" id="coming_soon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Coming Soon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Alert!</h5>
                       This module will be available soon
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for Not closed alert -->
 @endsection