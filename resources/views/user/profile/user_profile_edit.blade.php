@extends('user.user_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="body-content mt-5">
	<div class="container">
		<div class="row">
       
       

			<div class="col-md-2">
				
			</div> <!-- // end col md 2 -->


			<div class="col-md-6">
  <div class="card">
  	<h3 class="text-center"><span class="text-danger">Hi....</span><strong>{{ $user->name }}</strong> Edit User Profile  </h3>

  	<div class="card-body">
  		


  		<form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
  			@csrf


         <div class="form-group">
            <label class="info-title" for="exampleInputEmail1">Name <span> </span></label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label class="info-title" for="exampleInputEmail1">Email <span> </span></label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>




         <div class="row">

				<div class="col-md-6">
		<div class="form-group">
		<h5>Profile Image <span class="text-danger">*</span></h5>
		<div class="controls">
 <input type="file" name="profile_photo_path" class="form-control" required="" id="image"> </div>
	</div>
				</div><!-- end cold md 6 --> 

				<div class="col-md-6">
				
<img id="showImage" src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}" style="width: 100px; height: 100px;">	
				</div><!-- end cold md 6 --> 




			</div><!-- end row 	 -->	

         <div class="form-group">            
           <button type="submit" class="btn btn-danger">Update</button>
        </div>         
 

  			
  		</form>  		
  	</div>

 
  	
  </div>
				
			</div> <!-- // end col md 6 -->
			
		</div> <!-- // end row -->
		
	</div>
	
</div>



<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
			 $('#showImage').attr('src',e.target.result);	
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>




@endsection