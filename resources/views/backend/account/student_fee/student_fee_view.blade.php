@extends('admin.admin_master')
  @section('admin')
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Student Fee List</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
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
				  <h3 class="box-title">Data Table With Full Features</h3>
                  <a href="{{ route('student.fee.add') }}" class="btn btn-success btn-rounded btn-fl">Add Student Fee</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 5%;">Sl</th>
								<th>ID No</th>
								<th>Name</th>
								<th>Year</th>
								<th>Class</th>
                                <th>Fee Type</th>
                                <th>Amount</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>

                          @foreach ($alldata as $key=>$data)
							<tr>
							    <td>{{ $key+1 }}</td>
                                <td>{{ $data['student']['id_no'] }}</td>
                                <td>{{ $data['student']['name'] }}</td>
                                <td>{{ $data['year']['name'] }}</td>
                                <td>{{ $data['class']['name'] }}</td>
                                <td>{{ $data['fee_category']['name'] }}</td>
                                <td>{{ $data->amount }}</td>
                                <td>{{ date('M Y',strtotime($data->date)) }}</td>
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
