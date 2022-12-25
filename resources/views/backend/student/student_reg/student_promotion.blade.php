@extends('admin.admin_master')
 @section('admin')

 <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>

 <div class="content-wrapper" style="min-height: 248px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Student Promotion Page</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Student Promotion</li>
                              
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
            <h4 class="box-title">Student Promotion</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">

                  <form novalidate="" action="{{ route('student.promotion.update',$editdata->student_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $editdata->id }}">

                   <div class="row">

                      <div class="col-12 col-md-12">
                        
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Student Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" value="{{ $editdata['student']['name'] }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                                                            </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Father Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="fathername" value="{{ $editdata['student']['fathername'] }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                                                            </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Mother Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mothername" value="{{ $editdata['student']['mothername'] }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                                                            </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Mobile Number <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mobile" value="{{ $editdata['student']['mobile'] }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                                                            </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Address <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="address" value="{{ $editdata['student']['address'] }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                                                            </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Select Gender <span class="text-danger">*</span></h5>
    
                                    <div class="controls">
                                        <select name="gender"  required="" class="form-control">
                                            <option value="">Select Gender Name</option>
                                            
                                            <option value="Female" {{ ($editdata['student']['gender'] == 'Female') ? 'selected' : "" }}>Female</option>
                                            <option value="Male" {{ ($editdata['student']['gender'] == "Male") ? "selected" : "" }}>Male</option>
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
                                            
                                        <option value="Muslim" {{ ($editdata['student']['religion'] == "Muslim") ? "selected" : "" }}>Muslim</option>
                                        <option value="Hindu" {{ ($editdata['student']['religion'] == "Hindu") ? "selected" : "" }}>Hindu</option>
                                        <option value="Buddho" {{ ($editdata['student']['religion'] == "Buddho") ? "selected" : ""  }}>Buddho</option>
                                        <option value="Kristan" {{ ($editdata['student']['religion'] == "Kristan") ? "selected" : "" }}>Kristan</option>
                                           
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Date of Birth <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="dob" id="dob" value="{{ (!is_null($editdata['student']['dob']))  ? $editdata['student']['dob'] : ''}}" class="form-control" required=""> 
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Discount <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="discount" value="{{ $editdata['discount']['discount'] }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                                                            </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Select Year <span class="text-danger">*</span></h5>
    
                                    <div class="controls">
                                        <select name="year_id" required="" class="form-control">
                                            <option value="">Select Year Name</option>
                                            
                                            @foreach($years as $year)
                                              <option value="{{ $year->id }}" {{ ($editdata->year_id == $year->id) ? "selected" : "" }}>{{ $year->name }}</option>
                                            @endforeach
                                                                                   
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Select Class <span class="text-danger">*</span></h5>
    
                                    <div class="controls">
                                        <select name="class_id" required="" class="form-control">
                                            <option value="">Select Class Name</option>
                                            
                                            @foreach($classes as $class)
                                               <option value="{{ $class->id }}" {{ ($editdata->class_id == $class->id) ? "selected" : "" }}>{{ $class->name }}</option>
                                            @endforeach
                                         

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Select Group <span class="text-danger">*</span></h5>
    
                                    <div class="controls">
                                        <select name="group_id" required="" class="form-control">
                                            <option value="">Select Group Name</option>
                                            
                                            @foreach($groups as $group)
                                            <option value="{{ $group->id }}" {{ ($editdata->group_id == $group->id) ? "selected" : "" }}>{{$group->name }}</option>
                                            @endforeach
                                                                                   
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Select Shift <span class="text-danger">*</span></h5>
    
                                    <div class="controls">
                                        <select name="shift_id" required="" class="form-control">
                                            <option value="">Select Shift Name</option>
                                            
                                            @foreach($shifts as $shift)
                                            <option value="{{ $shift->id }}" {{ ($editdata->shift_id == $shift->id) ? "selected" : "" }}>{{ $shift->name }}</option>
                                            @endforeach
                                                                                       
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Select Image <span class="text-danger">*</span></h5>

                                    <div class="controls">
                                        <input type="file" id="image" name="image" class="form-control" style="margin-bottom: 20px;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <img id="showImage" src="{{ (!empty($editdata['student']['image'])) ? url('upload/student/'.$editdata['student']['image']) : url('upload/no-image.jpg') }}" class="img-fluid" alt="student-image" style="width: 85px;" />
                                </div>
                            </div>

                        </div>

                      </div>

                     

                      <div class="col-12">
                        
                      <div class="text-xs-right">
                        <input type="submit" value="Student Update" class="btn btn-info btn-rounded">
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
             $('#showImage').attr('src',e.target.result);
         }

         reader.readAsDataURL(e.target.files['0']);
     });
     $('#dob').trigger('change');
 });
 </script>

 @endsection