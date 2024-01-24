@extends('layouts.poll_layout')
    @section('content')
  <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Dashboard <a class="btn btn-success btn-xs" href="{{url('/admin/poll/'.$polluser->id)}}"><i class="fa fa-user"></i> Back</a>
                <button data-toggle="modal" data-target="#add_award"class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Award</button></h5>
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
          <h4>MANAGE ROLES AND PERMISSIONS</h4>
        <div class="row justify-content-center align-items-round">
            
          <div class="col-md-12">
                 <table class="customers-actions" id="example1">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>AWARD</th>
                            <th>PERMISSIONS</th>
                            <th>ACTION</th>
                            <th>ACTION</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                      @foreach($awards as $ward)
                         <tr>
                             <td>{{$ward->id}}</td>
                             <td>{{$ward->name}}</td>
                             <td>
                                 @foreach($permissions as $permission)
                                    @if($permission->reward->id == $ward->id)
                            <span class="badge badge-primary">{{$permission->role->name}}</span>
                                        
                                    @endif
                                 @endforeach
                             </td>
                             <td><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#edit_{{$ward->id}}"><i class="fa fa-edit"></i> Edit</button>
                             <button data-toggle="modal" data-target="#delete_{{$ward->id}}" class="btn btn-warning btn-xs"><i class="fa fa-trash"></i> Del</button>
                              <button class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#role_{{$ward->id}}"><i class="fa fa-edit"></i> Permissions</button>
                             </td>
                             <td></td>
                        </tr>
                        
                        <div class="modal fade" id="role_{{$ward->id}}">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">{{$ward->name}} <br/></h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="post"  name="frm" class="form-horizontal" action="{{route('submit_permission')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="form-group row">
     @php
        $status = "false";
    @endphp
    @foreach($roles as $role)
        @foreach($permissions as $permission)
            @if($permission->role_id == $role->id && $permission->reward_id == $ward->id)
                @php
                    $status = "checked";
                @endphp
            @continue
            @php
             $status = "false";
             @endphp
            @endif
            
         @endforeach
    <div class="col-md-3">
        <div class="form-check">
        <input class="form-check-input" name="role[]" value="{{$role->id}}" type="checkbox" {{$status}}>
        <input class="form-check-input" name="award" value="{{$ward->id}}" type="hidden">
        <label class="form-check-label">{{$role->name}}</label>
        </div>
    </div>
   
    @endforeach
</div>
</div>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save</button>
</div>
</div>
</form>
</div>

</div>



                        <div class="modal fade" id="edit_{{$ward->id}}">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">{{$ward->name}} <br/></h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="post"  name="frm" class="form-horizontal" action="{{route('update_award')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="form-group">
<label for="exampleInputPassword1">Award Name</label>
        <input class="form-control" name="award" type="text" value="{{$ward->name}}">
        <input class="form-control" name="award_id" value="{{$ward->id}}" type="hidden">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Award Description</label>
        <textarea class="form-control" name="description">{{$ward->description}}</textarea>
</div>
</div>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Update</button>
</div>
</div>
</form>
</div>

</div>








                        <div class="modal fade" id="delete_{{$ward->id}}">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">{{$ward->name}} <br/></h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="post"  name="frm" class="form-horizontal" action="{{route('delete_award')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="form-group row">


        <p>Are you sure you want to Delete this record?</p>
        <input class="form-control" name="award_id" value="{{$ward->id}}" type="hidden">
    

</div>
</div>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Update</button>
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
  <div class="modal fade" id="add_award">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">New Award <br/></h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="post"  name="frm" class="form-horizontal" action="{{route('add_award')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="form-group">
<label for="exampleInputPassword1">Award Name</label>
        <input class="form-control" name="award" type="text">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Award Description</label>
        <textarea class="form-control" name="description"></textarea>
</div>
</div>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save</button>
</div>
</div>
</form>
</div>

</div>
 @endsection