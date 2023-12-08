@extends('layouts.dashboard')


@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
                <h1>Add Users</h1>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="color: #7f7b7b;">
                <h4 class="fw-bold">Add New User</h4>
                <p>Create a new user and add to this site</p>
            </div>
            <div class="card-body" style="color: #7f7b7b;">
                <form action="{{ route('add.user.insert')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="Usernameexample" class="form-label">Username</label>
                                <input type="text" name="name" value="{{ old('name')}}" class="form-control @error('name') is-invalid @enderror" id="Usernameexample">
                            </div>
                            @error('name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="mb-3">
                                <label for="exampleEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" value="{{ old('email')}}" class="form-control @error('email') is-invalid @enderror" id="exampleEmail1">
                            </div>
                            @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="mb-3">
                                <label for="Password1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="Password1">
                            </div>
                            @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="mb-3">
                                <label for="Password2" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="Password2">
                            </div>

                        </div>
                        <div class="col-md-4">
                            <label for="role" class="form-label tw-bold">Role</label>
                            <select class="form-select" id="role" name="role">
                                <option value="user">User</option>
                                <option value="author">Author</option>
                                <option value="editor">Editor</option>
                                <option value="administrator">Administrator</option>
                            </select>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Add User</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts_content')



@endsection


