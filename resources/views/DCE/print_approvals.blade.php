@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Print Engagement Approvals</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Casuals</li>
                  <li class="breadcrumb-item active">H.R Rep</li>
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
                   <div class="panel-heading"><button onclick="printApprovals('approvals')" class="btn btn-info btn-sm" ><i class="fa fa-print"></i>&nbsp;&nbsp;Print</button>
                   </div>
                   <div class="panel-body" id="approvals" >
                            <div class="panel panel-default">
                            <div class="panel-body">
                              <img src="{{ asset('dist/img/logo.png')}}" alt="Kimfay Letter Head" width="100%">
                              <hr/>
                              <div class="row">
                                    <div class="col-md-12" align="center">
                                            <p><strong><u><h6>DAILY CASUALS APPROVAL SHEET</h6></u></strong></p>
                                            <p><strong><h6>HR Record - Version 1</h6></strong></p>
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="col-md-3" align="left">
                                            <p><strong>Reference Token : {{$dce_requisition->token_id}} </strong></p>
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="col-md-6" align="left">
                                            <p><h6><u><strong>ENGAGEMENT DETAILS</strong></u></h6></p>
                                    </div>
                              </div>
                              <table>
                                  <tr>
                                      <td width="65%">
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                        <strong>Department : </strong>{{$dce_requisition->dept->name}}
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                        <strong>Division : </strong>{{$dce_requisition->div->name}}
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                        <strong>Applicant : </strong>{{$dce_requisition->user->name}}
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                        <strong>Start Date : </strong>{{$dce_requisition->start_date}}
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                        <strong>End Date : </strong>{{$dce_requisition->end_date}}
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                        <strong>Duration of Engagement : </strong>{{$dce_requisition->no_of_days}}
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12" align="left">
                                                        <strong>Reason for Engagement : </strong>{{$dce_requisition->reason}}
                                                </div>
                                        </div>
                                    </td>
                                    <td><td>
                                    <td><td>
                                    <td><td>
                                    <td>
                                      @if($approvals->budget_approval == 1)
                                            <img src="{{ asset('dist/img/budgeted_circle.png')}}" alt="Kimfay budgeted" width="60%" height="60%">
                                        @else
                                            <img src="{{ asset('dist/img/not_budgeted')}}" alt="Kimfay not budgeted" width="60%" height="60%">
                                        @endif
                                    </td>
                                </tr>
                                </table>
                              <br/>
                              <hr/>
                              <div class="row">
                                    <div class="col-md-6" align="left">
                                            <p><h6><u><strong>WAGES DETAILS</strong></u></h6></p>
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="col-md-12" align="left">
                                            <strong>Daily Payment Rate : </strong>Ksh. {{number_format($dce_requisition->rate_per_casual,2)}}
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="col-md-12" align="left">
                                            <strong>No of Casuals : </strong>{{$dce_requisition->no_of_casuals}}
                                    </div>
                              </div>
                              @php
                                $net_pay = 0;
                                $cnt = 1;
                                $total = ($dce_requisition->no_of_casuals * $dce_requisition->rate_per_casual * $dce_requisition->no_of_days);
                              @endphp
                              @foreach($selected as $casual)
                                @php
                                    $net_pay += $casual->net_pay;
                                    
                                @endphp
                              @endforeach
                               @php
                                    $cnt = 1;
                                    $deductions = ($dce_requisition->nssf + $dce_requisition->nhif + $dce_requisition->tax);
                                    $total_deductions = ($deductions * $dce_requisition->no_of_casuals);
                                    $net = ($total - $total_deductions);
                                  @endphp
                              <div class="row">
                                <div class="col-md-12" align="left">
                                        <strong>Total Deductions : </strong>Ksh.{{number_format($total_deductions,2)}}
                                </div>
                              </div>
                              <div class="row">
                                    <div class="col-md-12" align="left">
                                            <strong>Total Amount Payable : </strong>Ksh.{{number_format($net,2)}}
                                    </div>
                              </div>
                              <br/>
                              <hr/>
                              <div class="row">
                                    <div class="col-md-6" align="left">
                                            <p><h6><u><strong>CASUALS DETAILS</strong></u></h6></p>
                                    </div>
                              </div>
                              <table class="customers-actions">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #000;">No.</th>
                                        <th style="border: 1px solid #000;">Casual Name</th>
                                        <th style="border: 1px solid #000;">I.D No.</th>
                                        <th style="border: 1px solid #000;">NHIF No.</th>
                                        <th style="border: 1px solid #000;">NSSF No.</th>
                                        <th style="border: 1px solid #000;">KRA Pin</th>
                                        <th style="border: 1px solid #000;">Casual Staff Sign</th>
                                        <th style="border: 1px solid #000;">Paying officer Name/Sign</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($selected as $casual)
                                    <tr>
                                        <td style="border: 1px solid #000;">{{$cnt}}</td>
                                        <td style="border: 1px solid #000;">{{$casual->user->casual_name}}</td>
                                        <td style="border: 1px solid #000;">{{$casual->user->casual_id_no}}</td>
                                        <td style="border: 1px solid #000;">{{$casual->user->nhif_no}}</td>
                                        <td style="border: 1px solid #000;">{{$casual->user->nssf_no}}</td>
                                        <td style="border: 1px solid #000;">{{$casual->user->kra_pin}}</td>
                                        <td style="border: 1px solid #000;"></td>
                                        <td style="border: 1px solid #000;"></td>
                                        
                                    </tr>
                                @php
                                    $cnt++
                                @endphp
                                @endforeach
                                </tbody>
                                </table>
                                <br/>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-6" align="left">
                                            <p><h6><u><strong>APPROVALS</strong></u></h6></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" align="left">
                                           <strong> Head of Department : </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$approvals->hod->name}}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Sign : </strong><img src="{{ asset('dist/signatures/'.$approvals->hod->signature)}}" width="8%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Date : </strong>{{$approvals->hod_approval_date}}
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-md-12" align="left">
                                           <strong> H.R Representative : </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$approvals->wages->name}}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Sign : </strong> <img src="{{ asset('dist/signatures/'.$approvals->wages->signature)}}" width="8%" alt="sign here">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Date : </strong>{{$approvals->wages_approval_date}}
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-md-12" align="left">
                                           <strong> Budget Officer : </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$approvals->budgetofficer->name}}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Sign :  </strong> <img src="{{ asset('dist/signatures/'.$approvals->budgetofficer->signature)}}" width="8%"><strong>Date : </strong>{{$approvals->budget_approval_date}}
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-md-12" align="left">
                                           <strong> H.R Manager : </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$approvals->hr->name}}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Sign :  </strong> <img src="{{ asset('dist/signatures/'.$approvals->hr->signature)}}" width="8%"> <strong>Date : </strong>{{$approvals->hr_approval_date}}
                                    </div>
                                </div>
                            </div>
                            </div>
                   </div>
                  </div>
                 </div>
        <!-- end of request history-->
    
          </div><!-- /.container-fluid -->
        </section>
@endsection