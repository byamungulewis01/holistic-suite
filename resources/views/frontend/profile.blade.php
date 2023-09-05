@extends('layouts.frontend.app')
@section('title', 'Profile')
@section('css')
<style>
  .upload-label {
    cursor: pointer;
  }

  .upload-label:hover {
    opacity: 0.8;
  }

  #image-upload {
    display: none;
  }
</style>
@endsection
@section('body')
   <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-9">
            <h4 class="fw-semibold mb-8">Account Setting</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('member.memberProfile') }}">Member</a></li>
                <li class="breadcrumb-item" aria-current="page">Account Setting</li>
                </ol>
            </nav>
            </div>
        </div>
        </div>
  </div>
  <div class="row">
    <div class="col-lg-6 d-flex align-items-stretch">
      <div class="card w-100 position-relative overflow-hidden">
        <div class="card-body p-4">
          <h5 class="card-title fw-semibold">Change Profile</h5>
          <p class="card-subtitle mb-4">Change your profile picture from here</p>
        <form id="profile-form" action="{{ route('member.changeProfilePicture') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
          <div class="text-center">
            @php
             if (auth()->guard('member')->user()->member->photo == null) {
               $photo = 'default.jpg';
             }else {
                $photo = auth()->guard('member')->user()->member->photo;
             }
            @endphp
            <label for="image-upload" class="upload-label">
              <img id="preview-image" src="{{ asset('dist/images/profile/'.$photo) }}" alt="" class="img-fluid rounded-circle" width="120" height="120">
            </label>
            <div class="d-flex align-items-center justify-content-center my-4 gap-3">
              <button type="submit" class="btn btn-primary" onclick="uploadImage()">Upload</button>
              <button class="btn btn-outline-danger" onclick="resetImage()">Reset</button>
            </div>
            <input type="file" name="image" id="image-upload" accept="image/jpeg, image/png, image/gif" onchange="previewImage(event)">
            <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 2MB</p>
          </div>
        </form>


        </div>
      </div>
    </div>
    <div class="col-lg-6 d-flex align-items-stretch">
      <div class="card w-100 position-relative overflow-hidden">
        <div class="card-body p-4">

          <h5 class="card-title fw-semibold">Change Password</h5>
          <p class="card-subtitle mb-4">To change your password please confirm here</p>
          @if($errors->any())
          <div class="alert customize-alert alert-dismissible alert-light-warning text-warning fade show remove-close-icon" role="alert">
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              <div class="font-medium me-3 me-md-0">
                @foreach ($errors->all() as $error)
                  <li>* {{ $error }}</li>
                  @endforeach
              </div>
            </div>
            @endif

            @if(session()->has('error'))
                <div class="alert customize-alert alert-dismissible alert-light-warning text-warning fade show remove-close-icon" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="font-medium me-3 me-md-0">
                        {{ session()->get('error') }}
                    </div>
                </div>
                @endif

          <form action="{{ route('member.changePassword') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
              <label for="exampleInputPassword1" class="form-label fw-semibold">Current Password</label>
              <input type="password" name="old_password" class="form-control" id="exampleInputPassword1" placeholder="**********">
            </div>
            <div class="mb-4">
              <label for="exampleInputPassword2" class="form-label fw-semibold">New Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="**********">
            </div>
            <div class="">
              <label for="exampleInputPassword3" class="form-label fw-semibold">Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword3" placeholder="**********">
            </div>
            <div class="d-flex align-items-center justify-content-end mt-4">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card w-100 position-relative overflow-hidden mb-0">
        <div class="card-body p-4">
          <h5 class="card-title fw-semibold">Personal Details</h5>
          <p class="card-subtitle mb-4">To change your personal detail , edit and save from here</p>
          <form action="{{ route('member.changePersonalDetails') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-4">
                  <label for="exampleInputPassword1" class="form-label fw-semibold">Your Name</label>
                  <input required type="text" class="form-control" id="exampleInputtext" name="name" value="{{ auth()->guard('member')->user()->member->name }}">
                </div>
                <div class="mb-4">
                  <label for="exampleInputPassword1" class="form-label fw-semibold">Email</label>
                  <input required type="email" class="form-control" id="exampleInputtext" name="email" value="{{ auth()->guard('member')->user()->member->email }}">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-4">
                  <label for="phone" class="form-label fw-semibold">Phone</label>
                  <input required type="text" minlength="10" maxlength="10" class="form-control" id="phone" name="phone" value="{{ auth()->guard('member')->user()->member->phone }}">
                </div>
              </div>
              <div class="col-12">
                <div class="d-flex align-items-center justify-content-end gap-3">
                  <button class="btn btn-primary">Save Changes</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection

@section('script')
<script>
// Function to preview the selected image
function previewImage(event) {
  var input = event.target;
  var reader = new FileReader();
  reader.onload = function() {
    var image = document.getElementById('preview-image');
    image.src = reader.result;
  };
  reader.readAsDataURL(input.files[0]);
}

// Function to upload the image
function uploadImage() {
  var input = document.getElementById('image-upload');
  var file = input.files[0];
  // Add your logic to upload the image to the server here
  console.log('Uploading image:', file);
}

// Function to reset the image
function resetImage() {
  var input = document.getElementById('image-upload');
  var image = document.getElementById('preview-image');
  input.value = ''; // Clear the input file
  image.src = ''; // Clear the preview image
}

// phone number only numbers
$(document).ready(function() {
  $("#phone").keydown(function(event) {
    if (event.keyCode == 46 || event.keyCode == 8) {
    } else {
      if (event.keyCode < 48 || event.keyCode > 57) {
        event.preventDefault();
      }
    }
  });
});

</script>
@endsection
