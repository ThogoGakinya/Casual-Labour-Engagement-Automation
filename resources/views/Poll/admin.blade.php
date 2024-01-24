@extends('layouts.poll_layout')
    @section('content')
  <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Dashboard</h5>
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

    <div class="content">
      <div class="container-fluid winbox-white">
        <div class="row justify-content-center align-items-round">
        <div class="col-10 col-sm-10">
            <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Integrity <span class="badge badge-pill badge-warning">{{count($Integrity)}}</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Customer Focus <span class="badge badge-pill badge-warning">{{count($Customer_Focus)}}</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Team Spirit <span class="badge badge-pill badge-warning">{{count($Team_Spirit)}}</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-settings" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Respect <span class="badge badge-pill badge-warning">{{count($Respect)}}</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-conti" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Continual Improvement <span class="badge badge-pill badge-warning">{{count($Continual_Improvement)}}</span></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-open" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Openness and Honesty <span class="badge badge-pill badge-warning">{{count($Openness_and_Honesty)}}</span></a>
                    </li>
                     <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#total" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false"> Total Votes <span class="badge badge-pill badge-warning">{{count($total_votes)}}</span></a>
                    </li>
                    
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                       <h4><a href="#">INTEGRITY</a></h4>
                    <table class="customers-actions" id="example1">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>VOTE TOKEN ID</th>
                            <th>NOMINEE</th>
                            <th>VOTER</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($Integrity as $application)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$application->token_id}}</td>
                            <td>{{$application->nominated->name}}</td>
                            <td>{{$application->voter->name}}</td>
                        </tr>
                        @php
                          $cnt++
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                    <hr/>
                    <h4><a href="#">CUMULATIVE VOTES FOR INTEGRITY</a></h4>
                    <table class="customers-actions" id="example9">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>USER</th>
                            <th>VOTES</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                          $total = 0;
                      @endphp
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                            @foreach($Integrity as $inte)
                            @if($user->id == $inte->nominated_id )
                              @php
                                $total += $inte->status;
                              @endphp
                               
                            @endif
                            @endforeach
                            {{$total}}
                            </td>
                        </tr>
                        @php
                          $cnt++;
                          $total = 0;
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                        <h4><a href="#">CUSTOMER FOCUS</a></h4>
                       <table class="customers-actions" id="example2">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>VOTE TOKEN ID</th>
                            <th>NOMINEE</th>
                            <th>VOTER</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($Customer_Focus as $application)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$application->token_id}}</td>
                            <td>{{$application->nominated->name}}</td>
                            <td>{{$application->voter->name}}</td>
                        </tr>
                        @php
                          $cnt++
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                    <hr/>
                    <h4><a href="#">CUMULATIVE VOTES FOR CUSTOMER FOCUS</a></h4>
                    <table class="customers-actions" id="example10">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>USER</th>
                            <th>VOTES</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                          $total = 0;
                      @endphp
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                            @foreach($Customer_Focus as $inte)
                            @if($user->id == $inte->nominated_id )
                              @php
                                $total += $inte->status;
                              @endphp
                               
                            @endif
                            @endforeach
                            {{$total}}
                            </td>
                        </tr>
                        @php
                          $cnt++;
                          $total = 0;
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                        <h4><a href="#">TEAM SPIRIT</a></h4>
                    <table class="customers-actions" id="example3">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>VOTE TOKEN ID</th>
                            <th>NOMINEE</th>
                            <th>VOTER</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($Team_Spirit as $application)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$application->token_id}}</td>
                            <td>{{$application->nominated->name}}</td>
                            <td>{{$application->voter->name}}</td>
                        </tr>
                        @php
                          $cnt++
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                     <hr/>
                    <h4><a href="#">CUMULATIVE VOTES FOR TEAM SPIRIT</a></h4>
                    <table class="customers-actions" id="example11">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>USER</th>
                            <th>VOTES</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                          $total = 0;
                      @endphp
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                            @foreach($Team_Spirit as $inte)
                            @if($user->id == $inte->nominated_id )
                              @php
                                $total += $inte->status;
                              @endphp
                               
                            @endif
                            @endforeach
                            {{$total}}
                            </td>
                        </tr>
                        @php
                          $cnt++;
                          $total = 0;
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                        <h4><a href="#">RESPECT</a></h4>
                    <table class="customers-actions" id="example4">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>VOTE TOKEN ID</th>
                            <th>NOMINEE</th>
                            <th>VOTER</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($Respect as $application)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$application->token_id}}</td>
                            <td>{{$application->nominated->name}}</td>
                            <td>{{$application->voter->name}}</td>
                        </tr>
                        @php
                          $cnt++
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                     <hr/>
                    <h4><a href="#">CUMULATIVE VOTES FOR RESPECT</a></h4>
                    <table class="customers-actions" id="example12">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>USER</th>
                            <th>VOTES</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                          $total = 0;
                      @endphp
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                            @foreach($Respect as $inte)
                            @if($user->id == $inte->nominated_id )
                              @php
                                $total += $inte->status;
                              @endphp
                               
                            @endif
                            @endforeach
                            {{$total}}
                            </td>
                        </tr>
                        @php
                          $cnt++;
                          $total = 0;
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                    </div>
                 <div class="tab-pane fade" id="custom-tabs-one-conti" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                     <h4><a href="#">CONTINUAL IMPROVEMENT</a></h4>
                    <table class="customers-actions" id="example5">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>VOTE TOKEN ID</th>
                            <th>NOMINEE</th>
                            <th>VOTER</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($Continual_Improvement as $application)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$application->token_id}}</td>
                            <td>{{$application->nominated->name}}</td>
                            <td>{{$application->voter->name}}</td>
                        </tr>
                        @php
                          $cnt++
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                                         <hr/>
                    <h4><a href="#">CUMULATIVE VOTES FOR CONTINUAL IMPROVEMENT</a></h4>
                    <table class="customers-actions" id="example13">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>USER</th>
                            <th>VOTES</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                          $total = 0;
                      @endphp
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                            @foreach($Continual_Improvement as $inte)
                            @if($user->id == $inte->nominated_id )
                              @php
                                $total += $inte->status;
                              @endphp
                               
                            @endif
                            @endforeach
                            {{$total}}
                            </td>
                        </tr>
                        @php
                          $cnt++;
                          $total = 0;
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-open" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                        <h4><a href="#">OPENNESS AND HONESTY</a></h4>
                    <table class="customers-actions" id="example6">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>VOTE TOKEN ID</th>
                            <th>NOMINEE</th>
                            <th>VOTER</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($Openness_and_Honesty as $application)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$application->token_id}}</td>
                            <td>{{$application->nominated->name}}</td>
                            <td>{{$application->voter->name}}</td>
                        </tr>
                        @php
                          $cnt++
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                                                             <hr/>
                     <h4><a href="#">CUMULATIVE VOTES FOR OPENNESS AND HONESTY</a></h4>
                    <table class="customers-actions" id="example14">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>USER</th>
                            <th>VOTES</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                          $total = 0;
                      @endphp
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                            @foreach($Openness_and_Honesty as $inte)
                            @if($user->id == $inte->nominated_id )
                              @php
                                $total += $inte->status;
                              @endphp
                               
                            @endif
                            @endforeach
                            {{$total}}
                            </td>
                        </tr>
                        @php
                          $cnt++;
                          $total = 0;
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                    </div>
                     <div class="tab-pane fade" id="total" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                        <h4><a href="#">TOTAL VOTES</a></h4>
                     <table class="customers-actions" id="example7">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>TOKEN</th>
                            <th>NOMINEE</th>
                            <th>VOTER</th>
                            <th>PERIOD</th>
                            <th>VALUES</th>
                            <th>STORY</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($total_votes as $vote)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$vote->vote_token}}</td>
                            <td>{{$vote->nominated->name}}</td>
                            <td>{{$vote->user->name}}</td>
                            <td>{{$vote->period}}</td>
                            <td>
                                @foreach($total_value_votes as $valuevotes)
                                   @if($valuevotes->token_id == $vote->vote_token)
                                     <li>{{$valuevotes->corevalue->name}}</li>
                                   @endif
                                @endforeach
                            </td>
                            <td>{{$vote->story}}</td>
                        </tr>
                        @php
                          $cnt++
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                    <hr/>
                    <h4><a href="#">TOTAL CUMULATIVE VOTES</a></h4>
                    <table class="customers-actions" id="example17">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>USER</th>
                            <th>VOTES</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                          $total = 0;
                      @endphp
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                            @foreach($total_votes as $inte)
                            @if($user->id == $inte->nominated_id )
                              @php
                                $total += $inte->status;
                              @endphp
                               
                            @endif
                            @endforeach
                            {{$total}}
                            </td>
                        </tr>
                        @php
                          $cnt++;
                          $total = 0;
                        @endphp
                        @endforeach
                        
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </div>
      </div>
    </div>
    <!-- /.content -->
 @endsection

