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
                    <input type="hidden" class="form-control" name="book_id" id="book_id" value="">
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
<!-- Modal for removing comment-->
<div class="modal fade" id="remove_comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Remove Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('remove_comment','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{method_field('delete')}}
                   Are you sure you want to remove this Comment?
                    <input type="hidden" class="form-control" name="comment_id" id="comment_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Not Now</button>
                <button type="submit" class="btn btn-warning">Remove</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for removing attachment-->