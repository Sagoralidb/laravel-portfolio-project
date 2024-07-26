@extends('profile.frontend.layout')
@section('title','Single Portfolio')
@section('customCss')
    {{--Custom css  --}}
@endsection

    @section('topMenu')
        @include('profile.frontend.common-menu')
    @endsection
    @if (! empty($portfolioData))
        @section('content')

        @section('slider')
                <!--  Page Title -->
            <div class="page-title" data-aos="fade">
                <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Portfolio Details</h1>
                <nav class="breadcrumbs">
                    <ol>
                    <li><a href="{{route('home.front')}}">Home</a></li>
                    <li class="current">Portfolio Details</li>
                    </ol>
                </nav>
                </div>
            </div><!-- End Page Title -->
            <!-- Page Slider -->
        <section id="portfolio-details" class="portfolio-details section">

            <div class="container" data-aos="fade-up">
    
                <div class="portfolio-details-slider swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 600,
                        "autoplay": {
                            "delay": 5000
                        },
                        "slidesPerView": "auto",
                        "navigation": {
                            "nextEl": ".swiper-button-next",
                            "prevEl": ".swiper-button-prev"
                        },
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        }
                    }
                    </script>
                    <div class="swiper-wrapper align-items-center">
                        @foreach($portfolioData->images as $image)
                            <div class="swiper-slide">
                                <img src="{{$image->imagess ? url('storage/'.$image->images) : asset('frontend-assets/img/portfolio/app-1.jpg') }}" alt="" height="520px">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-pagination"></div>
                </div>
                
    
            <div class="row justify-content-between gy-4 mt-4">
    
                <div class="col-lg-8" data-aos="fade-up">
                <div class="portfolio-description">
                    <h2>{!! $portfolioData->title ? $portfolioData->title: 'Dumy Title' !!}</h2>
                    <i class="bi bi-quote quote-icon-left"></i>
                    <p style="text-align: justify;">{!!$portfolioData->short_description ? $portfolioData->short_description: 'Dumy Short descripton' !!}</p>
                    <i class="bi bi-quote quote-icon-right"></i>
                    <p style="text-align: justify;">{!!$portfolioData->description ? $portfolioData->description: 'Dumy descripton' !!}</p>
    
                    <div class="testimonial-item">
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    <div>
                        <img src="{{asset('adminLogin-assets/img/sagor-login image.jpg')}}" class="testimonial-img" alt="">
                        <h3>Md.Sagor Ali</h3>
                        <h4>Developer</h4>
                    </div>
                    </div>
    
                </div>
                </div>
    
                <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="portfolio-info">
                    <h3>Project information</h3>
                    <ul>
                    <li><strong>Category</strong> {{$portfolioData->category ? $portfolioData->category->name:'Defalut'}}</li>
                    <li><strong>Client</strong> {{$portfolioData->clint ? $portfolioData->clint:'N/A' }}</li>
                    <li><strong>Project date</strong> {{ \Carbon\Carbon::parse($portfolioData->created_at)->format('d F, Y h:i:s A') }}</li>
                    <li>
                        <a href="{{ $portfolioData->project_url ? $portfolioData->project_url : '#' }}" target="_blank">
                            {{ $portfolioData->project_url ? $portfolioData->project_url : 'N/A' }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ $portfolioData->project_url ? $portfolioData->project_url : '#' }}" class="btn-visit align-self-start" target="_blank">
                            Visit Website
                        </a>
                    </li>
                    </ul>
                </div>
                </div>
    
            </div>
    
            </div>
    
        </section><!-- /Portfolio Details Section -->
        @endsection


    @endsection

@else
    
@endif


@section('script')
    {{--custom js--}}
@endsection