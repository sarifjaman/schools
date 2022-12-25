@extends('admin.admin_master')
 @section('admin')

 <script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>

 <div class="content-wrapper" style="min-height: 1189.55px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Edit Fee Amount Page</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Edit Fee Amount</li>
                              {{-- <li class="breadcrumb-item active" aria-current="page">Add User</li> --}}
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>	  

      <style type="text/css">
      i.fa.fa-plus-circle {
    padding: 5px 0px;
}
    </style>
      <!-- Main content -->
      <section class="content">

       <!-- Basic Forms -->
        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Edit Fee Amount</h4>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">

                  <form novalidate="" action="{{ route('fee.amount.update',$editdata[0]->fee_category_id) }}" method="POST">
                    @csrf

                  
                    <div class="row">

                        <div class="col-12 col-md-12">	
                            <div class="add_item">

                            <div class="form-group">
                                <h5>Select Fee Category <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="fee_category_id" id="fee_category_id" required="" class="form-control">
                                        <option value="">Select Fee Category</option>

                                        @foreach($category as $cat)
                                           <option value="{{ $cat->id }}" {{ ($editdata['0']->fee_category_id == $cat->id) ? "selected" : "" }}>{{ $cat->name }}</option>
                                       @endforeach

                                    </select>
                                </div>
                                <div class="help-block"></div></div>
                         
                        @foreach($editdata as $edit)
                         <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                            <div class="row">
                                <div class="col-5 col-md-5">	
                                    <div class="form-group">
                                        <h5>Select Student Class <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="class_id[]" id="class_id" required="" class="form-control">
                                                <option value="">Select Fee Category</option>
        
                                                @foreach($classes as $class)
                                                   <option value="{{ $class->id }}" {{ ($edit->class_id == $class->id) ? "selected" : "" }}>{{ $class->name }}</option>
                                               @endforeach
        
                                            </select>
                                        </div>
                                        <div class="help-block"></div></div>
                                    </div>
                            
        
                                <div class="col-5 col-md-5">
                                    <div class="form-group">
                                        <h5>Amount <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="amount[]" value="{{ $edit->amount }}" class="form-control" required="" data-validation-required-message="This field is required"> 
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                  </div>
        
                                  <div class="col-2" style="top:32px">
                                    <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle"></i></span>
                                    <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle"></i></span>
                                  </div>
                            </div>
                           
                        </div>
                        @endforeach
                  
                        </div>
                       

                      <div class="col-12">
                        
                      <div class="text-xs-right">
                        <input type="submit" value="Fee Amount Update" class="btn btn-info btn-rounded" />
                      </div>
                      </div>
                    </div>

                  </form>


              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>
</div>
    <!-- Basic Forms -->

     <!-- /.box -->

     <!--Add Class & Amount-->
     <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">

                <div class="form-row">
                    <div class="col-5 col-md-5">

                        <div class="form-group">
                            <h5>Select Student Class <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="class_id[]" id="class_id" required="" class="form-control">
                                    <option value="">Select Fee Category</option>

                                    @foreach($classes as $class)
                                       <option value="{{ $class->id }}">{{ $class->name }}</option>
                                   @endforeach

                                </select>
                            </div>
                            <div class="help-block"></div></div>
                        </div>
                

                    <div class="col-5 col-md-5">
                        <div class="form-group">
                            <h5>Amount <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="amount[]" class="form-control" required="" data-validation-required-message="This field is required"> 
                                <div class="help-block"></div>
                            </div>
                        </div>
                      </div>

                      <div class="col-2" style="top:32px">
                        <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle"></i></span>
                        <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle"></i></span>
                      </div>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
        var counter = 0;
        $(document).on("click",".addeventmore",function(){
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });

        $(document).on("click",".removeeventmore",function(event){
            $(this).closest(".delete_whole_extra_item_add").remove();
            counter -= 1
        });
    });
    </script>

 @endsection