

    @if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="icon fa fa-ban"></i> Error ! {{ Session::get('error') }}
        
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="icon fa fa-check"></i> Success! {{ Session::get('success') }}
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
