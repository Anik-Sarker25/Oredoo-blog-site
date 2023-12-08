@extends('layouts.dashboard')


@section('content')
<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Category</h1>
        </div>
    </div>
</div>

<!----------category insert section starts form here---------->
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h2>Insert Category</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('category.insert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="titleexample" class="form-label mb-3">Enter Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror"  id="titleexample">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label for="slugexample" class="form-label mb-3">Enter Slug</label>
                    <input type="text" name="slug"  value="{{ old('slug') }}" class="form-control" id="slugexample">



                    <label for="imgexample" class="form-label mb-3">Select Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="imgexample">
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <button type="submit" class="btn float-end btn-success mt-4">Insert</button>

                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h2>Category List</h2>
            </div>
            <div class="card-body">
                <div class="table-list" style="min-height: 240px;">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Title</th>
                                  <th scope="col">Slug</th>
                                  <th scope="col">Image</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Edit</th>
                                  <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($catagories as $category)
                                    <tr>
                                        <th scope="row">{{ $catagories->firstItem() + $loop->index }}</th>
                                        <td>

                                            <textarea name="" disabled class="bg-white" id="" cols="15" rows="1">{{ $category->title}}</textarea>
                                        </td>
                                        <td>
                                            <textarea name="" disabled class="bg-white" id="" cols="15" rows="1">{{ $category->slug}}</textarea>
                                        </td>
                                        <td>
                                            <img style="width: 35px; height: 35px; border-radius: 10px;" src="{{ asset('uploads/category') }}/{{ $category->image}}" alt="image">
                                        </td>
                                        <td>
                                            <form action="{{ route('category.status',$category->id) }}" method="POST">
                                                @csrf
                                                @if ($category->status == 'active')
                                                <button type="submit" class="btn btn-success">{{ $category->status}}</button>
                                                @else
                                                <button type="submit" class="btn btn-danger">{{ $category->status}}</button>
                                                @endif
                                            </form>
                                        </td>
                                        <td>
                                                <!-- Button trigger modal -->
                                                <button type="submit" data-bs-toggle="modal" data-bs-target="#categoryModal{{ $category->id }}" class="btn btn-success">Edit</button>


                                            <!-- Modal -->
                                            <div class="modal fade" id="categoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Category Edit</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h2>Edit Category</h2>
                                                            </div>
                                                            <div class="card-body">
                                                                <form action="{{ route('category.edit',$category->id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <label for="titleexample" class="form-label mb-3">Edit Title</label>
                                                                    <input type="text" name="title" value="{{ $category->title }}" class="form-control"  id="titleexample">


                                                                    <label for="slugexample" class="form-label mb-3">Edit Slug</label>
                                                                    <input type="text" name="slug"  value="{{ $category->slug }}" class="form-control" id="slugexample">



                                                                    <label for="imgexample" class="form-label mb-3">Select Image</label>
                                                                    <input type="file" name="image" class="form-control" id="imgexample">

                                                                    <button type="submit" class="btn btn-success mt-4">Update</button>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{{ route('category.delete',$category->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="paginate-sec mt-3" >
                    {{ $catagories->links() }}

                </div>
            </div>
        </div>
    </div>

</div>
<!----------category insert section ends form here---------->



@endsection


@section('scripts_content')

@if (session('insert_success'))
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

@endif

@endsection
