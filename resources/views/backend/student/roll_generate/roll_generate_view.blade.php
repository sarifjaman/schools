@extends('admin.admin_master')
 @section('admin')

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
              <form action="" method="get">
                <div class="row">
                  <div class="col-12 col-md-4">
                     <div class="form-group">
                      <h5>Year</h5>

                      <div class="controls">
                        <select name="year_id" class="form-control">
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
                        <select name="class_id" class="form-control">
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
              </form>
            </div>
          </div>
         </div>
            
      <style type="text/css">
      .btn-fl{
          float: right;
      }
      </style>

          {{-- <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Data Table With Full Features</h3>
                <a href="http://127.0.0.1:8000/students/registration/add" class="btn btn-success btn-rounded btn-fl">Add Student</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    
                                      <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr role="row"><th style="width: 13px;" class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Sl: activate to sort column descending">Sl</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 67px;">Name</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Id No: activate to sort column ascending" style="width: 55px;">Id No</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Roll: activate to sort column ascending" style="width: 28px;">Roll</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Year: activate to sort column ascending" style="width: 32px;">Year</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Class: activate to sort column ascending" style="width: 61px;">Class</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Image: activate to sort column ascending" style="width: 46px;">Image</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Code: activate to sort column ascending" style="width: 37px;">Code</th><th style="width: 189px;" class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th></tr>
                    </thead>
                    <tbody>

                                              
                  
                    <tr role="row" class="odd">
                            <td class="sorting_1">1</td>
                            <td>Rahat Sikder</td>
                            <td>20100001</td>
                            <td></td>
                            <td>2012</td>
                            <td>Class Three</td>
                            <td>
                              <img src="http://127.0.0.1:8000/upload/student/1752108943668321.png" class="img-fluid" style="width: 50px;">
                            </td>
                            <td>6977</td>
                            <td>
                                <a href="http://127.0.0.1:8000/students/registration/edit/3" class="btn btn-primary mr-2" title="Edit"><i class="fa fa-edit"></i></a>
                                <a href="http://127.0.0.1:8000/students/registration/promotion/3" class="btn btn-success" title="Promotion"><i class="fa fa-check"></i></a>
                                <a href="http://127.0.0.1:8000/students/registration/pdf/3" class="btn btn-dark" title="pdf"><i class="	fa fa-clipboard"></i></a>
                            </td>
                        </tr></tbody>
                    <tfoot>
                        
                    </tfoot>
                  </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 1 of 1 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>

                  

                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->

                   
          </div> --}}
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>

 @endsection



