@extends('profile.customer.login.user_layout')

@section('title','User Login')

@section('customCss')
    {{-- CSS --}}
@endsection

@section('content')

<h1>User Login</h1>
@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="icon fa fa-ban"></i> Error ! {{ Session::get('error') }}  
    </div>
@endif
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="icon fa fa-check"></i> Success! {{ Session::get('success') }}
    </div>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Alert messages will fade out after 3 seconds (3000 milliseconds)
        setTimeout(function() {
            $(".alert").alert('close');
        }, 5000);
    });
</script>

<form action="{{ route('login.user') }}" method="POST" id="loginForm">
    @csrf
    <hr>
    <label id="icon" for="email"><i class="fas fa-envelope"></i></label>
    <input type="text" name="email" id="email" placeholder="Email" required/>
    <p class="email-error"></p>

    <label id="icon" for="password"><i class="fas fa-unlock-alt"></i></label>
    <input type="password" name="password" id="password" placeholder="Password" required/>
    <p class="password-error"></p>
    <hr>
    <div class="text-center small"><a href="{{route('home.front')}}"><i class="fa-solid fa-house" style="font-size: 15px;"></i></a> Don't have an account? <a href="{{ route('register.user') }}">Sign up</a></div>
    <hr>
    <div class="btn-block">
        <button type="submit">Login</button>
    </div>
</form>

@section('script')
<script>
    $("#loginForm").submit(function(event) {
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true); 
        $.ajax({
            url: "{{ route('processLogin.user') }}",
            type: 'post',
            data: element.serializeArray(),
            datatype: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false); 
                if (response["status"] == true) {
                    $(".email-error").html("");
                    $(".password-error").html("");
                    window.location.href = "{{ route('dashboard.user') }}";
                } else {
                    var errors = response['errors'];

                    if (errors['email']) {
                        $("#email").addClass('is-invalid');
                        $(".email-error").addClass('invalid-feedback').html(errors['email']);
                    } else {
                        $("#email").removeClass('is-invalid');
                        $(".email-error").removeClass('invalid-feedback').html("");
                    }

                    if (errors['password']) {
                        $("#password").addClass('is-invalid');
                        $(".password-error").addClass('invalid-feedback').html(errors['password']);
                    } else {
                        $("#password").removeClass('is-invalid');
                        $(".password-error").removeClass('invalid-feedback').html("");
                    }
                }
            },
            error: function(jqXHR, exception) {
                console.log("Something is wrong, Refresh and try again");
            }
        });
    });
</script> 
@endsection

@endsection
