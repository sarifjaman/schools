@extends('admin.admin_master')
  @section('admin')
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Employee List</h3>
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
                  <a href="{{ route('employee.registration.add') }}" class="btn btn-success btn-rounded btn-fl">Add Employee</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 5%;">Sl</th>
								<th>Name</th>
								<th>ID No</th>
								<th>Mobile</th>
								<th>Gender</th>
                                <th>Join Date</th>
                                <th>Salary</th>
                                @if(Auth::user()->role == 'Admin')
                                 <th>Code</th>
                                @endif
								<th style="width: 25%;">Action</th>
							</tr>
						</thead>
						<tbody>

                        @foreach($alldata as $key=>$employee)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $employee->name }}</td>
								<td>{{ $employee->id_no }}</td>
								<td>{{ $employee->mobile }}</td>
								<td>{{ $employee->gender }}</td>
                                <td>{{ $employee->join_date}}</td>
                                <td>{{ $employee->salary }}</td>

                                @if(Auth::user()->role=="Admin")
                                <td>{{ $employee->code }}</td>
                                @endif

								<td>
                                    <a href="{{ route('employee.registration.edit',$employee->id) }}" class="btn btn-primary mr-2" title="Edit">Edit</a>
                                    <a href="{{ route('employee.registration.details',$employee->id) }}" class="btn btn-success" title="Details">Details</a>
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
