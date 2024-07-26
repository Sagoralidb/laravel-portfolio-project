@extends('profile.backend.layout')
@section('title','Admin Dashboard')
@section('content')
 <div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Visitor: Visitor history</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <h4>Total Unique Visitors: {{ $totalVisitors }}</h4>
            </div>
    
            @if ($visitors->count())
                <table class="table-bordered">
                    <thead>
                        <tr>
                            <th>IP Address</th>
                            <th>User Agent</th>
                            <th>URL</th>
                            <th>Visited At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($visitors as $visitor)
                            <tr>
                                <td>{{ $visitor->ip_address }}</td>
                                <td>{{ $visitor->user_agent }}</td>
                                <td>{{ $visitor->url }}</td>
                                <td>{{ $visitor->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $visitors->links() }} <!-- Pagination links -->
                </div>
            @else
                <h4 class="text-center text-danger">No visitor data found</h4>
            @endif
    
            <div class="mt-4">
                <h5>Daily Unique Visitor Counts for the Last Month</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Unique Visitors</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dates as $index => $date)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</td>
                                <td>{{ $visitorCounts[$index] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    

    
</div>   
@endsection
@section('scripts')
    
@endsection

