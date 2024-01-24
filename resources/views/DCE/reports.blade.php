@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Reports Daily Casuals Requisition</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Casuals</li>
                  <li class="breadcrumb-item active">Reports</li>
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
                   <form method="post" action="{{ url('/get_daily_report')}} ">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-1" align="right">
                                From
                            </div>
                            <div class="col-md-2">
                                        <input type="date" name="start_date" onchange="setChecker();" id="end" class="form-control" required>
                            </div>
                            <div class="col-md-1" align="right">
                                To
                            </div>
                             <div class="col-md-2">
                                        <input type="date" name="end_date" onchange="setChecker();" id="end" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                        <button type="submit" class="btn btn-info btn-sm" ><i class="fa fa-search"></i>&nbsp;&nbsp;Find</button>
                            </div>
                        </div>
                  </form>
                   </div>
                   <div class="panel-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>APPLICANT</th>
                            <th>DATE</th>
                            <th>DEP</th>
                            <th>DIV</th>
                            <th>MANAGER</th>
                            <th>NO.CASUALS</th>
                            <th>DAYS</th>
                            <th>DESCRIPTIONS</th>
                            <th>PAYABLE AMOUNT</th>
                             <th>DEDUCTIONS</th>
                            <th>TOTAL PAID</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$report->user->name}}</td>
                            <td>{{$report->created_at}}</td>
                            <td>{{$report->dept->name}}</td>
                            <td>{{$report->div->name}}</td>
                            <td>{{$report->manager->name}}</td>
                            <td>{{$report->no_of_casuals}}</td>
                            <td>{{$report->no_of_days}}</td>
                            <td>{{$report->reason}}</td>
                            <td>{{$report->rate_per_casual}}</td>
                             <td>{{$report->nssf+$report->nhif+$report->tax}}</td>
                            <td>{{($report->rate_per_casual-($report->nssf+$report->nhif+$report->tax))*$report->no_of_days*$report->no_of_casuals}}</td>
                            
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