@extends('admin.admin_master')
 @section('admin')

 <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>

 <div class="content-wrapper" style="min-height: 1189.55px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Add Other Cost Page</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Add Other Cost</li>
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
            <h4 class="box-title">Add Other Cost</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">

                  <form novalidate="" action="{{ route('other.cost.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                      <div class="col-12 col-md-12">
                        
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <h5>Amount <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="amount" class="form-control" required="" data-validation-required-message="This field is required"> 
                                        <div class="help-block"></div>
                                        @error('amount')
                                         <span class="text-danger">{{ $message }}</span>
                                         @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <h5>Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" class="form-control" required=""> 
                                        <div class="help-block"></div>
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

                        <div class="row">
                            <div class="col-12">
                                <h5>Description <span class="text-dabnger">*</span></h5>

                                <div class="form-controls">
                                    <textarea name="description" id="" class="form-control" required="" placeholder="Enter Description" aria-invalid="false"></textarea>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                      </div>

                     

                      <div class="col-12 mt-3">
                        
                      <div class="text-xs-right">
                        <input type="submit" value="Add Other Cost" class="btn btn-info btn-rounded" />
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