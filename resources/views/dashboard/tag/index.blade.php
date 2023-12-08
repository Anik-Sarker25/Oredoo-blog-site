@extends('layouts.dashboard');


@section('content')
<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Tags</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h2>Insert Tags</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('tag.insert') }}" method="POST">
                    @csrf
                    <label for="titleexample" class="form-label mb-3">Tags</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  id="titleexample">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <button type="submit" class="btn float-end btn-success mt-4">Add</button>

                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h2>Tag List</h2>
                <!-- Button trigger modal -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="material-icons-two-tone">restore</i>Restore</button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Restore</th>
                                    <th scope="col">Delete</th>
                                  </tr>
                                </thead>
                                <tbody>


                                @forelse ($trashed as $trash)
                                    <tr>
                                        <th scope="row">{{ $trash->id }}</th>
                                        <td>{{ $trash->name }}</td>
                                        <td>
                                            @if ($trash->status == 'active')
                                                <button type="submit" class="btn btn-success">{{ $trash->status}}</button>
                                                @else
                                                <button type="submit" class="btn btn-danger">{{ $trash->status}}</button>
                                                @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('tag.restore',$trash->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Restore</button>
                                            </form>

                                        </td>
                                        <td>
                                            <form action="{{ route('tag.deletepermanent',$trash->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-danger text-center">DELETED DATA LIST IS EMPTY!</td>
                                    </tr>
                                @endforelse


                                </tbody>
                              </table>
                        </div>
                    </div>
                    </div>
                </div>


            </div>
            <div class="card-body">
                <div class="table-list" style="min-height: 240px;">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tags as $tag)
                                    <tr>
                                        <th scope="row">{{ $tags->firstItem() + $loop->index }}</th>
                                        <td>{{ $tag->name }}</td>
                                        <td>
                                            <form action="{{ route('tag.status',$tag->id) }}" method="POST">
                                                @csrf
                                                @if ($tag->status == 'active')
                                                <button type="submit" class="btn btn-success">{{ $tag->status}}</button>
                                                @else
                                                <button type="submit" class="btn btn-danger">{{ $tag->status}}</button>
                                                @endif
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('tag.delete',$tag->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-danger">TAGS NOT FOUND!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="paginate-sec mt-3" >
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
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
