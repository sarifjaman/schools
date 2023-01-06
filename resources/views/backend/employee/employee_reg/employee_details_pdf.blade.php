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
        <span>Employee Information</span>
    </div>

    <div class="bor"></div>

    <div class="std-info">
        <div class="std-img">
            <img src="{{ public_path('upload/employee/'.$details->image) }}" alt=""/>
        </div>
        {{-- {{ url('upload/student/'.$details['student']['image'])}} --}}
        <br>
        
<div class="basic-info">
    <div class="std-name">
        <span>Name :</span> 
        <p>{{ $details->name }}</p>
    </div>

    <div class="std-name">
        <span>Father Name :</span> 
        <p>{{ $details->fathername }}</p>
    </div>

    <div class="std-name">
        <span>Mother Name :</span> 
        <p>{{ $details->mothername }}</p>
    </div>

    <div class="std-name">
        <span>Mobile Number :</span> 
        <p>{{ $details->mobile }}</p>
    </div>

    <div class="std-name">
        <span>Address :</span> 
        <p>{{ $details->address }}</p>
    </div>

    <div class="std-name">
        <span>Gender :</span> 
        <p>{{ $details->gender }}</p>
    </div>

    <div class="std-name">
        <span>Religion :</span> 
        <p>{{ $details->religion }}</p>
    </div>

    <div class="std-name">
        <span>Date Of Birth :</span> 
        <p>{{ date('Y-m-d',strtotime($details->dob)) }}</p>
    </div>

    <div class="table-sec">
        <table class="table">
            <thead>
                <th>S1</th>
                <th>Employee Name</th>
                <th>ID No</th>
                <th>DOB</th>
                <th>Mobile</th>
                <th>Join Date</th>
                <th>Designation</th>
                <th>Salary</th>
            </thead>

            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ $details->name }}</td>
                    <td>{{ $details->id_no }}</td>
                    <td>{{ date('Y-m-d',strtotime($details->dob) ) }}</td>
                    <td>{{ $details->mobile }}</td>
                    <td>{{ date('Y-m-d',strtotime($details->join_date) ) }}</td>
                    <td>{{ $details['designation']['name'] }}</td>
                    <td>{{ $details->salary }}</td>
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
