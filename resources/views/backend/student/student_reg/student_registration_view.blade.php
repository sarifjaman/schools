@extends('admin.admin_master')
 @section('admin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Student List Show</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Student List Table</li>
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
              <h4 class="box-title">Student <strong>Search</strong></h4>
            </div>

            <div class="box-body">
              <form action="{{ route('student.year.class') }}" method="get">
                <div class="row">
                  <div class="col-12 col-md-4">
                     <div class="form-group">
                      <h5>Year</h5>

                      <div class="controls">
                        <select name="year_id" class="form-control">
                          <option value="">Select Your Year</option>

                          @foreach($years as $year)
                          <option value="{{ $year->id }}" {{ ($year_id == $year->id) ? "selected" : "" }}>{{ $year->name }}</option>
                        @endforeach

                        </select>
                      </div>
                     </div>
                  </div>

                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <h4>Class</h4>

                      <div class="contrls">
                        <select name="class_id" class="form-control">
                          <option value="">Select Your Class</option>

                          @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ ($class_id == $class->id) ? "selected" : "" }}>{{ $class->name }}</option>
                          @endforeach

                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-md-4">
                    <input type="submit" class="btn btn-rounded btn-dark cus-btn-m mt-4" name="search" value="Search" />
                  </div>
                </div>
              </form>
            </div>
          </div>
         </div>
            
      <style type="text/css">
      .btn-fl{
          float: right;
      }
      </style>

          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Data Table With Full Features</h3>
                <a href="{{ route('student.registration.add') }}" class="btn btn-success btn-rounded btn-fl">Add Student</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    
                   @if(!isset($request->serch))
                   <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%;">Sl</th>
                            <th>Name</th>
                            <th>Id No</th>
                            <th>Roll</th>
                            <th>Year</th>
                            <th>Class</th>
                            <th>Image</th>
                            
                            @if(Auth::user()->usertype == 'Admin')
                            <th>Code</th>
                            @endif
                            <th style="width: 25%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                      @foreach($alldata as $key=>$student)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $student['student']['name'] }}</td>
                            <td>{{ $student['student']['id_no'] }}</td>
                            <td>{{ $student->roll }}</td>
                            <td>{{ $student['student_year']['name'] }}</td>
                            <td>{{ $student['student_class']['name'] }}</td>
                            <td>
                              <img src="{{ (!empty($student['student']['image']) ? url('upload/student/'.$student['student']['image']) : url('upload/no-image.jpg') )}}" class="img-fluid" style="width: 50px;" />
                            </td>
                            <td>{{ $student['student']['code'] }}</td>
                            <td>
                                <a href="{{ route('student.registration.edit',$student->student_id) }}" class="btn btn-primary mr-2" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('student.registration.promotion',$student->student_id) }}" class="btn btn-success"  title="Promotion"><i class="fa fa-check"></i></a>
                                <a href="{{ route('student.registration.pdf',$student->student_id) }}" class="btn btn-dark" title="pdf"><i class="	fa fa-clipboard"></i></a>
                            </td>
                        </tr>
                  @endforeach

                    </tbody>
                    <tfoot>
                        {{-- <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr> --}}
                    </tfoot>
                  </table>

                  @else

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 5%;">Sl</th>
                            <th>Name</th>
                            <th>Id No</th>
                            <th>Roll</th>
                            <th>Year</th>
                            <th>Class</th>
                            <th>Image</th>
                            @if(Auth::user()->usertype == 'Admin')
                            <th>Code</th>
                            @endif
                            <th style="width: 25%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                      @foreach($alldata as $key=>$student)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $student['student']['name'] }}</td>
                            <td>{{ $student['student']['id_no'] }}</td>
                            <td>{{ $student->roll }}</td>
                            <td>{{ $student['student_year']['name'] }}</td>
                            <td>{{ $student['student_class']['name'] }}</td>
                            <td>
                              <img src="{{ (!empty($student['student']['image']) ? url('upload/student/'.$student['student']['image']) : url('upload/no-image.jpg') )}}" class="img-fluid" style="width: 50px;" />
                            </td>
                            <td>{{ $student['student']['code'] }}</td>
                            <td>
                                <a href="{{ route('student.registration.edit',$student->student_id) }}" class="btn btn-primary mr-2" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('student.registration.promotion',$student->student_id) }}" class="btn btn-success"  title="Promotion"><i class="fa fa-check"></i></a>
                                <a href="{{ route('student.registration.pdf',$student->student_id) }}" class="btn btn-dark" title="pdf"><i class="	fa fa-clipboard"></i></a>
                            </td>
                        </tr>
                  @endforeach

                    </tbody>
                    <tfoot>
                        {{-- <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr> --}}
                    </tfoot>
                  </table>
                   @endif


                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

                   
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>
<!-- /.content-wrapper -->


 @endsection