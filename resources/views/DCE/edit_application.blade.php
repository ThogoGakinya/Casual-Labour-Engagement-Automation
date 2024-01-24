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
                        <form method="post" action="{{ url('/update_dce_request',$dce_requisition->id)}} ">
                        {{ csrf_field() }}
                        @method('put')
                           <div class="row">
                              <div class="col-md-4">
                                    <div class="form-group">
                                        Department
                                        <select name="department_id" id="department_id" class="form-control department_id" required>
                                             <option value="{{$dce_requisition->dept_id}}">{{$dce_requisition->dept->name}} </option>
                                             @foreach($departments as $department)
                                             <option value="{{$department->id}}">{{$department->name}}</option>
                                             @endforeach
                                        </select>
                                    </div>
                              </div>
                              <div class="col-md-4">
                                    <div class="form-group">
                                       Division
                                     <select class="form-control" id="division" name="division_id">
                                     <option value="{{$dce_requisition->div_id}}">{{$dce_requisition->div->name}}</option>
                                     </select>
                                     
                                    </div>
                              </div>
                              <div class="col-md-4">
                                    <div class="form-group">
                                        No of Casuals
                                        <input type="number" name="no_of_casuals" class="form-control" value="{{$dce_requisition->no_of_casuals}}" required>
                                        <input type="hidden" name="request_token" class="form-control" value="{{$dce_requisition->token_id}}" required>
                                        <input type="hidden" name="user_id" class="form-control" value="{{auth::user()->id}}" required>
                                    </div>
                              </div>
                              <div class="col-md-3">
                                    <div class="form-group">
                                        Start Date
                                        <input type="date" name="start_date" id="start_date" value="{{$dce_requisition->start_date}}" class="form-control" required>
                                    </div>
                              </div>
                              <div class="col-md-3">
                                    <div class="form-group">
                                        End Date
                                        <input type="date" name="end_date" onchange="setChecker();" id="end" value="{{$dce_requisition->end_date}}" class="form-control" required>
                                    </div>
                              </div>
                              <div class="col-md-3">
                                    <div class="form-group">
                                        No Of Days
                                        <input type="number" name="end_date" value="{{$dce_requisition->no_of_days}}" class="form-control" disabled>
                                    </div>
                              </div>
                              <div class="col-md-3 half-full" style="display: none;">
                                    <div class="form-group">
                                      Select Full or Halfday
                                      <div class="input-group">
                                          <input type="radio" id="full" name="day" value="1">  &nbsp;&nbsp;&nbsp;Full Day
                                          <input type="radio" id="half" name="day" value="0.5">  &nbsp;&nbsp;&nbsp;Half Day
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-3 weekends">
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
                                        <textarea name="reason" class="form-control" required>{{$dce_requisition->reason}}</textarea>
                                    </div>
                              </div>
                              @if($approvals->hod_approval == 0) 
                                <div class="col-md-12">
                                      <div class="form-group">
                                      <button type="submit"  id="submit" name="submit" class="btn btn-default"><i class="fa fa-edit"></i>Update</button>
                                      </div>
                                </div> 
                              @endif
                        </div>
                        </form>
                        </div>     
                    </div>
              </div>
            <!--end of application tab-->
            
            <!--Start of other approvals-->
        <div>
                     @if($approvals->process_status < 100)
                        <i class="fas fa-spinner bg-yellow"></i>
                    @else
                        <i class="fas fa-check bg-green"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"></span>
                        <h3 class="timeline-header"><a href="#">Approvals</a></h3>

                       <!--H.O.D Checks-->  
                       <div class="timeline-footer">
                          1.<strong>H.O.D : </strong>&nbsp;&nbsp;{{$approvals ->hod->name}}&nbsp;&nbsp;&nbsp;
                          <i class="fas fa-clock"></i><small> {{$approvals->hod_approval_date}}</small>&nbsp;&nbsp;&nbsp;
                           @if($approvals->hod_approval == 0)   
                            <button type="button" class="btn btn-warning btn-xs"><i class="fas fa-spinner"></i>&nbsp;waiting..</button>
                           @elseif($approvals->hod_approval == 1)
                           <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved</button>
                           @elseif($approvals->hod_approval == 2)
                           <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-times"></i>&nbsp;Declined</button>
                           @endif
                       </div>
                      <!--Wages Checks-->  
                       <div class="timeline-footer">
                          2.<strong>Wages Approval : </strong>&nbsp;&nbsp;{{$approvals->wages_approver}}&nbsp;&nbsp;&nbsp;
                          <i class="fas fa-clock"></i><small> {{$approvals->wages_approval_date}}</small>&nbsp;&nbsp;&nbsp;
                           @if($approvals->wages_approval == 0)   
                            <button type="button" class="btn btn-warning btn-xs"><i class="fas fa-spinner"></i>&nbsp;waiting..</button>
                           @elseif($approvals->wages_approval == 1)
                           <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved</button>
                           @elseif($approvals->wages_approval == 2)
                           <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-times"></i>&nbsp;Declined</button>
                           @endif
                       </div>
                       <!--Budget Officer Checks-->  
                       <div class="timeline-footer">
                          3.<strong>Budget Officer : </strong>&nbsp;&nbsp;{{$approvals->budget_officer}}&nbsp;&nbsp;&nbsp;
                          <i class="fas fa-clock"></i><small> {{$approvals->budget_approval_date}}</small>&nbsp;&nbsp;&nbsp;
                           @if($approvals->budget_approval == 0)   
                            <button type="button" class="btn btn-warning btn-xs"><i class="fas fa-spinner"></i>&nbsp;waiting..</button>
                           @elseif($approvals->budget_approval == 1)
                           <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved</button>
                           @elseif($approvals->budget_approval == 2)
                           <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-times"></i>&nbsp;Declined</button>
                           @endif
                       </div>
                        <!--HR Officer Checks-->  
                        <div class="timeline-footer">
                          4.<strong>H.R Officer : </strong>&nbsp;&nbsp;{{$approvals->hr_manager}}&nbsp;&nbsp;&nbsp;
                          <i class="fas fa-clock"></i><small> {{$approvals->hr_approval_date}}</small>&nbsp;&nbsp;&nbsp;
                           @if($approvals->hr_approval == 0)   
                            <button type="button" class="btn btn-warning btn-xs"><i class="fas fa-spinner"></i>&nbsp;waiting..</button>
                           @elseif($approvals->hr_approval == 1)
                           <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved</button>
                           @elseif($approvals->hr_approval == 2)
                           <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-times"></i>&nbsp;Declined</button>
                           @endif
                       </div>
                       <!--I.A Checks-->  
                   
                    </div>
         
            <div>
                 <a href="{{url ('/dce/applications')}}" class="btn btn-primary btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>         
            </div>
          </div><!-- /.container-fluid -->
        </section>
@endsection
