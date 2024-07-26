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
                <h1>Admin</h1>
            </div>
            <div class="col-sm-6 text-right mt-3">
                <a href="{{ Route('create.admin')}}" class="btn btn-primary">New Admin</a>
            </div>
            <div>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Admin :list</li>
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
                            <button title="reset" type="button" onclick="window.location.href='{{route('list.admin')}}' " class="btn btn-default btn-sm">X</button>
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
             @if (! empty($admins))
                 <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    @foreach ($admins as $admin )
                        <tbody>
                        <tr>
                            <td>{{$admin->id ? $admin->id:'' }}</td>
                            <td>{{$admin->name ? $admin->name:''}}</td>
                            <td>{{$admin->email ? $admin->email:''}}</td>   
                            <td>
                                <a href="{{route('edit.admin',$admin->id)}}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                
                                    <a href="#"onclick="deleteAdmin({{$admin->id}})" class="text-blue-500 hover:text-blue-700 mr-1">
                                        <i class="fas fa-trash text-danger"></i> 
                                    </a>
                                
                            </td>
                        </tr>

                    </tbody>
                    @endforeach
                    
                </table>
            <div class="card-footer clearfix">
              <ul class="pagination pagination m-0 float-right">
                {{ $admins->links() }}
                </ul>
            </div>
             @else
                 <h3 class="text-center text-danger">No Admin Found</h3>
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
            function deleteAdmin(id) {
                var url = '{{route('delete.admin',"ID")}}';
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