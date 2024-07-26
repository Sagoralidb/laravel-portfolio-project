@extends('profile.frontend.layout')
@section('title','All Services')

@section('customCss')  

@endsection

@section('topMenu')
 @include('profile.frontend.common-menu')
@endsection


@section('content')


<div class="container">
    <h1 class="mt-4">Post Details</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.front')}}">Home</a></li>
        <li class="breadcrumb-item active">Services</li>
    </ol>
    <div class="row mt-5">
        @if (count($homeServices)>0)
            @foreach ($homeServices as $service )
              <div class="card border-dark mb-3 col-md-4 mt-3" style="max-width: 18rem; margin-left:10px;">
                <div class="card-header">
                    <div class="icon">
                        <i class="{{$service->icon}}"></i>
                    </div>
                </div>
                <div class="card-body text-dark">
                 <h5 class="card-title"> <a href="{{route('OpensinglePageService.front',$service->id)}}"> {!! \Illuminate\Support\Str::limit($service->title, 50) !!} </a> </h5>
                 <p class="card-text">{!! \Illuminate\Support\Str::limit($service->description ? $service->description:'',127) !!}</p>
                </div>
              </div>
          @endforeach
          <div class="row justify-content-center mt-0">
            <span>{{$homeServices->links() }}</span>
        </div>
        @else
        <h4 class="text-center text-danger"> Services are empty</h4>
        @endif
    </div>
  </div>

@endsection

@section('script')   
@endsection