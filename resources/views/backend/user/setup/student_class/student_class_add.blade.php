@extends('admin.admin_master')
 @section('admin')

 <div class="content-wrapper" style="min-height: 1189.55px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Add Student Class Page</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Add Student Class</li>
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
            <h4 class="box-title">Add Student Class</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">

                  <form novalidate="" action="{{ route('student.class.store') }}" method="POST">
                    @csrf
                    <div class="row">

                      <div class="col-12 col-md-12">
                        <div class="form-group">
                            <h5>Student Class Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name" class="form-control" required="" data-validation-required-message="This field is required"> 
                                <div class="help-block"></div>
                                @error('name')
                                 <span class="text-danger">{{ $message }}</span>
                                 @enderror
                            </div>
                        </div>
                      </div>

                     

                      <div class="col-12">
                        
                      <div class="text-xs-right">
                        <input type="submit" value="Student Class Add" class="btn btn-info btn-rounded" />
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