@if(count($comments)>0)
<!--Start of comments tab-->
              <div>
                    <i class="fas fa-check bg-green"></i>
                    <div class="timeline-item">
                        <span class="time">Requested on :&nbsp;<i class="fas fa-clock"></i>&nbsp;{{$specific->created_at}}</span>
                        <h3 class="timeline-header"><a href="#">Internal Auditor's Comments</a>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-default btn-xs" data-commentid="{{$specific->token_id}}" data-toggle="modal" data-target="#comment"><i class="fa fa-plus"></i>&nbsp;Comment</button></h3>

                        <div class="timeline-body">
                                 @php
                                    $cnt = 1;
                                @endphp
                        <table class="customers-actions">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($comments as $comment)
                                  <tr>
                                      <td>{{$cnt}}</td>
                                      <td>{{$comment->comment}}</td>
                                      <td>
                                          <i class="fa fa-times-circle" aria-hidden="true" data-removeid="{{$comment->id}}" data-documentid="document1" data-toggle="modal" data-target="#remove" title="Remove this comment"></i>
                                      </td>
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
<!--End of comments tab--> 
<!-- Modal for commenting on a request-->
<div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Add Comments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('comment','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     @method('put')
                    <textarea class="form-control" rows="4" name="comment" placeholder="Please type comment here" required></textarea>
                    <input type="hidden" class="form-control" name="comment_id" id="comment_id" value="">
                    <input type="hidden" class="form-control" name="ia_id"  value="{{auth::user()->id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-warning button"><i class="loading-icon fa fa-spinner fa-spin hide"></i>&nbsp;<span class="btn-txt">&nbsp;&nbsp;Submit</span></button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for commenting on a request -->
@endif 