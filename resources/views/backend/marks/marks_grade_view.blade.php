@extends('admin.admin_master')
  @section('admin')
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Mark Grade List</h3>
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
                  <a href="{{ route('marks.grade.add') }}" class="btn btn-success btn-rounded btn-fl">Add Marks Grade</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="width: 5%;">Sl</th>
								<th>Grade Name</th>
								<th>Grade Point</th>
								<th>Start Mark</th>
								<th>End Mark</th>
                                <th>Point Range</th>
                                <th>Remarks</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

                            @foreach ($alldata as $key=>$grade)
							<tr>
								<td>{{ $key+1 }}</td>
                                 <td>{{ $grade->grade_name }}</td>
                                 <td>{{ $grade->grade_point }}</td>   
                                 <td>{{ $grade->start_mark }}</td>
                                 <td>{{ $grade->end_mark }}</td>
                                 <td>{{ $grade->start_point }} - {{ $grade->end_point }}</td>
                                 <td>{{ $grade->remarks }}</td>
								 <td>
                                    <a href="{{ route('marks.grade.edit',$grade->id) }}" class="btn btn-primary mr-2" title="Edit">Edit</a>
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
