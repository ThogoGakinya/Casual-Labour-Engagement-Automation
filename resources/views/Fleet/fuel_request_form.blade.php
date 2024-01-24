<div class="modal fade" id="add-request">
          <div class="modal-dialog">
            <div class="modal-content">
 
              <form method="post" action="{{ url('/place_request')}} ">
              @php 
                $requestTocken = rand(100000,999999);
              @endphp
                <div class="modal-body">
                              {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="target">Previous Mileage</label>
                                        <input type="number" name="previous_mileage" id="previous_mileage" class="form-control" value="{{$myvehicle->current_milage}}" readonly>
                                        <input type="hidden" name="token_id" class="form-control" value="{{$requestTocken}}" readonly>
                                        <input type="hidden" name="vehicle_id" class="form-control" value="{{$myvehicle->id }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="target">Previous Diesel Requisition</label>
                                        <input type="number" name="previous_diesel_requisition" id="previous_diesel" class="form-control" value="{{$myvehicle->previous_fuel}}" readonly>   
                                        <input type="hidden" name="previous_diesel" id="rate" class="form-control" value="{{$myvehicle->coverage_per_litre}}" readonly>            
                                    </div>
                                    <div class="form-group">
                                        <label for="target">Current Mileage</label>
                                        <input type="number" name="current_mileage" class="form-control" id="current_mileage" onkeyup="computeFuel();" required>
                                        <input type="hidden" name="difference" class="form-control" id="difference">
                                    </div>
                                    <div class="form-group">
                                        <label for="target">Current Diesel Requested</label>
                                        <input type="number" name="current_diesel_requisition" class="form-control" id="current_diesel" readonly>
                                    </div>
                                </div>
                               <!-- /.card-body -->
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary fuel-button"><i class="adding fa fa-plus-square"></i><i class="loading-icon fa fa-spinner fa-spin hide"></i>&nbsp;<span class="btn-txt">&nbsp;&nbsp;Submit</span></button>
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