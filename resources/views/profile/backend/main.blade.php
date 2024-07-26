@extends('profile.backend.layout')
@section('title','Admin Dashboard')
@section('cutomCss')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">

@endsection

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Main Board</li>
    </ol>

    <div id="sessionMessage" class="alert alert-success mt-3" style="display: none;">
        {{ Session::get('message') }}
    </div>

    <form method="POST" action="{{ route('main.update') }}" id="mainForm" name="mainForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="form-group col-md-3 mt-3">
               <h5>Background Image</h5>
                @if (! empty($main->bc_image)>0)
                    <img style="width:250px;height:30vh" src="{{ url('storage/' . $main->bc_image) }}" class="img-thumbnail" alt="Background Thumbnail">
                @else
                    <h4 class="text-danger">Background image not found,upload 1920x1055 size image.</h4>
                @endif
               
                @if (! empty($main->resume)>0)
                    <div class="bg-info">
                    <a href="{{ url('storage/' . $main->resume) }}" target="_blank" class="btn">View PDF</a>
                    </div>
                    @else
                        <h4 class="text-danger">Resume not found.</h4> 
                @endif
                <h5>Background Image*:</h5>
                <input type="file" name="bc_image" id="bc_image" style="margin: 5px;">
                <p class="text-danger" id="bcImageError"></p>
                  <div class="mt-2">
                    <h5>Upload Resume: </h5>
                    <input type="file" name="resume" id="resume" class="form-control">
                    <p class="text-danger" id="resumeError"></p>
                </div>
            </div>

            <div class="form-group col-md-4 mt-3">
                <div>
                    <label for="title"><h5>Title*</h5></label>
                    @if (! empty($main->title))
                        <input type="text" value="{{ $main->title }}" name="title" id="title" class="form-control">
                        <p class="text-danger" id="titleError"></p>
                    @else
                    <input type="text" name="title" id="title" class="form-control">
                        <p class="text-danger" id="titleError"></p>
                    @endif                    
                </div>
                <div>
                    <label for="sub_title"><h5>Sub Title*</h5></label>
                    @if (! empty($main->sub_title))
                    <input type="text" name="sub_title" id="sub_title" class="form-control" value="{{ $main->sub_title}}">
                    <p class="text-danger" id="subTitleError"></p> 
                    @else
                    <input type="text" name="sub_title" id="sub_title" class="form-control">
                    <p class="text-danger" id="subTitleError"></p> 
                    @endif                   
                </div>
                <div>
                    <label for="profile"><h5>Profile Type*</h5></label>
                    @if (! empty($main->profile))
                    <input type="text" name="profile" id="profile" class="form-control" value="{{ $main->profile}}">
                    <p class="text-danger" id="profileError"></p> 
                    @else
                    <input type="text" name="profile" id="profile" class="form-control" placeholder="Full stack developer">
                    <p class="text-danger" id="profileError"></p> 
                    @endif                   
                </div>
                <div>         
                    @if (! empty($main->profile_picture)>0)
                    <img src="{{ url('storage/' . $main->profile_picture) }}" class="rounded-circle" alt="Cinque Terre" width="120" height="120" style="border:5px solid #dee7e7;"> 
                    <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                    <p class="text-danger" id="profile_pictureError"></p>
                    @else
                        <h5>Profile Picture*:</h5>
                        <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                        <p class="text-danger" id="profile_pictureError"></p>
                    @endif
                </div>
            </div>  
            <div class="form-group col-md-4 mt-3">
                <div>
                   @if (!empty($main->full_name)>0)
                   <label for=""><h5>Full Name</h5></label>
                   <input type="text" name="full_name" id="full_name" value="{{$main->full_name}}" class="form-control">
                   <p class="text-danger" id="full_nameError"></p>  
                   @else
                    <label for=""><h5>Full Name</h5></label>
                    <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Full name">
                    <p class="text-danger" id="full_nameError"></p> 
                   @endif 
                </div>
                <div>
                    @if (!empty($main->email)>0)
                    <label for=""><h5>Email*</h5></label>
                    <input type="email" name="email" id="email" value="{{$main->email}}" class="form-control">
                    <p class="text-danger" id="emailError"></p> 
                    @else
                    <label for=""><h5>Email*</h5></label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                    <p class="text-danger" id="emailError"></p>   
                    @endif
                </div>
                <div>
                    @if (!empty($main->phone)>0)
                    <label for=""><h5>Phone*</h5></label>
                    <input type="phone" name="phone" id="phone" value="{{$main->phone}}" class="form-control">
                    <p class="text-danger" id="phoneError"></p> 
                    @else
                    <label for=""><h5>Phone*</h5></label>
                    <input type="phone" name="phone" id="phone" class="form-control" placeholder="phone">
                    <p class="text-danger" id="phoneError"></p>   
                    @endif
                </div>  
            </div>
            <div class="col-md-12">
                @if (! empty($main->about_me)>0)
                <label for=""><h5>About me*</h5></label>
                <textarea name="about_me" id="about_me" cols="30" rows="10" class="summernote" placeholder="Description">{{$main->about_me}}</textarea>
                <p class="text-danger" id="about_meError"></p> 
                @else
                <label for=""><h5>About me*</h5></label>
                <textarea name="about_me" id="about_me" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>  
                <p class="text-danger" id="about_meError"></p>   
                @endif
            </div>
        </div>
        <button type="submit" class="btn btn-dark mt-5" style="width:20%">Update</button>
    </form>
</div>   
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#mainForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ route("main.update") }}',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status === false) {
                    if (response.errors.title) {
                        $('#titleError').text(response.errors.title[0]);
                    } else {
                        $('#titleError').text('');
                    }

                    if (response.errors.sub_title) {
                        $('#subTitleError').text(response.errors.sub_title[0]);
                    } else {
                        $('#subTitleError').text('');
                    }
                    if (response.errors.email) {
                        $('#emailError').text(response.errors.email[0]);
                    } else {
                        $('#emailError').text('');
                    }
                    if (response.errors.phone) {
                        $('#phoneError').text(response.errors.phone[0]);
                    } else {
                        $('#phoneError').text('');
                    }
                    if (response.errors.profile) {
                        $('#profileError').text(response.errors.profile[0]);
                    } else {
                        $('#profileError').text('');
                    }
                    if (response.errors.full_name) {
                        $('#full_nameError').text(response.errors.full_name[0]);
                    } else {
                        $('#full_nameError').text('');
                    }
                    if (response.errors.profile_picture) {
                        $('#profile_pictureError').text(response.errors.profile_picture[0]);
                    } else {
                        $('#profile_pictureError').text('');
                    }
                    if (response.errors.about_me) {
                        $('#about_meError').text(response.errors.about_me[0]);
                    } else {
                        $('#about_meError').text('');
                    }
                } else {
                    // Show session message
                    $('#sessionMessage').text(response.message).show();
                    setTimeout(function () {
                        window.location.href = '{{ route('main.dashboard') }}';
                    }, 2000);
                   
                }
            },
            error: function (response) {
                if (response.responseJSON.errors) {
                    if (response.responseJSON.errors.title) {
                        $('#titleError').text(response.responseJSON.errors.title[0]);
                    } else {
                        $('#titleError').text('');
                    }

                    if (response.responseJSON.errors.sub_title) {
                        $('#subTitleError').text(response.responseJSON.errors.sub_title[0]);
                    } else {
                        $('#subTitleError').text('');
                    }
                    if (response.responseJSON.errors.email) {
                        $('#emailError').text(response.responseJSON.errors.email[0]);
                    } else {
                        $('#emailError').text('');
                    }
                    if (response.responseJSON.errors.phone) {
                        $('#phoneError').text(response.responseJSON.errors.phone[0]);
                    } else {
                        $('#phoneError').text('');
                    }
                    if (response.responseJSON.errors.profile) {
                        $('#profileError').text(response.responseJSON.errors.profile[0]);
                    } else {
                        $('#profileError').text('');
                    }
                    if (response.responseJSON.errors.full_name) {
                        $('#full_nameError').text(response.responseJSON.errors.full_name[0]);
                    } else {
                        $('#full_nameError').text('');
                    }
                    if (response.responseJSON.errors.profile_picture) {
                        $('#profile_pictureError').text(response.responseJSON.errors.profile_picture[0]);
                    } else {
                        $('#profile_pictureError').text('');
                    }
                    if (response.responseJSON.errors.about_me) {
                        $('#about_meError').text(response.responseJSON.errors.about_me[0]);
                    } else {
                        $('#about_meError').text('');
                    }
                }
            }
        });
    });
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

<script>
    $(document).ready(function() {
        $('#about_me').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                  // set focus to editable area after initializing summernote
        });
    });
</script>
@endsection
