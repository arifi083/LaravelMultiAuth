@extends('admin.admin_master')
@section('content')

<div class="card" style="width: 20rem;">
<img class="card-img-top" style="border-radius: 50%" 
     src="{{ (!empty($admin->profile_photo_path))? url('upload/admin_images/'.$admin->profile_photo_path):url('upload/no_image.jpg') }}" height="80px" ><br><br>
  <div class="card-body">
    <h5 class="card-title">Admin Name:{{ $admin->name }}</h5>
    <p class="card-text ">Admin Email:{{ $admin->email }}</p>
    <a href="{{ route('admin.edit.profile') }}" class="btn btn-primary">Admin Edit Profile</a>
  </div>
</div>

@endsection