@if(count($comments)>0)
<!--Start of comments tab-->
              <div>
                    <i class="fas fa-check bg-green"></i>
                    <div class="timeline-item">
                        <span class="time">Commented on :&nbsp;<i class="fas fa-clock"></i>&nbsp;{{$specific->created_at}}</span>
                        <h3 class="timeline-header"><a href="#">Internal Auditor's Comments</a>&nbsp;&nbsp;&nbsp;&nbsp;
                        @if(auth::user()->level == 6)
                          <button class="btn btn-default btn-xs" data-commentid="{{$specific->token_id}}" data-bookid="{{$specific->voucher_id}}" data-toggle="modal" data-target="#comment"><i class="fa fa-plus"></i>&nbsp;Comment</button>
                        @endif
                          </h3>

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
                                          <i class="fa fa-times-circle" aria-hidden="true" data-commentid="{{$comment->id}}"  data-toggle="modal" data-target="#remove_comment" title="Remove this comment"></i>
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
@endif 