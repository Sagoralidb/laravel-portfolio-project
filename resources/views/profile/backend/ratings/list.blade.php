@extends('profile.backend.layout')
@section('title', 'Admin Dashboard')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Rating : Clint Reviews & Ratings</li>
    </ol>
    <div id="status-message"></div> <!-- For displaying session messages -->
    <div class="row">
        <div class="col-md-12">
            @if (! empty($ratings))
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr class="table-success">
                        <th>Id</th>
                        <th>Name</th>
                        <th>Service Title</th>
                        <th>Comment</th>
                        <th>Ratings</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ratings as $rating)
                        <tr>
                            <td>{{ $rating->id }}</td>
                            <td>{{ $rating->user->name }}</td>
                            <td>{{ $rating->service ? $rating->service->title : 'N/A' }}</td>
                            <td>{{ $rating->comment }}</td>
                            <td>{{ $rating->rating }}</td>
                            <td>{{ $rating->created_at->format('d M, Y h:i A') }}</td>
                            <td class="text-center">
                                @if ($rating->status == 1)
                                    <i class="btn btn-hover btn-light fa-regular fa-circle-check text-success status-toggle" 
                                       data-id="{{ $rating->id }}" 
                                       data-status="0" 
                                       title="Click to deactivate"></i>
                                @else
                                    <i class="btn btn-hover btn-light fa-solid fa-circle-xmark text-danger status-toggle" 
                                       data-id="{{ $rating->id }}" 
                                       data-status="1" 
                                       title="Click to activate"></i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                {{ $ratings->links() }}
            </div>
            @else
                <h4 class="text-center text-danger">No visitor data found</h4>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.status-toggle').on('click', function() {
        var icon = $(this);
        var id = icon.data('id');
        var newStatus = icon.data('status');

        if (confirm('Are you sure you want to change the status?')) {
            $.ajax({
                url: '/update-status/' + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: newStatus
                },
                success: function(response) {
                    if (response.success) {
                        if (newStatus == 1) {
                            icon.removeClass('fa-circle-xmark text-danger').addClass('fa-circle-check text-success');
                            icon.data('status', 1);
                        } else {
                            icon.removeClass('fa-circle-check text-success').addClass('fa-circle-xmark text-danger');
                            icon.data('status', 0);
                        }
                        // Show success message
                        $('#status-message').html('<div class="alert alert-success">' + response.message + '</div>');
                        
                        // Reload page after 3 seconds
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else {
                        // Show error message
                        $('#status-message').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function() {
                    // Show error message
                    $('#status-message').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                }
            });
        }
    });
});
</script>
@endsection
