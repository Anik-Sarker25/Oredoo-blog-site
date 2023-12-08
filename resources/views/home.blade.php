@extends('layouts.dashboard')


@section('content')

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1>Dashboard</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card" >
            <div class="card-header" style="color: #7f7b7b;">
                <h4 class="fw-bold">User Request list</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-header" style="color: #7f7b7b;">
                <h5>Unapprove list</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($users as $user)
                        @if ($user->approve_status == false)
                            <tr>
                                <th scope="row">{{ $loop->index +1}}</th>
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>
                                <td>
                                    {{-- <a href="{{ route('Request.approve', $user->id) }}"><button type="button" class="btn btn-outline-success fw-bold">Approve</button></a> --}}
                                    <form action="{{route('request.approve', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success fw-bold">Approve</button>
                                    </form>
                                </td>
                                <td>
                                    {{-- <a href="{{ route('Request.reject', $user->id)}}"><button type="button" class="btn btn-outline-danger fw-bold">Reject</button>
                                    </a> --}}
                                    <form action="{{route('request.reject', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger fw-bold">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                      @endforeach

                    </tbody>
                  </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header" style="color: #7f7b7b;">
                <h5>Approved list</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Block Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($users as $user)
                        @if ($user->approve_status == true)
                            <tr>
                                <th scope="row">{{ $loop->index +1}}</th>
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>
                                <td>
                                    <form action="{{route('request.approve', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success fw-bold">Unapprove</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('block.status', $user->id) }}" method="POST">
                                        @csrf
                                        @if ($user->block_status == "blocked")
                                        <button type="submit" class="btn btn-outline-danger fw-bold">{{ $user->block_status }}</button>
                                        @else
                                        <button type="submit" class="btn btn-outline-success fw-bold">{{ $user->block_status }}</button>
                                        @endif
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('request.reject', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger fw-bold">delete</button>
                                    </form>
                                    {{-- <a href="{{ route('Request.reject', $user->id)}}"><button type="button" class="btn btn-outline-danger fw-bold">Delete</button></a> --}}
                                </td>
                            </tr>
                        @endif
                      @endforeach

                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>


@endsection


