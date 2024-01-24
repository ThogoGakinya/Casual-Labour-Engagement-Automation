@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Make Payment</h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Admin</li>
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
                      <a href="{{route ('admin')}}" class="btn btn-primary btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a> 
                    </div>
                      <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">M-PESA Self</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="post"  name="frm"class="form-horizontal" action="{{route('stk-initial')}}" enctype="multipart/form-data">
                                     {{ csrf_field() }}
                                     <div class="row">
                                        <div class="col-md-4">
                                            Enter Amount
                                        </div>
                                            <div class="col-md-8">
                                            <input type="text" class="form-control" name="amount" min="0" max="150000" value = "0">
                                            </div>
                                    </div><br/>
                                    <div class="row">
                                        <div class="col-md-4">
                                        M-PESA Number
                                        </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="number" id="number" value="254">
                                                <small>Number format : 2547xxxxxxxx</small>
                                                </div>
                                            </div>
                                            <br/><br/>
                                            <div id="loader" align="center" style="display:none;"><img src="{{asset('docs/ajax-loader.gif')}}" alt="Loader"></div>
                                            <div id="results"></div>
                                            @if($ResponseCode == 0)
                                            <div class="alert alert-info alert-dismissible" id="first" >
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <h5><i class="icon fas fa-info"></i> Alert!</h5>
                                                Unlock your phone screen and in a few seconds enter your M-Pesa PIN to confirm the payment.
                                            </div>
                                            <input type="hidden" id="CheckoutRequestID" value="{{$CheckoutRequestID}}">
                                            <marquee id="maq" scrollamount="1" behavior="alternate" style="color:red;"><strong>NOTE</strong> : If you dont receive an M-PESA prompt,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;your balance is insufficient for this transaction</marquee>
                                            @endif
                                            
                                           
                                    </div>
                                    <hr/>
                                    <div align="center">
                                        @if($ResponseCode == 0)
                                           <button type="button" class="btn btn-primary" onclick="complete();">Complete</button><br/>
                                        @else
                                           <button type="submit" id="getBack" class="btn btn-success" onclick="numberValidator();"><i class="fa fa-repeat" aria-hidden="true"></i> Initiate</button><br/>
                                        @endif
                                    </div>
                                    <hr/> 
                                </form>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Second Party </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                             Also here
                            </div>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <!-- END ACCORDION & CAROUSEL-->
                   </div>
                  </div>
                 </div>
        <!-- end of request history-->
          </div><!-- /.container-fluid -->
        </section>
@endsection