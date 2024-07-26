@extends('profile.backend.layout')

@section('title','User List')

@section('css')
    
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2 ">
        
        <div class="row mb-2">
            
            <div class="col-sm-6 mt-3">
                <h1>Users</h1>
            </div>
            <div class="col-sm-6 text-right mt-3">
                <a href="{{ Route('create.user')}}" class="btn btn-primary">New User</a>
            </div>
            <div>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Users : User list</li>
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
                    {{-- <div class="card-title">
                        <button title="reset" type="button" onclick="window.location.href='{{route('list.user')}}' " class="btn btn-default btn-sm">X</button>
                    </div> --}}
                <div class="card-tools">
                    
                    <div class="input-group input-group" style="width: 100%;">
                        <div class="card-title">
                            <button title="reset" type="button" onclick="window.location.href='{{route('list.user')}}' " class="btn btn-default btn-sm">X</button>
                        </div>
                        <input type="text" value="{{Request::get('keyword')}}" name="keyword" class="form-control float-right" placeholder="Search" style="width: 55%">
    
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
             @if (count($users)>0)
                 <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Phone</th>
                            <th width="100">Status</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    @foreach ($users as $user )
                        <tbody>
                        <tr>
                            <td>{{$user->id ? $user->id:'' }}</td>
                            <td>{{$user->name ? $user->name:''}}</td>
                            <td>{{$user->email ? $user->email:''}}</td>
                            <td>
                                @if ($user->user_type==0)
                                    <span>User</span>
                               @elseif ($user->user_type==1)
                                    <span>Clint</span>
                               @endif

                            </td>
                            <td>{{$user->phone ? $user->phone:''}}</td> 
                            <td>
                                @if ($user->status == 1)
                                <i class="fa-regular fa-circle-check text-success"></i>
                                @else
                                <i class="fa-solid fa-circle-xmark text-danger"></i>
                                @endif
                            </td>
                                
                            <td>
                                <a href="{{route('edit.user',$user->id)}}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                
                                    <a href="#"onclick="deleteUser({{$user->id}})" class="text-blue-500 hover:text-blue-700 mr-1">
                                        <i class="fas fa-trash text-danger"></i> 
                                    </a>
                                
                            </td>
                        </tr>

                    </tbody>
                    @endforeach
                    
                </table>
            <div class="card-footer clearfix">
              <ul class="pagination pagination m-0 float-right">
                {{ $users->links() }}
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
            function deleteUser(id) {
                var url = '{{route('delete.user',"ID")}}';
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
                                window.location.href = "{{ route('list.user') }} ";
                            }
                        }
                    });
                }
            }
        </script>
    
@endsection