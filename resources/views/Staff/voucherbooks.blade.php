@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Petty Cash Voucher Books</h5>
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

        <!-- Start of request history -->
                <div class="tab-content" style="margin-top:16px;">
                 <div class="tab-pane active" id="login_details">
                  <div class="panel panel-default">
                   <div class="panel-heading">
                   @foreach($bridged as $bridge)
                      @php
                        $balanceBF = $bridge->closing_balance;
                        $end_voucher = $bridge->end_voucher;
                        $bridgeid = $bridge->id;
                        $topup = (150000)-($balanceBF);
                        $opening_balance = ($balanceBF + $topup);
                      @endphp
                    @endforeach
                  @if(auth::user()->level == 6)
                    @if($number == 0)
                        <a href="#" class="btn btn-info btn-sm" data-toggle="modal"
                                                                data-bridgeid="{{$bridgeid}}"
                                                                data-balance="{{$balanceBF}}"
                                                                data-topup="{{$topup}}"
                                                                data-endvoucher="{{$end_voucher}}"  
                                                                data-openingbalance="{{$opening_balance}}"
                                                                data-target="#add-voucher">
                        <i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Voucher Book
                        </a>
                    @else
                        <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#close_alert"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;New Voucher Book</a>
                    @endif
                 
                  @endif
                  <a href="{{route ('staff_dashboard')}}" class="btn btn-info btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
                  <a href="{{route ('burfer_float')}}" class="btn btn-success btn-sm" id="burfar_float"><i class="fa fa-money fa-5x"></i>Burfer Float</a>
                   </div>
                   <div class="panel-body">
                    <table class="customers-actions">
                      <thead>
                        <tr>
                            <th>S.N</th>
                            <th>TOKEN</th>
                            <th>OWNER</th>
                            <th>VOUCHER NAME</th>
                            <th>BALANCE B/F</th>
                            <th>OPENING BALANCE</th>
                            <th>EXPENSES</th>
                            <th>CLOSING BALANCE</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($voucherbooks as $voucherbook)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$voucherbook->token}}</td>
                            <td>{{$voucherbook->user->name}}</td>
                            <td>{{$voucherbook->name}}</td>
                            <td>{{$voucherbook->balance_BF}}</td>
                            <td>{{$voucherbook->opening_balance}}</td>
                            <td>{{$voucherbook->expenses}}</td>
                            <td>{{$voucherbook->closing_balance}}</td>
                            <td>
                                @if($voucherbook->status==1)
                                  <button type="button" class="btn btn-primary btn-xs"><i class="fas fa-times"></i>&nbsp;Closed</button>
                                @elseif($voucherbook->status==0)
                                    <button type="button" class="btn btn-success btn-xs"><i class="fas fa-door-open"></i>&nbsp;running..</button>
                                @else
                                     <button type="button" class="btn btn-warning btn-xs"><i class="fas fa-spinner"></i>&nbsp;Bridged</button>
                                @endif

                                @foreach($incomplete as $incom)
                                  @if($voucherbook->id == $incom->voucher_id)
                                      <i class="fa fa-question-circle" aria-hidden="true" title="incomplete transactions"></i>
                                  @break
                                  @endif
                                @endforeach
                            </td>
                            <td>
                                @if($voucherbook->status==1)
                                  <a href="{{url ('/expand/'.$voucherbook->id)}}" class="btn btn-default btn-xs"><i class="fas fa-folder-open"></i>&nbsp;Expand</a>
                                @elseif($voucherbook->status==0)
                                  <a href="{{url ('/expand/'.$voucherbook->id)}}" class="btn btn-default btn-xs"><i class="fas fa-folder-open"></i>&nbsp;Expand</a>
                                  @if(auth::user()->level == 6)
                                    <button type="button" class="btn btn-danger btn-xs" data-closeid="{{$voucherbook->id}}" data-toggle="modal" data-target="#close_voucher"><i class="fas fa-times"></i>&nbsp;End</button>
                                  @endif
                             @else
                                  <a href="{{url ('/expand/'.$voucherbook->id)}}" class="btn btn-default btn-xs"><i class="fas fa-folder-open"></i>&nbsp;Expand</a>
                                @endif
                            </td>   
                        </tr>
                        @php
                          $cnt++
                        @endphp
                        @endforeach
                        </tbody>
                    </table>
                   </div>
                   {{$voucherbooks->links()}}
                  </div>
                 </div>
        <!-- end of request history-->
    
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
<!-- start of the modal form to add a voucher -->
     <div class="modal fade" id="add-voucher">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="post" action="{{ url('/add_voucher')}} ">
              @php 
                $requestTocken = rand(100000,999999);
              @endphp
                <div class="modal-body">
                              {{ csrf_field() }}
                                <div class="card-body">
                                   <div class="form-group">
                                        <label for="target">Voucher Book Name</label>
                                        <input type="text" name="name" class="form-control" id="target" required>
                                        <input type="hidden" name="token" value="{{$requestTocken}}" id="target" placeholder="Enter Amount" maxlength="4" required>
                                        <input type="hidden" name="bridge_id" value="" id="bridge_id"  required>
                                    </div>
                                    <div class="form-group">
                                        <label for="target">Balance B/F</label>
                                        <input type="number" name="balance_bf" class="form-control" id="balance_bf" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="target">Topup Amount</label>
                                        <input type="number" name="topup" class="form-control" id="topup" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="goal">Opening Balance</label>
                                        <input type="number" name="opening_balance" class="form-control" id="opening_balance" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="goal">Starting PCV</label>
                                        <input type="number" name="start_voucher" class="form-control" id="start_voucher" value="" required>
                                    </div>
                                    
                                </div>
                               <!-- /.card-body -->
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Submit Voucher</button>
                                </div>
                        </form>
                </div>
            </div>   <!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
<!-- end of the modal form to add a cash request-->

<!-- Modal for Not closed alert-->
<div class="modal fade" id="close_alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Close Current Voucher Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Alert!</h5>
                       Please Close the current opened Voucher book before initiating another.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for Not closed alert -->

<!-- Modal for ending a voucher -->
<div class="modal fade" id="close_voucher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Close Voucher Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <p align="center">Are you sure you want to end this Voucher Book?</p>
                    <form method="post"  class="form-horizontal" action="{{route('close_voucher','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     @method('put')
                    <input type="hidden" class="form-control" name="close_id" id="close_id" value="">
                    <input type="hidden" class="form-control" name="hod_id"  value="{{auth::user()->id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Not Now</button>
                <button type="submit" class="btn btn-success">Yes Proceed</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for closing a vouncher -->
@endsection