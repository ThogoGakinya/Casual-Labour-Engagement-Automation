@extends('layouts.poll_layout')
    @section('content')
  <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">@if($polluser->level == 1)<a class="btn btn-primary btn-xs" href="{{url('/admin/poll/'.$polluser->id)}}"><i class="fa fa-user"></i> Core Values</a> <a class="btn btn-primary btn-xs" href="{{url('/admin/awards/'.$polluser->id)}}"><i class="fa fa-user"></i> Awards</a> <a class="btn btn-primary btn-xs" href="{{url('/admin/permissions/'.$polluser->id)}}"><i class="fa fa-key"></i> Roles</a> <a class="btn btn-primary btn-xs" href="{{url('/admin/criteria/'.$polluser->id)}}"><i class="fa fa-key"></i> Criteria</a> </a> <a class="btn btn-primary btn-xs" href="{{url('/voters/'.$polluser->id)}}"><i class="fa fa-key"></i> Voters</a> <a class="btn btn-primary btn-xs" href="{{url('/results/'.$polluser->id)}}"><i class="fa fa-file"></i> Results</a> <a class="btn btn-primary btn-xs" href="{{url('/images/'.$polluser->id)}}"><i class="fa fa-file"></i> Images</a>@endif</h5>
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
          <div align="center"><h5><a href="#">Welcome to KFL E-Voting Platform</a></h5></div>
        <div class="row">
           
           
            @foreach($rewards as $reward)
             @php
                 $accesstester =  $permissions->contains('reward_id', $reward->id);
            @endphp
             @php
                 $tester =  $votes->contains('reward_id', $reward->id);
            @endphp
            @if($accesstester == 1)
                  @if( $tester == 1 )
                 @foreach($votes as $vote)
                   @if($vote->reward_id == $reward->id)
                    <div class="col-lg-2 col-6" data-toggle="modal" data-target="#nominated_{{$vote->id}}">
                            <div class="card">
                              <div class="card-body">
                                <div class="info-box bg-warning">
                                <span class="info-box-icon bg-default"><i class="far fa-check-circle"></i></span>
                                <div class="info-box-content">
                                <span class="info-box-text">{{$vote->nominated->name}}</span>
                                <span class="info-box-number">{{$vote->reward->name}} 2023</span>
                                </div>
                                </div>

                                </div>
                            </div>
                        </div>
           
             
                           <div class="modal fade" id="nominated_{{$vote->id}}">
                            <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">{{$vote->reward->name}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <p>You nominated <strong><a href="#">{{$vote->nominated->name}}</a> </strong> for the <strong><a href="#"> {{$vote->reward->name}} </a></strong> Award <a href="#">2023</a></p>
                            </div>
                            <!--<div align="center">-->
                            <!--<small font-color="red">NOTE : <i>You can change your nominee before 15/10/2023</i></small>-->
                            <!--</div>-->
                            <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary"><i class="fa fa-edit"></i> Okay</button>
                            </div>
                            </div>
                            
                            </div>
                            
                            </div>
                @endif
                @endforeach
               @else
                        @if($reward->id != 12)
                        <div class="col-lg-2 col-6" data-toggle="modal" data-target="#nominate_{{$reward->id}}">
                            <div class="card">
                              <div class="card-body">

                                  <div class="info-box bg-info">
                                <span class="info-box-icon bg-info"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                                <div class="info-box-content">
                                <span class="info-box-text">{{$reward->name}}</span>
                                <span class="info-box-number">2023</span>
                                </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    @endif
            
            
            
                        <div class="modal fade" id="nominate_{{$reward->id}}">
                        <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <div class="modal-header bg-info">
                        <h4 class="modal-title">Nominate  {{$reward->name}}</h4> 
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form method="POST"  name="frm" class="form-horizontal" action="{{route('submit_vote')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="modal-body">
                            <p><i> {{$reward->description}}</i></p>
                            <h6><strong><u>Selection Criteria</u></strong></h6>
                                <div class="row">
                                    @foreach($criterias as $criteria)
                                       @if($criteria->reward_id == $reward->id)
                                            <p>
                                                <strong>{{$criteria->criteria}} : </strong> <i>{{$criteria->description}}</i>
                                            </p>
                                       @endif
                                    @endforeach
                                    
                                </div>
                                <hr><br/>
                                        <div class="row">
                                            <div class="col-md-4">
                                            <label for="image">Employee</label>
                                                <select name="nominee" id="nominee" class="form-control" required>
                                                   <option value="">Please select the name</option>
                                                   @if($reward->id == 3)
                                                    @foreach($kpusers as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                    @elseif($reward->id == 4)
                                                    @foreach($salesusers as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                    @elseif($reward->id == 11)
                                                    @foreach($stores as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                    @elseif($reward->id == 9)
                                                    @foreach($financeusers as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                    @elseif($reward->id == 6)
                                                    @foreach($operationsusers as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                    @elseif($reward->id == 5)
                                                    @foreach($merchandizers as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                    @elseif($reward->id == 7)
                                                    @foreach($sixkusers as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                    @elseif($reward->id == 20)
                                                    @foreach($dispatchusers as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                    @else
                                                    @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                     @endif
                                                </select>
                                            </div>
                                            <input name="user_id" value="{{$polluser->id}}" type="hidden">
                                            <input name="period" value="Qater 4" type="hidden">
                                            <input name="reward_id" value="{{$reward->id}}" type="hidden">
                                             <input name="year" value="{{date('Y')}}" type="hidden">
                                            <div class="col-md-4" >
                                                <div id="nominee_user"></div>
                                                <div id="loader" align="center" style="display:none;"><img src="{{asset('dist/img/ajax-loader.gif')}}" width="40%" alt="Loader"></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <label for="exampleInputPassword1">Justification(With Examples)*</label>
                                                <input class="form-control" name="story" id="exampleInputPassword1" row="5" placeholder="Your story" min="2" required>
                                                    </input>
                                                </div>
                                                </div>
                                            
                                        </div>
                                <hr>
                        </div>
                        <div class="modal-footer justify-content-between bg-info">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </div>
                        </form>
                        </div>
                        
                        </div>
            @endif
            @endif
            @endforeach
            
                        <div class="col-lg-2 col-6>
                            <div class="card">
                            <a href="{{url('/poll/values/'.$polluser->id)}}">
                              <div class="card-body">

                                  <div class="info-box bg-info">
                                <span class="info-box-icon bg-info"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                                <div class="info-box-content">
                                <span class="info-box-text">Core Values Champion</span>
                                <span class="info-box-number">2023</span>
                                </div>
                                </div>

                                </div>
                            </a>
                            </div>
                        </div>
       </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
 @endsection