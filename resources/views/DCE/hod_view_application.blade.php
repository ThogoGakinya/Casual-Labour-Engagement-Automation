@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">H.O.D Daily Casuals Application</h5>
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
                    <a class="nav-link inactive_tab1" style="border:1px solid #ccc" id="list_login_details">Engagement Details</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active_tab1" id="list_personal_details" style="border:1px solid #ccc">H.O.D Approval</a>
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
            <!-- start of application details The time line -->
            <div class="timeline">
              <div>
                    <i class="fas fa-check bg-green"></i>
                    <div class="timeline-item">
                        <span class="time">Request Token&nbsp;&nbsp;{{$dce_requisition->token_id}}</span>
                        <h3 class="timeline-header"><a href="#">1.Casuals Application Details as requested by {{$dce_requisition->user->name}}</a></h3>
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

            <!-- Start of Hod Approval -->
        <!--Start of H.O.D tab-->
           <div>
                    <i class="fas fa-spinner bg-yellow"></i>
                    @if($approvals->hod_approval == 0)
                        <i class="fas fa-spinner bg-yellow"></i>
                    @elseif($approvals->hod_approval == 1)
                        <i class="fas fa-check bg-green"></i>
                    @elseif($approvals->hod_approval == 2)
                        <i class="fas fa-times bg-red"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time">Approved on :&nbsp;<i class="fas fa-clock"></i> {{$approvals->hod_approval_date}}</span>
                        <h3 class="timeline-header"><a href="#">2. H.O.D Approval</a></h3>
                    @if($approvals->hod_approval == 0)
                        <div class="timeline-footer">
                            <button type="button" class="btn btn-primary btn-sm" data-approvalid="{{$approvals->id}}" data-tokenid="{{$approvals->token_id}}" data-toggle="modal" data-target="#approve"><i class="fas fa-check"></i>&nbsp;Approve</button>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger btn-sm" data-declineid="{{$approvals->id}}" data-toggle="modal" data-target="#decline"><i class="fas fa-times"></i>&nbsp;Decline</button>
                        </div>
                    @elseif($approvals->hod_approval == 1)
                        <div class="timeline-footer">
                            <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved</button>
                             by {{$approvals->hod->name}}
                        </div>
                    @elseif($approvals->hod_approval == 2)
                        <div class="timeline-footer">
                            <button type="button" class="btn btn-danger btn-sm" ><i class="fas fa-times"></i>&nbsp;Declined</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <strong>Reason for Decline</strong>&nbsp;&nbsp;{{$approvals->decline_reason}}
                        </div>
                    @endif
                    </div>
                </div>
        <!--end of requisition tab-->
        <br/><br/>
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
              </div>
         
            <div>
                 <a href="{{route ('budget_requisitions')}}" class="btn btn-default btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>         
            </div>
          </div><!-- /.container-fluid -->
        </section>

<!-- Modal for approving request -->
<div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Approve Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <p align="center">Are you sure you want to approve this request?</p>
                    <form method="post"  class="form-horizontal" action="{{route('hod_approve_dce_request','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     @method('put')
                    <input type="hidden" class="form-control" name="approval_id" id="approval_id" value="">
                    <input type="hidden" class="form-control" name="token_id" id="token_id" value="">
                    <input type="hidden" class="form-control" name="hod_id"  value="{{auth::user()->id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Not Now</button>
                <button type="submit" class="btn btn-success button"><i class="loading-icon fa fa-spinner fa-spin hide"></i>&nbsp;<span class="btn-txt">&nbsp;&nbsp;Approve</span></button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for approving -->
<!-- Modal for declining request-->
<div class="modal fade" id="decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Decline Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('decline_dce_request','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     @method('put')
                    <textarea class="form-control" rows="4" name="reason" placeholder="Please provide a reason for declining this request" required></textarea>
                    <input type="hidden" class="form-control" name="decline_id" id="decline_id" value="">
                    <input type="hidden" class="form-control" name="hod_id"  value="{{auth::user()->id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Not Now</button>
                <button type="submit" class="btn btn-warning button"><i class="loading-icon fa fa-spinner fa-spin hide"></i>&nbsp;<span class="btn-txt">&nbsp;&nbsp;Yes Decline</span></button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for declining request -->
@endsection
