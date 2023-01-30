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
                  <h3 class="page-title">Employee Monthly Salary Show</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Employee Monthly Salary Table</li>
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
              <h4 class="box-title">Employee <strong>Monthly Salary</strong></h4>
            </div>

            <div class="box-body">

                <div class="row">
                  <div class="col-12 col-md-6">
                     <div class="form-group">
                      <h5>Date</h5>

                      <div class="controls">
                          <input type="date" name="date" id="date" class="form-control" />
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
        var date = $('#date').val();

        $.ajax({
            url        : "{{ route('employee.monthly.salary.get') }}",
            method     : "get",
            data       : {'date' : date},
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