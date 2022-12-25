@extends('admin.admin_master')
 @section('admin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Fee Amount Details Show</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Fee Amount Details Table</li>
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
            
      <style type="text/css">
      .btn-fl{
          float: right;
      }
      </style>

          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Assign Subject : <small>{{ $detaildata['0']['student_class']['name'] }}</small></h3>
                <a href="{{ route('fee.amount.add') }}" class="btn btn-success btn-rounded btn-fl">Add Fee Amount</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead class="thead-light">
                          <tr>
                              <th style="width: 5%;">Sl</th>
                              <th>Subject</th>
                              <th>Full Mark</th>
                              <th>Pass Mark</th>
                              <th>Subjective Mark</th>
                              {{-- <th style="width: 25%;">Action</th> --}}
                          </tr>
                      </thead>
                      <tbody>

                       @foreach($detaildata as $key=>$detail)
                          <tr>
                            <td>{{ $key+1 }}</td>
                              <td>{{ $detail['school_subject']['name'] }}</td>
                              <td>{{ $detail->fullmark }}</td>
                              <td>{{ $detail->passmark }}</td>
                              <td>{{ $detail->subjective_mark }}</td>
                           
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