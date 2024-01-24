@extends('layouts.poll_layout')
    @section('content')
  <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Dashboard @if($polluser->level == 1)<a class="btn btn-success btn-xs" href="{{url('/admin/poll/'.$polluser->id)}}"><i class="fa fa-user"></i> Admin</a>@endif</h5>
                 <h5 class="m-0 text-dark">@if($polluser->level == 1)<a class="btn btn-primary btn-xs" href="{{url('/admin/awards/'.$polluser->id)}}"><i class="fa fa-user"></i> Awards</a>@endif</h5>
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
<form method="post"  name="frm" class="form-horizontal" action="{{route('submit_poll')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid winbox-white">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5>Choose your Core Value Champion</h5>
                <i>Please select your champion from the list of employees below:</i>
              </div>
              
              <div class="card-body">
                <div class="row">
                    <div class="col-md-6"><br/><br/><br/>
                        <select name="nominee" id="nominee" class="form-control"required>
                           <option value="">Please select the name</option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-6" >
                        <div id="nominee_user"></div>
                        <div id="loader" align="center" style="display:none;"><img src="{{asset('dist/img/ajax-loader.gif')}}" width="40%" alt="Loader"></div>
                       
                    </div>
                    
                </div>
                
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header secondary">
                <h5>Kim-Fay Core Values</h5>
                <i>Select the value which you feel your champion has demonstrated/shown. You may select more than one value.</i>
              </div>
              <div class="card-body">
                  <div class="row">
                      
                     @foreach($corevalues as $core)
                          <div class="col-md-6">
                              <div class="row" data-target="#view_{{$core->id}}" data-toggle="modal">
                                  <div class="col-md-1" align="right">
                                      <input type="checkbox" id="{{$core->name}}" name="corevalue[]" value="{{$core->id}}">
                                  </div>
                                  
                                  <div class="col-md-3" align="center">
                                      <input class="form-control" type="hidden" name="period" value="Quater 1">
                 <input class="form-control" type="hidden" name="user_id" value="{{$polluser->id}}">
                 <input class="form-control" type="hidden" name="pnumber" value="{{$polluser->email}}">
                                  <img src="{{ asset('dist/img/'.$core->img)}}" height="100%" width="60%"
                                   alt="User profile picture">
                                   </div>
                                   
                                  <div class="col-md-8" align="left">
                                     {{$core->name}} 
                                  </div>
                                  
                              </div>

                        </div><br/>
                 <!-- Modal for approving request -->
<div class="modal fade" id="view_{{$core->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">{{$core->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <p align="center">
                        <div class="row">
                            <div class="col-md-6">
<img class="card-img-top" src="{{ asset('dist/img/'.$core->english)}}" alt="Dist Photo 2">
                            </div>
                            <div class="col-md-6">
<img class="card-img-top" src="{{ asset('dist/img/'.$core->kiswahili)}}" alt="Dist Photo 2">
                            </div>
</p>
</div>
                    </p>
            </div>
            <div class="modal-footer" align="center">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="autoUnCheck('{{$core->name}}');"> No Go Back</button>
                <button type="button" class="btn btn-primary button select" onclick="autoCheck('{{$core->name}}');" data-dismiss="modal"><i class="fa fa-check"></i>&nbsp;<span class="btn-txt">&nbsp;&nbsp;Yes select this value</span></button>
            </div>
        </div>
    </div>
</div>
                          @endforeach
               
                </div>
              </div>
            </div>
<br/>
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0">Give a short example of how your selected champion has lived by the core value you chose</h5>
              </div>
              <div class="card-body">
                <div class="form-group">
                        <textarea id="mytextarea" class="form-control" rows="3" name ="story" placeholder="Enter ..." required></textarea>
                </div>
                <div id="remaining_character" align="right">Characters remaining 250</div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div><br/>
        <div align="center">
          <button class="btn btn-primary" type="submit">Submit Poll</button>
          <a class="btn btn-default" href="{{url('/poll')}}"><i class="fas fa-sign-out-alt"></i>Logout</i></a>
          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</form>
    </div>
    <!-- /.content -->
 @endsection