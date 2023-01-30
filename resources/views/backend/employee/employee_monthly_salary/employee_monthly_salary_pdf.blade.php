<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>

    <style type="text/css">
        .scl-logo{
            width: 80px;
            height: 80px;
        }

        .scl-logo img{
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        .std-head h3 {
    position: absolute;
    left: 97px;
    top: 8px;
}

.sch-bor{
    margin: 20px 0px;
    text-align: center;
}

.std-in{
    text-align: center;
}

.sch-bor span{
    color: #fff;
    background: #04AA6D;
    padding: 10px;
    font-size: 18px;
    border-radius: 20px;
}

.bor{
    border-bottom: 2px solid #000;
}

.std-info{
    margin: 20px;
}

.std-name{
    display: flex;
    margin-bottom: 10px;
}

.std-name span{
    font-size: 18px;
    font-weight: 600;
}

.std-name p {
    position: absolute;
    margin-top: 4px;
    left: 200px;
}

.table,.table td,.table th {
  border: 1px solid black;
}

.table {
  border-collapse: collapse;
  width: 100%;
}

.table th,.table td {
  padding: 8px;
}

.table th{
    background-color: #04AA6D;
    color: #fff;
}

.std-foot{
    text-align: center;
    position: absolute;
    bottom: 0;
    width: 100%;
}

.std-img {
    position: relative;
    float: right;
}

.std-img img{
    width: 120px;
    height: 120px;
}

.basic-info {
    margin-top: 148px;
}

.table-sec{
    margin: 40px 0px;
}

    </style>
  </head>
  <body>
    <div class="std-in">
      <div class="scl-logo">
        <img src="" alt=""/>
      </div>

      <div class="std-head">
        <h3>School Name</h3>
      </div>
    </div>

    <div class="sch-bor">
        <span>Student Information</span>
    </div>

    <div class="bor"></div>

    <div class="std-info">
        <div class="std-img">
            <img src="{{ public_path('upload/employee/'.$details['0']['user']['image']) }}" alt=""/>
        </div>
        {{-- {{ url('upload/student/'.$details['student']['image'])}} --}}
        <br>
        
<div class="basic-info">
    <div class="std-name">
        <span>Name :</span> 
        <p>{{ $details['0']['user']['name'] }}</p>
    </div>

    <div class="std-name">
        <span>Father Name :</span> 
        <p>{{ $details['0']['user']['fathername'] }}</p>
    </div>

    <div class="std-name">
        <span>Mother Name :</span> 
        <p>{{ $details['0']['user']['mothername'] }}</p>
    </div>

    <div class="std-name">
        <span>Mobile Number :</span> 
        <p>{{ $details['0']['user']['mobile'] }}</p>
    </div>

    <div class="std-name">
        <span>Address :</span> 
        <p>{{ $details['0']['user']['address'] }}</p>
    </div>

    <div class="std-name">
        <span>Gender :</span> 
        <p>{{ $details['0']['user']['gender'] }}</p>
    </div>

    <div class="std-name">
        <span>Religion :</span> 
        <p>{{ $details['0']['user']['religion'] }}</p>
    </div>

    <div class="std-name">
        <span>Date Of Birth :</span> 
        <p>{{ $details['0']['user']['dob'] }}</p>
    </div>

    <div class="std-name">
        <span>ID :</span> 
        <p>{{ $details['0']['user']['id_no'] }}</p>
    </div>


    @php
    $date = date('Y-m',strtotime($details['0']->date));

    if($date != ''){
        $where[] = ['date','like',$date.'%'];
    }

    $totalattend = App\Models\EmployeeAttendance::with('user')->where($where)->where('employee_id',$details['0']->employee_id)->get();
    $countabsent = count( $totalattend->where('attend_status', 'Absent'));

            $salary = (float)$details['0']['user']['salary'];
            $perdaysalary = (float)$salary / 30;
            $totalsalaryminus = (float)$perdaysalary * (float)$countabsent;
            $totalsalary = (float)$salary - (float)$totalsalaryminus;
    @endphp

    <div class="table-sec">
        <table class="table">
            <thead>
                <th>S1</th>
                <th>Employee Name</th>
                <th>ID No</th>
                <th>Basic Salary</th>
                <th>Salary Of The Month</th>
                <th>Date</th>
            </thead>

            <tbody>
                <tr>
                  <td>1</td>
                  <td>{{ $details['0']['user']['name']}}</td>
                  <td>{{ $details['0']['user']['id_no'] }}</td>
                  <td>{{ $details['0']['user']['salary'] }}</td>
                  <td>{{ $totalsalary }}</td>
                  <td>{{ date('M Y',strtotime($details['0']->date)) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>




    </div>



    <div class="std-foot">
        <div class="bor"></div>
        <p>School Address: Comilla Modern High School,Comilla</p>
    </div>
  </body>
</html>
