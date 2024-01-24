@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Add New Casual Details</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">H.R</li>
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
                   <a href="{{url ('/casuals')}}" class="btn btn-default btn-sm" ><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
                   </div>
                   <div class="panel-body">
                   <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Create New Casual</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- /.tab-pane -->
                  <form method="post"  action="{{route('submit_casual')}}" enctype="multipart/form-data">
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
                                 ID Number: 
                             </div>
                             <div class="col-md-8">
                                <input  type="number" class="form-control" name="number" value="" required>
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
                                 NSSF: 
                             </div>
                             <div class="col-md-8">
                                <input  type="text" class="form-control" name="nssf" value="">
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 NHIF: 
                             </div>
                             <div class="col-md-8">
                                <input  type="text" class="form-control" name="nhif" value="">
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 K.R.A Pin: 
                             </div>
                             <div class="col-md-8">
                                <input  type="number" class="form-control" name="kra" value="">
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
                                 Gender: 
                             </div>
                             <div class="col-md-8">
                               <select class="form-control" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    
                                </select>
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                 Next of Kin Name: 
                             </div>
                             <div class="col-md-8">
                                 <input  type="text" class="form-control" name="next_of_kin_name" value="">
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                Next of Kin Relationship: 
                             </div>
                             <div class="col-md-8">
                                <input  type="text" class="form-control" name="relationship" value="" required>
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                Next of Kin ID: 
                             </div>
                             <div class="col-md-8">
                                <input  type="text" class="form-control" name="next_of_kin_id" value="" required>
                             </div>
                          </div><br/>
                          <div class="row">
                             <div class="col-md-4" align="right">
                                Next of Kin Tel: 
                             </div>
                             <div class="col-md-8">
                                <input  type="text" class="form-control" name="next_of_kin_tel" value="" required>
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