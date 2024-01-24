@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Buffer Float</h5>
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
                   @if(auth::user()->level == 5)
                      <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_buffer"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Add New</a>
                   @else
                     <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_buffer"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Request Buffer Float</a>
                   @endif
                   </div>
                   <div class="panel-body">
                   <table class="customers-actions">
                      <thead>
                      <tr>
                            <th>No.</th>
                            <th>OWNER</th>
                            <th>TOKEN</th>
                            <th>AMOUNT</th>
                            <th>V.BOOK No.</th>
                            <th>NEW FLOAT</th>
                            <th>REQUEST DATE</th>
                            <th>STATUS</th>
                            <th>REFUND</th>
                            <th>ACTIONS</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($buffers as $buffer)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$buffer->user->name}}</td>
                            <td>{{$buffer->token_id}}</td>
                            <td><strong>{{$buffer->burfer_amount}}</strong></td>
                            <td>{{$buffer->voucher_book_token}}</td>
                            <td>{{$buffer->new_float}}</td>
                            <td>{{$buffer->created_at}}</td>
                            <td>
                                @if($buffer->status == 0)
                                <button type="button" class="btn btn-block btn-outline-warning btn-xs"><i class="fa fa-spinner"></i>&nbsp;Waiting</button>
                                @else
                                <button type="button" class="btn btn-block btn-outline-success btn-xs"><i class="fas fa-check"></i>&nbsp;Issued</button>
                                @endif
                            </td>
                            <td>
                                @if($buffer->refund_status == 0)
                                <button type="button" class="btn btn-block btn-outline-primary btn-xs"><i class="fas fa-times"></i>&nbsp;Not Refunded</button>
                                @elseif($buffer->refund_status == 1)
                                <button type="button" class="btn btn-block btn-outline-primary btn-xs"><i class="fas fa-spinner"></i>&nbsp;Bridged</button>
                                @else
                                <button type="button" class="btn btn-block btn-outline-primary btn-xs"><i class="fas fa-check"></i>&nbsp;Refunded</button>
                                @endif
                            </td>
                            <td align="center">
                                @if(auth::user()->level == 5)
                                    @if($buffer->refund_status == 1)
                                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#accept_buffer_{{$buffer->id}}"><i class="fas fa-edit"></i>Confirm</button>
                                    @elseif($buffer->refund_status == 2)
                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#view_buffer_{{$buffer->id}}"><i class="fas fa-eye"></i></button>
                                    @else
                                       @if($buffer->status == 1)
                                          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#view_buffer_{{$buffer->id}}"><i class="fas fa-eye"></i></button>
                                       @else 
                                          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_buffer_{{$buffer->id}}"><i class="fas fa-edit"></i>Issue</button>
                                       @endif
                                    
                                    @endif
                                @else
                                    @if($buffer->refund_status == 1)
                                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#view_buffer_{{$buffer->id}}"><i class="fas fa-eye"></i></button>
                                    @elseif($buffer->refund_status == 2)
                                    <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#view_buffer_{{$buffer->id}}"><i class="fas fa-eye"></i></button>
                                    @else
                                       @if($buffer->status == 1)
                                          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#refund_buffer_{{$buffer->id}}"><i class="fas fa-edit">Refund</i></button>
                                       @else 
                                            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#view_buffer_{{$buffer->id}}"><i class="fas fa-eye"></i></button>
                                       @endif
                                    @endif
                                    
                                @endif
                               
                            </td>
                        </tr>
                        @php
                          $cnt++;
                        @endphp
                        <!-- Modal for issuing buffer -->
                            <div class="modal fade" id="add_buffer_{{$buffer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel" align="center">Issue Buffer Float #{{$buffer->token_id}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <form method="post"  class="form-horizontal" action="{{route('issue_buffer','test')}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                @method('put')
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    Current Book No.
                                                    </div>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" name="current_voucher_book_no" value="{{$buffer->voucher_book_token}}" readonly>
                                                    <input type="hidden" class="form-control" name="request_id" value="{{$buffer->id}}" readonly>
                                                    <input type="hidden" class="form-control" name="token_id" value="{{$buffer->token_id}}" readonly>
                                                    <input type="hidden" class="form-control" name="user_id" value="{{auth::user()->level}}" readonly>
                                                    </div>
                                                </div><br/>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    Current Float
                                                    </div>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" name="current_float"  value="{{$buffer->current_float}}" readonly>
                                                    </div>
                                                </div><br/>
                                                
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    Requested Amount
                                                    </div>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" name="buffer_amount"  value="{{$buffer->burfer_amount}}"  required>
                                                    </div>
                                                </div><br/>
                                                
                                                
                                                
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Modal for issuing buffer -->
                            <!-- Modal for view buffer -->
                            <div class="modal fade" id="view_buffer_{{$buffer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel" align="center">Buffer Float #{{$buffer->token_id}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                Requested Amount
                                                </div>
                                                <div class="col-md-8">
                                                <input type="text" class="form-control" name="buffer_amount"  value="{{$buffer->burfer_amount}}" readonly required>
                                                </div>
                                            </div><br/>
                                            <div class="row">
                                            <div class="col-md-4">
                                            </div>
                                            <div class="col-md-4">
                                                @if($buffer->refund_status == 0)
                                                <button type="button" class="btn btn-block btn-outline-primary btn-xs"><i class="fas fa-times"></i>&nbsp;Not Refunded</button>
                                                @elseif($buffer->refund_status == 1)
                                                <button type="button" class="btn btn-block btn-outline-primary btn-xs"><i class="fas fa-spinner"></i>&nbsp;Bridged</button>
                                                @else
                                                <button type="button" class="btn btn-block btn-outline-primary btn-xs"><i class="fas fa-check"></i>&nbsp;Refunded</button>
                                                @endif 
                                            </div>
                                            <div class="col-md-4">
                                                @if($buffer->status == 0)
                                                <button type="button" class="btn btn-block btn-outline-warning btn-xs"><i class="fa fa-spinner"></i>&nbsp;Waiting</button>
                                                @else
                                                <button type="button" class="btn btn-block btn-outline-success btn-xs"><i class="fas fa-check"></i>&nbsp;Issued</button>
                                                @endif
                                            </div>
                                        </div>    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"> OK</button>
                                          
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Modal for issuing buffer -->
                            <!-- Modal for refunding buffer -->
                            <div class="modal fade" id="refund_buffer_{{$buffer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel" align="center">Refund Buffer Float #{{$buffer->token_id}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <form method="post"  class="form-horizontal" action="{{route('refund_buffer','test')}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                @method('put')
                                                @foreach($voucher as $v)
                                                    <input type="hidden" class="form-control" name="request_id" value="{{$buffer->id}}" readonly>
                                                    <input type="hidden" class="form-control" name="voucher_book_id" value="{{$v->id}}" readonly>
                                                    <input type="hidden" class="form-control" name="buffer_token" value="{{$buffer->token_id}}" readonly>
                                                    <input type="hidden" class="form-control" name="user_id" value="{{auth::user()->level}}" readonly>
                                                @endforeach  
                                                
            
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    Requested Amount
                                                    </div>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" name="buffer_amount"  value="{{$buffer->burfer_amount}}" required readonly>
                                                    </div>
                                                </div><br/>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    Refund Amount
                                                    </div>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" name="refund_amount"  value="{{$buffer->burfer_amount}}" readonly required>
                                                    </div>
                                                </div><br/>
                                                
                                                
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Modal for refund buffer -->
                            <!-- Modal for accept refunding buffer -->
                            <div class="modal fade" id="accept_buffer_{{$buffer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel" align="center">Confirm Buffer Float Refund  #{{$buffer->token_id}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <form method="post"  class="form-horizontal" action="{{route('accept_buffer','test')}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                @method('put')
                                                @foreach($voucher as $v)
                                                    <input type="hidden" class="form-control" name="request_id" value="{{$buffer->id}}" readonly>
                                                    <input type="hidden" class="form-control" name="voucher_book_id" value="{{$v->id}}" readonly>
                                                    <input type="hidden" class="form-control" name="buffer_token" value="{{$buffer->token_id}}" readonly>
                                                    <input type="hidden" class="form-control" name="user_id" value="{{auth::user()->level}}" readonly>
                                                @endforeach  
                                                
            
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    Requested Amount
                                                    </div>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" name="buffer_amount"  value="{{$buffer->burfer_amount}}" required readonly>
                                                    </div>
                                                </div><br/>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    Refunded Amount
                                                    </div>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" name="refund_amount"  value="{{$buffer->burfer_amount}}" readonly required>
                                                    </div>
                                                </div><br/>
                                                
                                                
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                                            <button type="submit" class="btn btn-success">Confirm</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Modal for issuing buffer -->
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
<!-- Modal for adding buffer -->
<div class="modal fade" id="add_buffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Add buffer Float</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @php 
                $token_id = rand(100000,999999);
            @endphp
            @foreach($voucher as $v)
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('add_buffer')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                        Current Book No.
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="current_voucher_book_no" value="{{$v->token}}" readonly>
                          <input type="hidden" class="form-control" name="token_id" value="{{$token_id}}" readonly>
                          <input type="hidden" class="form-control" name="token" value="{{$v->id}}" readonly>
                          <input type="hidden" class="form-control" name="user_id" value="{{auth::user()->level}}" readonly>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Current Float
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="current_float" id="current_float" value="{{$v->closing_balance}}" readonly>
                        </div>
                    </div><br/>
                    
                    <div class="row">
                        <div class="col-md-4">
                        Buffer Amount
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="buffer_amount" id="burfer_amount" onkeyup="computenew()" required>
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        New Float
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="new_float" id="new_float" readonly>
                        </div>
                    </div><br/>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                <button type="submit" class="btn btn-primary button"><i class="adding fa fa-plus-square"></i><i class="loading-icon fa fa-spinner fa-spin hide"></i>&nbsp;<span class="btn-txt">&nbsp;&nbsp;Submit Request</span></button>
            </div>
        </form>
        </div>
        @endforeach
    </div>
</div>
<!-- End of Modal for adding buffer -->
<!-- Modal for editing buffer -->
<div class="modal fade" id="edit_buffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Edit Expense buffer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('put')
                    <div class="row">
                        <div class="col-md-4">
                        buffer Name
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="name" id="name" value="">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Monthly Budget
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="budget" id="budget" value="">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        MTD
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="mtd" id="mtd" value="">
                          <input type="hidden" class="form-control" name="buffer_id" id="buffer_id" value="">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Budget Owner
                        </div>
                        <div class="col-md-8">
                          <select class="form-control" name="b_owner" required>
                          <option id="b_owner" value=""></option>
                          @foreach($all_users as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                          @endforeach
                          </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for adding buffer -->


<!-- Modal for deleting buffer-->
<div class="modal fade" id="delete_buffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Delete buffer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <p align="center">Are you sure you want to delete this record?</p>
                    <form method="post"  class="form-horizontal" action="" enctype="multipart/form-data">
                    {{method_field('delete')}}
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="buffer_id" id="buffer_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"> No Cancel</button>
                <button type="submit" class="btn btn-danger">Yes Delete</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for deleting buffer -->

@endsection