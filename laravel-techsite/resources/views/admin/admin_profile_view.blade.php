@extends('admin.admin_master')

@section('admin')



    <div class="page-content">
        <div class="container-fluid">




<div class="row">
    <div class="col-md-6">

        <!-- Simple card -->
        <div class="card">
            <div class="pt-4 mt-md-0 text-center">
                <img class="rounded-circle avatar-xl" alt="200x200"
                     src="{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image) : url('upload/no_image.png')}}"
                     data-holder-rendered="true">
            </div>
            <div class="card-body">
                <h4 class="card-title">Name:{{ $adminData->name }} </h4>
                <hr>
                <h4 class="card-title">Email: {{ $adminData->email }} </h4>
                <hr>
                <h4 class="card-title pb-4">User name: {{ $adminData->username }} </h4>
<a href="{{ route('admin.edit_profile') }}" class="btn btn-info waves-effect waves-light" >Edit Profile</a>
            </div>
        </div>

    </div><!-- end col -->



</div>

        </div>

    </div>

@endsection
