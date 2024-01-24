@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Access Levels</h5>
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
                      <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-level" ><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Add New</button>
                      <a href="{{route ('admin')}}" class="btn btn-primary btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a> 
                    </div>
                   <div class="panel-body">
                    <table class="customers-actions">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>NAME</th>
                            <th>LEVEL</th>
                            <th>PREVILEDGED USERS</th>
                            <th>EDIT</th>
                            <th>DEL</th>
                            <th>ADD</th>
                         </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($access_levels as $level)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$level->name}}</td>
                            <td>{{$level->level}}</td>
                            <td>
                                @foreach($users as $user)
                                    @if($user->level == $level->level)
                                      <i class="fas fa-user"></i>&nbsp;&nbsp;&nbsp;{{$user->name}} &nbsp;&nbsp;&nbsp;&nbsp;
                                      <i class="fa fa-times-circle" aria-hidden="true" data-userid="{{$user->id}}" data-levelid="{{$level->level}}" data-levelname="{{$level->name}}" data-username="{{$user->name}}" data-toggle="modal" data-target="#reasign_level" title="Remove this user"></i><br/> 
                                              
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <button type="button" class="btn btn-default btn-xs" 
                                                                                    data-toggle="modal" 
                                                                                    data-target="#edit_level_{{$level->id}}   ">
                                <i class="fas fa-edit"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-default btn-xs" data-userid="{{$level->id}}"
                                                                                    data-toggle="modal" 
                                                                                    data-target="#delete_level">
                                <i class="fas fa-trash"></i></button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-default btn-xs" data-level_id="{{$level->id}}"
                                                                                     data-level_name="{{$level->name}}"
                                                                                    data-toggle="modal" 
                                                                                    data-target="#assign_level_{{$level->level}}">
                                <i class="fas fa-plus"></i>&nbsp;Add User</button>
                            </td>
                        </tr>
                        <!-- Modal for editing level -->
                        <div class="modal fade" id="edit_level_{{$level->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel" align="center">Edit Level</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <form method="post"  class="form-horizontal" action="{{route('update_level','test')}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('put')
                                        <div class="row">
                                            <div class="col-md-4">
                                            Access Level Name
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="name" id="name" value="{{$level->name}}">
                                                <input type="hidden" class="form-control" name="acc_id" id="name" value="{{$level->id}}">
                                            </div>
                                        </div><br/>
                                        <div class="row">
                                            <div class="col-md-4">
                                            Level
                                            </div>
                                            <div class="col-md-8">
                                            <select name="level" class="form-control" required>
                                                <option value="{{$level->level}}">{{$level->level}}</option>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
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
                        <!-- End of Modal for aediting access levels -->
                         <!-- Modal for assigning level-->
                         <div class="modal fade" id="assign_level_{{$level->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel" align="center">{{$level->name}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <form method="post"  class="form-horizontal" action="{{route('reasign_level','test')}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('put')
                                        <div class="row">
                                            <div class="col-md-4">
                                            Add User
                                            </div>
                                            <div class="col-md-8">
                                                <input type="hidden" class="form-control" name="new_level" id="level_id" value="{{$level->id}}">
                                                <select name="user_id" class="form-control" required>
                                                <option value="">Select user</option>
                                                @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
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
                        <!-- End of Modal for aediting access levels -->

                        <!-- Modal for deleting category-->
                        <div class="modal fade" id="delete_level" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" align="center">Delete Level</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <p align="center">Are you sure you want to delete this record?</p>
                                    <form method="post"  class="form-horizontal" action="{{route('delete_level','test')}}" enctype="multipart/form-data">
                                    {{method_field('delete')}}
                                    {{ csrf_field() }}
                                    <input type="hidden" class="form-control" name="acc_id" value="{{$level->id}}">
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
<!-- Modal for adding level -->
<div class="modal fade" id="add-level" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Add Access Level</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('submit_level')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                        Access Level Name
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="name">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Level
                        </div>
                        <div class="col-md-8">
                        <select name="level" class="form-control" required>
                            <option value="">Select Level </option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>    
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                              
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

  <!-- Modal for reasigning access -->
  <div class="modal fade" id="reasign_level" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center" id="user_name"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('reasign_level','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('put')
                    <div class="row">
                        <div class="col-md-4">
                        Current Level
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" id="level_name" value="">
                            <input type="hidden" class="form-control" name="level_id" id="level_id" value="">
                            <input type="hidden" class="form-control" name="user_id" id="user_id" value="">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                         New Level
                        </div>
                        <div class="col-md-8">
                        <select name="new_level" class="form-control" required>
                            <option value="">Select new level</option>
                            @foreach($access_levels as $access)
                             <option value="{{$access->level}}">{{$access->name}}</option>
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
<!-- End of Modal for aediting access levels -->

@endsection