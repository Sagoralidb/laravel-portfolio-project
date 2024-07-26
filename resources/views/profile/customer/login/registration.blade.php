@extends('profile.customer.login.user_layout')
@section('title','User Registration Form')
@section('customCss')
  {{-- CSS --}}
@endsection
@section('content')
    <h1>Registration</h1>
        
    @if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="icon fa fa-ban"></i> Error ! {{ Session::get('error') }}  
    </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="icon fa fa-check"></i>{{ Session::get('success') }}
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
    <form action="{{ route('register.user') }}" method="POST" name="registrationFrom" id="registrationFrom"enctype="multipart/form-data">
      @csrf 
    <div>
    <label id="icon" for="name"><i class="fas fa-user"></i></label>
    <input type="text" name="name" id="name" placeholder="Name" required/>
    <p></p>
    </div>   
    <div>
    <label id="icon" for="email"><i class="fas fa-envelope"></i></label>
    <input type="text" name="email" id="email" placeholder="Email" required/>
    <p></p>
    </div>
    
    <div>
      <label id="icon" for="phone"><i class="fas fa-user"></i></label>
      <input type="text" name="phone" id="phone" placeholder="phone" required/>
      <p></p>
    </div>
    
    <div>
     <label id="icon" for="password"><i class="fas fa-unlock-alt"></i></label>
    <input type="password" name="password" id="password" placeholder="Password" required/>
    <p></p> 
    </div>

    <label id="icon" for="password_confirmation"><i class="fas fa-unlock-alt"></i></label>
    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="password confirmation"required/>
    <p></p>
    <hr>
    <div class="text-center small"><a href="{{route('home.front')}}"><i class="fa-solid fa-house" style="font-size: 20px;"></i></a> Already have an account? <a href="{{ route('login.user') }}">login</a></div>
    <div class="btn-block">
      <button type="submit">Submit</button>
    </div>
    </form>
@endsection

@section('script')

  <script>
       $("#registrationFrom").submit(function(event) {
    event.preventDefault();
    var element = $(this);
    $("button[type=submit]").prop('disabled',true); 
    $.ajax({
        url: "{{ route('processRegister.user') }}",
        type: 'post',
        data: element.serializeArray(),
        datatype: 'json',
        success: function(response) {
            $("button[type=submit]").prop('disabled',false); 
            if (response["status"] == true) {

                window.location.href="{{route('login.user')}}";
                
                $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $("#phone").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
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

                if (errors['email']) {
                    $("#email").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['email']);
                } else {
                    $("#email").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                    }
                  //phone
                  if (errors['phone']) {
                    $("#phone").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['phone']);
                } else {
                    $("#phone").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                    }
                    //password
                    if (errors['password']) {
                    $("#password").addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['password']);
                } else {
                    $("#password").removeClass('is-invalid')
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


<script>
$(document).ready(function() {
    $('#phone').on('input', function() {
        var phoneValue = $(this).val();
        var errorMessage = $(this).siblings('p');

        if (phoneValue.length < 11 || phoneValue.length > 16) {
            errorMessage.text('Phone number must be between 11 and 16 digits.');
            errorMessage.addClass('invalid-feedback');
            $(this).addClass('is-invalid');
        } else {
            errorMessage.text('');
            errorMessage.removeClass('invalid-feedback');
            $(this).removeClass('is-invalid').addClass('is-valid');
        }
    });
});
</script>

<style>
.invalid-feedback {
    color: red;
}

.is-invalid {
    border-color: red;
}

.is-valid {
    border-color: green;
}
</style>
@endsection
   