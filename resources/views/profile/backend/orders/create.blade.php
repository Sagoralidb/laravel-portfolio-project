@extends('profile.backend.layout')

@section('title','Order Create')

@section('css')



@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2 ">
        
        <div class="row mb-2">
            
            <div class="col-sm-6 mt-3">
                <h1>Orders create</h1>
            </div>
            <div class="col-sm-6 text-right mt-3">
                <a href="{{route('order.list')}}" class="btn btn-primary">Back</a>
            </div>
            <div>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Order : Create</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        @include('profile.alert.messages')
        <div class="card">          
            <div class="card-body table-responsive p-0">	
                <div class=" container card mb-4">
                    <div class="row">
                      <span class="btn btn-primary text-light text-center" id="newOrder">
                        <i class="fa-solid fa-plus text-light"></i> Create New Order</span>
                    </div>  
                    @if (! empty($users)) 
                    <form action="{{route('customerOrder.store')}}" method="post" id="orderForm" style="display: none">
                      @csrf
                      @method('POST')
                        
                        <div class="row mt-3">
                          <div class="col-sm-3">
                              <label for="" class="mb-0">Select User *</label>
                          </div>
                          <div class="col-sm-9"> 
                            <select name="user_id" id="user_id" class="form-control select2" style="width: 20%">
                                <option value="" disabled>Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"> {{ $user->id }}-{{ $user->name }}</option>  
                                @endforeach
                            </select>
                            <p id="user_idError" class="text-danger"></p>
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-sm-3">
                              <label for="" class="mb-0">Order Title *</label>
                          </div>
                          <div class="col-sm-9"> 
                            <input type="text" name="title" id="title" class="form-control" placeholder="">
                            <p id="titleError" class="text-danger"></p>
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-sm-3">
                              <label for="" class="mb-0">Order Details *</label>
                          </div>
                          <div class="col-sm-9"> 
                            <textarea name="description" id="description" cols="30" rows="5" class="summernote form-control" placeholder="Description"></textarea>
                            <p id="descriptionError" class="text-danger"></p> 
                          </div>            
                          <hr class="mt-2">
                          <div class="row mt-3">
                            <div class="col-sm-3">
                                <label for="" class="mb-0">Budget (Optional)</label>
                            </div>
                            <div class="col-sm-9"> 
                              <input type="text" name="budget" id="budget" class="form-control" placeholder="">
                              <p id="titleError" class="text-danger"></p>
                            </div>
                          </div>
                          <hr class="mt-2">
                          <button type="submit" class="btn btn-outline-primary" style="float: right;">Submit Order</button>
                        </div> 
                    </form>
                    @else
                        <h4 class="text-center text-danger">At first create the user</h4>
                    @endif  
                </div> 
            </div>  
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection
    @section('scripts')
    <script>
        $("#orderForm").submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $("button[type=submit]").prop('disabled', true);
      
            $.ajax({
                url: "{{ route('customerOrder.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response.status) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = "{{ route('order.list') }}";
                        }, 3000);
                    } else {
                        var errors = response.errors;
                        $.each(errors, function(key, value) {
                            $("#" + key).addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(value);
                        });
                        toastr.error('Please fix those errors & try again.');
                    }
                },
                error: function(jqXHR, exception) {
                    $("button[type=submit]").prop('disabled', false);
                    toastr.error("Something went wrong, please refresh and try again");
                }
            });
        });
      </script>
      <script>
        $(document).ready(function() {
          $('#newOrder').click(function() {
            $('#orderForm').slideToggle();
          });
        });
      </script>

    <!-- Include Select2 JS -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#user_id').select2();
        });
    </script>
    
    @endsection