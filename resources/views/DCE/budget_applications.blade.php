@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Budget Daily Casuals Requisition</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Casuals</li>
                  <li class="breadcrumb-item active">Budget</li>
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
                   <div class="panel-heading"><a href="{{route('application_form')}}" class="btn btn-info btn-sm" ><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Request</a>
                   <a href="{{route ('staff_dashboard')}}" class="btn btn-primary btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a> 
                   </div>
                   <div class="panel-body">
                    <table class="customers-actions">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>TOKEN ID</th>
                            <th>APPLICANT</th>
                            <th>REQUEST DATE</th>
                            <th>START DATE</th>
                            <th>END DATE</th>
                            <th>DAYS</th>
                            <th>CASUALS</th>
                            <th>PROGRESS</th>
                            <th>ACTION</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($applications as $application)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$application->token_id}}</td>
                            <td>{{$application->user->name}}</td>
                            <td>{{$application->created_at}}</td>
                            <td>{{$application->start_date}}</td>
                            <td>{{$application->end_date}}</td>
                            <td>{{$application->no_of_days}}</td>
                            <td>{{$application->no_of_casuals}}</td>
                            <td>
                               @foreach($approvals as $approval)
                                    @if($approval->token_id == $application->token_id)
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$approval->process_status}}" aria-valuemin="0"
                                            aria-valuemax="100" style="width: {{$approval->process_status}}%">
                                            {{$approval->process_status}}%
                                        </div>
                                    </div>
                                    @endif
                               @endforeach
                            </td>
                            <td>
                                <a href="{{route('budget_view_application',$application->token_id)}}" class="btn btn-success btn-xs editbtn" id="edit_Application"><i class="fa fa-eye"></i>&nbsp;&nbsp;View</a>
                            </td>
                        </tr>
                        @php
                          $cnt++
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
@endsection