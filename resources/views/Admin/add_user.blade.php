@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Manage Users</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Admin</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <!-- Start of tabs content -->
        
        <section class="content">
            <div class="container-fluid winbox-white">
        <!-- End of tabs content -->

        <!-- Start of request history -->
                <div class="tab-content" style="margin-top:16px;">
                 <div class="tab-pane active" id="login_details">
                  <div class="panel panel-default">
                   <div class="panel-heading">
                   <a href="{{route ('users')}}" class="btn btn-default btn-sm" ><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
                   </div>
                   <div class="panel-body">
                   <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Create New User</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- /.tab-pane -->
                  <form method="post"  action="{{route('submit_user')}}" enctype="multipart/form-data">
                     {{ csrf_field() }}
                  <div class="active tab-pane" id="timeline">
                    <!-- The profile -->
                   <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('dist/img/user.png')}}"
                                alt="User profile picture">
                            </div>
                            <br/>
                            <div class="text-center">
                                 <label for="password" >{{ __('Default Profile Picture') }}</label>
                                 <input  type="hidden" class="form-control" name="profile" value="profile.png" required>
                            </div>
                     
                           
                        </div>
                        
                        <div class="col-md-4">
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 Name: 
                             </div>
                             <div class="col-md-8">
                                <input  type="text" class="form-control" name="name" value="" required>
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 Email: 
                             </div>
                             <div class="col-md-8">
                                <input  type="email" class="form-control" name="email" value="" required>
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 Phone: 
                             </div>
                             <div class="col-md-8">
                                <input  type="number" class="form-control" name="phone" value="">
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 Title: 
                             </div>
                             <div class="col-md-8">
                                <input  type="text" class="form-control" name="title" value="">
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-8" align="right">
                               
                             </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 Level: 
                             </div>
                             <div class="col-md-8">
                               <select class="form-control" name="level">
                                    <option value="">Select Level</option>
                                    @foreach($access_levels as $level)
                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                    @endforeach
                                </select>
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 Extension: 
                             </div>
                             <div class="col-md-8">
                                <input  type="number" class="form-control" name="ext" value="">
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 Department: 
                             </div>
                             <div class="col-md-8">
                                <select class="form-control" name="department">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 Password: 
                             </div>
                             <div class="col-md-8">
                                <input  type="text" class="form-control" name="password" value="" required>
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-8" align="right">
                                <button  type="submit" class="btn btn-success">Submit</button>
                             </div>
                          </div>
                    
                        </div>
                   </div>
                   </form>
                   <!-- end profile -->
                  </div>
                  <!-- /.tab-pane -->
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
                   </div>
                  </div>
                 </div>
        <!-- end of request history-->
    
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
@endsection