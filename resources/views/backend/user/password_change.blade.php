@extends('admin.admin_master')
 @section('admin')



 
 <div class="content-wrapper" style="min-height: 1189.55px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Change Password Page</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Manage Users</li>
                              <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
            <h4 class="box-title">Change Password</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">

                <form novalidate="" action="{{ route('update.password') }}" method="POST">
                    @csrf
                     <div class="row">
                
                         <div class="col-12 col-md-6">
                           <div class="form-group">
                               <h5>Current Password <span class="text-danger">*</span></h5>
                               <div class="controls">
                                   <input type="password" name="oldpassword" id="oldpassword" class="form-control" data-validation-required-message="This field is required"> 
                                   <div class="help-block"></div>
                
                                   @error('oldpassword')
                                      <span class="text-danger">{{ $message }}</span>
                                   @enderror   
                               </div>
                           </div>
                         </div>
                
                         <div class="col-12 col-md-6">
                             <div class="form-group">
                                 <h5>New Password <span class="text-danger">*</span></h5>
                                 <div class="controls">
                                     <input type="password" name="password" id="password" class="form-control" data-validation-required-message="This field is required"> 
                                     <div class="help-block"></div></div>
                
                                     @error('password') 
                                       <span class="text-danger">{{ $message }}</span>
                                     @enderror
                             </div>
                         </div>
                
                         <div class="col-12 col-md-6">
                             <div class="form-group">
                                 <h5>Password <span class="text-danger">*</span></h5>
                                 <div class="controls">
                                     <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"  data-validation-required-message="This field is required"> <div class="help-block"></div></div>

                                     @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                     @enderror
                             </div>
                         </div>
                
                         <div class="col-12">
                           
                         <div class="text-xs-right">
                           <input type="submit" value="Change Password" class="btn btn-info btn-rounded">
                       </div>
                         </div>
                     
                
                
                 </div></form>


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

 @endsection