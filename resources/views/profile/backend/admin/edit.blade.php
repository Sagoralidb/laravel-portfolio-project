@extends('profile.backend.layout')

@section('title','Edit Admin')

@section('css')
    
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit the Admin</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('list.admin')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="" method="POST" id="adminForm" name="adminForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">								
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{$admin->name ? $admin->name:''}}" class="form-control" placeholder="Name">	
                                <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Email</label>
                                    <input type="text" name="email" id="email"value="{{$admin->email ? $admin->email:''}}" class="form-control" placeholder="Email">	
                               <p></p>
                                </div>
                            </div>	
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">	
                                    <span style="color:rgb(245, 16, 16)">Note: Enter a value to change password or leave it blank</span>
                               <p></p>
                                </div>
                            </div>
                        </div>
                    </div>							
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{route('list.admin')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
     
            </form>
            

           
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('scripts')
    <script>
      $("#adminForm").submit(function(event) {
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled', true); 
    $.ajax({
        url: "{{ route('updateAmin.admin', $admin->id) }}",
        type: 'PUT',
        data: element.serializeArray(),
        datatype: 'json',
        success: function(response) {
            $("button[type=submit]").prop('disabled', false); 
            if (response["status"] == true) {
                $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");                    
                
                toastr.success(response.message);
                setTimeout(function() {
                    window.location.href = "{{ route('list.admin') }}";
                }, 3000);

            } else {
                var errors = response['errors'];
                if (errors['name']) {
                    $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                } else {
                    $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                }
                if (errors['email']) {
                    $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['email']);
                } else {
                    $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                }
                if (errors['password']) {
                    $("#password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['password']);
                } else {
                    $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                }
              
                toastr.error('Please fix those errors & try again.')
            }
        },
        error: function(jqXHR, exception) {
            toastr.error("something is wrong, Refresh and try again");
        }
    });
});
 
    </script>
@endsection
