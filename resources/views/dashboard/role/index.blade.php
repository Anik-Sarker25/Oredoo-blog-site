@extends('layouts.dashboard')


@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <div class="d-flex justify-content-between">
                <h1>Users</h1>
                @if (auth()->user()->role == "administrator")
                    <a href="{{ route('add.user') }}"><button type="button" class="btn mt-1 btn-outline-primary">Add New</button></a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">

        @if (auth()->user()->role == "administrator")
            <div class="card">
                <div class="card-header">
                    <h3>All Users</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Edit Role</th>
                            <th scope="col">Delete</th>
                          </tr>
                        </thead>
                        <tbody>

                         @forelse ($all_users as $user)
                            @if ($user->approve_status == true)
                                 <tr>
                                   <th scope="row">{{ $loop->index +1}}</th>
                                   <td>
                                        <img style="width: 36px; border-radius: 5px;" src="{{ asset('uploads/profile') }}/{{ $user->image }}" alt="image">
                                   </td>
                                   <td>{{ $user->name }}</td>
                                   <td>{{ $user->email }}</td>
                                   <td class="text-capitalize">{{ $user->role }}</td>

                                   <td>
                                       <!-- Button trigger modal -->
                                        <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $user->id}}">Edit</button>
                                   </td>



                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop{{ $user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Select Role</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('user.edit', $user->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <label for="Username">Username</label>
                                                    <input type="text" name="usernam" readonly class="form-control mt-3" value="{{ $user->name }}">

                                                    <label for="roleexample">Select Role</label>
                                                    <select class="form-select mt-3 text-capitalize" name="role" id="roleexample">
                                                        <option selected>{{ $user->role }}</option>
                                                        <option value="user">User</option>
                                                        <option value="author">Author</option>
                                                        <option value="editor">Editor</option>
                                                        <option value="administrator">Administrator</option>
                                                    </select>

                                                </div>
                                                <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>

                                        </div>
                                        </div>
                                    </div>

                                   <td>
                                        <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                   </td>
                                 </tr>
                            @endif
                         @empty
                             <tr>
                                <td colspan="6" class="text-danger text-center">THIS TABLE IS EMPTY</td>
                             </tr>

                         @endforelse

                        </tbody>
                      </table>
                </div>
            </div>
        @elseif ($specific_users)
            <div class="card">
                <div class="card-header">
                    <h3>All Users</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse ($all_users as $user)
                            @if ($user->approve_status == true)
                                <tr>
                                <th scope="row">{{ $loop->index +1}}</th>
                                <td>
                                        <img style="width: 36px; border-radius: 5px;" src="{{ asset('uploads/profile') }}/{{ $user->image }}" alt="image">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-capitalize">{{ $user->role }}</td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6" class="text-danger text-center">THIS TABLE IS EMPTY</td>
                            </tr>

                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        @endif

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
