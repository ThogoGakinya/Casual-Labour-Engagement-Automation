@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Manage Drivers</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Fleet</li>
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
                      <a href="" data-toggle="modal" data-target="#add_driver" class="btn btn-info btn-sm" ><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Add New Driver</a>
                      <a href="{{route ('fleet')}}" class="btn btn-default btn-sm" ><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
                   </div>
                   <div class="panel-body">
                   <div class="table-responsive">
                    <table class="customers-actions">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Vehicle</th>
                            <th>Date Assigned</th>
                            <th>EDIT</th>
                            <th>DEL</th>
                         </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($drivers as $driver)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$driver->name}}</td>
                            <td>{{$driver->email}}</td>
                            <td>{{$driver->vehicle->reg_no}}</td>
                            <td>{{$driver->created_at}}</td>
                            <td>
                            <a href="" class="btn btn-primary btn-xs editbtn" data-toggle="modal" data-target="#edit_driver_{{$driver->id}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_driver_{{$driver->id}}">
                                <i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @php
                          $cnt++;
                        @endphp
                        <!-- Modal for editing driver -->
                        <div class="modal fade" id="edit_driver_{{$driver->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" align="center">Edit Driver</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <form method="post"  class="form-horizontal" action="{{route('edit-driver',$driver->id)}}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            @method('put')
                                            <div class="row">
                                                <div class="col-md-4">
                                                Name :
                                                </div>
                                                <div class="col-md-8">
                                                <input type="text" class="form-control" name="name" value="{{$driver->name}}" required>
                                                </div>
                                            </div><br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                                Email :
                                                </div>
                                                <div class="col-md-8">
                                                <input type="text" class="form-control" name="email" value="{{$driver->email}}" required>
                                                </div>
                                            </div><br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                            Assign Vehicle :
                                                </div>
                                                <div class="col-md-8">
                                                <select class="form-control" name="vehicle" >
                                                    <option value="{{$driver->vehicle_id}}">{{$driver->vehicle->reg_no}}</option>
                                                    @foreach($vehicles as $vehicle)
                                                    <option value="{{$vehicle->id}}">{{$vehicle->reg_no}}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div><br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                            Mobile No. :
                                                </div>
                                                <div class="col-md-8">
                                                <input type="text" class="form-control" name="phone" value="{{$driver->phone}}" >
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
                        <!-- End of Modal for editing driver-->
                        <!-- Modal for deleting driver-->
                        <div class="modal fade" id="delete_driver_{{$driver->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" align="center">Delete Driver</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <p align="center">Are you sure you want to delete this record?</p>
                                            <form method="post"  class="form-horizontal" action="{{route('delete_driver',$driver->id)}}" enctype="multipart/form-data">
                                            {{method_field('delete')}}
                                            {{ csrf_field() }}
                                           
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
                        @endforeach
                        </tbody>
                    </table>
                
                  </div>
                   </div>
                  </div>
                 </div>
        <!-- end of request history-->
    
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
<!-- Modal for adding driver -->
<div class="modal fade" id="add_driver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Add New Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('post-driver')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                        Name :
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="name" required>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Email :
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="email" required>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                       Assign Vehicle :
                        </div>
                        <div class="col-md-8">
                          <select class="form-control" name="vehicle" >
                            <option value="">Select Vehicle</option>
                            @foreach($vehicles as $vehicle)
                              <option value="{{$vehicle->id}}">{{$vehicle->reg_no}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                       Mobile No. :
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="phone" >
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


@endsection