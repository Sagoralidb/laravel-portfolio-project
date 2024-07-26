<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title','Home Page')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
  
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">
  
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
    <!-- Vendor CSS Files -->
    
    <link href="{{ asset('frontend-assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
     <link rel="stylesheet" href="{{asset('backend-assets/css/styles.css')}}">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('common-assets/summernote/summernote-bs4.min.css')}}">

     {{-- User Account CDN --}}
     <link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/user_account/style.css')}}?v=<?php echo rand(111,999); ?>" />
     {{-- User Account CDN end--}}
  <!-- Main CSS File -->
  <link href="{{asset('frontend-assets/css/main.css')}}" rel="stylesheet">
  <link href="{{asset('frontend-assets/css/custom-style.css')}}" rel="stylesheet">
   <link rel="stylesheet" href="{{asset('backend-assets/css/toastr.min.css')}}">
 @yield('customCss')

  </head>


<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
      @yield('topMenu')
  </header>
  
    @yield('slider')

  <main class="main">
    @yield('content')

  </main>

  <footer id="footer" class="footer">

    <div class="container">
      <div class="copyright text-center ">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">w3techbd</strong> <span>All Rights Reserved</span></p>
      </div>
      <div class="social-links d-flex justify-content-center">
        <a href="https://www.facebook.com/sagoralibd" target="_blank"><i class="bi bi-facebook"></i></a>
        <a href="https://www.linkedin.com/in/sagor-ali-bd-14a32b15a/" target="_blank"><i class="bi bi-linkedin"></i></a>
        <a href="#"><i class="bi bi-instagram"></i></a>
        <a href="#"><i class="bi bi-twitter-x"></i></a>
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
        Develop by <a href="https://www.linkedin.com/in/sagor-ali-bd-14a32b15a/"target="_blank">Sagor Ali BD</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('frontend-assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  {{-- <script src="{{asset('frontend-assets/vendor/php-email-form/validate.js')}}"></script> --}}
  <script src="{{asset('frontend-assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('frontend-assets/vendor/typed.js/typed.umd.js')}}"></script>
  <script src="{{asset('frontend-assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{asset('frontend-assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('frontend-assets/vendor/glightbox/js/glightbox.js')}}"></script>
  <script src="{{asset('frontend-assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('frontend-assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('frontend-assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{ asset('common-assets/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('backend-assets/plugins/popper/popper.min.js') }}"></script>
  <script src="{{ asset('common-assets/jquery-3.5.1.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
  <!-- Main JS File -->
  <script src="{{asset('frontend-assets/js/main.js')}}"></script>
  <script src="{{asset('backend-assets/js/toastr.min.js')}}"></script>
@yield('script')
<script>
  // Social media icon toggle
  function toggleSocial() {
      document.querySelector('.social-container').classList.toggle('active');
  }
</script>
<script>
  $(document).ready(function() {
      $('#description').summernote({
          height: 200,                 // set editor height
          minHeight: null,             // set minimum height of editor
          maxHeight: null,             // set maximum height of editor
          focus: true                  // set focus to editable area after initializing summernote
      });
  });
</script>
</body>

</html>