@extends('profile.backend.layout')
@section('title','Admin Dashboard')
@section('content')
 <div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4 text-center">
                <div class="card-body"><h4 class="text-center">Total User</h4></div>
                <h4 class="text-center">{{$totalUser ?: ''}}</h4>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('list.user')}}">View</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4 text-center">
                <div class="card-body"><h4 class="text-center">Total Clint</h4></div>
                <h4 class="text-center">{{$totalClint ?: ''}}</h4>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('list.user')}}">View</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body"><h4 class="text-center">Total Admin</h4></div>
                <h4 class="text-center">{{$totalAdmin ? : ''}}</h4>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('list.user')}}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body"><h4 class="text-center">Total Project</h4></div>
                <h4 class="text-center">{{$total_Portfolio_Project ? : ''}}</h4>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('list.portfolio')}}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body"><h4 class="text-center">Total Order</h4></div>
                <h4 class="text-center">{{$totalOrders ? :''}}</h4>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{route('order.list')}}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-md-6">
            <h1>Visitors Info</h1>
            <canvas id="visitorChart" width="400" height="200"></canvas>
        
            <script>
                const ctx = document.getElementById('visitorChart').getContext('2d');
                const visitorChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($dates), // তারিখগুলি
                        datasets: [{
                            label: 'Number of Visitors',
                            data: @json($visitorCounts), // ভিজিটর সংখ্যা
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                beginAtZero: true
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
    
   
    
</div>   
@endsection
@section('scripts')
    
@endsection

