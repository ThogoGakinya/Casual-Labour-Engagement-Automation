@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Cash Requisition</h5>
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
            <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" style="border:1px solid #ccc" id="list_login_details">Requisition</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_personal_details" style="border:1px solid #ccc">H.O.D</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Budget Owner</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Budgeting</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">C.F.O</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Internal Auditor</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Collection</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active_tab1" id="list_contact_details" style="border:1px solid #ccc">Documents</a>
                  </li>
                </ul>
        <!-- End of tabs content -->

<!--Start of requisition tab-->
                <div class="tab-content" style="margin-top:16px;">
                 <div class="tab-pane active" id="login_details">
                  <div class="panel panel-default">
     
                   <div class="panel-body">
                        <!-- START ALERTS AND CALLOUTS -->
       @foreach($specific_document_requisition as $specific)                    
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <div>
                    <i class="fas fa-check bg-green"></i>
                    <div class="timeline-item">
                        <span class="time">Requested on :&nbsp;<i class="fas fa-clock"></i>&nbsp;{{$specific->created_at}}</span>
                        <h3 class="timeline-header"><a href="#">Request No. #{{$specific->token_id}}</a>
                            @if(auth::user()->level == 7)
                             &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-default btn-xs" data-commentid="{{$specific->token_id}}" data-bookid="{{$specific->voucher_id}}" data-toggle="modal" data-target="#recall"><i class="fa fa-plus"></i>&nbsp;Call Back</button>
                             @endif
                        </h3>

                        <div class="timeline-body">
                        <div class="row">
                            <div class="col-md-4">
                             <strong>Request By : </strong>{{$specific->user->name}}
                            </div>
                            <div class="col-md-4">
                            <strong>Department : </strong>{{$specific->department->name}}
                            </div>
                            <div class="col-md-4">
                            <strong>Amount: </strong>{{$specific->amount}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                               <strong>Description :</strong>
                            </div><br/>
                        </div>
                        {{$specific->description}}
                        </div>
                      
                    </div>
              </div>
  <!--end of requisition tab-->
  
<!--Start of documents tab-->
    <div>
                    @if($specific->documents_approval_status == 0)
                        <i class="fas fa-spinner bg-yellow"></i>
                    @elseif($specific->documents_approval_status == 1)
                        <i class="fas fa-check bg-green"></i>
                    @endif
                    @if($specific->hod_approval_status == 2)
                        <i class="fas fa-times bg-red"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time">Uploaded on :&nbsp;<i class="fas fa-clock"></i> {{$specific->admin_approval_date}}</span>
                        <h3 class="timeline-header"><a href="#">Documents Upload</a>
                          @if(count($comments) == 0)
                             @if(auth::user()->level == 6)
                             &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-default btn-xs" data-commentid="{{$specific->token_id}}" data-bookid="{{$specific->voucher_id}}" data-toggle="modal" data-target="#comment"><i class="fa fa-plus"></i>&nbsp;Comment</button>
                             @endif
                          @endif
                        </h3>
                    @if($specific->hod_approval_status == 2)
                        <div class="timeline-footer">
                            <button type="button" class="btn btn-danger btn-sm" ><i class="fas fa-times"></i>&nbsp;This request was declined by {{$specific->hod_approver_id}}</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    @else
                        @if($specific->documents_approval_status == 0)
                            <div class="timeline-footer">
                                <button type="button" class="btn btn-primary btn-xs" data-approvalid="{{$specific->id}}" data-tokenid="{{$specific->token_id}}" data-toggle="modal" data-target="#approve"><i class="fa fa-upload" aria-hidden="true"></i>
                                &nbsp;Upload</button>
                                <button type="button" class="btn btn-danger btn-xs" data-nodocumentid="{{$specific->id}}" data-toggle="modal" data-target="#no-document"><i class="fas fa-times"></i>&nbsp;Without Documents</button>
                            </div>
                        @elseif($specific->documents_approval_status == 1)
                            @if($specific->no_documents_reason != "")
                                <div class="timeline-footer">
                                <button type="button" class="btn btn-success btn-xs"><i class="fas fa-check"></i>&nbsp;Approved without Documents</button>
                                by {{$specific->admin_approver->name}} &nbsp;&nbsp;&nbsp;&nbsp;<strong>Reason:</strong> {{$specific->no_documents_reason}}
                                </div>
                            @else
                            <br/>
                            <div class="row">
                                <div class="col-md-2" align="center">
                                <br/><br/>
                                @if(auth::user()->level != 6)
                                  <button type="button" class="btn btn-primary btn-xs" data-approvalid="{{$specific->id}}" data-tokenid="{{$specific->token_id}}" data-toggle="modal" data-target="#approve"><i class="fa fa-upload" aria-hidden="true"></i>
                                    &nbsp;Upload more
                                  </button>
                                @endif
                                </div>
                                @php
                                    $cnt = 1;
                                @endphp
                                <div class="col-md-9">
                                    <table class="customers-actions">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Document</th>
                                                <th>Verification</th>
                                                <th>Owner</th>
                                                <th>Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    @foreach($specific_document as $document)
                                        @if($document->document_name != '')
                                        <tr>
                                            <td>{{$cnt}}</td>
                                            <td>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-file"></i> <a href="{{url ('/download/'.$document->document_name)}}" class="document_links">&nbsp;{{$document->document_name}}</a>
                                            </td>
                                            <td>
                                            @if($document->approval == 0)
                                               <i class="fa fa-spinner"></i>&nbsp;&nbsp;<small>waiting verification</small>
                                            @elseif($document->approval == 1)
                                                <i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;<small>verified</small>
                                            @else($document->approval == 2)
                                                <i class="fa fa-times"></i>&nbsp;&nbsp;<small>Invalid</small>
                                            @endif
                                            </td>
                                            <td>{{$document->user->name}}</td>
                                            <td>
                                            <button class="btn btn-default btn-xs"  data-toggle="modal" data-target="#docs_{{$document->id}}"><i class="fas fa-eye" title="View this attachment"></i></button>
                                              @if($document->user_id == auth::user()->id)
                                               <i class="fa fa-times-circle" aria-hidden="true" data-removeid="{{$document->id}}" data-documentid="document1" data-toggle="modal" data-target="#remove" title="Remove this attachment"></i>
                                              @endif
                                               
                                            </td>
                                        @endif
                                        @php
                                            $cnt++
                                        @endphp
                                      
                                        <!-- Modal for viewing uploaded document-->
                                        <div class="modal fade" id="docs_{{$document->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                @if(auth::user()->level == 7)
                                                    <div class="modal-header">
                                                        <form method="post" action="{{ url('/invalid')}} ">
                                                        {{ csrf_field() }}
                                                        @method('put')
                                                            <input type="hidden" name="button_type" value="2">
                                                            <input type="hidden" name="token_id" value="{{$specific->id}}">
                                                            <input type="hidden" name="token" value="{{$specific->token_id}}">
                                                            <input type="hidden" name="doc_id" value="{{$document->id}}">
                                                            <button type="submit" class="btn btn-warning btn-xs"><i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp;Invalidate</button>
                                                        </form>&nbsp;&nbsp;&nbsp;
                                                        <form method="post" action="{{ url('/valid')}} ">
                                                        {{ csrf_field() }}
                                                        @method('put')
                                                            <input type="hidden" name="button_type" value="1">
                                                            <input type="hidden" name="token_id" value="{{$specific->id}}">
                                                            <input type="hidden" name="token" value="{{$specific->token_id}}">
                                                            <input type="hidden" name="doc_id" value="{{$document->id}}">
                                                            <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-thumbs-up"></i>&nbsp;Validate</button>
                                                        </form>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @endif
                                                    <div class="modal-body">
                                                        @php
                                                           $path = $document->document_name;
                                                        @endphp
                                                        <embed src="{{asset('Documents/'.$path)}}" id="files" type="application/pdf" width="100%" height="600px"/>
                                                    </div>
                                                   
                                                </form>
                                                </div>
                                            </div>
                                        </div> <!-- End of Modal for viewing uploaded document -->
                                     
                                    @endforeach
                                    </tbody>
                                    </table>
                            </div>
                            <div class="col-md-1">
                                  
                            </div>
                           
                            </div>
                            <br/>
                            @endif
                        @endif
                    @endif
                    </div>
              </div>
@include('Staff.comment_form') 
              <div>
                 @if(auth::user()->level == 7)
                 <a href="{{route ('admin_requisitions')}}" class="btn btn-primary btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>         
                 @elseif(auth::user()->level == 1)
                 <a href="{{route ('user_requisitions')}}" class="btn btn-primary btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>         
                @endif
              </div>
              </div>
              </section>
<!-- Modal for recalling a transaction-->
<div class="modal fade" id="recall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Recall Transaction #{{$specific->token_id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ url('/rollback')}} ">
            {{ csrf_field() }}
            @method('put')
            <div class="modal-body">
            <div class="card-body">
                <div class="form-group">
                    <label for="target">Request By</label>
                    <input type="text" name="user" class="form-control" value="{{$specific->user->name}}" required>  
                </div>
                <div class="form-group">
                    <label for="target">Requested Amount</label>
                    <input type="number" name="requested_amount" class="form-control" id="requested" value="{{$specific->amount}}" required>
                </div>
                <div class="form-group">
                    <label for="target">Used Amount</label>
                    <input type="number" name="used" class="form-control" id="used" value="" onkeyup="sum()" required>
                </div>
                <div class="form-group">
                    <label for="goal">Difference</label>
                    <input type="number" name="difference" class="form-control" id="difference" value="" required readonly>
                    <input type="hidden" name="voucher_no" class="form-control"  value="{{$specific->token_id}}">
                    <input type="hidden" name="voucher_book_no" class="form-control"  value="{{$specific->voucher_id}}">
                </div>
                
                
            </div>
            <!-- /.card-body -->
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Recall</button>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for commenting on a request -->         
    @endforeach


<!-- Modal for uploading documents -->
<div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Upload support documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('submit_documents','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                   
                     <div class="row">
                        <div class="col-md-4">
                         Document 1
                        </div>
                        <div class="col-md-8">
                            <input type="file" class="form-control" name="document1" required>
                        </div>
                     </div><br/>
                        <div class="col-md-8">
                          <input type="hidden" class="form-control" name="approval_id" id="approval_id" value="">
                          <input type="hidden" class="form-control" name="token_id" id="token_id" value="">
                          <input type="hidden" class="form-control" name="user_id"  value="{{auth::user()->id}}">
                        </div>
                    </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Not Now</button>
                <button type="submit" class="btn btn-success button"><i class="loading-icon fa fa-spinner fa-spin hide"></i>&nbsp;<span class="btn-txt">&nbsp;&nbsp;Submit</span></button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for approving -->

<!-- Modal for approving without documents-->
<div class="modal fade" id="no-document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Approve without Documents</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('no_documents','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     @method('put')
                    <textarea class="form-control" rows="4" name="reason" placeholder="Please provide a reason for completing this request without documents" required></textarea>
                    <input type="hidden" class="form-control" name="no_document_id" id="no_document_id" value="">
                    <input type="hidden" class="form-control" name="user_id"  value="{{auth::user()->id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Not Now</button>
                <button type="submit" class="btn btn-warning">Yes Proceed </button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for declining request -->
<!-- Modal for removing attachment-->
<div class="modal fade" id="remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Remove Attachement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('remove_document','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{method_field('delete')}}
                   Are you sure you want to remove this Attachment?
                    <input type="hidden" class="form-control" name="remove_id" id="remove_id" value="">
                    <input type="hidden" class="form-control" name="document_id" id="document_id" value="">
                    <input type="hidden" class="form-control" name="doc" id="doc" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Not Now</button>
                <button type="submit" class="btn btn-warning">Yes Decline</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for removing attachment-->


@include('Staff.comment_modal')  

@endsection