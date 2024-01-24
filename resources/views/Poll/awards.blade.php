@extends('layouts.poll_layout')
    @section('content')
  <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Dashboard <a class="btn btn-success btn-xs" href="{{url('/admin/poll/'.$polluser->id)}}"><i class="fa fa-user"></i> Admin</a> <a class="btn btn-success btn-xs" href="{{url('/poll-signin')}}"><i class="fa fa-user"></i> Home</a>  <button class="btn btn-success btn-xs" data-target="#add-nominee" data-toggle="modal"><i class="fa fa-plus"></i> Add Nominee</button></h5>
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
          <h4>MANAGE NOMINEES</h4>
        <div class="row justify-content-center align-items-round">
            
          <div class="col-md-12">
                 <table class="customers-actions" id="example1">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>AWARD</th>
                            <th>NOMINEE</th>
                            <th>DEPARTMENT</th>
                            <th>YEAR</th>
                            <th>ACTION</th>
                            <th>YEAR</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                      @foreach($nominees as $nominee)
                      <tr>
                          <td>{{$nominee->id}}</td>
                          <td>{{$nominee->reward->name}}</td>
                          <td>{{$nominee->user->name}}</td>
                          <td>{{$nominee->user->department}}</td>
                          <td>{{$nominee->year}}</td>
                          <td>
                              <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#view_{{$nominee->id}}"><i class="fa fa-eye"></i> view</button>
                              <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_{{$nominee->id}}"><i class="fa fa-trash"></i> Delete</button>
                          
                          </td>
                          <td>{{$nominee->year}}</td>
                        
                        </tr>
                        <div class="modal fade" id="view_{{$nominee->id}}">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">{{$nominee->user->name}}</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
     <img src="{{ asset('centralroot/public/Documents/'.$nominee->img_url)}}" height="100%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
<form method="post"  name="frm" class="form-horizontal" action="{{route('update_nominee')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<div class="form-group">
     <input type="hidden" id="image" name="nominee_id" value="{{$nominee->id}}" class="form-control">
<label for="exampleInputEmail1">Reward</label>
<select class="form-control" name="reward" required>
    <option value="{{$nominee->reward_id}}">{{$nominee->reward->name}}</option>
    @foreach($rewards as $reward)
       <option value="{{$reward->id}}">{{$reward->name}}</option> 
    @endforeach
</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Nominee</label>
<select class="form-control" name="nominee" required>
    <option value="{{$nominee->user_id}}">{{$nominee->user->name}}</option>
    @foreach($voters as $vote)
       <option value="{{$vote->id}}">{{$vote->name}}</option> 
    @endforeach
</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Year</label>
<select class="form-control" name="year" required>
    <option value="{{$nominee->year}}">{{$nominee->year}}</option>
    <option value="{{date('Y')-2}}">{{date('Y')-2}}</option> 
    <option value="{{date('Y')-1}}">{{date('Y')-1}}</option> 
     <option value="{{date('Y')}}">{{date('Y')}}</option>
     <option value="{{date('Y')+1}}">{{date('Y')+1}}</option> 

</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Justification</label>
<textarea class="form-control" name="justification" id="exampleInputPassword1" placeholder="Password">{{$nominee->justification}}
    </textarea>
</div>
<div class="form-group">
<label for="image">Picture</label>
 <input type="file" id="image" name="image" class="form-control">
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

 <div class="modal fade" id="delete_{{$nominee->id}}">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">{{$nominee->user->name}}</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
     <p>Are you sure you want to Delete this record?</p>
<form method="post"  name="frm" class="form-horizontal" action="{{route('delete_record')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
<input type="hidden" value="{{$nominee->id}}" name="record_id"/>
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
<form method="post"  name="frm" class="form-horizontal" action="{{route('submit_nominee')}}" enctype="multipart/form-data">
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
<label for="exampleInputPassword1">Nominee</label>
<select class="form-control" name="nominee" required>
    <option value="">Select Nominee</option>
    @foreach($voters as $vote)
       <option value="{{$vote->id}}">{{$vote->name}}</option> 
    @endforeach
</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Year</label>
<select class="form-control" name="year" required>
    <option value="">Select Year</option>
    <option value="{{date('Y')-2}}">{{date('Y')-2}}</option> 
    <option value="{{date('Y')-1}}">{{date('Y')-1}}</option> 
     <option value="{{date('Y')}}">{{date('Y')}}</option>
     <option value="{{date('Y')+1}}">{{date('Y')+1}}</option> 

</select>
</div>
<div class="form-group">
<label for="exampleInputPassword1">Justification</label>
<textarea class="form-control" name="justification" id="exampleInputPassword1" placeholder="Password">
    </textarea>
</div>
<div class="form-group">
<label for="image">Picture</label>
 <input type="file" id="image" name="image" class="form-control">
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