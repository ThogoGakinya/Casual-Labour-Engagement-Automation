@extends('layouts.poll_layout')
    @section('content')
  <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Dashboard <a class="btn btn-success btn-xs" href="{{url('/admin/poll/'.$polluser->id)}}"><i class="fa fa-user"></i> Admin</a> <button class="btn btn-success btn-xs" data-target="#add-nominee" data-toggle="modal"><i class="fa fa-plus"></i> Add Voter</button></h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid winbox-white">
          <h4>MANAGE VOTERS</h4>
        <div class="row justify-content-center align-items-round">
            
          <div class="col-md-12">
                 <table class="customers-actions" id="example1">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>NAME</th>
                            <th>DEPARTMENT</th>
                            <th>DESIGNATION</th>
                            <th>ROLE</th>
                            <th>ID</th>
                            <th>ACTION</th>
                            <th>ACTION</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                      @foreach($voters as $voter)
                      <tr>
                          <td>{{$voter->id}}</td>
                          <td>{{$voter->name}}</td>
                          <td>{{$voter->department}}</td>
                          <td>{{$voter->designation}}</td>
                          <td><span class="badge badge-primary">{{$voter->role->name}}</span></td>
                          <td>{{$voter->id_no}}</td>
                          <td><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#view_{{$voter->id}}"><i class="fa fa-eye"></i> view</td>
                          <td></td>
                          
                        </tr>
                        <div class="modal fade" id="view_{{$voter->id}}">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">{{$voter->name}}</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="post"  name="frm" class="form-horizontal" action="{{route('edit_voter')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" id="image" name="name" value="{{$voter->name}}" class="form-control">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Designation</label>
    <input type="text" id="image" name="designation" value="{{$voter->designation}}" class="form-control">
     <input type="hidden" id="image" name="voter_id" value="{{$voter->id}}" class="form-control">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Role</label>
<select class="form-control" name="role_id" required>
    <option value="{{$voter->role_id}}"><span class="badge badge-primary"> {{$voter->role->name}} </span></option>
    @foreach($roles as $role)
        <option value="{{$role->id}}"><span class="badge badge-primary"> {{$role->name}} </span></option>
     @endforeach
</select>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">ID</label>
    <input type="text" id="image" name="id_no" value="{{$voter->id_no}}" class="form-control">
</div>

</div>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
</div>
</div>
</form>
</div>

</div>
                        @endforeach
                        
                        </tbody>
                    </table>
          </div>
          <!-- /.col-md-6 -->
        </div><br/>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
<div class="modal fade" id="add-nominee">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Add Nominee</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="post"  name="frm" class="form-horizontal" action="{{route('submit_voter')}}" enctype="multipart/form-data">
    {{ csrf_field() }}

<div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" id="image" name="name"  class="form-control">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">Designation</label>
    <input type="text" id="image" name="designation" class="form-control">
    
</div>
<div class="form-group">
<label for="exampleInputPassword1">Role</label>
<select class="form-control" name="role_id" required>
    <option value=""><span class="badge badge-primary"> Select Role </span></option>
    @foreach($roles as $role)
        <option value="{{$role->id}}"><span class="badge badge-primary"> {{$role->name}} </span></option>
     @endforeach
</select>
</div>
<div class="form-group">
    <label for="exampleInputEmail1">ID</label>
    <input type="text" id="image" name="id_no" class="form-control">
</div>

<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
</div>
</div>
</form>
</div>

</div>
 @endsection