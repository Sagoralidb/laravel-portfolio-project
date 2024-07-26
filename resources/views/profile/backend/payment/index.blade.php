@extends('profile.backend.layout')

@section('title','Payments')

@section('cutomCss')

@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2 ">
        
        <div class="row mb-2">
            
            <div class="col-sm-6 mt-3">
                <h1>Payment</h1>
            </div>
            <div class="col-sm-6 text-right mt-3">
                {{-- <a href="" class="btn btn-primary">Back</a> --}}
            </div>
            <div>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Payment : Create & listing</li>
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

                    <div class="row mt-2">
                        <span class="btn btn-success text-center" id="openPayment"><i class="fa-solid fa-dollar-sign"></i> Create New Payment</span>
                      </div>        
                    <div class="" id="payfields" name="payfields"  style="display: none;">
                     
                      <form action="{{route('customerPayment.store')}}" id="payForm" name="payForm" > 
                          @csrf
                          @method('post') 
                          <div class="row bg-warning">
                              <div class="col-sm-3 text-center ">
                                <label for="">Select User</label><br>
                                  <select name="user_id" id="user_id" class="select2" style="width: 100%">
                                    @foreach ($userInfo as $user)
                                    <option value="{{ $user->id }}">{{ $user->id }}-{{ $user->name }}</option>  
                                    @endforeach
                                  </select>
                                
                                <p id="user_idError" class="text-danger"></p> 
                              </div>
                              
                              <div class="col-sm-3 text-center ">
                                <label for="">Your Order</label>
                                <input type="text" name="order_id" id="order_id" class="form-control">
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
                              <div class="col-sm-3  text-center">
                                <label for="">Transaction id</label>
                                <div class="mb-2">
                                  <input type="text" name="tranjection_id" id="tranjection_id" class="form-control text-center"
                                  placeholder="0177xxxxxx">
                                  <p id="tranjection_idError" class="text-danger"></p> 
                                </div>            
                              </div>   
                              <div class="col-sm-3 text-center">
                                <label for="">Transaction id</label>
                                <div class="mb-2">
                                  <input type="file" name="pay_slip" id="pay_slip" class="form-control">
                                  <p id="pay_slipError" class="text-danger"></p> 
                                </div>
                               
                              </div>       
                                <button type="submit" class="form-control btn-success">Submit</button>
                            </div> 
                       </form>
                     
                      </div>  
                </div> 
                
            </div>  
        </div>
        <div class="card mb-4 mt-3">
          @if (! empty($paymentInfo))
          <table class="table table-light border text-center">
            <thead>
                <th>#id</th>
                <th>User ID</th>
                <th>OrderId</th>
                <th>Project Cost</th>
                <th>Amount</th>
                <th class="bg-danger">Due</th>
                <th>PayMethod</th>
                <th>Tranjection Id</th>
                <th>Status</th>
                <th>Slip</th>
            </thead>
            <tbody>
              @foreach ($paymentInfo as $payment)
                
              
              <tr>
                <td>#{{$payment->id}}</td>
                <td>User#{{$payment->user_id}}</td>
                <td>Order#{{$payment->order_id}}</td>
                <td>{{$payment->project_cost}}/-</td>
                <td>{{$payment->amount}}/-<sup style="font-size: 10px">{{$payment->payment_type}}</sup></td>
                <td class="bg-danger">{{($payment->project_cost)-($payment->amount)}}/-</td>
                <td>{{$payment->pay_method}}</td>
                <td>{{$payment->tranjection_id}}</td>
                <td>
                  @if ($payment->status =='hold')
                    <button class="btn-warning" disabled>Hold</button>
                 @elseif($payment->status =='accept')
                  <button class="btn-success" disabled>Accepted</button>  
                 @elseif($payment->status =='reject')
                  <button class="btn-danger" disabled>Rejected</button>
                 @elseif($payment->status =='refunded')
                  <button class="btn-danger" disabled>Refunded</button>
                  @endif
                </td>
                <td>
                  <a href="{{ asset('storage/' . $payment->pay_slip) }}" target="_blank">
                    <img src="{{ asset('storage/' . $payment->pay_slip) }}" alt="Avatar" style="height:25px;width:50px;border-radius: 20%;border:1px solid hsl(192, 11%, 9%);">
                  </a>
                 
                 
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
            
          @endif
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
                url: "",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response.status) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            window.location.href = "";
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
                        window.location.href = "{{ route('showPaymentList.index') }}";
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
  
  </script>
  
  <script>
    $(document).ready(function() {
      $('#openPayment').click(function() {
        $('#payfields').slideToggle();
      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
        $('#user_id').select2();
    });
</script>

    @endsection