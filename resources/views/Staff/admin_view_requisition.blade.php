@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Cash Requisition</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Petty cash</li>
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
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" style="border:1px solid #ccc" id="list_login_details">Requisition</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_personal_details" style="border:1px solid #ccc">H.O.D</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Budget Owner</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Budgeting</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">C.F.O</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Internal Auditor</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active_tab1" id="list_contact_details" style="border:1px solid #ccc">Collection</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Documents</a>
                  </li>
                 
                </ul>
        <!-- End of tabs content -->

<!--Start of requisition tab-->
                <div class="tab-content" style="margin-top:16px;">
                 <div class="tab-pane active" id="login_details">
                  <div class="panel panel-default">
     
                   <div class="panel-body">
                        <!-- START ALERTS AND CALLOUTS -->
       @foreach($specific_admin_requisition as $specific)                    
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <div>
                    <i class="fas fa-check bg-green"></i>
                    <div class="timeline-item">
                        <span class="time">Requested on :&nbsp;<i class="fas fa-clock"></i>&nbsp;{{$specific->created_at}}</span>
                        <h3 class="timeline-header"><a href="#">Request No. #{{$specific->token_id}}</a></h3>

                        <div class="timeline-body">
                        <div class="row">
                            <div class="col-md-4">
                             <strong>Request By : </strong>{{$specific->user->name}}
                            </div>
                            <div class="col-md-4">
                            <strong>Department : </strong>{{$specific->department->name}}
                            </div>
                            <div class="col-md-4">
                            <strong>Amount: </strong>{{$specific->amount}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                               <strong>Description :</strong>
                            </div><br/>
                        </div>
                        {{$specific->description}}
                        </div>
                      
                    </div>
              </div>
         
  <!--end of requisition tab-->
  <!--Start of Budgetting tab-->
  <div>
                    <i class="fas fa-spinner bg-yellow"></i>
                    @if($specific->admin_approval_status == 0)
                        <i class="fas fa-spinner bg-yellow"></i>
                    @elseif($specific->admin_approval_status == 1)
                        <i class="fas fa-check bg-green"></i>
                    @elseif($specific->admin_approval_status == 2)
                        <i class="fas fa-times bg-red"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time">Approved on :&nbsp;<i class="fas fa-clock"></i> {{$specific->admin_approval_date}}</span>
                        <h3 class="timeline-header"><a href="#">Cash Collection</a></h3>
            @if($specific->hod_approval_status == 0)
                       <div class="timeline-footer">
                            <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-caution"></i>&nbsp;Please wait for HOD's approval</button>
                       </div>
            @elseif($specific->hod_approval_status == 2)
                       <div class="timeline-footer">
                            <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-caution"></i>&nbsp;This request was declined by {{$specific->decline->name}}</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <strong>Reason for Decline</strong>&nbsp;&nbsp;{{$specific->decline_reason}}
                       </div>
            @elseif($specific->budgeto_approval_status == 0)
                        <div class="timeline-footer">
                                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-caution"></i>&nbsp;Please wait for Budget Owner approval</button>
                        </div>
            @elseif($specific->budgeto_approval_status == 2)
                        <div class="timeline-footer">
                                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-caution"></i>&nbsp;This request was declined by {{$specific->decline->name}}</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <strong>Reason for Decline</strong>&nbsp;&nbsp;{{$specific->decline_reason}}
                        </div>
            @elseif($specific->budget_approval_status == 0)
            <div class="timeline-footer">
                    <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-caution"></i>&nbsp;Please wait for Budgetting</button>
            </div>
            @elseif($specific->budget_approval_status == 2)
            <div class="timeline-footer">
                    <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-caution"></i>&nbsp;This request was declined by {{$specific->decline->name}}</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <strong>Reason for Decline</strong>&nbsp;&nbsp;{{$specific->decline_reason}}
            </div>
            @else 
                @if($specific->cfo_ia_status == 0)
                        <div class="timeline-footer">
                                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-caution"></i>&nbsp;Please wait for CFO or IA Approval</button>
                        </div>
                @elseif($specific->cfo_ia_status == 2)
                        <div class="timeline-footer">
                                <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-caution"></i>&nbsp;This request was declined by {{$specific->decline->name}}</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <strong>Reason for Decline</strong>&nbsp;&nbsp;{{$specific->decline_reason}}
                        </div>
                @else 

                    @if($specific->admin_approval_status == 0)
                        @if(auth::user()->level != 7)
                         <div class="timeline-footer">
                            <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-thumbs-up"></i>&nbsp;Please proceed to the reception for collection</button>
                         </div>
                        @else
                        <div class="timeline-footer">
                            <button type="button" class="btn btn-default btn-sm" data-approvalid="{{$specific->id}}" data-amount="{{$specific->amount}}" data-toggle="modal" data-target="#approve">&nbsp;Cash</button>&nbsp;&nbsp;&nbsp;
                            <img src="{{ asset('dist/img/mpesa.png')}}" alt="M-PESA" height="5%" width="10%" data-approvalid="{{$specific->id}}" data-amount="{{$specific->amount}}" data-toggle="modal" data-target="#mpesa">
                        </div>
                        @endif
                    @elseif($specific->admin_approval_status == 1)
                        <div class="timeline-footer">
                            <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved</button>
                             by {{$specific->admin_approver->name}}
                        </div>
                    @elseif($specific->admin_approval_status == 2)
                        <div class="timeline-footer">
                            <button type="button" class="btn btn-danger btn-sm" ><i class="fas fa-times"></i>&nbsp;Declined</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <strong>Reason for Decline</strong>&nbsp;&nbsp;{{$specific->decline_reason}}
                        </div>
                    @endif
                @endif
            @endif
                    </div>
                </div>
<!--end of requisition tab-->
<br/><br/>
<!--Start of other approvals-->
             <div>
                    @if($specific->budget_approval_status == 0)
                        <i class="fas fa-spinner bg-yellow"></i>
                    @elseif($specific->budget_approval_status == 1)
                        <i class="fas fa-check bg-green"></i>
                    @elseif($specific->budget_approval_status == 2)
                        <i class="fas fa-times bg-red"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"></span>
                        <h3 class="timeline-header"><a href="#">Approvals</a></h3>

                       <!--H.O.D Checks-->  
                       <div class="timeline-footer">
                          1.<strong>H.O.D : </strong>&nbsp;&nbsp;{{$specific->hod_approver->name}}&nbsp;&nbsp;&nbsp;
                          <i class="fas fa-clock"></i><small> {{$specific->hod_approval_date}}</small>&nbsp;&nbsp;&nbsp;
                           @if($specific->hod_approval_status == 0)   
                            <button type="button" class="btn btn-warning btn-xs"><i class="fas fa-spinner"></i>&nbsp;waiting..</button>
                           @elseif($specific->hod_approval_status == 1)
                           <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved</button>
                           @elseif($specific->hod_approval_status == 2)
                           <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-times"></i>&nbsp;Declined</button>
                           @endif
                       </div>
                      <!--Budget Owner Checks-->  
                       <div class="timeline-footer">
                          2.<strong>Budget Owner : </strong>&nbsp;&nbsp;{{$specific->budgeto_approver->name}}&nbsp;&nbsp;&nbsp;
                          <i class="fas fa-clock"></i><small> {{$specific->budgeto_approval_date}}</small>&nbsp;&nbsp;&nbsp;
                           @if($specific->budgeto_approval_status == 0)   
                            <button type="button" class="btn btn-warning btn-xs"><i class="fas fa-spinner"></i>&nbsp;waiting..</button>
                           @elseif($specific->budgeto_approval_status == 1)
                           <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved</button>
                           @elseif($specific->budgeto_approval_status == 2)
                           <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-times"></i>&nbsp;Declined</button>
                           @endif
                       </div>
                       <!--Budget Officer Checks-->  
                       <div class="timeline-footer">
                          3.<strong>Budget Officer : </strong>&nbsp;&nbsp;{{$specific->budget_approver->name}}&nbsp;&nbsp;&nbsp;
                          <i class="fas fa-clock"></i><small> {{$specific->budget_approval_date}}</small>&nbsp;&nbsp;&nbsp;
                           @if($specific->budget_approval_status == 0)   
                            <button type="button" class="btn btn-warning btn-xs"><i class="fas fa-spinner"></i>&nbsp;waiting..</button>
                           @elseif($specific->budget_approval_status == 1)
                           <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved</button>
                           @elseif($specific->budget_approval_status == 2)
                           <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-times"></i>&nbsp;Declined</button>
                           @endif
                       </div>
                        <!--C.F.O Checks-->  
                        <div class="timeline-footer">
                          4.<strong>C.F.O : </strong>&nbsp;&nbsp;{{$specific->cfo_approver->name}}&nbsp;&nbsp;&nbsp;
                          <i class="fas fa-clock"></i><small> {{$specific->cfo_approval_date}}</small>&nbsp;&nbsp;&nbsp;
                           @if($specific->cfo_approval_status == 0)   
                            <button type="button" class="btn btn-warning btn-xs"><i class="fas fa-spinner"></i>&nbsp;waiting..</button>
                           @elseif($specific->cfo_approval_status == 1)
                           <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved</button>
                           @elseif($specific->cfo_approval_status == 2)
                           <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-times"></i>&nbsp;Declined</button>
                           @endif
                       </div>
                       <!--I.A Checks-->  
                       <div class="timeline-footer">
                          5.<strong>Internal Auditor: </strong>&nbsp;&nbsp;{{$specific->ia_approver->name}}&nbsp;&nbsp;&nbsp;
                          <i class="fas fa-clock"></i><small> {{$specific->ia_approval_date}}</small>&nbsp;&nbsp;&nbsp;
                           @if($specific->ia_approval_status == 0)   
                            <button type="button" class="btn btn-warning btn-xs"><i class="fas fa-spinner"></i>&nbsp;waiting..</button>
                           @elseif($specific->ia_approval_status == 1)
                           <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved</button>
                           @elseif($specific->ia_approval_status == 2)
                           <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-times"></i>&nbsp;Declined</button>
                           @endif
                       </div>
                        <!--Cash Collection-->  
                        <div class="timeline-footer">
                          6.<strong>Collection : </strong>&nbsp;&nbsp;{{$specific->admin_approver->name}}&nbsp;&nbsp;&nbsp;
                          <i class="fas fa-clock"></i><small> {{$specific->admin_approval_date}}</small>&nbsp;&nbsp;&nbsp;
                           @if($specific->admin_approval_status == 0)   
                            <button type="button" class="btn btn-warning btn-xs"><i class="fas fa-spinner"></i>&nbsp;waiting..</button>
                           @elseif($specific->admin_approval_status == 1)
                           <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved</button>
                           @elseif($specific->admin_approval_status == 2)
                           <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-times"></i>&nbsp;Declined</button>
                           @endif
                       </div>
                       <!--Documents Check-->  
                       <div class="timeline-footer">
                          7.<strong>Documents : </strong>&nbsp;&nbsp;{{$specific->documents_approver->name}}&nbsp;&nbsp;&nbsp;
                          <i class="fas fa-clock"></i><small> {{$specific->documents_approval_date}}</small>&nbsp;&nbsp;&nbsp;
                           @if($specific->documents_approval_status == 0)   
                            <button type="button" class="btn btn-warning btn-xs"><i class="fas fa-spinner"></i>&nbsp;waiting..</button>
                           @elseif($specific->documents_approval_status == 1)
                           <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved</button>
                           @elseif($specific->documents_approval_status == 2)
                           <button type="button" class="btn btn-danger btn-xs"><i class="fas fa-times"></i>&nbsp;Declined</button>
                           @endif
                       </div>
                    </div>
              </div>
              <div>
                 @if(auth::user()->level == 7)
                 <a href="{{route ('admin_requisitions')}}" class="btn btn-primary btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>         
                 @elseif(auth::user()->level == 1)
                 <a href="{{route ('user_requisitions')}}" class="btn btn-primary btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>         
                @endif
              </div>
      @endforeach
    </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

<!-- Modal for approving request -->
<div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Issue Petty Cash</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('admin_approve_request','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     @method('put')
                     <div class="row">
                        <div class="col-md-4">
                        Issued Amount
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="issued_amount" id="amount" value="" required>
                        </div>
                    </div>
                        <div class="col-md-8">
                          <input type="hidden" class="form-control" name="approval_id" id="approval_id" value="">
                          <input type="hidden" class="form-control" name="admin_id"  value="{{auth::user()->id}}">
                          <input type="hidden" class="form-control" name="payment_mode"   value="CASH" required>
                          <input type="hidden" class="form-control" name="sending_charges"   value="0" required>
                          <input type="hidden" class="form-control" name="withdrawal_charges"   value="0" required>
                        </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal"> Not Now</button>
                          <button type="submit" class="btn btn-success">Yes Approve</button>
                      </div>
                     </form>
            </div>
          </div>
    </div>
</div>
<!-- End of Modal for approving -->
<!-- Modal for mpesa -->
<div class="modal fade" id="mpesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">M-PESA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('admin_approve_request','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     @method('put')
                     <div class="row">
                        <div class="col-md-4">
                        Requested Amount
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="requested_amount" id="requested_amount" value=""  required>
                            <input type="hidden" class="form-control" name="payment_mode"   value="M-PESA" required>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Sending Charges
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="sending_charges" id="sending_amount" value=""  required>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Withdrawal Charges
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="withdrawal_charges" id="withdrawal_amount"  value="" required>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Amount to Send
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="withdrawal_amount" id="to_send"  value="" required>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        TOTAL DEBITED
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="issued_amount" id="issued_amount" value=""  required>
                        </div>
                    </div>
                        <div class="col-md-8">
                          <input type="hidden" class="form-control" name="approval_id" id="approval_id" value="">
                          <input type="hidden" class="form-control" name="admin_id"  value="{{auth::user()->id}}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"> Not Now</button>
                            <button type="submit" class="btn btn-success button"><i class="loading-icon fa fa-spinner fa-spin hide"></i>&nbsp;<span class="btn-txt">&nbsp;&nbsp;Issue</span></button>
                        </div>
                     </form>
            </div>
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
                    <form method="post"  class="form-horizontal" action="{{route('decline_request','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     @method('put')
                    <textarea class="form-control" rows="4" name="reason" placeholder="Please provide a reason for declining this request" required></textarea>
                    <input type="hidden" class="form-control" name="decline_id" id="decline_id" value="">
                    <input type="hidden" class="form-control" name="hod_id"  value="{{auth::user()->id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Not Now</button>
                <button type="submit" class="btn btn-warning">Yes Decline</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for declining request -->


@endsection