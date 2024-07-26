@extends('profile.frontend.layout')
@section('title','Single service page')
@section('customCss')
<link rel="stylesheet" href="{{asset('frontend-assets/css/rating.css')}}">

@endsection
@section('topMenu')
@include('profile.frontend.common-menu')
@endsection

@section('content') 

<div class="container-fluid">
    <h1 class="mt-4">Post Details</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('allService.front')}}">Service</a></li>
        <li class="breadcrumb-item active">Post</li>
    </ol>
    
  


@if (! empty($singleServicePost) )
     <div class="container mb-4">
        @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="icon fa fa-ban"></i> Error ! {{ Session::get('error') }}
        </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <i class="icon fa fa-check"></i> Success! {{ Session::get('success') }}
            </div>
        @endif
        <script>
            $(document).ready(function() {
                // Alert messages will fade out after 3 seconds (3000 milliseconds)
                setTimeout(function() {
                    $(".alert").alert('close');
                }, 5000);
            });
        </script>
        <div class=" card card-header">
            <h5><li class="{{$singleServicePost->icon ? $singleServicePost->icon : '' }}"></li>  {{ $singleServicePost->title ? $singleServicePost->title: ''  }}
                <small class="pt-1 "style="float: right;">( {{($totalReviews >1) ? $totalReviews.' Reviews':$totalReviews.' Review' }})</small>
                <div class="back-stars" style="float: right;">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    
                    <div class="front-stars" style="width: {{$avgRatingPercentage}}%">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                </div>
                
            </h5>
        </div>
        <div class="card" style="padding: 40px;">
            <p class=" text-justify" >{!! $singleServicePost->description ? $singleServicePost->description: '' !!}</p>
            <p style="text-align: right;"><strong>Posted At:</strong> {{ $singleServicePost->created_at->format('F d, Y ') }}</p>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist" style="float: right;">
                       
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
            </li>
        </ul>
           
        <div class="card-footer">
            <div class="col-md-12 mt-5">
                <div class="bg-light">
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab"  style="padding: 20px">
                            <div class="col-md-8">
                                <div class="row">
                                    @auth('web')
                                        @if (auth('web')->user()->user_type == 1 && auth('web')->user()->status == 1)
                                            <h5 class="text-success mb-4">Dear client, thank you for your interest!</h5>
                                           
                                            <form action="{{ route('saveRating.user', $singleServicePost->id) }}" name="ProductRatingForm" id="ProductRatingForm" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ auth('web')->user()->id }}">
                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" readonly value="{{auth('web')->user()->name }}" id="name" placeholder="Name">
                                                  
                                                </div>
                                                <div class="form-group col-md-6 mb-3">
                                                    <label for="name">Email</label>
                                                    <input type="text" class="form-control" readonly value="{{auth('web')->user()->email }}" id="name" placeholder="Name">
                                                  
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="rating">Rating</label>
                                                    <br>
                                                    <div class="rating" style="width: 10rem">
                                                        <input id="rating-5" type="radio" name="rating" value="5"/><label for="rating-5"><i class="fas fa-3x fa-star"></i></label>
                                                        <input id="rating-4" type="radio" name="rating" value="4"/><label for="rating-4"><i class="fas fa-3x fa-star"></i></label>
                                                        <input id="rating-3" type="radio" name="rating" value="3"/><label for="rating-3"><i class="fas fa-3x fa-star"></i></label>
                                                        <input id="rating-2" type="radio" name="rating" value="2"/><label for="rating-2"><i class="fas fa-3x fa-star"></i></label>
                                                        <input id="rating-1" type="radio" name="rating" value="1"/><label for="rating-1"><i class="fas fa-3x fa-star"></i></label>
                                                    </div>
                                                    <p class="service-rating-error text-danger"></p>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="comment">How was your overall experience? Max character:1000</label>
                                                    <textarea name="comment" id="comment" class="form-control" cols="30" rows="10" placeholder="How was your overall experience?"></textarea>
                                                    <p class="invalid-feedback"></p>
                                                </div>
                                                <div>
                                                    <button class="btn btn-dark">Submit</button>
                                                </div>
                                            </form>
                                            
                                            
                                        @else
                                            <h5>Hello, {{ auth('web')->user()->name }}, <strong class="text-danger">Only clients can submit reviews.</strong>
                                                If you want to be our client, please contact us.
                                            </h5>
                                        @endif
                                    @else
                                        <p class="text-danger">
                                            <strong>Hello Client,</strong> You must login to submit a review.
                                        </p>
                                        <p class="text-danger">
                                            <strong>Note:</strong> Only verified clients can use the review form.
                                        </p>
                                    @endauth


                                </div>
                            </div>
                            <div class="col-md-12 mt-5">
                                <div class="overall-rating mb-3">
                                    <div class="d-flex">
                                        <h1 class="h3 pe-3">{{$averageRating }}</h1>
                                        <div class="star-rating mt-2" title="">
                                            <div class="back-stars">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                
                                                <div class="front-stars" style="width: {{$avgRatingPercentage}}%">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="pt-2 ps-2">({{($totalReviews >1) ? $totalReviews.' Reviews':$totalReviews.' Review' }})</div>
                                    </div>
                                    
                                </div>
                               
                                @if ($reviews->isNotEmpty())
                                    
                                   @foreach ($reviews  as $rating)
                                       @php
                                           $ratingPercentage = ($rating->rating*100)/5;
                                       @endphp
                                   
                                      <div class="rating-group mb-4">
                                        <span> Clint : <strong>{{$rating->user->name}}</strong></span>
                                        <div class="star-rating mt-2" title="">
                                            <div class="back-stars">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                
                                                <div class="front-stars" style="width: {{$ratingPercentage}}%">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="my-3">
                                            <p>{{$rating->comment}}</p>
                                        </div>
                                    </div>  
                                    @endforeach 
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
@else
    <h4 class="text-center text-danger"> >>No post found<< </h4>
@endif
   
</div> 
 
@endsection
@section('script')

<script type="text/javascript">$("#ProductRatingForm").submit(function(event) {
    event.preventDefault();
    $.ajax({
        url: '{{ route('saveRating.user', $singleServicePost->id) }}',
        type: 'POST',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response) {
            var errors = response.errors;
            if (response.status == false) {
                if (errors.comment) {
                    $("#comment").addClass('is-invalid').siblings('p.invalid-feedback').html(errors.comment);
                } else {
                    $("#comment").removeClass('is-invalid').siblings('p.invalid-feedback').html("");
                }
                if (errors.rating) {
                    $(".service-rating-error").html(errors.rating);
                } else {
                    $(".service-rating-error").html('');
                }
            } else {
                window.location.href = "{{ route('OpensinglePageService.front', $singleServicePost->id) }}";
            }
        }
    });
});

</script>
@endsection
