@extends('profile.backend.layout')

@section('title','Edit User')

@section('css')
    
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit the User</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('list.user')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('update.user', $user->id) }}" method="POST" id="userForm" name="userForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">								
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{$user->name ? $user->name:''}}" class="form-control" placeholder="Name">	
                                <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Email</label>
                                    <input type="text" name="email" id="email"value="{{$user->email ? $user->email:''}}" class="form-control" placeholder="Email">	
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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Phone</label>
                                    <input type="text" name="phone" id="phone"value="{{$user->phone ? $user->phone:''}}" class="form-control" placeholder="Phone">	
                               <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status"class="form-control">
                                        <option {{($user->status == 1)?'selected':''}} value="1">Active</option>
                                        <option {{($user->status == 0)?'selected':''}} value="0">Block</option>
                                    </select>	
                                </div>
                            </div>	
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="user_type">Role</label>
                                    <select name="user_type" id="user_type"class="form-control">
                                        <option {{($user->user_type==0) ? 'selected':'' }} value="0">User</option>
                                        <option {{($user->user_type==1) ? 'selected':'' }}  value="1">Clint</option>
                                    </select>	
                                </div>
                            </div>	
                        </div>
                    </div>							
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{route('list.user')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
     
            </form>
            

           
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('scripts')
    <script>
       $("#userForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop('disabled',true); 
            $.ajax({
                url: "{{ route('update.user', $user->id) }}",
                type: 'PUT',
                data: element.serializeArray(),
                datatype: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled',false); 
                    if (response["status"] == true) {
                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#phone").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = "{{ route('list.user') }}";
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
                        if (errors['phone']) {
                            $("#phone").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['phone']);
                        } else {
                            $("#phone").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
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
