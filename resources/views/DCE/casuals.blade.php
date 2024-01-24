@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Manage Casuals</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">H.R Representative</li>
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
                      <a href="{{route('add_casual_form')}}" class="btn btn-info btn-sm" ><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Add New</a>
                      <a href="{{url ('wages/applications')}}" class="btn btn-default btn-sm" ><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
                   </div>
                   <div class="panel-body">
                    <table class="customers-actions" id="table">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>NAME</th>
                            <th>ID</th>
                            <th>NHIF</th>
                            <th>NSSF</th>
                            <th>KRA PIN</th>
                            <th>TEL</th>
                            <th>DETAILS</th>
                         </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($casuals as $casual)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$casual->casual_name}}</td>
                            <td>{{$casual->casual_id_no}}</td>
                            <td>{{$casual->nhif_no}}</td>
                            <td>{{$casual->nssf_no}}</td>
                            <td>{{$casual->kra_pin}}</td>
                            <td>{{$casual->tel_no}}</td>
                            <td>
                               <a href="{{url ('/casual/'.$casual->id)}}" class="btn btn-success btn-xs editbtn"><i class="fa fa-eye"></i>&nbsp;Details</a>
                            </td>
                        </tr>
                        @php
                          $cnt++;
                        @endphp
                        @endforeach
                        </tbody>
                    </table>
                   </div>
                  </div>
                 </div>
        <!-- end of request history-->

<!-- Modal for deleting casual-->
<div class="modal fade" id="delete_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <p align="center">Are you sure you want to delete this record?</p>
                    <form method="post"  class="form-horizontal" action="{{route('delete_user','test')}}" enctype="multipart/form-data">
                    {{method_field('delete')}}
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="user_id" id="user_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"> No Cancel</button>
                <button type="submit" class="btn btn-danger">Yes Delete</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for deleting casual-->

@endsection