@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Expense Category</h5>
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
        <!-- End of tabs content -->

        <!-- Start of request history -->
                <div class="tab-content" style="margin-top:16px;">
                 <div class="tab-pane active" id="login_details">
                  <div class="panel panel-default">
                   <div class="panel-heading">
                  
                   <form method="post" action="{{ url('/search_category')}} ">
                   {{ csrf_field() }}
                        <div class="row">
                        <a href="{{route ('categories')}}" class="btn btn-info btn-sm" id="edit_goal"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
                            <div class="col-md-3">
                                <select name="category_id" class="form-control" required>
                                    <option value=""><small>Choose Expense Category</small></option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3" align="left">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</button>
                            </div>
                        </div>
                     </form>
                   </div>
                   <div class="panel-body">
                   <h5>{{$specific_category->name}}</h5>
                   <table class="customers-actions">
                      <thead>
                      <tr>
                            <th>Budget</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>PCV</th>
                            <th>Credit</th>
                            <th>Debit</th>
                            <th>Balance</th>
                            <th>MTD</th>
                            <th>Owner</th>
                        </tr>
                      </thead>
                      <tr>
                            <td>{{number_format($specific_category->budget, 2)}}</td>
                            <td>{{$specific_category->created_at}}</td>
                            <td>Float</td>
                            <td>B/F</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            
                      </tr>
                      @foreach($expense_history as $info)
                      <tr>
                            <td></td>
                            <td>{{$info->created_at}}</td>
                            <td>{{$info->description}}</td>
                            <td><a href="{{url ('/budget_request/'.$info->pcv)}}">{{$info->pcv}}</a></td>
                            <td>{{number_format($info->credit,2)}}</td>
                            <td>{{number_format($info->debit,2)}}</td>
                            <td>{{number_format($info->balance, 2)}}</td>
                            <td>{{number_format($info->mtd, 2)}}</td>
                            <td>{{$info->user->name}}</td>
                            
                      </tr>
                     @endforeach
                     <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            
                      </tr>
                    
                
                 </table>
                   </div>
                  
                  </div>
                 </div>
        <!-- end of request history-->
    
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

@endsection