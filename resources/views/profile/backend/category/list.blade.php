@extends('profile.backend.layout')
@section('title','Create Category')


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Categories</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('categories.create')}}" class="btn btn-primary">New Category</a>
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
                    <div class="row">
                        <div class="col-6">
                                    <button title="reset" type="button" onclick="window.location.href='{{route('categories.index')}}' " class="btn btn-default btn-sm">X</button>
                                {{-- <a href="{{route('categories.index')}}" class="btn">X</a> --}}
                            </div>
                            
                            <div class="col-6 ">
                                <div class="input-group float-right" style="width: 250px;">
                                    <input type="text" value="{{Request::get('keyword')}}" name="keyword" class="form-control float-right" placeholder="Search">
                
                                    <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
            </div>
            </form>
            

            <div class="card-body table-responsive p-0">	
             @if (count($categories)>0)
                 <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>ShowHome</th>
                            <th width="100" class="text-center">Status</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    @foreach ($categories as $category )
                        <tbody>
                        <tr>
                            <td>{{$category->id ? $category->id:'' }}</td>
                           
                            <td>{{$category->name ? $category->name:''}}</td>
                            <td>{{$category->slug ? $category->slug:''}}</td>
                            <td>
                                {!! ($category->showHome =="Yes") ? '<h6 class="text-success"> Yes </h6>': '<h6 class="text-danger"> No</h6>' !!}               
                            </td>
                            <td class="text-center">
                                @if ($category->status == 1)
                                <i class="fa-regular fa-circle-check text-success"></i>
                                @else
                                <i class="fa-solid fa-circle-xmark text-danger"></i>
                                @endif
                            </td>
                                
                            <td class="text-center">
                                <a href="{{route('categories.edit',$category->id)}}" class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-edit"></i> 
                                </a>
                                 <a href="#" onclick="deleteCategory({{$category->id}})" class="text-blue-500 hover:text-blue-700">
                                  <i class="fas fa-trash text-danger"></i> 
                                </a>          
                            </td>
                        </tr>

                    </tbody>
                    @endforeach
                    
                </table>
            <div class="card-footer clearfix ‍  ">
              <ul class="pagination pagination m-0 float-right">
                {{ $categories->links() }}
                </ul>
            </div>
             @else
                 <h3 class="text-center text-danger">No Category Found</h3>
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
    function deleteCategory(id) {
        var url = '{{ route("categories.delete", "ID") }}';
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
                        window.location.href = "{{ route('categories.index') }} ";
                    }
                }
            });
        }
    }
</script>
@endsection