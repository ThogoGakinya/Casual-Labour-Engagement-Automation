<div class="modal fade" id="add-request">
          <div class="modal-dialog">
            <div class="modal-content">
                <!-- <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Alert!</h5>
                    Proper supporting documentation must be submitted to the Administration office within 3 days of receiving cash. Failure to comply will attract non-refundable salary
                    deductions.
                </div> -->
              <form method="post" action="{{ url('/add_request')}} ">
              @php 
                $requestTocken = rand(100000,999999);
              @endphp
                <div class="modal-body">
                              {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="target">H.O.D</label>
                                        <select name="hod" class="form-control" required>
                                             <option value="">Select H.O.D </option>
                                             @foreach($hods as $hod)
                                             <option value="{{$hod->id}}">{{$hod->name}}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="target">Budget Owner &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#bo_guide"><i class="fa fa-question-circle"></i>&nbsp;&nbsp;Budget Owner Guide</a>
                                        </label>
                                        <select name="budgeto" class="form-control" required>
                                             <option value="">Select Budget Owner</option>
                                             @foreach($hods as $b_owner)
                                             <option value="{{$b_owner->id}}">{{$b_owner->name}}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="target">Amount Requested</label>
                                        <input type="number" name="amount" class="form-control" id="amount" onkeyup="requestcheck()" maxlength="4" required>
                                        <input type="hidden" name="department" value="{{ Auth::user()->department_id}}" id="target" placeholder="Enter Amount" maxlength="4" required>
                                        <input type="hidden" name="userid" value="{{ Auth::user()->id }}" id="target" placeholder="Enter Amount" maxlength="4" required>
                                        <input type="hidden" name="process_status" value="20" id="target" placeholder="Enter Amount" maxlength="4" required>
                                        @foreach($voucher as $v)
                                        <input type="hidden" name="voucher_id" value="{{$v->id}}" id="target"  required>
                                        <input type="hidden" name="balance" value="{{$v->closing_balance}}" id="balance"  required>
                                        @php 
                                            $currentTocken = $v->end_voucher;
                                            $requestTocken = ($currentTocken + 1);
                                        @endphp
                                        <input type="hidden" name="token_id" value="{{$requestTocken}}" required>
                                        @endforeach
                                       
                                    </div>
            
                                    <div class="form-group">
                                        <label for="goal">Description of Need</label>
                                        <textarea class="form-control" name="description" rows="3" placeholder="Enter description here..."></textarea>
                                    </div>
                                    
                                </div>
                               <!-- /.card-body -->
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel Request</button>
                                    <button type="submit" class="btn btn-primary button"><i class="adding fa fa-plus-square"></i><i class="loading-icon fa fa-spinner fa-spin hide"></i>&nbsp;<span class="btn-txt">&nbsp;&nbsp;Submit Request</span></button>
                                </div>
                        </form>
                </div>
            </div>   <!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->

    <div class="modal fade" id="bo_guide">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Alert!</h5>
                    Proper supporting documentation must be submitted to the Administration office within 3 days of receiving cash. Failure to comply will attract non-refundable salary
                    deductions.
                </div> -->
                <div class="modal-body">
                        <div class="card-body">
                        <table class="customers-actions">
                            <thead>
                            <tr>
                                <th>S.N</th>
                                <th>NAME</th>
                                <th>BUDGET</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                   $cnt=1;
                                @endphp
                                @foreach($budget_owners as $owner)
                                <tr>
                                    <td>{{$cnt}}</td>
                                    <td>{{$owner->name}}</td>
                                    <td>{{$owner->owner->name}}</td>
                                </tr>
                                @php
                                   $cnt++;
                                @endphp
                                @endforeach
                                
                            </tbody>
                        </table> 
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><< Back</button>
                           
                        </div>
                        </form>
                </div>
            </div>   <!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->