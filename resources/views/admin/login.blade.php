<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Admin Login</title>
        {{-- <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'> --}}
        <link href='{{asset('common-assets/bootstrap.min.css')}}' rel='stylesheet'>
        <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
        
         <script type='text/javascript' src='{{asset('common-assets/jquery-3.5.1.min.js')}}'></script>
        <link href='{{asset('adminLogin-assets/login-style.css')}}' rel='stylesheet'>
    </head>
    <body>
        <div class="wrapper">
            <div class="logo">
                <img src="{{asset('adminLogin-assets/img/sagor-login image.jpg')}}" alt="User">
            </div>
            <div class="text-center mt-4 name">
               w3techbd
            </div>
                @include('profile.alert.messages')
                <form class="p-3 mt-3" method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="form-field d-flex align-items-center">
                        <span class="far fa-user"></span>
                        <input type="text" name="email" id="email" placeholder="Email" required value="{{ old('email') }}">
                    </div>
                    @if ($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    <div class="form-field d-flex align-items-center">
                        <span class="fas fa-key"></span>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        @if ($errors->has('password'))
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <button class="btn mt-3">Login</button>
                </form>
                <div class="text-center fs-6">
                    {{-- <a href="#">Forget password?</a> --}}
                </div>
        </div>
        {{-- <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script> --}}
        <script src='{{asset('common-assets/bootstrap.bundle.min.js')}}'></script>
        <script>
            var myLink = document.querySelector('a[href="#"]');
            myLink.addEventListener('click', function(e) {
                e.preventDefault();
            });
        </script>
    </body>
</html>
