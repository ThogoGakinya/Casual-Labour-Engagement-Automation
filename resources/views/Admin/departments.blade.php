@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Manage Departments</h5>
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
                      <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-department" ><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Add New</button>
                      <a href="{{route ('admin')}}" class="btn btn-primary btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a> 
                    </div>
                   <div class="panel-body">
                    <table class="customers-actions">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>NAME</th>
                            <th>HOD</th>
                            <th>EDIT</th>
                            <th>DEL</th>
                         </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($departments as $department)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$department->name}}</td>
                            <td>{{$department->hod->name}}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-xs" 
                                                                                    data-toggle="modal" 
                                                                                    data-target="#edit_department_{{$department->id}}   ">
                                <i class="fas fa-edit"></i>&nbsp;Edit</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-xs" data-userid="{{$department->id}}"
                                                                                    data-toggle="modal" 
                                                                                    data-target="#delete_department">
                                <i class="fas fa-trash"></i>&nbsp;Del</button>
                            </td>
                        </tr>
                        <!-- Modal for editing department -->
                        <div class="modal fade" id="edit_department_{{$department->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel" align="center">Edit Department</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <form method="post"  class="form-horizontal" action="{{route('update_department','test')}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('put')
                                        <div class="row">
                                            <div class="col-md-4">
                                            Department Name
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="name" id="name" value="{{$department->name}}">
                                                <input type="hidden" class="form-control" name="dep_id" id="name" value="{{$department->id}}">
                                            </div>
                                        </div><br/>
                                        <div class="row">
                                            <div class="col-md-4">
                                            H.O.D
                                            </div>
                                            <div class="col-md-8">
                                            <select name="hod" class="form-control" required>
                                                <option value="{{$department->hod_id}}">{{$department->hod->name}}</option>
                                                @foreach($hods as $hod)
                                                <option value="{{$hod->id}}">{{$hod->name}}</option>
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
                        <!-- End of Modal for adding category -->


                        <!-- Modal for deleting category-->
                        <div class="modal fade" id="delete_department" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" align="center">Delete Department</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <p align="center">Are you sure you want to delete this record?</p>
                                    <form method="post"  class="form-horizontal" action="{{route('delete_department','test')}}" enctype="multipart/form-data">
                                    {{method_field('delete')}}
                                    {{ csrf_field() }}
                                    <input type="hidden" class="form-control" name="dep_id" value="{{$department->id}}">
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
<!-- Modal for adding category -->
<div class="modal fade" id="add-department" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Add Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('submit_department')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                        Department Name
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="name">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        H.O.D
                        </div>
                        <div class="col-md-8">
                        <select name="hod" class="form-control" required>
                                <option value="">Select H.O.D </option>
                                @foreach($hods as $hod)
                                <option value="{{$hod->id}}">{{$hod->name}}</option>
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
<!-- End of Modal for adding category -->
<!-- Modal for editing category -->
<div class="modal fade" id="edit_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Edit Expense Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('update_category','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('put')
                    <div class="row">
                        <div class="col-md-4">
                        Category Name
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="name" id="name" value="">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Monthly Budget
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="budget" id="budget" value="">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        MTD
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="mtd" id="mtd" value="">
                          <input type="hidden" class="form-control" name="category_id" id="category_id" value="">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for adding category -->


<!-- Modal for deleting category-->
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
<!-- End of Modal for deleting category -->

@endsection