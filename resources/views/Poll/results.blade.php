@extends('layouts.poll_layout')
    @section('content')
  <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">POLL RESULTS <a class="btn btn-success btn-xs" href="{{url('/admin/poll/'.$polluser->id)}}"><i class="fa fa-user"></i> Back</a>
                
               </h5>
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
           <form method="post"  name="frm" class="form-horizontal" action="{{route('search_award')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
          <div class="row">
              <div class = "col-md-3">
                    <div class="form-group">
                        <input name="poll_id" value="{{$polluser->id}}" type="hidden">
                    <select class="form-control" name="award_id" required>
                        <option value="">Switch Reward</option>
                        @foreach($awards as $reward)
                           <option value="{{$reward->id}}">{{$reward->name}}</option> 
                        @endforeach
                    </select>
                    </div>
             </div>
             <div class = "col-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
             </div>
          </div>
           </form> 
          
        <div class="row justify-content-center align-items-round">
            
          <div class="col-md-12">
             <table class="customers-actions" id="example1">
                      <thead>
                          <tr>@if(!empty($award))
                                 <th colspan="6">{{$award->name}}</th>
                              @endif
                            </tr>
                        <tr>
                            <th>S.N</th>
                            <th>AWARD</th>
                            <th>NOMINEE</th>
                            <th>VOTER</th>
                            <th>DESCRIPTION</th>
                            <th>TOTAL VOTES</th>
                            <th>ACTIONS</th>
                            
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                          $totalvotes = 0;
                      @endphp
                      <tbody>
                           
                    @if(!empty($results))
                    
                        @foreach($results as $result)
                             <tr>
                                 <td>{{$result->id}}</td>
                                 <td>{{$result->reward->name}}</td>
                                 <td>{{$result->nominated->name}}</td>
                                 <td>{{$result->user->name}}</td>
                                 <td>{{$result->story}}</td>
                                 <td>
                                     @foreach($nominees as $nominee)
                                      @if($nominee == $result->nominated_id)
                                       @php
                                        $totalvotes += 1;
                                        @endphp
                                      @endif
                                     @endforeach
                                     
                                     {{$totalvotes}}
                                  </td>
                                  <td>
                                     {{$nominees}}
                                  </td>
                            </tr>
                     @php
                          $cnt = 1;
                          $totalvotes = 0;
                      @endphp
                        @endforeach
                    @else
                     <small>No record found </small>
                    @endif
                      </tbody>
                      </table>
          </div>
          <!-- /.col-md-6 -->
        </div><br/>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

 @endsection