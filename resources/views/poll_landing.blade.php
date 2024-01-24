@extends('layouts.poll_landing_layout')
    @section('content')
      <!-- Main content -->
    <div class="content">
      <div class="container-fluid winbox-white">
        <div class="row justify-content-center align-items-round">
            
            
            <div class="col-md-3">
               <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                       <div class="carousel-item active">
                      <img class="d-block w-100" src="{{ asset('dist/img/esther.png')}}" alt="First slide"  height="30%">
                      <p style="background:#192953; padding-left: 5px"><small style="color:white;"><i>Admin Star of the year 2021 - Esther Murugi</i></small><p>
                    </div>
                      @foreach($topleft as $tleft)
                    <div class="carousel-item">
                      <img class="d-block w-100" src="{{ asset('centralroot/public/Documents/'.$tleft->image_url)}}" height="30%" alt="First slide">
                      <p style="background:#192953; padding-left: 5px"><small style="color:white;"><i>{{$tleft->caption}}</i></small><p>
                    </div>
                    @endforeach
                  </div>
                  
                  
                  <!--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">-->
                  <!--  <span class="carousel-control-custom-icon" aria-hidden="true">-->
                  <!--    <i class="fas fa-chevron-left"></i>-->
                  <!--  </span>-->
                  <!--  <span class="sr-only">Previous</span>-->
                  <!--</a>-->
                  <!--<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">-->
                  <!--  <span class="carousel-control-custom-icon" aria-hidden="true">-->
                  <!--    <i class="fas fa-chevron-right"></i>-->
                  <!--  </span>-->
                  <!--  <span class="sr-only">Next</span>-->
                  <!--</a>-->
                </div>
           
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="{{ asset('dist/img/prudence.png')}}" alt="First slide"  height="30%">
                     <p style="background:#192953; padding-left: 5px"><small style="color:white;"><i>Prudence Mutua - Human Resources</i></small><p>
                    </div>
                     @foreach($bottomleft as $bleft)
                    <div class="carousel-item">
                      <img class="d-block w-100" src="{{ asset('centralroot/public/Documents/'.$bleft->image_url)}}" height="50%" alt="First slide">
                      <p style="background:#192953;padding-left: 5px"><small style="color:white;"><i>{{$bleft->caption}}</i></small><p>
                    </div>
                    @endforeach
                  </div>
                  <!--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">-->
                  <!--  <span class="carousel-control-custom-icon" aria-hidden="true">-->
                  <!--    <i class="fas fa-chevron-left"></i>-->
                  <!--  </span>-->
                  <!--  <span class="sr-only">Previous</span>-->
                  <!--</a>-->
                  <!--<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">-->
                  <!--  <span class="carousel-control-custom-icon" aria-hidden="true">-->
                  <!--    <i class="fas fa-chevron-right"></i>-->
                  <!--  </span>-->
                  <!--  <span class="sr-only">Next</span>-->
                  <!--</a>-->
                </div>
            </div>
            
            
            
          <div class="col-md-6">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="{{ asset('dist/img/raj_bains.png')}}" alt="First slide">
                       <p style="background:#192953; color:white; padding: 14px;"><i>The C.E.O Mr Raj Bains</i><p>
                    </div>
                     @foreach($centers as $center)
                    <div class="carousel-item">
                      <img class="d-block w-100" src="{{ asset('centralroot/public/Documents/'.$center->image_url)}}" alt="First slide">
                      <p style="background:#192953; color:white; padding: 14px"><small style="color:white;"><i>{{$center->caption}}</i></small><p>
                    </div>
                    @endforeach
                     
                    <!--<div class="carousel-item">-->
                    <!--   <img class="d-block w-100" src="{{ asset('dist/img/team.png')}}" alt="First slide">-->
                    <!--</div>-->
                    <!--<div class="carousel-item">-->
                    <!--   <img class="d-block w-100" src="{{ asset('dist/img/miraj.png')}}" alt="First slide">-->
                    <!--</div>-->
                    <!--<div class="carousel-item">-->
                    <!--   <img class="d-block w-100" src="{{ asset('dist/img/mirajaddress.png')}}" alt="First slide">-->
                    <!--</div>-->
                    <!--<div class="carousel-item">-->
                    <!--   <img class="d-block w-100" src="{{ asset('dist/img/jane.png')}}" alt="First slide">-->
                    <!--</div>-->
                    <!--<div class="carousel-item">-->
                    <!--   <img class="d-block w-100" src="{{ asset('dist/img/vignesh.png')}}" alt="First slide">-->
                    <!--</div>-->
                    <!--<div class="carousel-item">-->
                    <!--   <img class="d-block w-100" src="{{ asset('dist/img/alice.png')}}" alt="First slide">-->
                    <!--</div>-->
                  </div>
                  <!--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">-->
                  <!--  <span class="carousel-control-custom-icon" aria-hidden="true">-->
                  <!--    <i class="fas fa-chevron-left"></i>-->
                  <!--  </span>-->
                  <!--  <span class="sr-only">Previous</span>-->
                  <!--</a>-->
                  <!--<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">-->
                  <!--  <span class="carousel-control-custom-icon" aria-hidden="true">-->
                  <!--    <i class="fas fa-chevron-right"></i>-->
                  <!--  </span>-->
                  <!--  <span class="sr-only">Next</span>-->
                  <!--</a>-->
                </div>
                <!--<img src="{{asset('dist/img/hall.jpg')}}" height="10%" width="100%" alt="Kim-Fay Logo">-->
                </div><!-- /.col-md-12 -->
                <div class="col-md-3">
               <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <!--<ol class="carousel-indicators">-->
                  <!--  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>-->
                  <!--  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>-->
                  <!--  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>-->
                  <!--</ol>-->
                  <div class="carousel-inner">
                            <div class="carousel-item active">
                      <img class="d-block w-100" src="{{ asset('dist/img/esther.png')}}" alt="First slide">
                      <p style="background:#192953; padding-left: 5px"><small style="color:white;"><i>Admin Star of the year 2021 - Esther Murugi</i></small><p>
                    </div>
                      @foreach($topright as $tright)
                    <div class="carousel-item">
                      <img class="d-block w-100" src="{{ asset('centralroot/public/Documents/'.$tright->image_url)}}" height="50%" alt="First slide">
                      <p style="background:#192953; padding-left: 5px"><small style="color:white;"><i>{{$tright->caption}}</i></small><p>
                    </div>
                    @endforeach
                    <!--<div class="carousel-item active">-->
                    <!--  <img class="d-block w-100" src="{{ asset('dist/img/vigy.png')}}" alt="First slide">-->
                       <!--<img src="{{ asset('dist/img/Kim-Fay awards logo-01.png')}}" height="80%" width="80%" alt="Kim-Fay Logo">-->
                    <!--</div>-->
                    <!--<div class="carousel-item">-->
                    <!--  <img class="d-block w-100" src="{{ asset('dist/img/production.png')}}" alt="First slide">-->
                    <!--</div>-->
                    <!--<div class="carousel-item">-->
                    <!--  <img class="d-block w-100" src="{{ asset('dist/img/selina.png')}}" alt="First slide">-->
                    <!--</div>-->
                    
                  </div>
                  <!--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">-->
                  <!--  <span class="carousel-control-custom-icon" aria-hidden="true">-->
                  <!--    <i class="fas fa-chevron-left"></i>-->
                  <!--  </span>-->
                  <!--  <span class="sr-only">Previous</span>-->
                  <!--</a>-->
                  <!--<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">-->
                  <!--  <span class="carousel-control-custom-icon" aria-hidden="true">-->
                  <!--    <i class="fas fa-chevron-right"></i>-->
                  <!--  </span>-->
                  <!--  <span class="sr-only">Next</span>-->
                  <!--</a>-->
                </div>
              
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <!--<ol class="carousel-indicators">-->
                  <!--  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>-->
                  <!--  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>-->
                  <!--  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>-->
                  <!--</ol>-->
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="{{ asset('dist/img/carol.png')}}" alt="First slide">
                       <p style="background:#192953; padding-left: 5px"><small style="color:white;"><i>Caroline Jane - HR Strar 2022</i></small><p>
                    </div>
                     @foreach($bottomright as $bright)
                    <div class="carousel-item">
                      <img class="d-block w-100" src="{{ asset('centralroot/public/Documents/'.$bright->image_url)}}" alt="First slide">
                      <p style="background:#192953; padding-left: 5px"><small style="color:white;"><i>{{$bright->caption}}</i></small><p>
                    </div>
                    @endforeach
                   <!-- <div class="carousel-item">-->
                   <!--   <img class="d-block w-100" src="{{ asset('dist/img/shadrack.png')}}" alt="First slide">-->
                   <!-- </div>-->
                   <!--<div class="carousel-item">-->
                   <!--   <img class="d-block w-100" src="{{ asset('dist/img/risper.png')}}" alt="First slide">-->
                   <!-- </div>-->
                  </div>
                  <!--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">-->
                  <!--  <span class="carousel-control-custom-icon" aria-hidden="true">-->
                  <!--    <i class="fas fa-chevron-left"></i>-->
                  <!--  </span>-->
                  <!--  <span class="sr-only">Previous</span>-->
                  <!--</a>-->
                  <!--<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">-->
                  <!--  <span class="carousel-control-custom-icon" aria-hidden="true">-->
                  <!--    <i class="fas fa-chevron-right"></i>-->
                  <!--  </span>-->
                  <!--  <span class="sr-only">Next</span>-->
                  <!--</a>-->
                </div>
            </div>
        </div><!-- /.row -->
        
        
        </br>
          <div class="row">
              <div class="col-md-12">
                  <img src="{{asset('dist/img/wall_of_fame.png')}}" height="70%" width="100%" alt="Kim-Fay Logo">
              </div>
           </div>
        <div class="row">
            <div class="col-md-12">
            <div class="card card-primary card-outline card-outline-tabs">
<div class="card-header p-0 border-bottom-0">
<ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist" align="center">
<li class="nav-item">
<a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><button type="button" class="btn btn-block btn-primary btn-xs">2023</button></a>
</li>
<li class="nav-item">
<a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"><button type="button" class="btn btn-block btn-primary btn-xs">2022</button></a>
</li>
</ul>
</div>
<div class="card-body">
<div class="tab-content" id="custom-tabs-four-tabContent">
<div class="tab-pane fade show active row" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
    
    <div class="row">
        @foreach($nominees_twentytwo as $twentytwo)
            <div class="col-md-2">
                <div class="card" data-toggle="modal" data-target="#view_{{$twentytwo->id}}">
                      <img src="{{ asset('centralroot/public/Documents/'.$twentytwo->img_url)}}" height="10%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
                      <div class="card-body">
                        <a href="">{{strtoupper($twentytwo->user->name)}}</a>
                        <h6>{{$twentytwo->reward->name}}</h6>
                        <h6>{{$twentytwo->year}}</h6>
                        <button type="button" data-toggle="modal" data-target="#view_{{$twentytwo->id}}" class="btn btn-block btn-outline-primary btn-xs">View</button>
                        
                      </div>
                </div>
            </div>
<div class="modal fade" id="view_{{$twentytwo->id}}">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">{{strtoupper($twentytwo->user->name)}} - {{$twentytwo->reward->name}} - {{$twentytwo->year}} </h4><br/>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
    <img src="{{ asset('centralroot/public/Documents/'.$twentytwo->img_url)}}" height="100%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
    </br></br>
<p>{{$twentytwo->justification}}</p>
</div>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>
</div>

</div>

</div>
        @endforeach
        
        
        </div>
</div>
<div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
    
        <div class="row">
        @foreach($nominees_twentyone as $twentyone)
            <div class="col-md-2">
                <div class="card" data-toggle="modal" data-target="#view_{{$twentyone->id}}">
                      <img src="{{ asset('centralroot/public/Documents/'.$twentyone->img_url)}}" height="100%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
                      <div class="card-body">
                        <h5>{{strtoupper($twentyone->user->name)}}</h5>
                        <h6>{{$twentyone->reward->name}}</h6>
                        <h6>{{$twentyone->year}}</h6>
                        <button type="button" data-toggle="modal" data-target="#view_{{$twentyone->id}}" class="btn btn-block btn-outline-primary btn-xs">View</button>
                        
                      </div>
                </div>
            </div>
<div class="modal fade" id="view_{{$twentyone->id}}">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">{{strtoupper($twentyone->user->name)}} - {{$twentyone->reward->name}} - {{$twentyone->year}} </h4><br/>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
    <img src="{{ asset('centralroot/public/Documents/'.$twentyone->img_url)}}" height="100%" width="100%" alt="Kim-Fay Logo" style="border-radius: 3%">
    </br></br>
<p>{{$twentyone->justification}}</p>
</div>
<div class="modal-footer justify-content-between">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

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
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->
 @endsection