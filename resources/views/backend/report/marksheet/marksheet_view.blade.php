@extends('admin.admin_master')
 @section('admin')

 <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>

 <div class="content-wrapper" style="min-height: 248px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Marksheet Ganerate Show</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Marksheet Ganerate Table</li>
                              <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">


         <div class="col-12">
          <div class="box bb-3 border-warning">
            <div class="box-header">
              <h4 class="box-title">Student <strong>Marksheet Ganerate</strong></h4>
            </div>

            <div class="box-body">
              <form action="{{ route('report.marksheet.get') }}" target="_blank" method="GET">
                @csrf
                <div class="row">
                  <div class="col-12 col-md-3">
                     <div class="form-group">
                      <h5>Year</h5>

                      <div class="controls">
                        <select name="year_id" id="year_id" class="form-control">
                          <option value="">Select Your Year</option>

                          @foreach($years as $year)
                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                          @endforeach

                        </select>
                      </div>
                     </div>
                  </div>

                  <div class="col-12 col-md-3">
                    <div class="form-group">
                      <h4>Class</h4>

                      <div class="contrls">
                        <select name="class_id" id="class_id" class="form-control">
                          <option value="">Select Your Class</option>

                          @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                          @endforeach

                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-md-3">
                    <div class="form-group">
                      <h4>Exam Type</h4>

                      <div class="contrls">
                        <select name="exam_type_id" id="exam_type_id" class="form-control">
                          <option value="">Select Your Class</option>

                          @foreach($exam_type as $exam)
                            <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                          @endforeach

                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-md-3">
                    <div class="form-group">
                      <h4>Student ID</h4>

                      <div class="contrls">
                         <input type="text" name="id_no" class="form-control" />
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-md-3">
                    <input type="submit" class="btn btn-primary btn-rounded mt-4" value="Mark Update " />
                  </div>
                </div>



                <!---Roll Generator Table--->
                {{-- <div class="row d-none" id="marks-entry">
                  <div class="col-md-12">

                  

                    <input type="submit" class="btn btn-primary btn-rounded" value="Mark Update " />

                  </div>
                </div> --}}

                <!---Roll Generator Table--->

              </form>
            </div>
          </div>
         </div>
            
      <style type="text/css">
      .btn-fl{
          float: right;
      }
      </style>

      
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>

 @endsection



