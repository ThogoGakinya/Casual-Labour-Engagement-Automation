@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Manage  Vehicles</h5>
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
                      <a href="" data-toggle="modal" data-target="#add_vehicle" class="btn btn-info btn-sm" ><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Add New Vehicle</a>
                      <a href="{{route ('fleet')}}" class="btn btn-default btn-sm" ><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
                   </div>
                   <div class="panel-body">
                   <div class="table-responsive">
                    <table class="customers-actions">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>REG NO.</th>
                            <th>MODEL</th>
                            <th>MAKE</th>
                            <th>CAPACITY</th>
                            <th>KM/LTR</th>
                            <th>DRIVER</th>
                            <th>EDIT</th>
                            <th>DEL</th>
                         </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($vehicles as $vehicle)
                        
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$vehicle->reg_no}}</td>
                            <td>{{$vehicle->model}}</td>
                            <td>{{$vehicle->make}}</td>
                            <td>{{$vehicle->tank_capacity}}</td>
                            <td>{{$vehicle->coverage_per_litre}}</td>
                            <td>{{$vehicle->driver->name}}</td>
                            <td>
                            <a href="" class="btn btn-primary btn-xs editbtn" data-toggle="modal" data-target="#edit_vehicle_{{$vehicle->id}}"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_vehicle_{{$vehicle->id}}">
                                <i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @php
                          $cnt++;
                        @endphp
                        <!-- Modal for editing vehicle -->
                        <div class="modal fade" id="edit_vehicle_{{$vehicle->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" align="center">Edit Vehicle</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <form method="post"  class="form-horizontal" action="{{route('edit-vehicle',$vehicle->id)}}" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            @method('put')
                                            <div class="row">
                                                <div class="col-md-4">
                                                Vehicle Reg No.
                                                </div>
                                                <div class="col-md-8">
                                                  <input type="text" class="form-control" name="reg_no" value="{{$vehicle->reg_no}}" required>
                                                </div>
                                            </div><br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                                Make
                                                </div>
                                                <div class="col-md-8">
                                                  <input type="text" class="form-control" name="make" value="{{$vehicle->make}}" required>
                                                </div>
                                            </div><br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                              Model
                                                </div>
                                                <div class="col-md-8">
                                                  <input type="text" class="form-control" name="model" value="{{$vehicle->model}}">
                                                </div>
                                            </div><br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                              Tank Capacity
                                                </div>
                                                <div class="col-md-8">
                                                  <input type="number" class="form-control" name="tank_capacity" value="{{$vehicle->tank_capacity}}" required>
                                                </div>
                                            </div><br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                              Coverage Per Litre
                                                </div>
                                                <div class="col-md-8">
                                                  <input type="number" class="form-control" name="coverage_per_km" value="{{$vehicle->coverage_per_litre}}" required>
                                                </div>
                                            </div><br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                              Current Mileage
                                                </div>
                                                <div class="col-md-8">
                                                  <input type="text" class="form-control" name="mileage" value="{{$vehicle->current_milage}}" required>
                                                </div>
                                            </div><br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                              Driver
                                                </div>
                                                <div class="col-md-8">
                                                  <select class="form-control" name="driver">
                                                     <option value="{{$vehicle->driver_id}}">{{$vehicle->driver->name}}</option>
                                                     @foreach($drivers as $driver)
                                                        <option value="{{$driver->id}}">{{$driver->name}}</option>
                                                     @endforeach
                                                  </select>  
                                                </div>
                                            </div><br/>
                                            <div class="row">
                                                <div class="col-md-4">
                                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('Documents/'.$vehicle->image)}}" alt="vehicle picture">
                                                </div>
                                                <div class="col-md-8">
                                                  Change Vehicle Image<br/>
                                                  <input type="file" class="form-control" name="vehicle_photo" value="" required>
                                                  <input type="hidden" class="form-control" name="old_vehicle_photo" value="{{$vehicle->image}}" required>
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
                        <!-- End of Modal for editing vehicle-->
                        <!-- Modal for deleting category-->
                        <div class="modal fade" id="delete_vehicle_{{$vehicle->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel" align="center">Delete Vehicle</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <p align="center">Are you sure you want to delete this record?</p>
                                            <form method="post"  class="form-horizontal" action="{{route('delete_vehicle',$vehicle->id)}}" enctype="multipart/form-data">
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
<!-- Modal for adding vehicle -->
<div class="modal fade" id="add_vehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Add New Vehicle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('post-vehicle')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                        Vehicle Reg No.
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="reg_no" required>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Make
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="make" required>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                       Model
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="model" >
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                       Tank Capacity
                        </div>
                        <div class="col-md-8">
                          <input type="number" class="form-control" name="tank_capacity" required>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                       Coverage Per Litre
                        </div>
                        <div class="col-md-8">
                          <input type="number" class="form-control" name="coverage_per_km" required>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                       Current Mileage
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="mileage" required>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                       Vehicle Photo
                        </div>
                        <div class="col-md-8">
                          <input type="file" class="form-control" name="vehicle_photo" required>
                        </div>
                    </div>
                    
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