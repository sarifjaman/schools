@extends('admin.admin_master')
 @section('admin')

 <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>

 <div class="content-wrapper" style="min-height: 248px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Student Roll generate Show</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Student Roll Generate Table</li>
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
              <h4 class="box-title">Student <strong>Roll Generate Search</strong></h4>
            </div>

            <div class="box-body">
              <form action="{{ route('student.roll.store') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-12 col-md-4">
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

                  <div class="col-12 col-md-4">
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

                  <div class="col-12 col-md-4">
                    <a id="search" class="btn btn-primary btn-rounded mt-4" name="search">Search</a>
                  </div>
                </div>



                <!---Roll Generator Table--->
                <div class="row d-none" id="roll-generate">
                  <div class="col-md-12">

                    <table class="table table-bordered table-striped" width="100%">
                      <thead>
                        <tr>
                          <th>Id No</th>
                          <th>Student Name</th>
                          <th>Father Name</th>
                          <th>Mother Name</th>
                          <th>Gender</th>
                          <th>Roll</th>
                        </tr>
                      </thead>

                      <tbody id="roll-generate-tr">

                      </tbody>
                    </table>

                  </div>
                </div>

                <input type="submit" class="btn btn-info" value="Roll Generator" />
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

<script type="text/javascript">
  // $(document).ready(function(){
    $(document).on('click','#search',function(){
      var year_id = $('#year_id').val();
      var class_id = $('#class_id').val();

      $.ajax({
        url     : "{{ route('student.registration.getstudents') }}",
        type    : "GET",
        data    : {'year_id' : year_id,'class_id' : class_id},
        success : function(data){
          $('#roll-generate').removeClass('d-none');
          var html = '';

          $.each(data,function(key,v){
            html += 
            '<tr>'+
              '<td>'+ v.student.id_no +'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
              '<td>'+v.student.name+'</td>'+
              '<td>'+v.student.fathername+'</td>'+
              '<td>'+v.student.mothername+'</td>'+
              '<td>'+v.student.gender+'</td>'+
              '<td><input type="text" class="form-control form-control-sm" name="roll[]" value="'+v.roll+'"></td>'+
              '</tr>';
          });

          html = $('#roll-generate-tr').html(html);
        }
      });
    });
  // });
</script>

 @endsection



