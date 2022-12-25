@extends('admin.admin_master')
 @section('admin')

 <div class="content-wrapper" style="min-height: 1107.55px;">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Profile</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Extra</li>
                              <li class="breadcrumb-item active" aria-current="page">Profile</li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>

      <style type="text/css">
      .btn-cus{
        position: absolute;
        right: 12px;
        top: 10px;
      }
    </style>
      <!-- Main content -->
      <section class="content">

        <div class="row">
            <div class="col-12">
                <div class="box box-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">
					  <h3 class="widget-user-username"><b>Name:</b> {{ $profile->name }}</h3>
					  <h6 class="widget-user-desc"><b>Rank:</b> {{ $profile->usertype }}</h6>
                      <h6 class="widget-user-desc"><b>Email:</b> {{ $profile->email }}</h6>

                      <a href="{{ route('edit.profile') }}" class="btn btn-primary btn-cus">Edit Profile</a>
					</div>
					<div class="widget-user-image">
					  <img class="rounded-circle" src="{{ (!empty($profile->image)) ? url('upload/user_image/'.$profile->image) : url('upload/no-image.jpg') }}" style="width: 100px!important;height: 100px!important;" alt="User Avatar">
					</div>
					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Mobile</h5>
							<span class="description-text">{{ $profile->mobile }}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Address</h5>
							<span class="description-text">{{ $profile->address }}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Gender</h5>
							<span class="description-text">{{ $profile->gender }}</span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>
					  <!-- /.row -->
					</div>
				  </div>
            </div>
        </div>

      </section>
      <!-- /.content -->
    </div>
</div>

 @endsection