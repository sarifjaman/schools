@extends('admin.admin_master')
 @section('admin')

 <div class="content-wrapper" style="min-height: 1189.55px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Add User Page</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Manage Users</li>
                              <li class="breadcrumb-item active" aria-current="page">Add User</li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>	  

      <!-- Main content -->
      <section class="content">

       <!-- Basic Forms -->
        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Add User</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">

                  <form novalidate="" action="{{ route('update.user',$edituser->id) }}" method="POST">
                    @csrf
                    <div class="row">

                      <div class="col-12 col-md-6">	
                        <div class="form-group">
                            <h5>User Role <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="role"  required="" class="form-control">
                                    <option value="">Select Your Rank</option>
                                    <option value="Admin" {{ ($edituser->role == "Admin" ? "selected" : "") }} >Admin</option>
                                    <option value="Operator"  {{ ($edituser->role == "Operator" ? "selected" : "") }}  >Operator</option>
                                </select>
                            <div class="help-block"></div></div>
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="form-group">
                            <h5>User Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name" value="{{ $edituser->name }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                <div class="help-block"></div>
                            </div>
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                          <div class="form-group">
                              <h5>User Email <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <input type="email" name="email" value="{{ $edituser->email}}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                  <div class="help-block"></div></div>
                          </div>
                      </div>

                      <div class="col-12">
                        
                      <div class="text-xs-right">
                        <input type="submit" value="Update" class="btn btn-info btn-rounded" />
                    </div>
                      </div>
                  </form>


              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>
</div>


    <!-- Basic Forms -->

     <!-- /.box -->

 @endsection