@extends('admin.admin_master')
 @section('admin')

 <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>

 <div class="content-wrapper" style="min-height: 314px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Add User Page</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="http://127.0.0.1:8000/dashboard"><i class="mdi mdi-home-outline"></i></a></li>
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

                  <form novalidate="" action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   <div class="row">
                      <div class="col-12 col-md-6">
                        <div class="form-group">
                            <h5>User Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name" value="{{ $profileedit->name }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                <div class="help-block"></div>
                            </div>
                        </div>
                      </div>

                      <div class="col-12 col-md-6">
                          <div class="form-group">
                              <h5>User Email <span class="text-danger">*</span></h5>
                              <div class="controls">
                                  <input type="email" name="email" class="form-control" value="{{ $profileedit->email }}" required="" data-validation-required-message="This field is required"> 
                                  <div class="help-block"></div></div>
                          </div>
                      </div>

                      <div class="col-12 col-md-6">
                        <div class="form-group">
                            <h5>Address <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="address" value="{{ $profileedit->address }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                <div class="help-block"></div></div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <h5>Mobile <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="mobile" value="{{ $profileedit->mobile }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                <div class="help-block"></div></div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">	
                        <div class="form-group">
                            <h5>Select Your Gender <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="gender" id="gender" required="" class="form-control">
                                    <option value="">Select Your Gender</option>
                                    <option value="Female" {{ $profileedit->gender == "Female" ? "selected" : ""}}>Female</option>
                                    <option value="male" {{ $profileedit->gender == "Female" ? "selected" : ""}}>Male</option>
                                </select>
                            <div class="help-block"></div></div>
                        </div>
                      </div>

                      <div class="col-12 col-md-6">	
                        <div class="form-group">
                            <h5>Choose Your Image <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <div class="form-group row">
                                    <div class="col-lg-10">
                                        <input type="file" id="image" name="image" class="form-control" style="margin-bottom: 20px;">
                                    </div>

                                    <img src="{{ (!empty($profileedit->image)) ? url('upload/user_image/'.$profileedit->image) : url('upload/no-image.jpg') }}" id="showimage" class="img-fluid" alt="profile-image" style="width: 100px!important;margin-left:20px" />
                                </div>
                            <div class="help-block"></div></div>
                        </div>
                      </div>

                      <div class="col-12 col-md-6">	
                        <div class="form-group">
                            <div class="controls">
                              
                            <div class="help-block"></div></div>
                        </div>
                      </div>

                      <div class="col-12">
                        
                      <div class="text-xs-right">
                        <input type="submit" value="Update Profile" class="btn btn-info btn-rounded">
                    </div>
                      </div>
                  


              </div></form>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div></section>
      <!-- /.content -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();

            reader.onload = function(e){
                $('#showimage').attr('src',e.target.result);
            }

            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

 @endsection