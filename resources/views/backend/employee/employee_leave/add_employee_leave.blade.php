@extends('admin.admin_master')
 @section('admin')

 <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>

 <div class="content-wrapper" style="min-height: 248px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Add Employee Leave Page</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Add Employee Leave</li>
                              
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
            <h4 class="box-title">Add Employee Leave</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">

                  <form novalidate="" action="{{ route('employee.leave.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                   <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <h5>Employee Name <span class="text-danger">*</span></h5>

                            <div class="controls">
                                <select name="employee_id" required="" class="form-control">
                                    <option value="">Select Employee Name</option>

                                    @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach    

                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <h5>Leave Purpose <span class="text-danger">*</span></h5>

                            <div class="controls">
                                <select name="leave_purpose_id" id="leave_purpose_id" required="" class="form-control">
                                    <option value="">Select Leave Purpose Name</option>
                                    
                                    @foreach($leave_purpose as $leave)
                                    <option value="{{ $leave->id }}">{{ $leave->name }}</option>
                                    @endforeach

                                    <option value="0">Another Purpose</option>

                                </select>
                                <input type="text" name="name" id="another_id" placeholder="Write Purpose" class="form-control" style="display: none;" />
                            </div>
                        </div>
                    </div>
                    
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <h5>Start Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="start_date" id="" class="form-control" required=""> 
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <h5>End Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="end_date" id="" class="form-control" required=""> 
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                     
                      <div class="col-12">
                        
                      <div class="text-xs-right">
                        <input type="submit" value="Add Employee Leave" class="btn btn-info btn-rounded">
                    </div>
                      </div>
                  


              </div>
            </form>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div></section>
      <!-- /.content -->
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','#leave_purpose_id',function(){
            var leave_purpose_id = $(this).val();

            if(leave_purpose_id == '0'){
                $('#another_id').show();
            }else{
                $('#another_id').hide();
            }
        });
    });
</script>

 @endsection