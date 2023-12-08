@extends('layouts.dashboard')


@section('content')
<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Posts</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Post list</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Author Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Tags</th>

                            @if (auth()->user()->role == "administrator" || auth()->user()->role == "editor")
                                <th scope="col">Edit</th>
                                <th scope="col">delete</th>
                            @endif
                            <th scope="col">Date</th>
                            </tr>
                        </thead>
                        @if (auth()->user()->role == "administrator")
                            <tbody>
                                @forelse ($blogs as $blog)
                                    <tr>
                                        <th scope="row">{{ $loop->index +1 }}</th>
                                        <td>{{ $blog->title }}</td>
                                        <td>
                                            <img style="width: 64px; height: 64px;" src="{{ asset('uploads/blog') }}/{{ $blog->image }}" alt="image">
                                        </td>
                                        <td>{{ $blog->RelationWithUser->name }}</td>
                                        <td>{{ $blog->RelationWithCategory->title }}</td>

                                        <td>

                                            @foreach ($blog->Manywithtags as $tag)
                                                <button type="button" class="btn btn-primary mt-1">{{ $tag->name }}</button>
                                            @endforeach
                                        </td>

                                        <td>

                                            {{-- <a href="{{ route('blog.edit_view') }}"><button type="submit" class="btn btn-success">Edit</button></a> --}}

                                            {{-- <form action="{{ route('blog.edit',$blog->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Edit</button>

                                            </form> --}}

                                            <!-- Button trigger modal -->
                                            <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$blog->id}}">Edit</button>


                                            <!-- Modal -->
                                            <div class="modal fade" data-bs-backdrop="static" id="exampleModal{{$blog->id}}" >
                                                <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Post No. {{ $blog->id}}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <form action="{{ route('blog.edit',$blog->id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="exampletitle" class="form-label">Enter Title</label>
                                                                        <input type="text" class="form-control" value="{{ $blog->title }}" name="title" id="exampletitle">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="examplecategory" class="form-label">Select Category</label>
                                                                        <select class="form-select" name="category_id" id="examplecategory">
                                                                            <option value="{{ $blog->RelationWithCategory->id }}" selected>{{ $blog->RelationWithCategory->title }}</option>
                                                                            @foreach ($categorie as $category)
                                                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="exampleCheck11">Select Tags</label>

                                                                        {{-- @if($blog->Manywithtags()->where('blog_id', 'tag_id')->exists()) checked @endif  --}}
                                                                        @foreach ($tags as $tag)
                                                                        <br>
                                                                        <input type="checkbox" class="form-check-input" name="tag_id[]" value="{{ $tag->id }}" id="exampleheck{{ $tag->id }}"
                                                                        @foreach ($blog->Manywithtags as $t)
                                                                        @if ($tag->id == $t->id)
                                                                        checked
                                                                        @endif
                                                                        @endforeach
                                                                        >
                                                                        <label class="form-check-label" for="exampleheck{{ $tag->id }}">{{ $tag->name }}</label>

                                                                        @endforeach


                                                                        {{-- @foreach ($tags as $tag)
                                                                        <br>
                                                                        <input type="checkbox" class="form-check-input" name="tag_id[]" value="{{ $tag->id }}" id="exampleCheck1{{ $tag->id }}">
                                                                        <label class="form-check-label" for="exampleCheck1{{ $tag->id }}">{{ $tag->name }}</label>

                                                                        @endforeach --}}



                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="exampledate" class="form-label">Enter Date</label>
                                                                        <input type="date" value="{{ $blog->date }}" class="form-control" name="date" id="exampledate">
                                                                    </div>
                                                                    <div class="mb-4">
                                                                        <label for="exampleimage" class="form-label">Choose Image</label>
                                                                        <input type="file" class="form-control" name="image" id="exampleimage">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Enter Description</label>
                                                                        <textarea name="description" class="form-control" id="summernotetwo">{{ $blog->description }}</textarea>
                                                                    </div>

                                                                    <button class="btn btn-success mt-4" type="submit">Update Post</button>

                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>
                                                </div>
                                            </div>


                                        </td>
                                        <td>
                                            <form action="{{ route('blog.delete',$blog->id)}}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                        <td>{{ $blog->date }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-danger">BLOG POST IS EMPTY!</td>
                                    </tr>

                                @endforelse

                            </tbody>

                        @elseif (auth()->user()->role == "editor" || auth()->user()->role == "author" || auth()->user()->role == "user")
                            <tbody>
                                @forelse ($specificblogs as $blog)
                                    <tr>
                                        <th scope="row">{{ $loop->index +1 }}</th>
                                        <td>{{ $blog->title }}</td>
                                        <td>
                                            <img style="width: 64px; height: 64px;" src="{{ asset('uploads/blog') }}/{{ $blog->image }}" alt="image">
                                        </td>
                                        <td>{{ $blog->RelationWithUser->name }}</td>
                                        <td>{{ $blog->RelationWithCategory->title }}</td>

                                        <td>

                                            @foreach ($blog->Manywithtags as $tag)
                                                <button type="button" class="btn btn-primary mt-1">{{ $tag->name }}</button>
                                            @endforeach
                                        </td>

                                        @if (auth()->user()->role == "editor")
                                            <td>

                                                {{-- <a href="{{ route('blog.edit_view') }}"><button type="submit" class="btn btn-success">Edit</button></a> --}}

                                                {{-- <form action="{{ route('blog.edit',$blog->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Edit</button>

                                                </form> --}}

                                                <!-- Button trigger modal -->
                                                <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$blog->id}}">Edit</button>


                                                <!-- Modal -->
                                                <div class="modal fade" data-bs-backdrop="static" id="exampleModal{{$blog->id}}" >
                                                    <div class="modal-dialog modal-dialog-scrollable modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Post No. {{ $blog->id}}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <form action="{{ route('blog.edit',$blog->id) }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <label for="exampletitle" class="form-label">Enter Title</label>
                                                                            <input type="text" class="form-control" value="{{ $blog->title }}" name="title" id="exampletitle">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="examplecategory" class="form-label">Select Category</label>
                                                                            <select class="form-select" name="category_id" id="examplecategory">
                                                                                <option value="{{ $blog->RelationWithCategory->id }}" selected>{{ $blog->RelationWithCategory->title }}</option>
                                                                                @foreach ($categorie as $category)
                                                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="exampleCheck11">Select Tags</label>

                                                                            {{-- @if($blog->Manywithtags()->where('blog_id', 'tag_id')->exists()) checked @endif  --}}
                                                                            @foreach ($tags as $tag)
                                                                            <br>
                                                                            <input type="checkbox" class="form-check-input" name="tag_id[]" value="{{ $tag->id }}" id="exampleheck{{ $tag->id }}"
                                                                            @foreach ($blog->Manywithtags as $t)
                                                                            @if ($tag->id == $t->id)
                                                                            checked
                                                                            @endif
                                                                            @endforeach
                                                                            >
                                                                            <label class="form-check-label" for="exampleheck{{ $tag->id }}">{{ $tag->name }}</label>

                                                                            @endforeach


                                                                            {{-- @foreach ($tags as $tag)
                                                                            <br>
                                                                            <input type="checkbox" class="form-check-input" name="tag_id[]" value="{{ $tag->id }}" id="exampleCheck1{{ $tag->id }}">
                                                                            <label class="form-check-label" for="exampleCheck1{{ $tag->id }}">{{ $tag->name }}</label>

                                                                            @endforeach --}}



                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="exampledate" class="form-label">Enter Date</label>
                                                                            <input type="date" value="{{ $blog->date }}" class="form-control" name="date" id="exampledate">
                                                                        </div>
                                                                        <div class="mb-4">
                                                                            <label for="exampleimage" class="form-label">Choose Image</label>
                                                                            <input type="file" class="form-control" name="image" id="exampleimage">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Enter Description</label>
                                                                            <textarea name="description" class="form-control" id="summernotetwo">{{ $blog->description }}</textarea>
                                                                        </div>

                                                                        <button class="btn btn-success mt-4" type="submit">Update Post</button>

                                                                    </form>
                                                                </div>
                                                            </div>

                                                        </div>


                                                    </div>
                                                    </div>
                                                </div>


                                            </td>

                                            <td>
                                                <form action="{{ route('blog.delete',$blog->id)}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        @endif
                                        <td>{{ $blog->date }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-danger">USER POST IS EMPTY!</td>
                                    </tr>

                                @endforelse

                            </tbody>
                        @endif

                    </table>
                </div>

                <div class="paginate-sec mt-3" >
                    {{-- {{ $blogs->links() }} --}}

                </div>
            </div>
        </div>
    </div>
</div>









@endsection


@section('scripts_content')
{{-- @if (session('insert_success'))

<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: 'success',
    title: "{{session('insert_success')}}"
  })
</script>
@elseif (session('delete_success'))
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: 'success',
    title: "{{session('delete_success')}}"
  })
</script>

@elseif (session('update_success'))
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: 'success',
    title: "{{session('update_success')}}"
  })
</script>


@endif --}}


<script>
    $(document).ready(function() {
      $('#summernotetwo').summernote();
    });
    </script>
@endsection
