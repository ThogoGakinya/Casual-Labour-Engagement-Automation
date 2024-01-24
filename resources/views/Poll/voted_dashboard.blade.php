@extends('layouts.poll_layout')
    @section('content')
  <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Dashboard @if($polluser->level == 1)<a class="btn btn-success btn-xs" href="{{url('/admin/poll/'.$polluser->id)}}"><i class="fa fa-user"></i> Admin</a> <a class="btn btn-primary btn-xs" href="{{url('/admin/awards/'.$polluser->id)}}"><i class="fa fa-user"></i> Awards</a> <a class="btn btn-primary btn-xs" href="{{url('/admin/permissions/'.$polluser->id)}}"><i class="fa fa-key"></i> Roles</a>@endif</h5>
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
        <div class="row justify-content-center align-items-round">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title m-0">Select Nominee</h5>
              </div>
              
              <div class="card-body">
                <div class="row justify-content-center align-items-round">
                    <div class="col-md-12">
                        <h3><a href="#"><img src="{{asset('dist/img/voted_2.png')}}" width="25%" alt="Loader">
                        THANK YOU FOR NOMINATING</a><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        {{$nominated->name}}</h3>
                        <hr/>
                        <div class="row">
                      
                          @foreach($selectedvalues as $core)
                          <div class="col-md-4">
                  <i class="fa fa-check-circle"></i> {{$core->corevalue->name}}
                          </div>
                          @endforeach
               
                </div>
                <hr/>
                <div class="card-body">
                <div class="form-group">
                    <strong>YOUR STORY :</strong><br/>
                        <i>{{$checker->story}}</i>
                      </div>
                    
              </div>
                    </div>
                    <a class="btn btn-default" href="{{url('/poll')}}"><i class="fas fa-sign-out-alt"></i>Logout</i></a>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div><br/>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</form>
    </div>
    <!-- /.content -->
 @endsection