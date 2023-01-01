@extends('admin.admin_master')
 @section('admin')



 <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js" integrity="sha512-RNLkV3d+aLtfcpEyFG8jRbnWHxUqVZozacROI4J2F1sTaDqo1dPQYs01OMi1t1w9Y2FdbSCDSQ2ZVdAC8bzgAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <div class="content-wrapper" style="min-height: 248px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Student Registration Fee Show</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Student Registration Fee Table</li>
                              <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>

      <section class="content">
        <div class="row">


         <div class="col-12">
          <div class="box bb-3 border-warning">
            <div class="box-header">
              <h4 class="box-title">Student <strong>Registration Fee</strong></h4>
            </div>

            <div class="box-body">

                <div class="row">
                  <div class="col-12 col-md-4">
                     <div class="form-group">
                      <h5>Year</h5>

                      <div class="controls">
                        <select name="year_id" id="year_id" class="form-control">
                          <option value="">Select Your Year</option>

                          @foreach ($years as $year)
                            <option value="{{ $year->id }}">{{ $year->name }}</option>  
                          @endforeach

                        </select>
                      </div>
                     </div>
                  </div>

                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <h4>Class</h4>

                      <div class="contrls">
                        <select name="class_id" id="class_id" class="form-control">
                          <option value="">Select Your Class</option>
                          
                          @foreach($classes as $class)
                           <option value="{{ $class->id }}">{{ $class->name }}</option>
                          @endforeach

                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-md-4">
                    <input type="submit" class="btn btn-rounded btn-dark cus-btn-m mt-4" name="search" id="search" value="Search">
                  </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div id="DocumentsResults">

                            <script id="document-template" type="text/x-handlebars-template" >
                                <table class="table table-bordered table-stripped" style="width:100%;">
                                    <thead>
                                        <tr>
                                            @{{{thsource}}}
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @{{#each this}}
                                        <tr>
                                            @{{{tdsource}}}
                                        </tr>
                                        @{{/each}}
                                    </tbody>
                                </table>
                            </script>

                        </div>
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


    </div>
 </div>

 <script type="text/javascript">
    $(document).on('click','#search',function(){
        var year_id = $('#year_id').val();
        var class_id = $('#class_id').val();

        $.ajax({
            url        : "{{ route('student.registration.fee.classwise.get') }}",
            method     : "get",
            data       : {'year_id' : year_id,'class_id' : class_id},
            beforeSend : function(){},
            success    : function(data){
                var source   = $('#document-template').html();
                var template = Handlebars.compile(source);
                var html = template(data);

                $('#DocumentsResults').html(html);
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    });
</script>
 @endsection