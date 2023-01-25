@extends('admin.admin_master')
 @section('admin')

 <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>

 <div class="content-wrapper" style="min-height: 248px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Edit Employee Attendance Page</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Edit Employee Attendance</li>
                              
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
            <h4 class="box-title">Edit Employee Attendance</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-12">

                  <form novalidate="" action="{{ route('employee.attendance.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                   <div class="row">
                    <div class="col-12">

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <h5>Attendance Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" id="" value="{{ $editdata['0']['date']}}" class="form-control" required=""> 
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-12">

                                <table class="table table-bordered table-striped" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">SL</th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee List</th>
                                            <th colspan="3" class="text-center" style="vertical-align: middle; width: 30%;">Attendance Status</th>
                                        </tr>

                                        <tr>
                                            <th class="text-center btn present_all" style="display: table-cell;background-color: #000000;">Present</th>
                                            <th class="text-center btn leave_all" style="display: table-cell;background-color: #000000;">Leave</th>
                                            <th class="text-center btn absent_all" style="display: table-cell;background-color: #000000;">Absent</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($editdata as $key=>$data)
                                        <tr id="div{{ $data->id }}" class="text-center">
                                            <input type="hidden" name="employee_id[]" value="{{ $data->employee_id }}" />

                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $data['user']['name'] }}</td>
                                            <td colspan="3">
                                                <div class="switch-toggle switch-3 switch-candy">
                                                    <input type="radio" name="attend_status{{$key}}" id="present{{$key}}" value="Present" {{ ($data->attend_status == 'Present') ? 'checked' : ''; }} />
                                                    <label for="present{{$key}}">Present</label>

                                                    <input type="radio" name="attend_status{{$key}}" id="leave{{$key}}" value="Leave" {{ ($data->attend_status == 'Leave') ? 'checked' : ''; }}/>
                                                    <label for="leave{{$key}}">Leave</label>

                                                    <input type="radio" name="attend_status{{$key}}" id="absent{{$key}}" value="Absent" {{ ($data->attend_status == 'Absent') ? 'checked' : ''; }} />
                                                    <label for="absent{{$key}}">Absent</label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    
                     
                      <div class="col-12">
                        
                      <div class="text-xs-right">
                        <input type="submit" value="Update Employee Leave" class="btn btn-info btn-rounded">
                    </div>
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