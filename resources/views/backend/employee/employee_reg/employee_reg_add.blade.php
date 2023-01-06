@extends('admin.admin_master')
 @section('admin')

 <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>

 <div class="content-wrapper" style="min-height: 1189.55px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Add Employee Page</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Add Employee</li>
                              {{-- <li class="breadcrumb-item active" aria-current="page">Add User</li> --}}
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
            <h4 class="box-title">Add Employee</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">

                  <form novalidate="" action="{{ route('employee.registration.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                      <div class="col-12 col-md-12">
                        
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Employee Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                        @error('name')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Father Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="fathername" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                        @error('fathername')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Mother Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mothername" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                        @error('mothername')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Mobile Number <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mobile" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                        @error('mobile')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Address <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="address" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                        @error('address')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Select Gender <span class="text-danger">*</span></h5>
    
                                    <div class="controls">
                                        <select name="gender" id="gender" required="" class="form-control">
                                            <option value="">Select Gender Name</option>
                                            
                                            <option value="Female">Female</option>
                                            <option value="Male">Male</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Select Religion <span class="text-danger">*</span></h5>
    
                                    <div class="controls">
                                        <select name="religion" id="religion" required="" class="form-control">
                                            <option value="">Select Religion Name</option>
                                            
                                        <option value="Muslim">Muslim</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddho">Buddho</option>
                                        <option value="Kristan">Kristan</option>
                                           
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Date of Birth <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="dob" class="form-control" required=""> 
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Designation <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                      <select name="designation_id" required="" class="form-control">
                                        <option value="">Select Your Designation</option>

                                        @foreach($designation as $desi)
                                          <option value="{{ $desi->id }}">{{ $desi->name }}</option>
                                        @endforeach

                                      </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <h5>Salary <span class="text-danger">*</span></h5>
    
                                    <div class="controls">
                                        <input type="text" name="salary" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                        @error('salary')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <h5>Join Date <span class="text-danger">*</span></h5>
    
                                    <div class="controls">
                                    <div class="controls">
                                        <input type="date" name="join_date" class="form-control" required=""> 
                                        <div class="help-block"></div>
                                    </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <h5>Select Image <span class="text-danger">*</span></h5>

                                    <div class="controls">
                                        <input type="file" id="image" name="image" class="form-control" style="margin-bottom: 20px;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <img id="showImage" src="{{ url('upload/no-image.jpg') }}" class="img-fluid" alt="student-image" style="width: 85px;" />
                                </div>
                            </div>

                        </div>

                      </div>

                     

                      <div class="col-12">
                        
                      <div class="text-xs-right">
                        <input type="submit" value="Add Employee" class="btn btn-info btn-rounded" />
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

     <script type="text/javascript">
       $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();

            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }

            reader.readAsDataURL(e.target.files['0']);
        });
    });
    </script>

 @endsection