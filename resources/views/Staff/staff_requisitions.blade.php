@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">My Requisitions</h5>
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
                   <div class="panel-heading"><a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-request"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Request</a>
                   <a href="{{route ('staff_dashboard')}}" class="btn btn-primary btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a> 
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                   <strong>KEY:</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <button type="button" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button> &nbsp;&nbsp;Approved &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <button type="button" class="btn btn-warning btn-xs"><i class="fas fa-spinner"></i></button>&nbsp;&nbsp;Waiting &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>&nbsp;&nbsp;Declined &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                            <th>HOD</th>
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
                        @foreach($requisitions as $requisition)
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
                            @if($requisition->hod_approval_status == 0)
                                <td>
                                  <button type="button" class="btn btn-default btn-xs editbtn" data-requestid="{{$requisition->id}}" data-hodid="{{$requisition->hod_id}}"
                                  data-hodname="{{$requisition->hod->name}}" data-budgetoid="{{$requisition->budgeto_id}}"
                                  data-budgetoname="{{$requisition->budgeto->name}}" data-description="{{$requisition->description}}"  data-amount="{{$requisition->amount}}" data-toggle="modal" data-target="#edit-request"><i class="fa fa-edit"title="Edit requisition"></i></button>
                                  <button type="button" class="btn btn-danger btn-xs" data-requisitionid="{{$requisition->id}}"
                                                                                    data-toggle="modal" 
                                                                                    data-target="#delete_requisition">
                                  <i class="fas fa-trash" title="Delete requisition"></i></button>
                                </td>
                            @elseif($requisition->hod_approval_status == 1)
                                @if($requisition->admin_approval_status == 0)
                                <td>
                                <a href="{{url ('/admin_request/'.$requisition->token_id)}}" class="btn btn-success btn-xs editbtn" id="edit_goal"><i class="fa fa-eye"></i>&nbsp;&nbsp;View</a>
                                </td>
                                @elseif($requisition->admin_approval_status == 1)
                                <td>
                                <a href="{{url ('/documents/'.$requisition->token_id)}}" class="btn btn-success btn-xs editbtn" id="edit_goal"><i class="fa fa-eye"></i>&nbsp;&nbsp;View</a>
                                </td>
                                @endif
                            @else
                               <td>
                                <a href="{{url ('/admin_request/'.$requisition->token_id)}}" class="btn btn-success btn-xs editbtn" id="edit_goal"><i class="fa fa-eye"></i>&nbsp;&nbsp;View</a>
                                </td>
                            @endif
                        </tr>
                        @php
                          $cnt++
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                   </div>
                   {{$requisitions->links()}}
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
@include('Staff.edit_form')
<!-- end of the modal form to add a cash request-->

<!-- Modal for deleting requisition-->
<div class="modal fade" id="delete_requisition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Delete Requisition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <p align="center">Are you sure you want to delete this request?</p>
                    <form method="post"  class="form-horizontal" action="{{route('delete_requisition','test')}}" enctype="multipart/form-data">
                    {{method_field('delete')}}
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="requisition_id" id="requisition_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"> No Cancel</button>
                <button type="submit" class="btn btn-danger">Yes Delete</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for deleting members -->

@endsection