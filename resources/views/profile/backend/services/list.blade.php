@extends('profile.backend.layout')
@section('title', 'Services list')
@section('cutomCss')

@endsection
@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Services</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Services list</li>
        </ol>
    </div>
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                @include('profile.alert.messages')
            </div>

            <div class="col-sm-6 text-right">
                <a href="{{route('create.services')}}" class="btn btn-primary">New Service</a>
            </div>
        </div>
    </div>
    @if ($services->isNotEmpty())
       <div class="container">
      <table class="table table-hover table-bordered">
        <thead >
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Icon</th>
            <th scope="col">view</th>
            <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
             @foreach ($services as $service )
                 <tr>
                    <th scope="row">{{$service->id ? $service->id:''}}</th>
                    <td> 
                        <a href="{{route('OpensinglePageService.front',$service->id)}}" target="_blank" >
                            {{\Illuminate\Support\Str::limit($service->title ? $service->title:'N/A',25)}}
                        </a> 
                    </td>
                    <td>{!! \Illuminate\Support\Str::limit($service->description ? $service->description:'N/A', 50) !!}</td>
                    <td scope="row">{{$service->icon ? $service->icon:'N/A'}}</td>
                    <td scope="row" class="text-center"> <a href="{{route('OpensinglePageService.front',$service->id)}}"><i class="fa-solid fa-eye"></i></a> </td>
                    <td class="text-center">
                        <a href="{{route('edit.service',$service->id)}}" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i> 
                        </a>
                        <a href="#"onclick="deleteService({{ $service->id }})" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-trash text-danger"></i> 
                        </a>
                    </td>
                </tr>
             @endforeach
                
        </tbody>
      </table>
    </div> 
    <div class="card-footer clearfix ‍  ">
        <ul class="pagination pagination m-0 float-right">
            {{ $services->links() }}
          </ul>
      </div>
    @else
        <h4 class=" text-center text-danger" >No service found, Please create some service</h4>
    @endif


    
    
@endsection

@section('scripts')
<script>
    //delete mathods
    function deleteService(id) {
        var url = '{{ route("delete.service", "ID") }}';
        var newUrl = url.replace("ID", id);

        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                 headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                success: function (response) {
                    if (response.status) { // Use response.status
                        window.location.href = "{{ route('list.services') }} ";
                    }else{
                        window.location.href = "{{ route('list.services') }} ";
                    }
                }
            });
        }
    }
</script>
@endsection
