@extends('profile.backend.layout')
@section('title','Create Post')
@section('cutomCss')
<style>
    .tag {
        display: inline-block;
        background-color: #f1f1f1;
        padding: 5px;
        margin: 2px;
        border-radius: 3px;
    }
    .tag .remove-tag {
        margin-left: 5px;
        color: red;
        cursor: pointer;
    }
    .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
    height: 100px !importan;
    }
      /*Image remove css :seleted image x button */
      .thumbnail {
        position: relative;
        display: inline-block;
        margin: 10px;
    }
    .thumbnail img {
        display: block;
    }
    .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
       
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        cursor: pointer;
    }
</style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h1 class="mt-4">Dashboard</h1>
            </div>
            <div class="col-md-6 mt-4 text-right">
                <a href="{{route('create.portfolio')}}" class="btn btn-primary">New Project</a>
            </div>
        </div>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Update Project</li>
        </ol>
        <div id="sessionMessage" class="alert alert-success mt-3" style="display: none;">
            {{ Session::get('message') }}
        </div>
       
         @if (count($categories)>0)
            <form action="{{ route("portfolio.update", $portfolios->id) }}" method="POST" name="postForm" id="postForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">								
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="title">Title</label>
                                                <input type="text" name="title" value="{{$portfolios->title}}" id="title" class="form-control" placeholder="Title">	
                                            <p class="error"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="slug">Slug</label>
                                                <input type="text" readonly name="slug" id="slug" value="{{$portfolios->slug}}" class="form-control" placeholder="Slug">	
                                                <p class="error"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="description">Short Description</label>
                                                <textarea name="short_description" id="short_description" cols="30" rows="10" class="summernote"
                                                placeholder="Description">{{$portfolios->short_description}}</textarea>
                                            
                                            </div>
                                        </div> 
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="description">Description</label>
                                                <textarea name="description" id="description" cols="30" rows="10" class="summernote" 
                                                placeholder="Description">{{$portfolios->description}}</textarea>
                                            
                                            </div>
                                        </div>                                          
                                    </div>
                                </div>	                                                                      
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Media</h2>
                                    <div>
                                        <label for="images">Select Images:</label>
                                        <input type="file" name="images[]" id="images" multiple accept="image/*">
                                    </div>
                                    <div id="selected-images"></div>
                                </div>
                                <p class="error"></p>
                                <div class="row">
                                    <i class="fa-regular fa-circle-question text-right" title="The image will auto update"></i>
                                    @foreach($portfolios->images as $image) {{--images is the hashMany relationship in Portfolio.php model --}}
                                        <div class="col-md-3">
                                            <div class="thumbnail">
                                                <img src="{{ asset('storage/' . $image->images) }}" alt="Avatar" style="width:80px;border-radius: 20%;border:1px solid hsl(192, 11%, 9%);">
                                            </div>
                                        </div>
                                    @endforeach
                                  <p class="text-center text-info">{{$portfolios->images->count()}}</p> 
                                </div>
                            </div>                  
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">	
                                    <h2 class="h4 mb-3">status</h2>
                                    <div class="mb-3">
                                        <select name="status" id="status" class="form-control">
                                            <option {{($portfolios->status==1) ? 'selected':''}} value="1">Active</option>
                                            <option {{($portfolios->status==0) ? 'selected':''}} value="0">Block</option>
                                        </select>
                                    </div>
                                </div>
                            </div> 
                            <div class="card">
                                <div class="card-body">	
                                    <h2 class="h4  mb-3">Category</h2>
                                    <div class="mb-3">
                                        <label for="category">Category</label>
                                        <select name="category_id" id="category" class="form-control">
                                            <option value="">Select A Category</option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category )
                                                <option {{ $portfolios->category_id == $category->id ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p class="error"></p>
                                    </div>
                                </div>
                            </div> 
                            <div class="card col-md-12 mt-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Tag Input</h2>
                                    <select id="tag-input" name="tags[]" multiple="multiple" style="width: 100%;" class="form-control">
                                        @foreach($portfolios->tags_array as $tag)
                                            <option value="{{ $tag }}">{{ $tag }}</option>
                                        @endforeach
                                    </select>
                                    <p id="tags-container" class="error"></p>
                               
                                   @if(!empty($portfolios->tags_array))
                                   <div class="tags-container mt-2">
                                       @foreach($portfolios->tags_array as $tag)
                                           <span class="badge badge-info mr-1" data-tag="{{ $tag }}">
                                               {!! $tag !!}
                                               <button type="button" class="btn btn-sm text-light remove-tag">X</button>
                                           </span>
                                       @endforeach
                                   </div>
                               @endif
                               

                                </div>
                            </div>
                            <div class="card mb-3 mt-2">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Show Home ?</h2>
                                    <div class="mb-3">
                                        <select name="showHome" id="showHome"class="form-control">
                                            <option {{($portfolios->showHome =='Yes') ? 'selected':'' }} value="Yes">Yes</option>
                                            <option {{ ($portfolios->showHome=='No') ? 'selected' : '' }} value="No">No</option>
                                        </select>
                                        <p class="error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3 mt-2">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Post type</h2>
                                    <div class="mb-3">
                                        <select name="post_type" id="post_type" class="form-control">
                                            <option value="blog">Blog</option>
                                            <option value="project">Project</option>
                                        </select>
                                        <p class="error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="clint_container" style="display: none;">
                                <div class="mb-3">
                                    <h2 class="h4 mb-3">Clint</h2>
                                    <input type="text" name="clint" id="clint" value="{{$portfolios->clint}}" class="form-control" placeholder="Clint name">
                                    <p class="error"></p>
                                </div>
                            </div>
                            <div class="col-md-12" id="url_container" style="display: none;">
                                <div class="mb-3">
                                    <h2 class="h4 mb-3">URL</h2>
                                    <input type="text" name="project_url"value="{{$portfolios->project_url}}" id="project_url" class="form-control" placeholder="Project URL">
                                    <p class="error"></p>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <div class="pb-5 pt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('list.portfolio')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                    </div>
                </div>
            </form>     
         @else
            <h4 class="text-info text-center">You must create some categories <a href="{{route('categories.create')}}">Go</a> </h4> 
         @endif
       



        
    </div>

@endsection


@section('scripts')
<script>
    $(document).ready(function() {
        $("#postForm").submit(function(event) {
            event.preventDefault();
            
            var formData = new FormData(this);
            formData.append('_method', 'PUT'); // Adding _method to indicate PUT request
            
            var submitButton = $("button[type='submit']");
            submitButton.prop('disabled', true);
            
            $.ajax({
                url: '{{ route("portfolio.update", $portfolios->id) }}',
                type: 'POST', // Change to POST
                data: formData,
                dataType: 'json',
                contentType: false, 
                processData: false, 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    submitButton.prop('disabled', false);

                    if (response['status'] == true) {
                        $(".error").removeClass('invalid-feedback').html('');
                        $("input[type='text'],select,input[type='number']").removeClass('is-invalid');
                        window.location.href = "{{ route('list.portfolio') }}";
                    } else {
                        var errors = response['errors'];
                        $(".error").removeClass('invalid-feedback').html('');
                        $("input[type='text'],select,input[type='number']").removeClass('is-invalid');
                        
                        $.each(errors, function(key, value) {
                            $("#" + key).addClass('is-invalid')
                                        .siblings('p')
                                        .addClass('invalid-feedback')
                                        .html(value);
                        });
                    }
                },
                error: function() {
                    console.log("Something went wrong");
                }
            });

            // Disable submit button for 5 seconds
            setTimeout(function() {
                submitButton.prop('disabled', false);
            }, 5000); 
        });
    });
</script>

<script>
// name to auto slug 
$("#title").change(function(){
    element = $(this);
    $("button[type=submit]").prop('disabled',true); 
    $.ajax({
        url     :   '{{ route("getSlug") }}',
        type    :   'get',
        data    :   {title: element.val()},
        datatype:   'json',
        success :   function(response){
            $("button[type=submit]").prop('disabled',false); 
            if(response["status"]== true ){
                $("#slug").val(response["slug"] );
            }

        }
    });
} );
//Select event manage for post_type

    document.addEventListener('DOMContentLoaded', function () {
        var postTypeSelect = document.getElementById('post_type');
        var clintContainer = document.getElementById('clint_container');
        var url_container  = document.getElementById('url_container')

        postTypeSelect.addEventListener('change', function () {
            if (postTypeSelect.value === 'project') {
                clintContainer.style.display = 'block';
                url_container.style.display = 'block';
            } else {
                clintContainer.style.display = 'none';
            }
        });

        // Initial check in case the form is already populated
        if (postTypeSelect.value === 'project') {
            clintContainer.style.display = 'block';
            url_container.style.display = 'block' ;
        } else {
            clintContainer.style.display = 'none';
        }
    });
    // Post Tag controll 
     $(document).ready(function() {
            const tagInput = $('#tag-input');
            const tagsContainer = $('#tags-container');

            tagInput.select2({
                tags: true,
                placeholder: 'Add a tag',
                allowClear: true,
                tokenSeparators: [',', ' ']
            });
        });
// Remove tag functionality
    $(document).ready(function() {                                  
        $(document).on('click', '.remove-tag', function() {
             var tagToRemove = $(this).parent().data('tag');
             var portfolioId = {{ $portfolios->id }};
            $('#tag-input option[value="' + tagToRemove + '"]').remove();
             $(this).parent().remove();                                   
             $.ajax({
                 url: '{{ route('portfolio.remove-tag') }}',
                method: 'POST',
                data: {
                      _token: '{{ csrf_token() }}',
                      portfolio_id: portfolioId,
                     tag: tagToRemove
                 },
                 success: function(response) {
                      console.log(response); 
                },
                error: function(xhr) {
                     console.error(xhr.responseText);
                 }
             });
        });
     });
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