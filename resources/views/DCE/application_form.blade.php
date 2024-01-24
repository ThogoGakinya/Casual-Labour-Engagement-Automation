@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Daily Casuals Application</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">DCE</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        @php 
           $requestTocken = rand(100000,999999);
        @endphp
        <!-- Main content -->
        <!-- Start of tabs content -->
        
        <section class="content">
            <div class="container-fluid winbox-white">
            <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active_tab1" style="border:1px solid #ccc" id="list_login_details">Engagement Details</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_personal_details" style="border:1px solid #ccc">H.O.D Approval</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Wage Details</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Budget Officer</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">H.R Manager</a>
                  </li>
                 
                </ul>
        <!-- End of tabs content -->

<!--Start of requisition tab-->
                <div class="tab-content" style="margin-top:16px;">
                 <div class="tab-pane active" id="login_details">
                  <div class="panel panel-default">
     
                   <div class="panel-body">
                        <!-- START ALERTS AND CALLOUTS -->                  
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <div>
                    <i class="fas fa-check bg-green"></i>
                    <div class="timeline-item">
                        <span class="time">Request Token&nbsp;&nbsp;{{$requestTocken}}</span>
                        <h3 class="timeline-header"><a href="#">Casuals Application Form</a></h3>
                        <div class="timeline-body">
                        <form method="post" action="{{ url('/add_dce_request')}} ">
                        {{ csrf_field() }}
                           <div class="row">
                              <div class="col-md-4">
                                    <div class="form-group">
                                        Department
                                        <select name="department_id" id="department_id" class="form-control department_id" required>
                                             <option value="">Select Department </option>
                                             @foreach($departments as $department)
                                             <option value="{{$department->id}}">{{$department->name}}</option>
                                             @endforeach
                                        </select>
                                    </div>
                              </div>
                              <div class="col-md-4">
                                    <div class="form-group">
                                       Division 
                                     <select class="form-control" id="division" name="division_id"></select>
                                    </div>
                              </div>
                              <div class="col-md-4">
                                    <div class="form-group">
                                        No of Casuals
                                        <input type="number" name="no_of_casuals" class="form-control" required>
                                        <input type="hidden" name="request_token" class="form-control" value="{{$requestTocken}}" required>
                                        <input type="hidden" name="user_id" class="form-control" value="{{auth::user()->id}}" required>
                                    </div>
                              </div>
                              <div class="col-md-4">
                                    <div class="form-group">
                                        Start Date
                                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                                    </div>
                              </div>
                              <div class="col-md-4">
                                    <div class="form-group">
                                        End Date
                                        <input type="date" name="end_date" onchange="setChecker();" id="end" class="form-control" required>
                                    </div>
                              </div>
                              <div class="col-md-4 half-full" style="display: none;">
                                    <div class="form-group">
                                      Select Full or Halfday
                                      <div class="input-group">
                                          <input type="radio" id="full" name="day" value="1">  &nbsp;&nbsp;&nbsp;Full Day
                                          <input type="radio" id="half" name="day" value="0.5">  &nbsp;&nbsp;&nbsp;Half Day
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-4 weekends">
                                <div class="form-group">
                                  Exclude weekend Days
                                  <div class="input-group">
                                    <input type="checkbox" name="saturday" value=1> &nbsp;&nbsp;&nbsp;Saturday
                                    <input type="checkbox" name="sunday" value=1> &nbsp;&nbsp;&nbsp;Sunday
                                  </div>
                                </div>
                              </div> 
                              <div class="col-md-12">
                                    <div class="form-group">
                                        Reason(s) for Engagement
                                        <textarea name="reason" class="form-control" required></textarea>
                                    </div>
                              </div>
                              <div class="col-md-12">
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-success button"><i class="loading-icon fa fa-spinner fa-spin hide"></i>&nbsp;<span class="btn-txt">&nbsp;&nbsp;Submit</span></button>
                                    </div>
                              </div> 
                        </div>
                        </form>
                        </div>     
                    </div>
              </div>
            <!--end of application tab-->
            <br/><br/><br/>
         
            <div>
                 <a href="{{route ('budget_requisitions')}}" class="btn btn-primary btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>         
            </div>
          </div><!-- /.container-fluid -->
        </section>
@endsection
