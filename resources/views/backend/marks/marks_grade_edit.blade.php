@extends('admin.admin_master')
 @section('admin')

 <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>

 <div class="content-wrapper" style="min-height: 1189.55px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Edit Grade Page</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Edit Grade Mark</li>
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
            <h4 class="box-title">Edit Grade Mark</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">

                  <form novalidate="" action="{{ route('marks.grade.update',$editdata->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                      <div class="col-12 col-md-12">
                        
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Grade Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="grade_name" value="{{ $editdata->grade_name }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                        @error('grade_name')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Grade Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="grade_point" value="{{ $editdata->grade_point }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                        @error('grade_point')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Start Mark <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="start_mark" value="{{ $editdata->start_mark }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                        @error('start_mark')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>End Mark <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="end_mark" value="{{ $editdata->end_mark }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                        @error('end_mark')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Start Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="start_point" value="{{ $editdata->start_point }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                        @error('start_point')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>End Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="end_point" value="{{ $editdata->end_point }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                        @error('end_point')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <h5>Remarks <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="remarks" value="{{ $editdata->remarks }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                        @error('remarks')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>
                            </div>
                        </div>


                      </div>

                     

                      <div class="col-12">
                        
                      <div class="text-xs-right">
                        <input type="submit" value="Update Grade Mark" class="btn btn-info btn-rounded" />
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