@extends('layouts.dashboard')


@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Profile</h1>
        </div>
    </div>
</div>
<!-- ----------Username update section starts form here--------- -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Update Username</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.name',auth()->id()) }}" method="POST">
                    @csrf
                    <label for="nameexample" class="form-label mb-3">Update username</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ auth()->user()->name }}" id="nameexample">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <button type="submit" class="btn btn-success mt-4">Update</button>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- ----------Username update section ends form here--------- -->

<!-- ----------Email update section starts form here--------- -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Update Email</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.email',auth()->id()) }}" method="POST">
                    @csrf
                    <label for="emailexample" class="form-label mb-3">Update Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ auth()->user()->email }}" id="emailexample">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <button type="submit" class="btn btn-success mt-4">Update</button>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- ----------Email update section ends form here--------- -->

<!-- ----------Image update section starts form here--------- -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Update Image</h2>
            </div>
            <div class="card-body">
                <img src="{{ asset('uploads/profile') }}/{{ auth()->user()->image }}" alt="image" style="width: 120px; border-radius: 10px;">
                <form action="{{ route('profile.image',auth()->id()) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="imageexample" class="form-label mb-3">Update Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="imageexample">
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <button type="submit" class="btn btn-success mt-4">Update</button>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- ----------Image update section ends form here--------- -->

<!-- ----------Password update section starts form here--------- -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Update Password</h2>
            </div>
            <div class="card-body">

                <form action="{{ route('profile.password',auth()->id()) }}" method="POST">
                    @csrf
                    <label for="currentpassexample" class="form-label mb-3">Current Password</label>
                    <input type="password" name="current_password" class="form-control mb-4 @error('current_password') is-invalid @enderror" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" id="currentpassexample">
                    @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label for="newpassexample" class="form-label mb-3">New Password</label>
                    <input type="password" name="password" class="form-control mb-4 @error('password') is-invalid @enderror" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" id="newpassexample">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <label for="confirmpassexample" class="form-label mb-3">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" id="confirmpassexample">


                    <button type="submit" class="btn btn-success mt-4">Update</button>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- ----------Password update section ends form here--------- -->
@endsection

@section('scripts_content')

@if (session('update_success'))
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

@elseif (session('update_error'))
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
    icon: 'warning',
    title: "{{session('update_error')}}"
  })
</script>

@endif

@endsection
