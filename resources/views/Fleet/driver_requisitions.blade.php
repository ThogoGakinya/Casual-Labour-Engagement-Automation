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
                  <li class="breadcrumb-item active">Fuel</li>
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
                   </div>
                   <div class="panel-body table-responsive">
                    <table class="customers-actions">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>APPLICANT</th>
                            <th>DATE</th>
                            <th>REG NO.</th>
                            <th>P MILEAGE</th>
                            <th>N MILEAGE</th>
                            <th>LITRES</th>
                            <th>APPROVAL 1</th>
                            <th>APPROVAL 2</th>
                            <th>ISSUE</th>
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
                            <td>{{$requisition->vehicle->reg_no}}</td>
                            <td>{{$requisition->previous_mileage}}</td>
                            <td>{{$requisition->current_mileage}}</td>
                            <td>{{$requisition->litres_requested}}</td>
                            <td>
                                @if($requisition->approver_1_status == 0)
                                    <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->approver_1_status == 1)
                                    <i class="fa fa-check"></i></button>
                                @elseif($requisition->approver_1_status == 2)
                                    <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                            <td>
                                @if($requisition->approver_2_status == 0)
                                    <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->approver_2_status == 1)
                                    <i class="fa fa-check"></i></button>
                                @elseif($requisition->approver_2_status == 2)
                                    <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                            <td>
                                @if($requisition->progress != 100)
                                    <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->progress == 100)
                                   <i class="fa fa-check"></i></button>
                                @endif
                            </td>
                           
                            <td>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$requisition->progress}}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{$requisition->progress}}%">
                                        {{$requisition->progress}}%
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a data-toggle="modal" data-target="#edit-request_{{$requisition->id}}"><i class="fa fa-edit"></i></a>
                                <i class="fa fa-trash"></i>  
                            </td>
                          
                        </tr>
                        @php
                          $cnt++
                        @endphp
                        <!-- start of the modal form to edit a cash request -->
                            @include('Fleet.fuel_edit_form')
                        <!-- end of the modal form to add a cash request-->
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
@include('Fleet.fuel_request_form')
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