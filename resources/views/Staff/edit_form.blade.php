<div class="modal fade" id="edit-request">
          <div class="modal-dialog">
            <div class="modal-content">
                <form method="post"  class="form-horizontal" action="{{route('update_request','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     @method('put')
              @php 
                $requestTocken = rand(100000,999999);
              @endphp
                <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="target">H.O.D</label>
                                        <input type="text" name="hods" class="form-control" id="hod_name" value="" disabled>
                                        <input type="hidden" name="request_id" class="form-control" id="request_id" value="">
                                        <select name="hod" class="form-control" required>
                                             <option  id="hod_id" value=""><small>Change</small></option>
                                             @foreach($hods as $hod)
                                             <option value="{{$hod->id}}">{{$hod->name}}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="target">Budget Owner</label>
                                        <input type="text" name="hods" class="form-control" id="budgeto_name" value="" disabled>
                                        <select name="budgeto" class="form-control" required>
                                             <option  id="budgeto_id" value=""><small>Change</small></option>
                                             @foreach($hods as $b_owner)
                                             <option value="{{$b_owner->id}}">{{$b_owner->name}}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="target">Amount Requested</label>
                                        <input type="number" name="amount" class="form-control" id="amount" value="" required>
                                        <input type="hidden" name="department" value="{{ Auth::user()->department_id}}" id="target" placeholder="Enter Amount" maxlength="4" required>
                                        <input type="hidden" name="userid" value="{{ Auth::user()->id }}" id="target" placeholder="Enter Amount" maxlength="4" required>
                                        <input type="hidden" name="process_status" value="20" id="target" placeholder="Enter Amount" maxlength="4" required>
                                        <input type="hidden" name="token_id" value="{{$requestTocken}}" id="target" placeholder="Enter Amount" maxlength="4" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="goal">Description of Need</label>
                                        <textarea class="form-control" name="description" id="description" rows="3" value=""></textarea>
                                    </div>
                                    
                                </div>
                               <!-- /.card-body -->
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel Request</button>
                                    <button type="submit" class="btn btn-primary button"><i class="adding fa fa-plus-square"></i><i class="loading-icon fa fa-spinner fa-spin hide"></i>&nbsp;<span class="btn-txt">&nbsp;&nbsp;Update</span></button>
                                </div>
                        </form>
                </div>
            </div>   <!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->