@extends('profile.frontend.layout')
@section('title','Sagor Ali BD')
@section('customCss')
<style>
  #resume {
    background-color: rgba(209, 211, 214, 0.322); /* Adjust the RGBA values to set the transparency */
    border-color: rgb(255, 255, 255);
}
.marketplace {
    position: fixed;
    top: 100px;
    right: 10px;
    background-color: rgba(0, 0, 0, 0.7); /* Optional: Background color for better visibility */
    padding: 10px;
    border-radius: 5px;
    z-index: 1000; /* Ensure it's on top of other elements */
}

.marketplace a {
    display: block;
    color: #fff;
    text-decoration: none;
    margin-bottom: 5px;
}

.marketplace a:hover {
    text-decoration: underline;
}

.fab.fa-fiverr {
  background-image: url('/frontend-assets/img/fiverr-icon.png');
    display: inline-block;
    width: 1.2em;
    height: 1.2em;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
    font-size: inherit;
    text-indent: -9999px;
}

</style>

@endsection

@section('topMenu')
<div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

  <a href="{{route('home.front')}}" class="logo d-flex align-items-center">
    <!-- Uncomment the line below if you also wish to use an image logo -->
    <!-- <img src="assets/img/logo.png" alt=""> -->
    <h1 class="sitename">Portfolio</h1>
  </a>

  <nav id="navmenu" class="navmenu">
    <ul>
      <li><a href="#hero" class="active">Home<br></a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#portfolio">Portfolio</a></li>
      <li class="dropdown"><a href="#"><span>Features</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
        <ul>
          <li><a href="{{route('allService.front')}}">Services</a></li>
          <li class="dropdown"><a href="#"><span>Laravel Project</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Laravel project 1</a></li>
              <li><a href="#">Laravel project 2</a></li>
              <li><a href="#">Laravel project 3</a></li>
              <li><a href="#">Laravel project 4</a></li>
              <li><a href="#">Laravel project 5</a></li>
            </ul>
          </li>
          <li><a href="#">Dropdown 2</a></li>
          <li><a href="#">Dropdown 3</a></li>
          <li><a href="#">Dropdown 4</a></li>
        </ul>
      </li>
      <li><a href="#contact">Contact</a></li>
      
        <div>
          @if (Auth::guard('web')->check())
              <li><a href="{{ route('dashboard.user') }}">{{ Auth::guard('web')->user()->name }}</a></li>
          @else
              <li><a href="{{ route('login.user') }}">Login</a></li>
          @endif
      </div>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
  </nav>
</div>
@endsection

@section('slider')
<section id="hero" class="hero section">
  <img src="{{ ! empty($mains->bc_image) ? url('storage/'.$mains->bc_image):asset('frontend-assets/img/hero-img.jpg') }}" alt="" data-aos="fade-in">
<div class="container d-flex flex-column align-items-center justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
    <h2>I am {{ !empty($mains->title) ? $mains->title:'I am Mohammod' }}</h2>
    <p><span class="typed" data-typed-items="Web Developer, Laravel, Full stack developer, Freelancer,"></span> 
      <button class="btn btn-light btn-transparent" id="resume"> <a href="{{ !empty($mains->resume) ? url('storage/'.$mains->resume):''}}" class="text-light" target="_blank">Resume</a> </button><br>
      <p style="margin-top:15%; font-size:20px">{{ ! empty($mains->sub_title) ? $mains->sub_title :'I will develop your website'}}</p> 
  </p>
</div>
<div class="marketplace">
  <a href="https://github.com/Sagoralidb" target="_blank"><i class="fab fa-github fa-lg text-body"></i></a>
  <a href="https://www.linkedin.com/in/sagor-ali-bd-14a32b15a/" target="_blank"><i class="fab fa-linkedin-in text-info" style="font-size: .8em;margin-left:3px"></i></a>
  <a href="https://www.fiverr.com/sagoralibd" target="_blank"><i class="fab fa-fiverr text-info"></i></a>
</div>
<div class="social-container">
  <div class="social-toggle" onclick="toggleSocial()">
      <i class="fa-solid fa-bars"></i>
  </div>
  <div class="social">
          <a href="https://facebook.com/sagoralibd" class="social-icon" target="_blank" ><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.linkedin.com/in/sagor-ali-bd-14a32b15a/" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a>
          <a href="https://youtube.com/c/w3techbd" class="social-icon"><i class="fab fa-youtube" target="_blank"></i></a>
  </div>
</div>

</section>

@endsection
@section('content')
      <!-- About Section -->
      <section id="about" class="about section">
  
        <div class="container" data-aos="fade-up" data-aos-delay="100">
  
          <div class="row gy-4">
            <div class="col-md-6">
  
              <div class="row justify-content-between gy-4">
                <div class="col-lg-5">
                  <img src="{{ ! empty($mains->profile_picture) ? url('storage/'.$mains->profile_picture): asset('frontend-assets/img/sagor 600x600.jpg') }}" class="img-fluid" alt="" style="border: 2px solid #def">
                </div>
                <div class="col-lg-7 about-info">
                  <p><strong>Full Name: </strong> <span>{{ !empty($mains->full_name) ? $mains->full_name : 'Md.Sagor Ali' }}</span></p>
                  <p><strong>Profile: </strong> <span>{{ ! empty( $mains->profile )? $mains->profile: 'Laravel developer'}}</span></p>
                  <p><strong>Email: </strong> <span>{{! empty($mains->email) ? $mains->email: 'mdsagorali033@gmail.com'}}</span></p>
                  <p><strong>Phone: </strong> <span>{{! empty($mains->phone) ? $mains->phone: '+88 01537 298 343'}}</span></p>
                </div>
  
              </div>
  
              <div class="skills-content skills-animation">
  
                <h5>Skills</h5>
  
                <div class="progress">
                  <span class="skill"><span>HTML</span> <i class="val">100%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div><!-- End Skills Item -->
  
                <div class="progress">
                  <span class="skill"><span>CSS</span> <i class="val">90%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div><!-- End Skills Item -->
  
                <div class="progress">
                  <span class="skill"><span>JavaScript</span> <i class="val">75%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div><!-- End Skills Item -->
                <div class="progress">
                  <span class="skill"><span>Bootstrap</span> <i class="val">80%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div><!-- End Skills Item -->
                <div class="progress">
                  <span class="skill"><span>Photoshop</span> <i class="val">50%</i></span>
                  <div class="progress-bar-wrap">
                    <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <!-- End Skills Item -->
              </div>
  
            </div>
            <div class="col-md-6">
              <div class="about-me">
                <h4>About me</h4>
                <p style="text-align: justify">
                  {!!   !empty($mains->about_me) ? $mains->about_me: 'N/A'  !!}
                </p>
              </div>
            </div>
          </div>
  
        </div>
  
      </section><!-- /About Section -->
  
      <!-- Resume Section -->
      <section id="resume" class="resume section">
  
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Resume</h2>
          <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->
  
        <div class="container">
  
          <div class="row">
  
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <div class="resume-item">
                <h3 class="resume-title">Professional Training</h3>
                <h4>Web desing</h4>
                <h5>Janu 2019 - April 2019 (4 months)</h5>
                <p><em>Bangladesh Korean Technical Training Center-BKTTC-SEIP, Dhaka </em></p>
                <ul>
                  <li>Skills: HTML,CSS,Bootstrap,Javascript, PHP, Wordpress</li>
                  <li>Project: I was design a website as like as BANGLADESH NAVY</li>
                </ul>
                <h4>INDUSTRIAL TRAINING AT WEB DESIGN & DEVELOPMENT</h4>
                <h5>Janu 2018 - July 2019 (6 months)</h5>
                <p><em>Arks Institute of Technology & Science-AITS, Rajshahi </em></p>
                <ul>
                  <li>Skills:HTML,CSS,Bootstrap,Javascript, PHP, Wordpress</li>
                </ul>
              </div><!-- Edn Resume Item -->
  
              <h3 class="resume-title">Education</h3>
              <div class="resume-item">
                <h4>BSc in Computer Science and Engineering</h4>
                <h5>2012 - 2024</h5>
                <p><em> <a href="https://www.nbiu.edu.bd"></a> North bengal international university</em></p>
                <p>Qui deserunt veniam. Et sed aliquam labore tempore sed quisquam iusto autem sit. Ea vero voluptatum qui ut dignissimos deleniti nerada porti sand markend</p>
              </div><!-- Edn Resume Item -->
              <div class="resume-item">
                <h4>Diploma in Computer Technology</h4>
                <h5>2014 - 2017</h5>
                <p><em>Rajshahi Polytechnic Institute, Bangladesh</em></p>
                <p>Quia nobis sequi est occaecati aut. Repudiandae et iusto quae reiciendis et quis Eius vel ratione eius unde vitae rerum voluptates asperiores voluptatem Earum molestiae consequatur neque etlon sader mart dila</p>
              </div><!-- Edn Resume Item -->
              {{-- <h3 class="resume-title">Education</h3> --}}
              <div class="resume-item">
                <h4>SSC in Genarel Electrical</h4>
                <h5>2011 - 2012</h5>
                <p><em> <a href="#"></a> Rajshahi Technical School,UCEP</em></p>
                <p>Qui deserunt veniam. Et sed aliquam labore tempore sed quisquam iusto autem sit. Ea vero voluptatum qui ut dignissimos deleniti nerada porti sand markend</p>
              </div><!-- Edn Resume Item -->
  
            </div>
  
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
              
              <h3 class="resume-title">Work & Experince</h3>
              <div class="resume-item">
                <h4>Web developer</h4>
                <h5>1th Jan 2024  - Present ({{ $years }} years, {{ $months }} months, {{ $days }} days)</h5>
                <p><em><a href="https://webhostever.com/">Web Hostever</a>, Dhaka </em></p>
                <p>Project: I have develop so many website for the company. <a href="https://webhostever.com/">Web Hostever</a> </p>
                <ul>
                  <li>Website customize & development</li>
                  <li>Hosting Management</li>
                  <li>Customer support</li>
                </ul>
              </div><!-- Edn Resume Item -->
              <div class="resume-item">
                <h4>Computer Engineer</h4>
                <h5>10th July 2019  - 23 Janyary,2024</h5>
                <p><em>Theme omor plaza & <a href="www.topnews24online.com">Top new</a>, Rajshahi </em></p>
                <p>Project: I was setup a news media website with wordpress call <a href="www.topnews24online.com">TopNew</a> </p>
                <ul>
                  <li>Company webiste setup & Maintenance, Social media mantanence</li>
                  <li>Gooogle adsense setup & Maintenance, Facebook Monitaization</li>
                  <li>Basic graphics design,Video editing with premier pro, video posting, keyword resurch</li>
                  <li>Youtube Channel Created & Maintenance</li>
                  <li>Photography,Live video, Broadcast,Camera Person</li>
                </ul>
              </div><!-- Edn Resume Item -->
  
              <div class="resume-item">
                <h4>Computer Oparetor</h4>
                <h5>2017 - 2018</h5>
                <p><em>Mona Enterprise,Mohammadpur,Dhaka </em></p>
                <ul>
                  <li>Developed numerous marketing programs (logos, brochures,infographics, presentations, and advertisements).</li>
                  <li>Managed up to 5 projects or tasks at a given time while under pressure</li>
                  <li>Recommended and consulted with clients on the most appropriate graphic design</li>
                  <li>Created 4+ design presentations and proposals a month for clients and account managers</li>
                </ul>
              </div><!-- Edn Resume Item -->
  
            </div>
  
          </div>
  
        </div>
  
      </section><!-- /Resume Section -->
  
      <!-- Services Section -->
      <section id="services" class="services section">
  
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Services</h2>
          <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->
  
        <div class="container">
          <div class="row gy-4">
            @if (count($homeServices)>0)
              @foreach ($homeServices as $service )
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                  <div class="service-item  position-relative">
                    <div class="icon">
                      <i class="{{$service->icon}}"></i>
                    </div>
                    <a href="{{route('OpensinglePageService.front',$service->id)}}" class="stretched-link">
                      <h3>{!! \Illuminate\Support\Str::limit($service->title, 50) !!}</h3>
                    </a>
                    <p>{!! \Illuminate\Support\Str::limit($service->description ? $service->description:'',127) !!}</p>
                  </div>
              </div>
              @endforeach
            @else
              <h4 class="text-center text-danger"> Services are empty</h4>
            @endif
            <!-- End Service Item -->
          </div>
        </div>
  
      </section><!-- /Services Section -->
  
      <!-- Stats Section -->
      <section id="stats" class="stats section">
  
        <img src="{{asset('frontend-assets/img/stats-bg.jpg')}}" alt="" data-aos="fade-in">
  
        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
  
          <div class="row gy-4">
  
            <div class="col-lg-3 col-md-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="0" class="purecounter">50</span>
                <p>Clients</p>
              </div>
            </div><!-- End Stats Item -->
  
            <div class="col-lg-3 col-md-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="0" class="purecounter">50</span>
                <p>Projects</p>
              </div>
            </div><!-- End Stats Item -->
  
            <div class="col-lg-3 col-md-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="0" class="purecounter">500</span>
                <p>Hours Of Support</p>
              </div>
            </div><!-- End Stats Item -->
  
            <div class="col-lg-3 col-md-6">
              <div class="stats-item text-center w-100 h-100">
                <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="0" class="purecounter">10</span>
                <p>Awards</p>
              </div>
            </div><!-- End Stats Item -->
  
          </div>
  
        </div>
  
      </section><!-- /Stats Section -->
   <!-- Portfolio Section -->
<section id="portfolio" class="portfolio section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
      <h2>Portfolio</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
  </div><!-- End Section Title -->

  @if ($portfolioData->isNotEmpty())
  <div class="container">
      <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
          @if ($categories->isNotEmpty())
          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
              <li data-filter="*" class="filter-active">All</li>
              @foreach ($categories as $category)
              <li data-filter=".filter-{{ $category->slug }}">{{ $category->name }}</li>
              @endforeach
          </ul>
          @else
          <h4 class="text-center text-danger">Category not found</h4>
          @endif

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
              @foreach ($portfolioData as $post)
              <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $post->category->slug }}">
                  @if ($post->images->isNotEmpty())
                  <img src="{{ asset('storage/' . $post->images->first()->images) }}" style="height: 235px !important;" class="img-fluid" alt="{{ $post->title }}">
                  @else
                  <img src="{{ asset('frontend-assets/img/portfolio/default.jpg') }}" class="img-fluid" alt="Default Image">
                  @endif
                  <div class="portfolio-info">
                      <h4>{!! Illuminate\Support\Str::limit($post->title ? $post->title:'',20) !!}</h4>
                      <p>{!! Illuminate\Support\Str::limit($post->short_description ? $post->short_description:'',20 ) !!}</p>
                      <a href="{{ $post->images->isNotEmpty() ? asset('storage/' . $post->images->first()->images) : asset('frontend-assets/img/portfolio/default.jpg') }}" title="{{ $post->title }}" data-gallery="portfolio-gallery-{{ $post->category->slug }}" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                      <a href="{{route('portfolio-details.front',$post->id)}}" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                  </div>
              </div>
              @endforeach
          </div>
      </div>
  </div>
  @else
  <h4 class="text-center text-danger">Portfolio data is empty now</h4>
  @endif
</section><!-- /Portfolio Section -->

  
      <!-- Pricing Section -->
      <section id="pricing" class="pricing section">
  
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Pricing</h2>
          <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->
  
        <div class="container" data-aos="fade-up" data-aos-delay="100">
  
          <div class="row gy-4 gx-lg-5">
  
            <div class="col-lg-6">
              <div class="pricing-item d-flex justify-content-between">
                <h3>Basic Package</h3>
                <h4>$160.00</h4>
              </div>
            </div><!-- End Pricing Item -->
  
            <div class="col-lg-6">
              <div class="pricing-item d-flex justify-content-between">
                <h3>Silver Package</h3>
                <h4>$300.00</h4>
              </div>
            </div><!-- End Pricing Item -->
  
            <div class="col-lg-6">
              <div class="pricing-item d-flex justify-content-between">
                <h3>Golden Package</h3>
                <h4>$600.00</h4>
              </div>
            </div><!-- End Pricing Item -->
  
            <div class="col-lg-6">
              <div class="pricing-item d-flex justify-content-between">
                <h3>Diamond Package</h3>
                <h4>$1000.00</h4>
              </div>
            </div><!-- End Pricing Item -->
  
            <div class="col-lg-6">
              <div class="pricing-item d-flex justify-content-between">
                <h3>Platinum Package</h3>
                <h4>$2000.00</h4>
              </div>
            </div><!-- End Pricing Item -->
  
            <div class="col-lg-6">
              <div class="pricing-item d-flex justify-content-between">
                <h3>Mega Package</h3>
                <h4>$2000.00+</h4>
              </div>
            </div><!-- End Pricing Item -->
  
          </div>
  
        </div>
  
      </section><!-- /Pricing Section -->
  
      <!-- Faq Section -->
      <section id="faq" class="faq section">
  
        <div class="container">
  
          <div class="row gy-4">
  
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
              <div class="content px-xl-5">
                <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                </p>
              </div>
            </div>
  
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
  
              <div class="faq-container">
                <div class="faq-item faq-active">
                  <h3><span class="num">1.</span> <span>Non consectetur a erat nam at lectus urna duis?</span></h3>
                  <div class="faq-content">
                    <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.</p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->
  
                <div class="faq-item">
                  <h3><span class="num">2.</span> <span>Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?</span></h3>
                  <div class="faq-content">
                    <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->
  
                <div class="faq-item">
                  <h3><span class="num">3.</span> <span>Dolor sit amet consectetur adipiscing elit pellentesque?</span></h3>
                  <div class="faq-content">
                    <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis</p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->
  
                <div class="faq-item">
                  <h3><span class="num">4.</span> <span>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</span></h3>
                  <div class="faq-content">
                    <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->
  
                <div class="faq-item">
                  <h3><span class="num">5.</span> <span>Tempus quam pellentesque nec nam aliquam sem et tortor consequat?</span></h3>
                  <div class="faq-content">
                    <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in</p>
                  </div>
                  <i class="faq-toggle bi bi-chevron-right"></i>
                </div><!-- End Faq item-->
  
              </div>
  
            </div>
          </div>
  
        </div>
  
      </section><!-- /Faq Section -->
  
      <!-- Testimonials Section -->
      <section id="testimonials" class="testimonials section">
  
        <img src="{{asset('frontend-assets/img/testimonials-bg.jpg')}}" class="testimonials-bg" alt="">
  
        <div class="container" data-aos="fade-up" data-aos-delay="100">
  
          <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 600,
                "autoplay": {
                  "delay": 5000
                },
                "slidesPerView": "auto",
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": true
                }
              }
            </script>
            <div class="swiper-wrapper">
  
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <img src="{{asset('testimonial/Mostofa-1.jpg')}}" class="testimonial-img" alt="">
                  <h3>Mostofa Al Faisal</h3>
                  <h4>Ceo &amp; Founder</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</span>
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                </div>
              </div><!-- End testimonial item -->
  
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <img src="{{asset('frontend-assets/img/testimonials/testimonials-2.jpg')}}" class="testimonial-img" alt="">
                  <h3>Sara Wilsson</h3>
                  <h4>Designer</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                </div>
              </div><!-- End testimonial item -->
  
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <img src="{{asset('frontend-assets/img/testimonials/testimonials-3.jpg')}}" class="testimonial-img" alt="">
                  <h3>Jena Karlis</h3>
                  <h4>Store Owner</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                </div>
              </div><!-- End testimonial item -->
  
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <img src="{{asset('frontend-assets/img/testimonials/testimonials-4.jpg')}}" class="testimonial-img" alt="">
                  <h3>Matt Brandon</h3>
                  <h4>Freelancer</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</span>
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                </div>
              </div><!-- End testimonial item -->
  
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <img src="{{asset('frontend-assets/img/testimonials/testimonials-5.jpg')}}" class="testimonial-img" alt="">
                  <h3>John Larson</h3>
                  <h4>Entrepreneur</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.</span>
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                </div>
              </div><!-- End testimonial item -->
  
            </div>
            <div class="swiper-pagination"></div>
          </div>
  
        </div>
  
      </section><!-- /Testimonials Section -->
  
      <!-- Contact Section -->
      <section id="contact" class="contact section">
  
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Contact</h2>
          <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->
  
        <div class="container" data-aos="fade-up" data-aos-delay="100">
  
          <div class="info-wrap" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-5">
  
              <div class="col-lg-4">
                <div class="info-item d-flex align-items-center">
                  <i class="bi bi-geo-alt flex-shrink-0"></i>
                  <div>
                    <h3>Address</h3>
                    <p>C/O: MD.Somjan Ali;Bamnail, Jhikrapara, Godagari, Rajshahi.</p>
                  </div>
                </div>
              </div><!-- End Info Item -->
  
              <div class="col-lg-4">
                <div class="info-item d-flex align-items-center">
                  <i class="bi bi-telephone flex-shrink-0"></i>
                  <div>
                    <h3>Phone</h3>
                    <p>+880 1537 298 343</p>
                  </div>
                </div>
              </div><!-- End Info Item -->
  
              <div class="col-lg-4">
                <div class="info-item d-flex align-items-center">
                  <i class="bi bi-envelope flex-shrink-0"></i>
                  <div>
                    <h3>Email<br></h3>
                    <p>mdsagorali033@gmail.com</p>
                  </div>
                </div>
              </div><!-- End Info Item -->
  
            </div>
          </div>
  
          <form action="{{ route('contact.store') }}" method="post" class="php-email-form" id="contactForm" data-aos="fade-up" data-aos-delay="300">
            @csrf
            <div class="row gy-4">
                <div class="col-md-4">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-md-4">
                    <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>
                <div class="col-md-4">
                    <input type="phone" class="form-control" name="phone" placeholder="Your Phone" required>
                </div>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                </div>
                <div class="col-md-12">
                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                </div>
                <div class="col-md-12 text-center">
                    <div id="response-message"></div>
                    <button type="submit">Send Message</button>
                </div>
            </div>
        </form> 
        
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#contactForm').on('submit', function(e) {
                    e.preventDefault();
        
                    let formData = $(this).serialize();
                    $("button[type=submit]").prop('disabled',true);
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('contact.store') }}',
                        data: formData,
                        success: function(response) {
                          $("button[type=submit]").prop('disabled',false);
                            if(response.status) {
                                $('#response-message').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="icon fa fa-check"></i> Success! ' + response.message + '</div>');
                            } else {
                                $('#response-message').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="icon fa fa-ban"></i> Error! ' + response.message + '</div>');
                            }
        
                            // Alert messages will fade out after 5 seconds
                            setTimeout(function() {
                                $(".alert").alert('close');
                            }, 5000);
                        },
                        error: function(response) {
                            $('#response-message').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="icon fa fa-ban"></i> Error! Something went wrong.</div>');
        
                            // Alert messages will fade out after 10 seconds
                            setTimeout(function() {
                                $(".alert").alert('close');
                            }, 10000);
                        }
                    });
                });
            });
        </script>
              
  
        </div>
  
      </section><!-- /Contact Section -->
@endsection
@section('script')
     {{-- Social media icon toggle script has been used to layout --}}
    
@endsection