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
                    <a class="nav-link inactive_tab1" id="list_personal_details" style="border:1px solid #ccc">H.O.D Approval</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">H.R Representative</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Budget Officer</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active_tab1" id="list_contact_details" style="border:1px solid #ccc">H.R Manager</a>
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
                        <h3 class="timeline-header"><a>Casuals Application Details</a></h3>
                        <div class="timeline-body">
                             Applicant : &nbsp;&nbsp;<a href="#">{{$dce_requisition->user->name}}</a><br/>
                             Department : &nbsp;&nbsp;<a href="#">{{$dce_requisition->dept->name}}</a><br/>
                             Division : &nbsp;&nbsp;<a href="#">{{$dce_requisition->div->name}}</a><br/>
                             No of Casuals : &nbsp;&nbsp;<a href="#">{{$dce_requisition->no_of_casuals}}</a><br/>
                             Start Date : &nbsp;&nbsp;<a href="#">{{$dce_requisition->start_date}}</a><br/>
                             End Date : &nbsp;&nbsp;<a href="#">{{$dce_requisition->end_date}}</a><br/>
                             No of Days : &nbsp;&nbsp;<a href="#">{{$dce_requisition->no_of_days}}</a><br/>
                             Reason : &nbsp;&nbsp;<a href="#">{{$dce_requisition->reason}}</a>
                        </div>     
                    </div>
              </div>
            <!--end of application tab-->

            <!-- Start of Hod Approval -->
        <!--Start of H.O.D tab-->
        @if($approvals->hod_approval == 0)
            @if($dce_requisition->hod_id == auth::user()->id)
                <div>
                    <i class="fas fa-times bg-red"></i>
                    <div class="timeline-item">
                        <span class="time">Approved on :&nbsp;<i class="fas fa-clock"></i> {{$approvals->hod_approval_date}}</span>
                        <h3 class="timeline-header"><a>H.O.D Approval</a></h3>
                        <div class="timeline-footer">
                            <button type="button" class="btn btn-primary btn-sm" data-approvalid="{{$approvals->id}}" data-tokenid="{{$approvals->token_id}}" data-toggle="modal" data-target="#approve_hod"><i class="fas fa-check"></i>&nbsp;Approve</button>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger btn-sm" data-declineid="{{$approvals->id}}" data-toggle="modal" data-target="#decline_hod"><i class="fas fa-times"></i>&nbsp;Decline</button>
                        </div>
                    </div>
                </div>
            @else
                <div>
                    <i class="fas fa-times bg-red"></i>
                    <div class="timeline-item">
                        <span class="time">Approved on :&nbsp;<i class="fas fa-clock"></i> {{$approvals->hod_approval_date}}</span>
                        <h3 class="timeline-header"><a>H.O.D Approval</a></h3>
                        <div class="timeline-footer">
                            <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-spinner"></i>&nbsp;Please wait for H.O.D's Approval</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                </div>
            @endif
        @elseif($approvals->wages_approval == 0)
            <div>
            <i class="fas fa-times bg-red"></i>
            <div class="timeline-item">
                <span class="time">Approved on :&nbsp;<i class="fas fa-clock"></i> {{$approvals->wages_approval_date}}</span>
                <h3 class="timeline-header"><a>Wages Approval</a></h3>
                <div class="timeline-footer">
                    <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-spinner"></i>&nbsp;Please wait for Wages Approval</button>&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
        @elseif($approvals->budget_approval == 0)
            <div>
            <i class="fas fa-times bg-red"></i>
            <div class="timeline-item">
                <span class="time">Approved on :&nbsp;<i class="fas fa-clock"></i> {{$approvals->budget_approval_date}}</span>
                <h3 class="timeline-header"><a>Budget Approval</a></h3>
                <div class="timeline-footer">
                    <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-spinner"></i>&nbsp;Please wait for Budget Approval</button>&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
        @else
           <div>
                    <i class="fas fa-spinner bg-yellow"></i>
                    @if($approvals->hr_approval == 0)
                        <i class="fas fa-spinner bg-yellow"></i>
                    @elseif($approvals->hr_approval == 1)
                        <i class="fas fa-check bg-green"></i>
                    @elseif($approvals->hr_approval == 2)
                        <i class="fas fa-times bg-red"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time">Approved on :&nbsp;<i class="fas fa-clock"></i> {{$approvals->hr_approval_date}}</span>
                        <h3 class="timeline-header"><a>H.R Manager Approval</a></h3>
                    @if($approvals->hr_approval == 0)
                        
                            @if($dce_requisition->no_of_days < 1)
                                @php
                                    $total_wages = ($dce_requisition->rate_per_casual * $dce_requisition->no_of_casuals)
                                @endphp
                            @else
                                @php
                                    $total_wages = ($dce_requisition->rate_per_casual * $dce_requisition->no_of_casuals * $dce_requisition->no_of_days)
                               @endphp
                            @endif
                        <div class="timeline-footer">
                             Rate = Ksh.{{$dce_requisition->rate_per_casual}} <br/>
                             Casuals = {{$dce_requisition->no_of_casuals}}<br/>
                             Days = {{$dce_requisition->no_of_days}}<br/>
                             <strong>TOTALS = Ksh.{{$total_wages}}</strong><br/><br/>
                            <button type="button" class="btn btn-primary btn-sm" data-approvalid="{{$approvals->id}}" data-tokenid="{{$approvals->token_id}}" data-toggle="modal" data-target="#approve"><i class="fas fa-check"></i>&nbsp;Approve</button>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger btn-sm" data-declineid="{{$approvals->id}}" data-toggle="modal" data-target="#decline"><i class="fas fa-times"></i>&nbsp;Decline</button>
                        </div>
                    @elseif($approvals->hr_approval == 1)
                        <div class="timeline-footer">
                            <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved</button>
                             by {{$approvals->hr->name}}
                        </div>
                    @elseif($approvals->hr_approval == 2)
                        <div class="timeline-footer">
                            <button type="button" class="btn btn-danger btn-sm" ><i class="fas fa-times"></i>&nbsp;Declined</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <strong>Reason for Decline</strong>&nbsp;&nbsp;{{$approvals->decline_reason}}
                        </div>
                    @endif
                    </div>
                </div>
         @endif
        <!--end of requisition tab-->
        <br/><br/>
        <!--Start of other approvals-->       
            <div>
                 <a href="{{url ('hr_manager/applications')}}" class="btn btn-default btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>         
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
                    <form method="post"  class="form-horizontal" action="{{route('hr_manager_approve_dce_request','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     @method('put')
                    <input type="hidden" class="form-control" name="approval_id" id="approval_id" value="">
                    <input type="hidden" class="form-control" name="token_id" id="token_id" value="">
                    <input type="hidden" class="form-control" name="hr_id"  value="{{auth::user()->id}}">
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
                    <form method="post"  class="form-horizontal" action="{{route('decline_hr_manager_request','test')}}" enctype="multipart/form-data">
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
<!-- Modal for approving request -->
<div class="modal fade" id="approve_hod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<div class="modal fade" id="decline_hod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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