@extends('layouts.poll_layout')
    @section('content')
  <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Dashboard <a class="btn btn-success btn-xs" href="{{url('/admin/poll/'.$polluser->id)}}"><i class="fa fa-user"></i> < Back</a> <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#add-criteria"><i class="fa fa-plus"></i> Add Criteria</button></h5>
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
          <h4>MANAGE AWARDS CRITERIA</h4>
        <div class="row justify-content-center align-items-round">
            
          <div class="col-md-12">
                 <table class="customers-actions" id="example1">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>AWARD</th>
                            <th>CRITERIA</th>
                            <th>DESCRIPTION</th>
                            
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                      @foreach($criterias as $criteria)
                         <tr data-toggle="modal" data-target="#edit_criteria_{{$criteria->id}}">
                             <td>{{$criteria->id}}</td>
                             <td>{{$criteria->reward->name}}</td>
                             <td>{{$criteria->criteria}}</td>
                            <td>{{$criteria->description}}
                            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_{{$criteria->id}}"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                            
                          
                        </tr>
                        
                        <div class="modal fade" id="edit_criteria_{{$criteria->id}}">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Edit </h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="post"  name="frm" class="form-horizontal" action="{{route('edit_criteria')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="form-group">
<label for="exampleInputEmail1">Reward</label>
<select class="form-control" name="reward" required>
    <option value="{{$criteria->reward_id}}">{{$criteria->reward->name}}</option>
    @foreach($rewards as $reward)
       <option value="{{$reward->id}}">{{$reward->name}}</option> 
    @endforeach
</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Criteria</label>
<input class="form-control" name="criteria" value="{{$criteria->criteria}}"id="exampleInputPassword1" placeholder="Criteria">
<input class="form-control" type="hidden" name="criteria_id" value="{{$criteria->id}}>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Description</label>
<textarea class="form-control" name="description" id="exampleInputPassword1" placeholder="Password">{{$criteria->description}}
    </textarea>
</div>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Update</button>
</div>
</div>
</form>
</div>

</div> 




 <div class="modal fade" id="delete_{{$criteria->id}}">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">DELETE</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
     <p>Are you sure you want to Delete this record?</p>
<form method="post"  name="frm" class="form-horizontal" action="{{route('delete_criteria')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<input type="hidden" value="{{$criteria->id}}" name="record_id"/>
<input type="hidden" name="model"/>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
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
 
 
 <div class="modal fade" id="add-criteria">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Add Criteria</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="post"  name="frm" class="form-horizontal" action="{{route('submit_criteria')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="form-group">
<label for="exampleInputEmail1">Reward</label>
<select class="form-control" name="reward" required>
    <option value="">Select Reward</option>
    @foreach($rewards as $reward)
       <option value="{{$reward->id}}">{{$reward->name}}</option> 
    @endforeach
</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Criteria</label>
<input class="form-control" name="criteria" id="exampleInputPassword1" placeholder="Criteria">
</div>
<div class="form-group">
<label for="exampleInputPassword1">Description</label>
<textarea class="form-control" name="description" id="exampleInputPassword1" placeholder="Password">
    </textarea>
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