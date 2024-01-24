@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Manage Divisions</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Admin</li>
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
                      <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-division" ><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Add New</button>
                      <a href="{{route ('admin')}}" class="btn btn-primary btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a> 
                    </div>
                  
                    <table class="customers-actions">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>NAME</th>
                            <th>DEPARTMENT</th>
                            <th>LINE MANAGER</th>
                            <th>EDIT</th>
                            <th>DEL</th>
                         </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($divisions as $division)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$division->name}}</td>
                            <td>{{$division->department->name}}</td>
                            <td>{{$division->line_manager->name}}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-xs" 
                                                                                    data-toggle="modal" 
                                                                                    data-target="#edit_division_{{$division->id}}">
                                <i class="fas fa-edit"></i>&nbsp;Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-xs" data-userid="{{$division->id}}"
                                                                                    data-toggle="modal" 
                                                                                    data-target="#delete_division_{{$division->id}}">
                                <i class="fas fa-trash"></i>&nbsp;Del</button>
                            </td>
                        </tr>
                        <!-- Modal for editing divisions -->
                        <div class="modal fade" id="edit_division_{{$division->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel" align="center">Edit Division</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <form method="post"  class="form-horizontal" action="{{route('update_division','test')}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('put')
                                        <div class="row">
                                            <div class="col-md-4">
                                            Division Name
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="name" id="name" value="{{$division->name}}">
                                                <input type="hidden" class="form-control" name="div_id" id="name" value="{{$division->id}}">
                                            </div>
                                        </div><br/>
                                        <div class="row">
                                            <div class="col-md-4">
                                            Line Manager
                                            </div>
                                            <div class="col-md-8">
                                            <select name="manager" class="form-control" required>
                                                <option value="{{$division->line_manager_id}}">{{$division->line_manager->name}}</option>
                                                @foreach($all_users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div><br/>
                                        <div class="row">
                                            <div class="col-md-4">
                                            Department
                                            </div>
                                            <div class="col-md-8">
                                            <select name="dept" class="form-control" required>
                                                <option value="{{$division->department_id}}">{{$division->department->name}}</option>
                                                @foreach($departments as $department)
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div><br/>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>
                        <!-- End of Modal for adding division -->


                        <!-- Modal for deleting division-->
                        <div class="modal fade" id="delete_division_{{$division->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" align="center">Delete division</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <p align="center">Are you sure you want to delete this record?</p>
                                    <form method="post"  class="form-horizontal" action="{{route('delete_division','test')}}" enctype="multipart/form-data">
                                    {{method_field('delete')}}
                                    {{ csrf_field() }}
                                    <input type="hidden" class="form-control" name="div_id" value="{{$division->id}}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal"> No Cancel</button>
                                <button type="submit" class="btn btn-danger">Yes Delete</button>
                            </div>
                        </form>
                        </div>
                        </div>
                        </div>
                        <!-- End of Modal for deleting category -->
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
    
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
<!-- Modal for adding division -->
<div class="modal fade" id="add-division" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Add division</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('submit_division')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                        Division Name
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="name">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Department
                        </div>
                        <div class="col-md-8">
                        <select name="dep" class="form-control" required>
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                        </select>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Line Manager
                        </div>
                        <div class="col-md-8">
                        <select name="lm" class="form-control" required>
                                <option value="">Select Line Manager </option>
                                @foreach($all_users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                        </select>
                        </div>
                    </div><br/>
                   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for adding division -->
@endsection