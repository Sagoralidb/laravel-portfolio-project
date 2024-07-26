@extends('profile.backend.layout')
@section('title', 'Edit Services')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Services</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Edit Services</li>
    </ol>
    <div class="row">
        <div id="sessionMessage" class="alert alert-success mt-3" style="display: none;">
            {{ Session::get('message') }}
        </div>
        <section class="content">
            <div class="card">
                <form action="{{route('service.update', $service->id)}}" method="POST" id="serviceForm" name="serviceForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">								
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="icon">Font Awesome Icon*</label>
                                        <input type="text" name="icon" id="icon" value="{{$service->icon}}" class="form-control" placeholder="Ex: fa-duotone fa-dumpster">	
                                        <p id="iconError" class="text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title">Title*</label>
                                        <input type="text" name="title" id="title" value="{{$service->title}}" class="form-control" placeholder="Title">	
                                        <p id="titleError" class="text-danger"></p>
                                    </div>
                                </div>	
                                <div class="col-md-12">
                                   <div class="mb-3">
                                     <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote form-control" placeholder="Description">{{$service->description}}</textarea>
                                    <p id="descriptionError" class="text-danger"></p>   
                                </div>								
                                </div>  
                            </div>
                        </div>							
                    </div>
                    <div class="pb-5 pt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('list.services')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        // Set CSRF token in the headers
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#serviceForm').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '{{ route("service.update", $service->id) }}',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status === false) {
                        if (response.errors.icon) {
                            $('#iconError').text(response.errors.icon[0]);
                        } else {
                            $('#iconError').text('');
                        }

                        if (response.errors.title) {
                            $('#titleError').text(response.errors.title[0]);
                        } else {
                            $('#titleError').text('');
                        }
                        if (response.errors.description) {
                            $('#descriptionError').text(response.errors.description[0]);
                        } else {
                            $('#descriptionError').text('');
                        }
                    } else {
                        // Show session message
                        $('#sessionMessage').text(response.message).show();
                        setTimeout(function () {
                            window.location.href = '{{ route('list.services') }}';
                        }, 2000);
                    }
                },
                error: function (response) {
                    if (response.responseJSON.errors) {
                        if (response.responseJSON.errors.icon) {
                            $('#iconError').text(response.responseJSON.errors.icon[0]);
                        } else {
                            $('#iconError').text('');
                        }

                        if (response.responseJSON.errors.title) {
                            $('#titleError').text(response.responseJSON.errors.title[0]);
                        } else {
                            $('#titleError').text('');
                        }

                        if (response.responseJSON.errors.description) {
                            $('#descriptionError').text(response.responseJSON.errors.description[0]);
                        } else {
                            $('#descriptionError').text('');
                        }
                    }
                }
            });
        });
    });
</script>
<script>
    // image manage
    $(document).ready(function() {
        $('#images').on('change', function() {
            var files = $(this)[0].files;
            $('#selected-images').empty(); // Clear previous thumbnails

            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var thumbnail = $('<div class="thumbnail" style="display: inline-block; margin: 10px; position: relative;"></div>');
                    var img = $('<img src="' + e.target.result + '" width="150px" style="display: block;"/>');
                    var removeBtn = $('<button class="remove-btn" style="position: absolute; top: 5px; right: 5px; background: red; color: white; border: none; border-radius: 50%; width: 25px; height: 25px; cursor: pointer;">X</button>');

                    removeBtn.on('click', function() {
                        $(this).parent('.thumbnail').remove();
                    });

                    thumbnail.append(img).append(removeBtn);
                    $('#selected-images').append(thumbnail);
                }
                reader.readAsDataURL(files[i]);
            }
        });
    });
</script>
@endsection
