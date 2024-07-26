@extends('profile.frontend.layout')
@section('title','User Dashboard')
@section('customCss')

@endsection

@section('content')
    @section('topMenu')
        @include('profile.frontend.common-menu')
    @endsection
<section style="background-color: #eee;">
  @include('profile.alert.messages')
    <div class="container">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{route('home.front')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="#">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>
        </div>
      </div>
  
      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              
              <img id="imagePreview" src="{{ auth('web')->user()->image ? url('storage/' . auth('web')->user()->image) : asset('frontend-assets/img/userProfile-default.webp') }}" 
              class="rounded-circle img-fluid" style="width: 150px; margin-top: 10px;">

              <h5 class="my-3">{{ auth('web')->user()->name}}</h5>
              <p class="text-muted mb-1">Email :{{auth('web')->user()->email}}</p>
              <p class="text-muted mb-4">Phone: {{ (auth('web')->user()->phone) ? (auth('web')->user()->phone) : 'N/A' }}</p>
              <div class="d-flex justify-content-center mb-2">
                <form id="logout-form" action="{{ route('logout.user') }}" method="POST" style="display: none;">
                    @csrf
                    </form>
                <button  type="submit" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger">Logout</button>
                
              </div>
            </div>
          </div>
          <div class="card mb-4 mb-lg-0">
            <div class="card-body p-0">
              @if ($getCustomerPaymentDetails->where('user_id',auth('web')->user()->id)->isNotEmpty())
             
              @foreach ( $getCustomerPaymentDetails->where('user_id',auth('web')->user()->id) as $payInfo)

              <ul class="list-group list-group-flush rounded-3">
                <li class="btn btn-info list-group-item d-flex justify-content-between align-items-center p-3" id="pay{{$payInfo->id}}">
                    <i class="fa-solid fa-dollar-sign text-success"></i>Order #{{$payInfo->order_id}}
                    <p class="mb-0">Payment No#{{$payInfo->id}}</p>
                </li>
                <div class="" id="PayDetails{{$payInfo->id}}" style="display: none; padding:10px">
                    Order #{{$payInfo->order_id}}<br>
                    Payment Type: {{$payInfo->payment_type ? $payInfo->payment_type:'0' }}<br>
                    Project Cost = {{$payInfo->project_cost ? $payInfo->project_cost:'0' }}/-<br>
                    Avance Amount = {{$payInfo->amount ? $payInfo->amount:'0' }}/-<br>
                    <hr>
                    Due = {{($payInfo->project_cost)-($payInfo->amount)}}/-<br>
                </div>
            </ul>
            @endforeach
            @else
              <div style="padding: 10px 10px">
                <h5 class="text-center text-danger">Payment is Empty</h5>
              </div>
           @endif

            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class=" container card mb-4">
            <div class="row">
              <span class="btn btn-primary text-light text-center" id="newOrder">
                <i class="fa-solid fa-plus text-light"></i> Create New Order</span>
            </div>         
            <form action="{{route('customerOrder.store')}}" method="post" id="orderForm" style="display: none">
              @csrf
              @method('POST')
              <input type="hidden" name="user_id" value="{{ auth('web')->user()->id}}">
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
                  <button type="submit" class="btn btn-outline-primary" style="float: right; margin:10px;">Submit Order</button>
                </div> 
            </form>

            <div class="row mt-2">
              <span class="btn btn-success text-center" id="openPayment"><i class="fa-solid fa-dollar-sign"></i> Payment</span>
            </div>

            <div class="" id="payfields" name="payfields" style="display: none;">
              @if ($getCustomerOrder->where('user_id', auth('web')->user()->id)->isNotEmpty() )
            <form action="{{route('customerPayment.store')}}" id="payForm" name="payForm" > 
                @csrf
                @method('post') 
                <div class="row bg-warning">
                    <div class="col-sm-3 text-center ">
                      <label for="">Your Order</label>
                      <input type="hidden" name="user_id" value="{{auth('web')->user()->id}}">
                      
                        <select name="order_id" id="order_id" class="form-control">
                          @foreach ($getCustomerOrder->where('user_id', auth('web')->user()->id) as $orderInfo )
                             <option value="{{$orderInfo->id}}">{{$orderInfo->title}}</option>
                          @endforeach  
                         
                        </select>
                      
                      <p id="order_idError" class="text-danger"></p> 
                    </div>

                    <div class="col-sm-3 text-center ">
                      <label for="">Project Cost(Tk)</label>
                      <div>
                        <input type="text" name="project_cost" id="project_cost" class="form-control">
                        <p id="project_costError" class="text-danger"></p> 
                      </div>
                     
                    </div>
                    <div class="col-sm-3 text-center">
                      <label for="">Payment type</label>
                      <div>
                        <select name="payment_type" id="payment_type" class="form-control text-center">
                            <option value="advance">Adnace</option>
                            <option value="final">Full</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-3 text-center ">
                      <label for="">Amount(Tk)</label>
                      <div>
                        <input type="text" name="amount" id="amount" class="form-control">
                        <p id="amountError" class="text-danger"></p> 
                      </div>
                     
                    </div>
                    
                    <div class="col-sm-3 text-center">
                      <label for="">Payment Method</label>
                      <div>
                        <select name="pay_method" id="pay_method" class="form-control text-center">
                          <option value="bkash">Bkash</option>
                          <option value="nagod">Nagod</option>
                          <option value="rocket">Rocket</option>
                          <option value="other">Others</option>
                        </select>
                      </div>
                      <p id="pay_methodError" class="text-danger"></p> 
                    </div>
                    <div class="col-sm-3 ml-3 text-center">
                      <label for="">Transaction id</label>
                      <div class="mb-2">
                        <input type="text" name="tranjection_id" id="tranjection_id" class="form-control text-center"
                        placeholder="0177xxxxxx">
                        <p id="tranjection_idError" class="text-danger"></p> 
                      </div>
                     
                    </div>   
                    <div class="col-sm-6 ml-3 text-center">
                      <label for="">Transaction id</label>
                      <div class="mb-2">
                        <input type="file" name="pay_slip" id="pay_slip" class="form-control">
                        <p id="pay_slipError" class="text-danger"></p> 
                      </div>
                     
                    </div>       
                      <button type="submit" class="form-control btn-success">Send</button>
                  </div> 
             </form>
             @else
                 <h4 class="text-center text-danger">You didn't create any order. Please order first</h4>
              @endif
            </div>       
          </div>

          <div class="container card">
            <div class="row">
              <span class="btn btn-info text-center" id="settings"><i class="fa-solid fa-gear"></i> Profile Setting</span>
            </div>
            <form action="{{ route('updateUserDashboard.front', auth('web')->user()->id) }}" method="POST" name="userForm" id="userForm" enctype="multipart/form-data" style="display: none;">
              @csrf
              @method('PUT')
              <div class="card-body">
                  <div class="row">
                      <div class="col-sm-3">
                          <p class="mb-0">Full Name</p>
                      </div>
                      <div class="col-sm-9">
                          <p class="text-muted mb-0"><input type="text" value="{{auth('web')->user()->name}}" name="name" id="name" class="form-control"></p>
                      </div>
                  </div>
                  <hr>
                  <div class="row">
                      <div class="col-sm-3">
                          <p class="mb-0">Email</p>
                      </div>
                      <div class="col-sm-9">
                          <p class="text-muted mb-0"><input type="email" value="{{auth('web')->user()->email}}" name="email" id="email" class="form-control"></p>
                      </div>
                  </div>
                  <hr>
                  <div class="row">
                      <div class="col-sm-3">
                          <p class="mb-0">Profile Picture</p>
                      </div>
                      <div class="col-sm-9">
                          <input type="file" name="image" id="image" class="form-control">
                      </div>
                  </div>
                  <hr>
                  <div class="row">
                      <div class="col-sm-3">
                          <p class="mb-0">Mobile</p>
                      </div>
                      <div class="col-sm-9">
                          <p class="text-muted mb-0"><input type="phone" value="{{auth('web')->user()->phone}}" name="phone" id="phone" class="form-control"></p>
                      </div>
                  </div>
                  <hr>
                  <div class="row">
                      <div class="col-sm-3">
                          <p class="mb-0">Address</p>
                      </div>
                      <div class="col-sm-9">
                          <p class="text-muted mb-0">
                              <textarea name="address" id="address" cols="30" rows="5" 
                              class="form-control">{{auth('web')->user()->address ?? ''}}</textarea>
                          </p>
                      </div>
                  </div>
                  <hr>
              </div>
              <button type="submit" class="btn btn-outline-primary" style="float: right; margin:10px;">Update</button>
          </form>
            
          </div>
          <div class="row mt-2">
            <div class="col-md-12">
              <div class="card mb-4 mb-md-0">
                <div class="card-body">
                  <h4 class="text-center">Your Orders list <i class="fa-solid fa-arrow-turn-down"></i></h4>
                  @if ($getCustomerOrder->where('user_id', auth('web')->user()->id)->isNotEmpty() )
                  <div>
                    @foreach ($getCustomerOrder->where('user_id', auth('web')->user()->id) as $order)
                    <div class="row mt-2">
                      <span class="btn btn-secondary text-center order-toggle" data-order-id="{{$order->id}}">Order#{{$order->id}}
                        @if ($order->status == 'in_review')
                        <button class="btn btn-secondary text-warning">In Review</button>
                            @elseif($order->status == 'approved')
                        <button class="btn btn-success">Approved</button>
                            @elseif($order->status == 'progress')
                        <button class="btn btn-warning">Progress</button>
                            @elseif($order->status == 'rejected')
                        <button class="btn btn-danger">Rejected</button>
                            @elseif($order->status == 'completed')
                        <button class="btn btn-success">Completed</button>
                            @endif
                    </span>
                      </div>
                      <div class="order-details" data-order-id="{{$order->id}}" style="display:none;">
                        <div class="row">
                          
                            <div class="col-md-4 text-info">Title: {{$order->title}}</div>
                            <div class="col-md-4">Create:{{$order->created_at}}</div>
                            <div class="col-md-4 mt-2">Status: 
                              @if ($order->status == 'in_review')
                                  <button class="btn btn-secondary">In Review</button>
                              @elseif($order->status == 'approved')
                                  <button class="btn btn-success">Approved</button>
                              @elseif($order->status == 'progress')
                                  <button class="btn btn-warning">In Progress</button>
                              @elseif($order->status == 'rejected')
                                  <button class="btn btn-danger">Rejected</button>
                              @elseif($order->status == 'completed')
                                  <button class="btn btn-success">Completed</button>
                              @endif
                          </div>                          
                         
                          <p>{!! $order->description  !!}</p>
                        </div>
                    </div>
                    @endforeach
                  </div>
                  
                  @else
                    <div class="text-center text-danger">You didn't make any order</div>
                  @endif

                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
@section('script')
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
                      window.location.href = "{{ route('dashboard.user') }}";
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
    $("#userForm").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $("button[type=submit]").prop('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST', // POST method will be used but with @method('PUT') it will be treated as PUT
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response["status"] == true) {
                    toastr.success(response.message);
                    setTimeout(function() {
                        window.location.href = "{{ route('dashboard.user') }}";
                    }, 3000);
                } else {
                    var errors = response['errors'];
                    $.each(errors, function(key, value) {
                        $("#" + key).addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(value);
                    });
                    toastr.error('Please fix those errors & try again.');
                }
            },
            error: function(jqXHR, exception) {
                toastr.error("Something is wrong, Refresh and try again");
            }
        });
    });
    // image manage
    $("#image").change(function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    // optional button active 

</script>
<script>
  $("#payForm").submit(function(event) {
      event.preventDefault();
      var formData = new FormData(this);
      $("button[type=submit]").prop('disabled', true);

      $.ajax({
          url: $(this).attr('action'),
          type: 'POST', 
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
              $("button[type=submit]").prop('disabled', false);
              if (response["status"] == true) {
                  toastr.success(response.message);
                  setTimeout(function() {
                      window.location.href = "{{ route('dashboard.user') }}";
                  }, 3000);
              } else {
                  var errors = response['errors'];
                  $.each(errors, function(key, value) {
                      $("#" + key).addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(value);
                  });
                  toastr.error('Please fix those errors & try again.');
              }
          },
          error: function(jqXHR, exception) {
              toastr.error("Something is wrong, Refresh and try again");
          }
      });
  });
  // image manage
  $("#image").change(function() {
      readURL(this);
  });

  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
              $('#imagePreview').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }
  // optional button active 

</script>

<script>
  $(document).ready(function() {
    $('#openPayment').click(function() {
      $('#payfields').slideToggle();
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
<script>
  $(document).ready(function() {
    $('#settings').click(function() {
      $('#userForm').slideToggle();
    });
  });
</script>
<script>
$(document).ready(function() {
    $('.order-toggle').click(function() {
        var orderId = $(this).data('order-id');
        $('.order-details[data-order-id="' + orderId + '"]').slideToggle();
    });
});
</script>

<script>
  $(document).ready(function() {
      @foreach ($getCustomerPaymentDetails->where('user_id', auth('web')->user()->id) as $payInfo)
          $('#pay{{$payInfo->id}}').click(function() {
              $('#PayDetails{{$payInfo->id}}').slideToggle();
          });
      @endforeach
  });
</script>

@endsection