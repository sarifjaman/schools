@extends('admin.admin_master')
 @section('admin')

 <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>

 <div class="content-wrapper" style="min-height: 248px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Marksheet PDF Show</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Marksheet PDF Table</li>
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
              <h4 class="box-title">Student <strong>Marksheet PDF</strong></h4>
            </div>

            <div class="box-body" style="border: solid 1px; padding: 10px;">
               <div class="row">
                <div style="float: right;" class="col-md-2 text-center">
                  <img src="{{ url('upload/school.png') }}" style="width: 122px; height: 100px;">
                </div>

                <div class="col-md-2 text-center"></div>

                <div class="col-md-4 text-center" style="float: left;">
                  <h4><strong>School Management</strong></h4>
                  <h6><strong>Cumilla,Bangladesh</strong></h6>
                  <h5><strong><u><i>Academic Transcript</i></u></strong></h5>
                  <h6><strong>{{ $allmarks[0]['exam_type']['name'] }}</strong></h6>
                </div>

                <div class="col-12">
                  <hr style="border: solid 1px; width: 100%; color: #ddd; margin-bottom: 0px;">

                  <p style="text-align: right;"><u><i>Print Date: {{ date('D M Y') }}</i></u></p>
                </div>

               </div>

               <div class="row">
                <div class="col-md-6">
                  <table border="1" style="border-color: #fff; width: 100%;" cellpadding: "8"  cellspecing: "2">
                    @php
                    $assign_student = App\Models\AssignStudent::where('year_id',$allmarks['0']->year_id)->where('class_id',$allmarks['0']->class_id)->first();
                    @endphp
      
                    <tr>
                      <td width="50%">Student ID</td>
                      <td width="50%">{{ $allmarks['0']['id_no']}}</td>
                    </tr>
      
                    <tr>
                      <td width="50%">Roll No</td>
                      <td width="50%">{{ $assign_student->roll }}</td>
                    </tr>
      
                    <tr>
                      <td width="50%">Name</td>
                      <td width="50%">{{ $allmarks['0']['student']['name'] }}</td>
                    </tr>
      
                    <tr>
                      <td width="50%">Class</td>
                      <td width="50%">{{ $allmarks['0']['student_class']['name'] }}</td>
                    </tr>
      
                    <tr>
                      <td width="50%">Session</td>
                      <td width="50%">{{ $allmarks['0']['year']['name'] }}</td>
                    </tr>
                  </table>
                </div>

                <div class="col-md-6">
                  <table border="1" style="border-color: #fff; width: 100%;" cellpadding: "8"  cellspecing: "2">
                    <thead>
                      <tr>
                        <th>Letter Grade</th>
                        <th>Marks Interval</th>
                        <th>Grade Point</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($allgrades as $mark)
                      <tr>
                        <td>{{ $mark->grade_name }}</td>
                        <td>{{ $mark->start_mark}} - {{ $mark->end_mark}}</td>
                        <td>{{ $mark->grade_point}} - {{ ($mark->grade_point == 5) ? $mark->grade_point : $mark->grade_point+1 - (float)0.01}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>

              <br><br>
              <div class="row">
                <div class="col-md-12">
                  <table border="1" style="border-color: #fff; width: 100%;" cellpadding: "1"  cellspecing: "1">
                    <thead>
                      <tr>
                        <th class="text-center">SL</th>
                        <th class="text-center">Get Marks</th>
                        <th class="text-center">Letter Grade</th>
                        <th class="text-center">Grade Point</th>
                      </tr>
                    </thead>

                    <tbody>
                      @php
                        $total_marks = 0;
                        $total_point = 0;
                      @endphp

@foreach($allmarks as $key=>$mark)
@php
$get_mark = $mark->marks;
$total_marks = (float)$total_marks+(float)$get_mark;
$total_subject = App\Models\StudentMark::where('year_id',$mark->year_id)->where('class_id',$mark->class_id)->where('exam_type_id',$mark->exam_type_id)->where('student_id',$mark->student_id)->get()->count();
@endphp

<tr>
  <td class="text-center">{{ $key+1 }}</td>
  <td class="text-center">{{ $get_mark }}</td>

  @php
  $grade_marks = App\Models\MarkGrade::where([['start_mark','<=',(int)$get_mark],['end_mark','>=',(int)$get_mark]])->first();
  $grade_name = $grade_marks->grade_name;
  $grade_point = $grade_marks->grade_point;
  @endphp

  <td class="text-center">{{ $grade_name }}</td>
  <td class="text-center">{{ $grade_point }}</td>
</tr>
@endforeach

<tr>
  <td colspan="3"><strong style="padding-left: 30px;">Total Marks</strong></td>
  <td colspan="3"><strong style="padding-left: 30px;">{{ $total_marks }}</strong></td>
</tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <br><br>
              <div class="row">
                <div class="col-md-12">
                  <table border="1" style="border-color: #fff; width: 100%;" cellpadding: "1"  cellspecing: "1">
                    @php
                      $total_grade = 0;
                      $point_for_letter_grade = (float)$total_point/(float)$total_subject;
                      $total_grade = App\Models\MarkGrade::where([['start_point','<=',$point_for_letter_grade],['end_point','>=',$point_for_letter_grade]])->first();

                      $grade_point_avg = (float)$total_point/(float)$total_subject;
                    @endphp

                    <tr>
                      <td width="50%"><strong>Grade Point Average</strong></td>
                      <td width="50%">
                        @if($fail_count > 0)
                        0.00
                        @else
                        {{$grade_point_avg}}
                        @endif
                      </td>
                    </tr>

                    <tr>
                      <td width="50%"><strong>Grade Point Average</strong></td>
                      <td width="50%">
                        @if($fail_count > 0)
                        Fail
                        @else
                        {{ $total_grade->grade_name }}
                        @endif
                      </td>
                    </tr>

                    <tr>
                      <td width="50%">Total Marks With Fraction</td>
                      <td width="50%"><strong>{{ $total_marks }}</strong></td>
                    </tr>
                  </table>
                </div>
              </div>

              <br><br>

              <div class="row">
                <div class="col-md-12">
                  <table border="1" style="border-color: #fff; width: 100%;" cellpadding: "1"  cellspecing: "1">
                    <tbody>
                      <tr>
                        <td style="text-align: left"><strong>Remark:</strong>
                          @if($fail_count>0)
                          Fail
                          @else
                          {{ $total_grade->remarks }}
                          @endif
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <br><br><br><br>

              <div class="row">
                <div class="col-md-4">
                  <hr style="border: solid 1px;widows:60%;color:#fff;margin-bottom: -3px;">
                  <div class="text-center">Teacher</div>
                </div>

                <div class="col-md-4">
                  <hr style="border: solid 1px;widows:60%;color:#fff;margin-bottom: -3px;">
                  <div class="text-center">Parents / Guardian</div>
                </div>

                <div class="col-md-4">
                  <hr style="border: solid 1px;widows:60%;color:#fff;margin-bottom: -3px;">
                  <div class="text-center">Principle / Headmaster</div>
                </div>
              </div>

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

 @endsection



