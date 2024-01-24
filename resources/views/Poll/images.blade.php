@extends('layouts.poll_layout')
    @section('content')
  <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Dashboard <a class="btn btn-success btn-xs" href="{{url('/admin/poll/'.$polluser->id)}}"><i class="fa fa-user"></i> Admin</a> <button class="btn btn-success btn-xs" data-target="#add-image" data-toggle="modal"><i class="fa fa-plus"></i> Add Image</button></h5>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid winbox-white">
          <h4>MANAGE SLIDER IMAGES</h4>
        <div class="row justify-content-center align-items-round">
                 <div class="row">
                     
                    <div class="col-md-12">
                         <div class="card card-primary collapsed-card">
                             <div class="card-header">
                                 <h3 class="card-title">Top Right</h3>
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                 </button>
                                </div>
                             </div>
                    
                             <div class="card-body">
                                <div class="row">
                              @foreach($topright as $tright)
                              
                                        <div class="col-md-2">
                                            <div class="card" data-toggle="modal" data-target="#view_{{$tright->id}}">
                                                  <img src="{{ asset('centralroot/public/Documents/'.$tright->image_url)}}" height="100%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
                                                  <div class="card-body">
                                                    <h6>{{$tright->caption}}</h6>
                                                   
                                                    <button type="button" data-toggle="modal" data-target="#view_{{$tright->id}}" class="btn btn-block btn-outline-primary btn-xs">Delete / Update</button>
                                                    
                                                  </div>
                                            </div>
                                        </div>
                            <div class="modal fade" id="view_{{$tright->id}}">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title"></h4><br/>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form method="post"  name="frm" class="form-horizontal" action="{{route('edit_image')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input name="image_id" value={{$tright->id}} type="hidden">
                               
                            <div class="modal-body">
                                <img src="{{ asset('centralroot/public/Documents/'.$tright->image_url)}}" height="100%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
                                </br></br>
                            <textarea name="caption" class="form-control">{{$tright->caption}}</textarea>
                            </div>
                            <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                             <a type="submit" href="{{ url('images/delete/'.$tright->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            </form>
                            </div>
                            </div>
                            
                            </div>
                            
                            </div>
                            @endforeach
                             </div>
                             </div>
                         </div>
                    </div>
                    <div class="col-md-12">
                         <div class="card card-primary collapsed-card">
                             <div class="card-header">
                                 <h3 class="card-title">Top Left</h3>
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                 </button>
                                </div>
                             </div>
                    
                             <div class="card-body">
                                 <div class="row">
                              @foreach($topleft as $tright)
                                        <div class="col-md-2">
                                            <div class="card" data-toggle="modal" data-target="#view_{{$tright->id}}">
                                                  <img src="{{ asset('centralroot/public/Documents/'.$tright->image_url)}}" height="100%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
                                                  <div class="card-body">
                                                    <h6>{{$tright->caption}}</h6>
                                                   
                                                    <button type="button" data-toggle="modal" data-target="#view_{{$tright->id}}" class="btn btn-block btn-outline-primary btn-xs">Delete / Update</button>
                                                    
                                                  </div>
                                            </div>
                                        </div>
                            <div class="modal fade" id="view_{{$tright->id}}">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title"></h4><br/>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form method="post"  name="frm" class="form-horizontal" action="{{route('edit_image')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input name="image_id" value={{$tright->id}} type="hidden">
                                <img src="{{ asset('centralroot/public/Documents/'.$tright->image_url)}}" height="100%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
                                </br></br>
                            <textarea name="caption" class="form-control">{{$tright->caption}}</textarea>
                            </div>
                            <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                             <a type="submit" href="{{ url('images/delete/'.$tright->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            </form>
                            </div>
                            </div>
                            
                            </div>
                            
                            </div>
                            @endforeach
                            </div>
                             </div>
                         </div>
                    </div>
                    <div class="col-md-12">
                         <div class="card card-primary collapsed-card">
                             <div class="card-header">
                                 <h3 class="card-title">Center</h3>
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                 </button>
                                </div>
                             </div>
                    
                             <div class="card-body">
                                                              <div class="row">
                              @foreach($centers as $center)
                                        <div class="col-md-2">
                                            <div class="card" data-toggle="modal" data-target="#view_{{$center->id}}">
                                                  <img src="{{ asset('centralroot/public/Documents/'.$center->image_url)}}" height="100%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
                                                  <div class="card-body">
                                                    <h6>{{$center->caption}}</h6>
                                                   
                                                    <button type="button" data-toggle="modal" data-target="#view_{{$center->id}}" class="btn btn-block btn-outline-primary btn-xs">Delete/Update</button>
                                                    
                                                  </div>
                                            </div>
                                        </div>
                            <div class="modal fade" id="view_{{$center->id}}">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title"></h4><br/>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form method="post"  name="frm" class="form-horizontal" action="{{route('edit_image')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input name="image_id" value={{$center->id}} type="hidden">
                                <img src="{{ asset('centralroot/public/Documents/'.$center->image_url)}}" height="100%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
                                </br></br>
                            <textarea name="caption" class="form-control">{{$tright->caption}}</textarea>
                            </div>
                            <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                             <a type="submit" href="{{ url('images/delete/'.$tright->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            </form>
                            </div>
                            </div>
                            
                            </div>
                            
                            </div>
                            @endforeach
                            </div>
                             </div>
                         </div>
                    </div>
                    <div class="col-md-12">
                         <div class="card card-primary collapsed-card">
                             <div class="card-header">
                                 <h3 class="card-title">Bottom Left</h3>
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                 </button>
                                </div>
                             </div>
                    
                             <div class="card-body">
                             <div class="row">
                              @foreach($bottomleft as $tright)
                                        <div class="col-md-2">
                                            <div class="card" data-toggle="modal" data-target="#view_{{$tright->id}}">
                                                  <img src="{{ asset('centralroot/public/Documents/'.$tright->image_url)}}" height="100%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
                                                  <div class="card-body">
                                                    <h6>{{$tright->caption}}</h6>
                                                   
                                                    <button type="button" data-toggle="modal" data-target="#view_{{$tright->id}}" class="btn btn-block btn-outline-primary btn-xs">Delete/Update</button>
                                                    
                                                  </div>
                                            </div>
                                        </div>
                            <div class="modal fade" id="view_{{$tright->id}}">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title"></h4><br/>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form method="post"  name="frm" class="form-horizontal" action="{{route('edit_image')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input name="image_id" value={{$tright->id}} type="hidden">
                                <img src="{{ asset('centralroot/public/Documents/'.$tright->image_url)}}" height="100%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
                                </br></br>
                            <textarea name="caption" class="form-control">{{$tright->caption}}</textarea>
                            </div>
                            <div class="modal-footer justify-content-between">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                             <a type="submit" href="{{ url('images/delete/'.$tright->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            </form>
                            </div>
                            </div>
                            
                            </div>
                            
                            </div>
                            @endforeach
                            </div>
                             </div>
                         </div>
                    </div>
                    <div class="col-md-12">
                         <div class="card card-primary collapsed-card">
                             <div class="card-header">
                                 <h3 class="card-title">Bottom Right</h3>
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                 </button>
                                </div>
                             </div>
                    
                             <div class="card-body">
                             <div class="row">
                              @foreach($bottomright as $tright)
                                        <div class="col-md-2">
                                            <div class="card" data-toggle="modal" data-target="#view_{{$tright->id}}">
                                                  <img src="{{ asset('centralroot/public/Documents/'.$tright->image_url)}}" height="100%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
                                                  <div class="card-body">
                                                    <h6>{{$tright->caption}}</h6>
                                                   
                                                    <button type="button" data-toggle="modal" data-target="#view_{{$tright->id}}" class="btn btn-block btn-outline-primary btn-xs">Delete/Update</button>
                                                    
                                                  </div>
                                            </div>
                                        </div>
                            <div class="modal fade" id="view_{{$tright->id}}">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title"></h4><br/>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <form method="post"  name="frm" class="form-horizontal" action="{{route('edit_image')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input name="image_id" value={{$tright->id}} type="hidden">
                                <img src="{{ asset('centralroot/public/Documents/'.$tright->image_url)}}" height="100%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
                                </br></br>
                            <textarea name="caption" class="form-control">{{$tright->caption}}</textarea>
                            </div>
                            <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                             <a type="submit" href="{{ url('images/delete/'.$tright->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            </form>
                            </div>
                            </div>
                            
                            </div>
                            
                            </div>
                            @endforeach
                            </div>
                             </div>
                         </div>
                    </div>
                    
                   
                </div>
          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <div class="modal fade" id="add-image">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Add Image</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="post"  name="frm" class="form-horizontal" action="{{route('add_image')}}" enctype="multipart/form-data">
    {{ csrf_field() }}

<div class="form-group">
<label for="exampleInputPassword1">Position</label>
<select class="form-control" name="location" required>
    <option value="">Select Position</option>
    <option value="1">Top Right</option> 
    <option value="2">Top Left</option> 
     <option value="3">Botton Right</option>
     <option value="4">Bottom Left</option> 
     <option value="5">Center</option> 

</select>
</div>

<div class="form-group">
<label for="image">Picture</label>
 <input type="file" id="image" name="image" class="form-control">
</div>
<div class="form-group">
<label for="image">Caption</label>
 <textarea name="caption" class="form-control"></textarea>
</div>

</div>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save</button>
</div>
</div>
</form>
</div>

</div>
 @endsection