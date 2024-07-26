@extends('profile.backend.layout')
@section('title','Project list')
<style>
    .tags-container {
        display: flex;
        flex-wrap: wrap;
    }
    .tag {
        background-color: #f1f1f1;
        padding: 5px;
        margin: 2px;
        border-radius: 3px;
    }
</style>
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <h1 class="mt-4">Dashboard</h1>
            </div>
            <div class="col-md-6 mt-4 text-right">
                <a href="{{route('create.portfolio')}}" class="btn btn-primary">New Project</a>
            </div>
        </div>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Portfoio : Project list</li>
        </ol>
        @include('profile.alert.messages')
        <div id="sessionMessage" class="alert alert-success mt-3" style="display: none;">
            {{ Session::get('message') }}
        </div>

        <div class="card-body table-responsive p-0">	
             {{-- @if (count($posts)>0) --}}
             @if ($posts->isNotEmpty())
                 <table class="table table-hover text-nowrap table-bordered">
                    <thead>
                        <tr>
                            <th width="100">ID</th>
                            <th>Images</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Shor Description</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th class="text-center">Tags</th>
                            <th>Clint</th>
                            <th>Project link</th>
                            <th>ShowHome</th>
                            <th>Post Type</th>
                            <th width="100" class="text-center">Status</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    @foreach ($posts as $post )
                        <tbody>
                        <tr>
                            <td>{{$post->id ? $post->id:'' }}</td>
                           
                            <td style="overflow:hidden">
                                <div class="row">
                                    @foreach($post->images as $image) {{--images is the hashMany relationship in Portfolio.php model --}}
                                        <div class="col-md-3">
                                            <div class="thumbnail">
                                                <img src="{{ asset('storage/' . $image->images) }}" alt="Avatar" style="width:80px;border-radius: 20%;border:1px solid hsl(192, 11%, 9%);">
                                            </div>
                                        </div>
                                    @endforeach
                                  <p class="text-center text-info">{{$post->images->count()}}</p> 
                                </div>
                            </td>
                            <td>{!! Illuminate\Support\Str::limit($post->title ? $post->title:'N/A',20)  !!}</td>
                            <td>{!! Illuminate\Support\Str::limit($post->slug ? $post->slug:'N/A',20)  !!}</td>
                            <td>{!! Illuminate\Support\Str::limit($post->short_description ? $post->short_description:'N/A',20)  !!}</td>
                            <td>{!! Illuminate\Support\Str::limit($post->description ? $post->description:'N/A',20)  !!}</td>
                            <td>{{$post->category_name ? $post->category_name:'N/A'}}</td>
                            <td>
                                <div class="tags-container">
                                    @foreach($post->tags_array as $tag)
                                        <span class="tag">{{ Illuminate\Support\Str::limit($tag, 5) }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td>{{$post->clint ? $post->clint:''}}</td>
                            <td>{!! Illuminate\Support\Str::limit($post->project_url ? $post->project_url:'N/A',20)  !!}
                            <td>
                                {!! ($post->showHome =="Yes") ? '<h6 class="text-success"> Yes </h6>': '<h6 class="text-danger"> No</h6>' !!}               
                            </td>
                            <td>{{$post->post_type ? $post->post_type:'N/A'}}</td>
                            <td class="text-center">
                                @if ($post->status == 1)
                                <i class="fa-regular fa-circle-check text-success"></i>
                                @else
                                <i class="fa-solid fa-circle-xmark text-danger"></i>
                                @endif
                            </td>
                                
                            <td class="text-center">
                                {{-- <a href="{{route('posts.edit',$post->id)}}" class="text-blue-500 hover:text-blue-700"> --}}
                                <a href="{{route('edit.portfolio',$post->id)}}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                
                                 <a href="#" onclick="deletePost({{$post->id}})"  class="text-blue-500 hover:text-blue-700">
                                  <i class="fas fa-trash text-danger"></i> 
                                </a>          
                            </td>
                        </tr>

                    </tbody>
                    @endforeach
                    
                </table>
            <div class="card-footer clearfix">
              <ul class="pagination pagination m-0 float-right">
                {{ $posts->links() }}
                </ul>
            </div>
             @else
                 <h3 class="text-center text-danger">No post Found</h3>
             @endif   							
                

            </div>




    </div> 

@endsection



@section('scripts')
    <script>
    //delete mathods
    function deletePost(id) {
        var url = '{{ route("delete.portfolio", "ID") }}';
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
                        window.location.href = "{{ route('list.portfolio') }} ";
                    }else{
                        window.location.href = "{{ route('list.portfolio') }} ";
                    }
                }
            });
        }
    }
    </script>
@endsection