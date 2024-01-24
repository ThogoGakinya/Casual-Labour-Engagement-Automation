@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-request"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Request</a>
                <a href="{{route ('voucher_requisitions')}}" class="btn btn-primary btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Petty cash</li>
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
        <div class="row">
            <div class="col-md-4">
                <strong>Voucher Book Name : </strong>{{$voucher_data->name}}</br>
                <strong>Voucher Book Number : </strong>{{$voucher_data->token}}</br>
            </div>
            <div class="col-md-2">
                <form method="post" action="{{ url('/vouchers_check')}} ">
                {{ csrf_field() }}
                    <input type="hidden" name="button_type" value="2">
                    <input type="hidden" name="type" value="All Vouchers">
                    <input type="hidden" name="voucher_book_token" value="{{$voucher_data->token}}">
                    <input type="hidden" name="voucher_book_name" value="{{$voucher_data->name}}">
                    <input type="hidden" name="voucher_book_id" value="{{$voucher_data->id}}">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i> All Vouchers
                        <small><a href="#">({{$number_of_all}})</a></small>
                    </button>
                </form>
            </div>
            <div class="col-md-2">
                <form method="post" action="{{ url('/vouchers_check')}} ">
                {{ csrf_field() }}
                    <input type="hidden" name="button_type" value="1">
                    <input type="hidden" name="type" value="Complete Vouchers">
                    <input type="hidden" name="voucher_book_token" value="{{$voucher_data->token}}">
                    <input type="hidden" name="voucher_book_name" value="{{$voucher_data->name}}">
                    <input type="hidden" name="voucher_book_id" value="{{$voucher_data->id}}">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i> Complete
                        <small><a href="#">({{$number_of_complete}})</a></small>
                    </button>
                </form>
            </div>
            <div class="col-md-2">
                <form method="post" action="{{ url('/vouchers_check')}} ">
                {{ csrf_field() }}
                    <input type="hidden" name="button_type" value="0">
                    <input type="hidden" name="type" value="Incomplete Vouchers">
                    <input type="hidden" name="voucher_book_token" value="{{$voucher_data->token}}">
                    <input type="hidden" name="voucher_book_name" value="{{$voucher_data->name}}">
                    <input type="hidden" name="voucher_book_id" value="{{$voucher_data->id}}">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-question-circle" aria-hidden="true"></i> Incomplete
                        <small><a href="#">({{$number_of_incomplete}})</a></small>
                    </button>
                </form>
            </div>
            <div class="col-md-2">
                <form method="post" action="{{ url('/vouchers_check')}} ">
                {{ csrf_field() }}
                    <input type="hidden" name="button_type" value="3">
                    <input type="hidden" name="type" value="Cash Book">
                    <input type="hidden" name="voucher_book_token" value="{{$voucher_data->token}}">
                    <input type="hidden" name="voucher_book_name" value="{{$voucher_data->name}}">
                    <input type="hidden" name="voucher_book_id" value="{{$voucher_data->id}}">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-book"></i> Petty Cashbook
                    </button>
                </form>
            </div>
            
        </div>
         
        <!-- Start of request history -->
                <div class="tab-content" style="margin-top:16px;">
                 <div class="tab-pane active" id="login_details">
                  <div class="panel panel-default">
                   <div class="panel-heading">
                   @if($cashbook == 1)
                   <a href="#">PETTY CASHBOOK</a>
                   @else
                   <a href="#">{{$type}} ({{$number}})</a>
                   @endif
                   </div>
                   <div class="panel-body">
                @if($cashbook == 0)
                    <table class="customers-actions">
                      <thead>
                      <tr>
                            <th>S.N</th>
                            <th>APPLICANT</th>
                            <th>REQUEST DATE</th>
                            <th>VOUCHER</th>
                            <th>AMOUNT</th>
                            <th>H.O.D</th>
                            <th>B.O</th>
                            <th>BUD</th>
                            <th>CFO</th>
                            <th>I.A</th>
                            <th>ISSUE</th>
                            <th>DOCS</th>
                            <th>PROGRESS</th>
                            <th>ACTION</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($specific_expanded_requisition as $requisition)
                        <tr>
                        <td>{{$cnt}}</td>
                            <td>{{$requisition->user->name}}</td>
                            <td>{{$requisition->created_at}}</td>
                            <td>{{$requisition->token_id}}</td>
                            <td>{{$requisition->amount}}</td>
                            <td>
                                @if($requisition->hod_approval_status == 0)
                                    <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->hod_approval_status == 1)
                                  <i class="fa fa-check"></i></button>
                                @elseif($requisition->hod_approval_status == 2)
                                    <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                            <td>
                                @if($requisition->budgeto_approval_status == 0)
                                   <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->budgeto_approval_status == 1)
                                  <i class="fa fa-check"></i></button>
                                @elseif($requisition->budgeto_approval_status == 2)
                                    <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                            <td>
                                @if($requisition->budget_approval_status == 0)
                                    <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->budget_approval_status == 1)
                                  <i class="fa fa-check"></i></button>
                                @elseif($requisition->budget_approval_status == 2)
                                    <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                           
                            <td>
                                @if($requisition->cfo_approval_status == 0)
                                    <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->cfo_approval_status == 1)
                                  <i class="fa fa-check"></i></button>
                                @elseif($requisition->cfo_approval_status == 2)
                                    <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                            <td>
                                @if($requisition->ia_approval_status == 0)
                                    <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->ia_approval_status == 1)
                                  <i class="fa fa-check"></i></button>
                                @elseif($requisition->ia_approval_status == 2)
                                    <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                            <td>
                                @if($requisition->admin_approval_status == 0)
                                    <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->admin_approval_status == 1)
                                  <i class="fa fa-check"></i></button>
                                @elseif($requisition->admin_approval_status == 2)
                                    <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                            <td>
                                @if($requisition->documents_approval_status == 0)
                                    <i class="fas fa-spinner"></i></button>
                                @elseif($requisition->documents_approval_status == 1)
                                  <i class="fa fa-check"></i></button>
                                @elseif($requisition->documents_approval_status == 2)
                                    <i class="fa fa-times"></i></button>
                                @endif
                            </td>
                            <td>
                            @if($requisition->process_status == 20)
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$requisition->process_status}}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{$requisition->process_status}}%">
                                        {{$requisition->process_status}}%
                                    </div>
                                </div>
                            @elseif($requisition->process_status == 40)
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$requisition->process_status}}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{$requisition->process_status}}%">
                                        {{$requisition->process_status}}%
                                    </div>
                                </div>
                            @elseif($requisition->process_status == 60)
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$requisition->process_status}}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{$requisition->process_status}}%">
                                        {{$requisition->process_status}}%
                                    </div>
                                </div>
                            @elseif($requisition->process_status == 80)
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$requisition->process_status}}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{$requisition->process_status}}%">
                                        {{$requisition->process_status}}%
                                    </div>
                                </div>
                            @elseif($requisition->process_status == 90)
                            <div class="progress mb-3">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$requisition->process_status}}" aria-valuemin="0"
                                    aria-valuemax="100" style="width: {{$requisition->process_status}}%">
                                    {{$requisition->process_status}}%
                                </div>
                            </div>
                            @elseif($requisition->process_status == 100)
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{$requisition->process_status}}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{$requisition->process_status}}%">
                                        {{$requisition->process_status}}%
                                    </div>
                                </div>
                            @endif
                            </td>
                            <td>
                            @if(auth::user()->level == 6)
                                @if($requisition->documents_approval_status == 0)
                                    <a href="{{url ('/ia_request/'.$requisition->token_id)}}" class="btn btn-success btn-xs editbtn" id="edit_goal"><i class="fa fa-eye"></i>&nbsp;&nbsp;View</a>
                                @else
                                    <a href="{{url ('/documents/'.$requisition->token_id)}}" class="btn btn-success btn-xs editbtn" id="edit_goal"><i class="fa fa-eye"></i>&nbsp;&nbsp;View</a>
                                @endif
                            @else
                               @if($requisition->admin_approval_status == 0)
                               
                                <a href="{{url ('/admin_request/'.$requisition->token_id)}}" class="btn btn-success btn-xs editbtn" id="edit_goal"><i class="fa fa-eye"></i>&nbsp;&nbsp;View</a>
                               
                                @elseif($requisition->admin_approval_status == 1)
                                
                                <a href="{{url ('/documents/'.$requisition->token_id)}}" class="btn btn-success btn-xs editbtn" id="edit_goal"><i class="fa fa-eye"></i>&nbsp;&nbsp;View</a>
                              
                                @endif
                            @endif
                            </td>
                        </tr>
                        @php
                          $cnt++
                        @endphp
                        @endforeach
                        </tbody>
                    </table>
                @else
                  <table class="customers-actions">
                      <thead>
                      <tr>
                            <th>Receipt</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>PCV</th>
                            <th>Totals</th>
                            <th>Balance</th>
                            <th>Category</th>
                            <th>Mode</th>
                            <th>Sending</th>
                            <th>Withdrawal</th>
                            <th>Comments</th>
                        </tr>
                      </thead>
                      <tr>
                            <td>{{number_format($voucher_data->balance_BF, 2)}}</td>
                            <td>{{$voucher_data->open_date}}</td>
                            <td>Balance</td>
                            <td>B/F</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                      </tr>
                      <tr>
                            <td>{{number_format($voucher_data->topup, 2)}}</td>
                            <td>{{$voucher_data->open_date}}</td>
                            <td>Imprest Amount</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                      </tr>
                      <tr>
                            <td style="border-top: 3px solid black;"><strong>{{number_format($voucher_data->opening_balance,2)}}</strong></td>
                            <td>{{$voucher_data->open_date}}</td>
                            <td>Float</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                      </tr>
                      @php
                        $totals =0;
                      @endphp
                      @foreach($book_info as $info)
                      @php
                        $totals += $info->amount;
                      @endphp
                      <tr>
                            <td>{{number_format($info->receipt, 2)}}</td>
                            <td>{{$info->created_at}}</td>
                            <td>{{$info->description}}</td>
                            <td>{{$info->voucher_no}}</td>
                            <td>{{number_format($info->amount,2)}}</td>
                            <td>{{number_format($info->balance, 2)}}</td>
                            <td>{{$info->category->name}}</td>
                            <td>{{$info->payment_mode}}</td>
                            <td>{{number_format($info->sending_charges, 2)}}</td>
                            <td>{{number_format($info->withdrawal_charges, 2)}}</td>
                            <td>
                               @foreach($comments as $comment)
                                    @if($info->voucher_no == $comment->token_id)
                                      - {{$comment->comment}}<br/>
                                    @endif
                               @endforeach
                            </td>
                      </tr>
                     @endforeach
                     <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                      </tr>
                      <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="border-top: 3px solid black; border-bottom: 3px solid black;"><strong>Ksh.{{number_format($voucher_data->expenses, 2)}}</strong></td>
                            <td style="border-top: 3px solid black; border-bottom: 3px solid black;"><strong>Ksh.{{number_format($voucher_data->closing_balance, 2)}}</strong></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                      </tr>
                      <tr>
                            <td style="border-top: 3px solid black;"><strong>{{number_format($voucher_data->closing_balance, 2)}} /=</strong></td>
                            <td>{{$voucher_data->close_date}}</td>
                            <td>Balance</td>
                            <td>C/F</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                      </tr>
                 </table>
                @endif
                   </div>
                  </div>
                 </div>
        <!-- end of request history-->
    
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

<!-- start of the modal form to add a cash request -->
@include('Staff.request_form')
<!-- end of the modal form to add a cash request-->

<!-- start of the modal form to edit a cash request -->
@include('Staff.edit_form')
<!-- end of the modal form to add a cash request-->

@endsection