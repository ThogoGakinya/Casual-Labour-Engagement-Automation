@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">My Requisitions/Approvals</h5>
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
        <!-- End of tabs content -->

        <!-- Start of request history -->
                <div class="tab-content" style="margin-top:16px;">
                 <div class="tab-pane active" id="login_details">
                  <div class="panel panel-default">
                   <div class="panel-heading">
                      <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-request"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Request</a>
                      <a href="{{route ('categories')}}" class="btn btn-info btn-sm" ><i class="fa fa-eye"></i>&nbsp;&nbsp;Expense Categories</a>
                      <a href="{{route ('staff_dashboard')}}" class="btn btn-info btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
                   </div>
                   <div class="panel-body">
                    <table class="customers-actions">
                      <thead>
                      <tr>
                            <th>S.N</th>
                            <th>APPLICANT</th>
                            <th>REQUEST DATE</th>
                            <th>VOUCHER</th>
                            <th>AMOUNT</th>
                            <th>H.O.D</th>
                            <th>B.O</th>
                            <th>BUD</th>
                            <th>CFO</th>
                            <th>I.A</th>
                            <th>ISSUE</th>
                            <th>DOCS</th>
                            <th>PROGRESS</th>
                            <th>ACTION</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($budget_requisitions as $requisition)
                        <tr>
                        <td>{{$cnt}}</td>
                            <td>{{$requisition->user->name}}</td>
                            <td>{{$requisition->created_at}}</td>
                            <td>{{$requisition->token_id}}</td>
                            <td>{{$requisition->amount}}</td>
                            <td>
                                @if($requisition->hod_approval_status == 0)
                                     <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->hod_approval_status == 1)
                                   <i class="fa fa-check"></i></button>
                                @elseif($requisition->hod_approval_status == 2)
                                     <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                            <td>
                                @if($requisition->budgeto_approval_status == 0)
                                     <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->budgeto_approval_status == 1)
                                   <i class="fa fa-check"></i></button>
                                @elseif($requisition->budgeto_approval_status == 2)
                                     <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                            <td>
                                @if($requisition->budget_approval_status == 0)
                                     <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->budget_approval_status == 1)
                                   <i class="fa fa-check"></i></button>
                                @elseif($requisition->budget_approval_status == 2)
                                     <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                           
                            <td>
                                @if($requisition->cfo_approval_status == 0)
                                     <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->cfo_approval_status == 1)
                                   <i class="fa fa-check"></i></button>
                                @elseif($requisition->cfo_approval_status == 2)
                                     <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                            <td>
                                @if($requisition->ia_approval_status == 0)
                                     <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->ia_approval_status == 1)
                                   <i class="fa fa-check"></i></button>
                                @elseif($requisition->ia_approval_status == 2)
                                     <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                            <td>
                                @if($requisition->admin_approval_status == 0)
                                     <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->admin_approval_status == 1)
                                   <i class="fa fa-check"></i></button>
                                @elseif($requisition->admin_approval_status == 2)
                                     <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                            <td>
                                @if($requisition->documents_approval_status == 0)
                                     <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->documents_approval_status == 1)
                                   <i class="fa fa-check"></i></button>
                                @elseif($requisition->documents_approval_status == 2)
                                     <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                            <td>
                            @if($requisition->process_status == 20)
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$requisition->process_status}}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{$requisition->process_status}}%">
                                        {{$requisition->process_status}}%
                                    </div>
                                </div>
                            @elseif($requisition->process_status == 40)
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$requisition->process_status}}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{$requisition->process_status}}%">
                                        {{$requisition->process_status}}%
                                    </div>
                                </div>
                            @elseif($requisition->process_status == 60)
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$requisition->process_status}}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{$requisition->process_status}}%">
                                        {{$requisition->process_status}}%
                                    </div>
                                </div>
                            @elseif($requisition->process_status == 80)
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$requisition->process_status}}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{$requisition->process_status}}%">
                                        {{$requisition->process_status}}%
                                    </div>
                                </div>
                            @elseif($requisition->process_status == 90)
                            <div class="progress mb-3">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$requisition->process_status}}" aria-valuemin="0"
                                    aria-valuemax="100" style="width: {{$requisition->process_status}}%">
                                    {{$requisition->process_status}}%
                                </div>
                            </div>
                            @elseif($requisition->process_status == 100)
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$requisition->process_status}}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{$requisition->process_status}}%">
                                        {{$requisition->process_status}}%
                                    </div>
                                </div>
                            @endif
                            </td>
                            <td>
                            <a href="{{url ('/budget_request/'.$requisition->token_id)}}" class="btn btn-success btn-xs editbtn" id="edit_goal"><i class="fa fa-eye"></i>&nbsp;&nbsp;View</a>
                            </td>
                        </tr>
                        @php
                          $cnt++
                        @endphp
                        @endforeach
                        </tbody>
                    </table>
                   </div>
                   {{$budget_requisitions->links()}}
                  </div>
                 </div>
        <!-- end of request history-->
    
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

<!-- start of the modal form to add a cash request -->
@include('Staff.request_form')
<!-- end of the modal form to add a cash request-->

<!-- start of the modal form to edit a cash request -->
<div class="modal fade" id="edit-request">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Alert!</h5>
                    Proper supporting documentation must be submitted to the Administration office within 3 days of receiving cash. Failure to comply will attract non-refundable salary
                    deductions.
                </div>
                <form method="post"  class="form-horizontal" action="{{route('update_request','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     @method('put')
              @php 
                $requestTocken = rand(100000,999999);
              @endphp
                <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="target">H.O.D</label>
                                        <input type="text" name="hods" class="form-control" id="hod_name" value="" disabled>
                                        <input type="hidden" name="request_id" class="form-control" id="request_id" value="">
                                        <select name="hod" class="form-control" required>
                                             <option  id="hod_id" value=""><small>Change H.O.D</small></option>
                                             @foreach($all_users as $users)
                                             <option value="{{$users->id}}">{{$users->name}}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="target">Amount Requested</label>
                                        <input type="number" name="amount" class="form-control" id="amount" value="" required>
                                        <input type="hidden" name="department" value="{{ Auth::user()->department_id}}" id="target" placeholder="Enter Amount" maxlength="4" required>
                                        <input type="hidden" name="userid" value="{{ Auth::user()->id }}" id="target" placeholder="Enter Amount" maxlength="4" required>
                                        <input type="hidden" name="process_status" value="20" id="target" placeholder="Enter Amount" maxlength="4" required>
                                        <input type="hidden" name="token_id" value="{{$requestTocken}}" id="target" placeholder="Enter Amount" maxlength="4" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="goal">Description of Need</label>
                                        <textarea class="form-control" name="description" id="description" rows="3" value=""></textarea>
                                    </div>
                                    
                                </div>
                               <!-- /.card-body -->
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel Request</button>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Update</button>
                                </div>
                        </form>
                </div>
            </div>   <!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
<!-- end of the modal form to add a cash request-->
@endsection