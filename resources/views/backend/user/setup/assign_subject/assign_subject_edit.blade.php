@extends('admin.admin_master')
 @section('admin')

 <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>

 <div class="content-wrapper" style="min-height: 1189.55px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Edit Assign Subject Page</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Edit Assign Subject</li>
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
            <h4 class="box-title">Edit Assign Subject</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">

                  <form novalidate="" action="{{ route('assign.subject.update',$editdata[0]->class_id) }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-12">
                          <div class="add_form">
                            <div class="form-group">
                                <h5>Student Class <span class="text-danger">*</span></h5>

                                <div class="controls">
                                    <select name="class_id" id="class_id" required="" class="form-control">
                                        <option value="">Select Class Name</option>
                                        
                                        @foreach($classes as $class)
                                         <option value="{{ $class->id }}" {{ ($editdata['0']->class_id == $class->id) ? "selected":""}}>{{ $class->name }}</option>
                                        @endforeach
                                       
                                    </select>
                                </div>
                            </div>
                  

     @foreach($editdata as $edit)
              <div class="delete_assign_subject">
               <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <h5>Student Subject <span class="text-danger">*</span></h5>

                        <div class="controls">
                            <select name="subject_id[]" id="subject_id" required="" class="form-control">
                                <option value="">Select Subject</option>

                                @foreach($subjects as $subject)
                                  <option value="{{ $subject->id }}" {{ ($edit->subject_id == $subject->id) ? 'selected' : "" }}>{{ $subject->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>

              <div class="col-2">
                <div class="form-group">
                    <h5>Fullmark<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="fullmark[]" value="{{ $edit->fullmark }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                        <div class="help-block"></div>
                        @error('fullmark')
                         <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>
                </div>
              </div>

              <div class="col-2">
                <div class="form-group">
                    <h5>Passmark<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="passmark[]" value="{{ $edit->passmark }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                        <div class="help-block"></div>
                        @error('passmark')
                         <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>
                </div>
              </div>

              <div class="col-2">
                <div class="form-group">
                    <h5>Subjective mark<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="subjective_mark[]" value="{{ $edit->subjective_mark }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                        <div class="help-block"></div>
                        @error('subjective_mark')
                         <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>
                </div>
              </div>

              <div class="col-2">
                <span class="btn btn-primary btn-sm addclasssub" style="margin-top: 33px;"><i class="fa fa-plus-circle"></i></span>
                <span class="btn btn-danger btn-sm delclasssub" style="margin-top: 33px;"><i class="fa fa-minus-circle"></i></span>
              </div>
               </div>
              </div>
              @endforeach
                          </div>
            
                    

                      <div class="col-12">
                        
                      <div class="text-xs-right">
                        <input type="submit" value="Assign Subject Update" class="btn btn-info btn-rounded" />
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


     <div style="visibility: hidden">
        <div class="add_assign_subject" id="add_assign_subject">
          <div class="delete_assign_subject">
            <div class="form-sec">
              <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <h5>Student Subject <span class="text-danger">*</span></h5>

                        <div class="controls">
                            <select name="subject_id[]" id="subject_id" required="" class="form-control">
                                <option value="">Select Subject</option>

                                @foreach($subjects as $subject)
                                  <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>

              <div class="col-2">
                <div class="form-group">
                    <h5>Fullmark<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="fullmark[]" class="form-control" required="" data-validation-required-message="This field is required"> 
                        <div class="help-block"></div>
                        @error('fullmark')
                         <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>
                </div>
              </div>

              <div class="col-2">
                <div class="form-group">
                    <h5>Passmark<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="passmark[]" class="form-control" required="" data-validation-required-message="This field is required"> 
                        <div class="help-block"></div>
                        @error('passmark')
                         <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>
                </div>
              </div>

              <div class="col-2">
                <div class="form-group">
                    <h5>Subjective mark<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="subjective_mark[]" class="form-control" required="" data-validation-required-message="This field is required"> 
                        <div class="help-block"></div>
                        @error('subjective_mark')
                         <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>
                </div>
              </div>

              <div class="col-2">
                <span class="btn btn-primary btn-sm addclasssub" style="margin-top: 33px;"><i class="fa fa-plus-circle"></i></span>
                <span class="btn btn-danger btn-sm delclasssub" style="margin-top: 33px;"><i class="fa fa-minus-circle"></i></span>
              </div>
               </div>

            </div>
          </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
      var conter = 0;
      $(document).on("click",".addclasssub",function(){
        var add_assign_subject = $("#add_assign_subject").html();
        $(this).closest(".add_form").append(add_assign_subject);
        counter++
      });

      $(document).on("click",".delclasssub",function(event){
        $(this).closest(".delete_assign_subject").remove();
        counter -=1
      });
    });
    </script>

 @endsection