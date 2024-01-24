@extends('layouts.staff')
    @section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5 class="m-0 text-dark">Expense Categories</h5>
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
                      <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_category"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Add New</a>
                   </div>
                   <div class="panel-body">
                   <table class="customers-actions">
                      <thead>
                      <tr>
                            <th>No.</th>
                            <th>EXPENSE NAME</th>
                            <th>BUDGET</th>
                            <th>MTD</th>
                            <th>BUDGET OWNER</th>
                            <th>BALANCE</th>
                            <th>ACTIONS</th>
                        </tr>
                      </thead>
                      @php
                          $cnt = 1;
                      @endphp
                      <tbody>
                        @foreach($categories as $category)
                        <tr>
                           <td>{{$cnt}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->budget}}</td>
                            <td>{{$category->mtd}}</td>
                            <td>{{$category->owner->name}}</td>
                            <td>{{$category->balance}}</td>
                            <td align="center">
                                <button type="button" class="btn btn-primary btn-xs" data-categoryid="{{$category->id}}"
                                                                                    data-name="{{$category->name}}"
                                                                                    data-budget="{{$category->budget}}"
                                                                                    data-mtd="{{$category->mtd}}"
                                                                                    data-bowner="{{$category->owner_id}}"
                                                                                    data-bownername="{{$category->owner->name}}"
                                                                                    data-toggle="modal" 
                                                                                    data-target="#edit_category">
                                <i class="fas fa-edit"></i>&nbsp;Edit</button>
                                <button type="button" class="btn btn-danger btn-xs" data-categoryid="{{$category->id}}"
                                                                                    data-toggle="modal" 
                                                                                    data-target="#delete_category">
                                <i class="fas fa-trash"></i>&nbsp;Delete</button>
                                <a href="{{url ('/view_category/'.$category->id)}}" class="btn btn-success btn-xs editbtn" ><i class="fa fa-eye"></i>&nbsp;&nbsp;View</a>
                            </td>
                        </tr>
                        @php
                          $cnt++;
                        @endphp
                        @endforeach
                        </tbody>
                    </table>
                   </div>
                   {{$categories->links()}}
                  </div>
                 </div>
        <!-- end of request history-->
    
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
<!-- Modal for adding category -->
<div class="modal fade" id="add_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Add Expense Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('submit_category')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-4">
                        Category Name
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="name">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Monthly Budget
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="budget">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        MTD
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="mtd">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Budget Owner
                        </div>
                        <div class="col-md-8">
                          <select class="form-control" name="b_owner" required>
                          <option id="b_owner" value="">Select budget owner</option>
                          @foreach($all_users as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                          @endforeach
                          </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for adding category -->
<!-- Modal for editing category -->
<div class="modal fade" id="edit_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Edit Expense Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="post"  class="form-horizontal" action="{{route('update_category','test')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('put')
                    <div class="row">
                        <div class="col-md-4">
                        Category Name
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="name" id="name" value="">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Monthly Budget
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="budget" id="budget" value="">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        MTD
                        </div>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="mtd" id="mtd" value="">
                          <input type="hidden" class="form-control" name="category_id" id="category_id" value="">
                        </div>
                    </div><br/>
                    <div class="row">
                        <div class="col-md-4">
                        Budget Owner
                        </div>
                        <div class="col-md-8">
                          <select class="form-control" name="b_owner" required>
                          <option id="b_owner" value=""></option>
                          @foreach($all_users as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                          @endforeach
                          </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for adding category -->


<!-- Modal for deleting category-->
<div class="modal fade" id="delete_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" align="center">Delete Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <p align="center">Are you sure you want to delete this record?</p>
                    <form method="post"  class="form-horizontal" action="{{route('delete_category','test')}}" enctype="multipart/form-data">
                    {{method_field('delete')}}
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" name="category_id" id="category_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"> No Cancel</button>
                <button type="submit" class="btn btn-danger">Yes Delete</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End of Modal for deleting category -->

@endsection