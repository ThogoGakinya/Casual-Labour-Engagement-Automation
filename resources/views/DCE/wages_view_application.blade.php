@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">H.R Representative Daily Casuals Application</h5>
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
                    <a class="nav-link active_tab1" id="list_contact_details" style="border:1px solid #ccc">H.R Representative</a>
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
                        <h3 class="timeline-header"><a>Casuals Application Details</a></h3>
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
                             
                                <div class="col-md-12">
                                      <div class="form-group">
                                      <button type="submit"  id="submit" name="submit" class="btn btn-success"><i class="fa fa-edit"></i>Update</button>
                                      </div>
                                </div> 
                           
                        </div>
                        </form>
                        </div>     
                    </div>
              </div>
            <!--end of application tab-->

            <!-- Start of Hod Approval -->
        <!--Start of H.O.D tab-->
        @if($approvals->hod_approval == 0)
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
        @else
           <div>
                    <i class="fas fa-spinner bg-yellow"></i>
                    @if($approvals->wages_approval == 0)
                        <i class="fas fa-spinner bg-yellow"></i>
                    @elseif($approvals->wages_approval == 1)
                        <i class="fas fa-check bg-green"></i>
                    @elseif($approvals->wages_approval == 2)
                        <i class="fas fa-times bg-red"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time">Approved on :&nbsp;<i class="fas fa-clock"></i> {{$approvals->wages_approval_date}}</span>
                        <h3 class="timeline-header"><a>Wages Approval</a></h3>
                    @if($approvals->wages_approval == 0)
                        <div class="timeline-footer">
                        <form method="post"  class="form-horizontal" action="{{route('wages_approve_dce_request','test')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @method('put')
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        Daily Rate
                                        <input type="number" name="rate" id="start_date" class="form-control" value="{{$dce_requisition->rate_per_casual}}" required>
                                        <input type="hidden" name="wages_id" class="form-control" value="{{$approvals->id}}" required>
                                        <input type="hidden" name="token_id" class="form-control" value="{{$approvals->token_id}}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                     <div class="form-group">
                                        Tax
                                        <input type="number" name="tax" id="start_date" class="form-control" value="{{$dce_requisition->tax}}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        NHIF
                                        <input type="number" name="nhif" id="start_date" class="form-control" value="{{$dce_requisition->nhif}}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        NSSF
                                        <input type="number" name="nssf" id="" class="form-control" value="{{$dce_requisition->nssf}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" align="right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success button"><i class="loading-icon fa fa-spinner fa-spin hide"></i>&nbsp;<span class="btn-txt">&nbsp;&nbsp;Approve</span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                    @elseif($approvals->wages_approval == 1)
                        @if($approvals->budget_approval == 0)
                                <div class="timeline-footer">
                                    <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-spinner"></i>&nbsp;Please wait for Budget Approval</button>&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                        @elseif($approvals->hr_approval == 0)
                        <div class="timeline-footer">
                            <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-spinner"></i>&nbsp;Please wait for H.R Manager's Approvals</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                        @else
                          <div class="timeline-footer">
                        <form method="post"  class="form-horizontal" action="{{route('wages_approve_dce_request','test')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @method('put')
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        Daily Rate
                                        <input type="number" name="rate" id="start_date" class="form-control" value="{{$dce_requisition->rate_per_casual}}" required>
                                        <input type="hidden" name="wages_id" class="form-control" value="{{$approvals->id}}" required>
                                        <input type="hidden" name="token_id" class="form-control" value="{{$approvals->token_id}}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                     <div class="form-group">
                                        Tax
                                        <input type="number" name="tax" id="start_date" class="form-control" value="{{$dce_requisition->tax}}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        NHIF
                                        <input type="number" name="nhif" id="start_date" class="form-control" value="{{$dce_requisition->nhif}}" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        NSSF
                                        <input type="number" name="nssf" id="" class="form-control" value="{{$dce_requisition->nssf}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" align="right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default button"><i class="fa fa-edit"></i>&nbsp;<span class="btn-txt">&nbsp;&nbsp;Update</span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="timeline-footer">
                        @if(count($selected) != 0)
                            <a href="{{route('approvals',$dce_requisition->token_id)}}" class="btn btn-primary btn-sm" ><i class="fas fa-print"></i>&nbsp;Print Approvals</a>&nbsp;&nbsp;
                            <a href="{{route('contract',$dce_requisition->token_id)}}" class="btn btn-primary btn-sm" ><i class="fas fa-print"></i>&nbsp;Print Contract</a>&nbsp;&nbsp;
                        @endif
                            <br/>
                            <div class="table-responsive" id="contract">
                            <table class="customers-actions">
                                <thead>
                                    <tr>
                                        <th colspan="2" align="center">CASUAL DATA</th>
                                        <th colspan="4" align="center">DEDUCTIONS</th>
                                        <th colspan="2" align="center">PAYABLE AMOUNT</th>
                                        <th align="center">ACTION</th>
                                    </tr>
                                    <tr>
                                        <th>No.</th>
                                        <th>Choose user</th>
                                        <th>Tax</th>
                                        <th>NHIF</th>
                                        <th>NSSF</th>
                                        <th>Total D</th>
                                        <th>Gross</th>
                                        <th>Net</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php
                                   $deductions = ($dce_requisition->tax + $dce_requisition->nhif + $dce_requisition->nssf);
                                   $net = ($dce_requisition->rate_per_casual - $deductions);
                                   $cnt = 1;
                                @endphp
                                <tbody>
                                    <tr>
                                    <form method="post"  action="{{route('submit_prefered_casual')}}" enctype="multipart/form-data">
                                       {{ csrf_field() }}
                                        <td>0</td>
                                        <td width="30%">
                                            <select class="form-control casual_id" name="casual_id" required>
                                                <option value="">Search By ID</option>
                                                 @foreach($casuals as $casual)
                                                  <option value="{{$casual->id}}">{{$casual->casual_id_no}}_{{$casual->casual_name}}</option>
                                                 @endforeach 
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="tax" id="" class="form-control" value="{{$dce_requisition->tax}}" required>
                                            <input type="hidden" name="token_id" id="" class="form-control" value="{{$dce_requisition->token_id}}" required>
                                        </td>
                                        <td>
                                             <input type="number" name="nhif" id="" class="form-control" value="{{$dce_requisition->nhif}}" required>
                                        </td>
                                        <td>
                                            <input type="number" name="nssf" id="" class="form-control" value="{{$dce_requisition->nssf}}" required>
                                        </td>
                                        <td>
                                          <input type="number" name="total_deductions" id="" class="form-control" value="{{$deductions}}" required>
                                        </td>
                                        <td>
                                          <input type="number" name="gross" id="" class="form-control" value="{{$dce_requisition->rate_per_casual}}" required>
                                        </td>
                                        <td>
                                          <input type="number" name="net" id="" class="form-control" value="{{$net}}" required>
                                        </td>
                                        <td>
                                          <button type="submit" class="btn btn-success btn-xs"><i class="fas fa-plus"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;  
                                        </td>
                                    </tr>
                                    </form> 
                                    @foreach($selected as $casual)
                                         <tr>
                                             <td>{{$cnt}}</td>
                                             <td>{{$casual->user->casual_name}}</td>
                                             <td>{{$casual->tax}}</td>
                                             <td>{{$casual->nhif}}</td>
                                             <td>{{$casual->nssf}}</td>
                                             <td>{{$casual->total_deductions}}</td>
                                             <td>{{$casual->gross_pay}}</td>
                                             <td>{{$casual->net_pay}}</td>
                                             <td>
                                             <form method="post"  class="form-horizontal" action="{{route('remove_casual',$casual->id)}}" enctype="multipart/form-data">
                                                {{method_field('delete')}}
                                                {{ csrf_field() }}
                                                <input type="hidden" class="form-control" name="casual_id" id="user_id" value="">
                                                <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-times-circle"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;  
                                            </form>
                                                
                                             </td>
                                         </tr>
                                         @php
                                            $cnt++
                                         @endphp
                                        @endforeach
                               
                                </tbody>
                            </table>
                            </div>
                        </div>
                    @endif
                    @elseif($approvals->hod_approval == 2)
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
                 <a href="{{url ('wages/applications')}}" class="btn btn-default btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>         
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
