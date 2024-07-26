@extends('profile.backend.layout')
@section('title','Create Category')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('categories.store') }}" method="POST" id="categoryForm" name="categoryForm" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                            <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">	
                           <p></p>
                            </div>
                        </div>	
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status"class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Block</option>
                                </select>	
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="showHome">Show Home ?</label>
                                <select name="showHome" id="showHome"class="form-control">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>	
                            </div>
                        </div>
                    </div>
                </div>							
            </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{route('categories.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
 
        </form>
        
    </div>

@endsection



@section('scripts')
    <script>
      // name to auto slug 
      $("#name").change(function(){
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

// form submit 
        $("#categoryForm").submit(function(event) {
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled',true); 
    $.ajax({
        url: "{{ route('categories.store') }}",
        type: 'post',
        data: element.serializeArray(),
        datatype: 'json',
        success: function(response) {
            $("button[type=submit]").prop('disabled',false); 
            if (response["status"] == true) {

                window.location.href="{{route('categories.index')}}";
                
                $("#name").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");

                $("#slug").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");
            } else {
                var errors = response['errors'];
                if (errors['name']) {
                    $("#name").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['name']);
                } else {
                    $("#name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                }

                if (errors['slug']) {
                    $("#slug").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['slug']);
                } else {
                    $("#slug").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                }
            }
        },
        error: function(jqXHR, exception) {
            console.log("something is wrong, Refresh and try again");
        }
    });
});

    </script>
@endsection