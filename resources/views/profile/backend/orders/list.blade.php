@extends('profile.backend.layout')

@section('title','Order List')

@section('css')
    
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2 ">
        
        <div class="row mb-2">
            
            <div class="col-sm-6 mt-3">
                <h1>Orders</h1>
            </div>
            <div class="col-sm-6 text-right mt-3">
                <a href="{{ Route('order.create')}}" class="btn btn-primary">New Order</a>
            </div>
            <div>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Users : Order list</li>
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
            <form action="" method="get">
                <div class="card-header">
                
                <div class="card-tools">
                    
                    <div class="input-group input-group" style="width: 100%;">
                        <div class="card-title">
                            <button title="reset" type="button" onclick="window.location.href='{{route('order.list')}}' " class="btn btn-default btn-sm">X</button>
                        </div>
                        <input type="text" value="{{Request::get('keyword')}}" name="keyword" class="form-control float-right" placeholder="Search" style="width: 50%">
    
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                </div>
            </div>
            </form>
            

            <div class="card-body table-responsive p-0">	
             @if (! empty($getCustomerOrders))
                 <table class="table table-hover text-nowrap table-bordered">
                    <thead>
                        <tr>
                            
                            <th>OrderNo</th>
                            <th>OrderTitle</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="100">Status</th>
                            <th width="100" class="text-center">Action</th>
                        </tr>
                    </thead>
                    @foreach ($getCustomerOrders as $orderInfo )
                        <tbody>
                        <tr>
                            <td><a class="btn btn-info" data-toggle="modal" data-toggle="modal" data-target="#exampleModalLong{{$orderInfo->id}}">
                               @include('profile.backend.orders.popup') 
                                #{{$orderInfo->id ? $orderInfo->id:'na'}}</a> <a class="text-center btn">{{ $orderInfo->created_at ? $orderInfo->created_at->format('d-m-Y') : 'na' }}</a></td>
                            <td> {{\Illuminate\Support\Str::limit($orderInfo->title ? $orderInfo->title:'',30)}}</td>
                            <td>{{$orderInfo->id?$orderInfo->id:''}}-{{$orderInfo->user->name ?$orderInfo->user->name :'N/A'}}</td>
                            <td>{{$orderInfo->user->email ? $orderInfo->user->email:''}}</td>
                            <td>
                                @if ($orderInfo->user->user_type==0)
                                    <span>User</span>
                               @elseif ($orderInfo->user->user_type==1)
                                    <span>Clint</span>
                               @endif

                            </td>
                            <td>
                                {{-- {{$orderInfo->status}} --}}
                                @if ($orderInfo->status == 'in_review')
                                <button class="btn btn-secondary text-warning" disabled>In Review</button>
                                    @elseif($orderInfo->status == 'approved')
                                <button class="btn btn-success"disabled>Approved</button>
                                    @elseif($orderInfo->status == 'progress')
                                <button class="btn btn-warning"disabled>Progress</button>
                                    @elseif($orderInfo->status == 'rejected')
                                <button class="btn btn-danger"disabled>Rejected</button>
                                    @elseif($orderInfo->status == 'completed')
                                <button class="btn btn-success"disabled>Completed</button>
                                    @endif
                            </td>
                                
                            <td class="text-center">
                                <a href="{{route('edit.order',$orderInfo->id)}}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                    <a href="#"onclick="deleteOrder({{$orderInfo->id}})" class="text-blue-500 hover:text-blue-700 mr-1">
                                        <i class="fas fa-trash text-danger"></i> 
                                    </a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach 
                </table>
            <div class="card-footer clearfix">
              <ul class="pagination pagination m-0 float-right">
                {{-- {{ $getCustomerOrders->links() }} --}}
                </ul>
            </div>
             @else
                 <h3 class="text-center text-danger">No user Found</h3>
             @endif   							
                

            </div>
            
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection
    @section('scripts')
    <script>
        //delete mathods
        function deleteOrder(id) {
            var url = '{{route('delete.order',"ID")}}';
            var newUrl = url.replace("ID", id);

            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    url: newUrl,
                    type: 'delete',
                    data: {},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.status) { // Use response.status
                            window.location.href = "{{ route('order.list') }} ";
                        }
                    }
                });
            }
        }
    </script>
    
@endsection