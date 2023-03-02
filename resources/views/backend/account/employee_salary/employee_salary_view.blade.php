@extends('admin.admin_master')
  @section('admin')
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Employee Salary List</h3>
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
                  <a href="{{ route('add.employee.salary') }}" class="btn btn-success btn-rounded btn-fl">Add Employee Salary</a>
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
								<th>Amount</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>

                        @foreach($alldata as $key=>$data)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $data['user']['id_no'] }}</td>
                            <td>{{ $data['user']['name'] }}</td>
                            <td>{{ $data->amount }}</td>
                            <td>{{ date('M Y',strtotime($data->date) ) }}</td>
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
