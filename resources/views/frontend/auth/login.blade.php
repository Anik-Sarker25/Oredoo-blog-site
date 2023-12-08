@extends('layouts.master')


@section('content')
 <!--Login-->
 <section class="login" style="margin: 80px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                @if (session('login_failed'))
                    <div class="text-white fw-bold text-center bg-danger p-4" >
                        {{ session('login_failed') }}
                    </div>
                @elseif (session('approve_false'))
                    <div class="text-white fw-bold text-center bg-danger p-4" >
                        {{ session('approve_false') }}
                    </div>
                @endif
                <div class="login-content">
                    <h4>Login</h4>
                    <p></p>
                    <form  action="{{ route('signin') }}" class="sign-form widget-form " method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email*" name="email" value="{{ session('email') }}">
                        </div>
                        @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        {{-- <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password*" name="password" value="{{ session('password') }}">
                        </div> --}}
                        <div class="form-group input-group" style="border: 1px solid #E6E7E7;">
                            <input id="chage_type3" type="password" class="form-control m-0" placeholder="Password*" name="password" value="{{ session('password') }}" style="border: none;">
                            <button type="button" style="height: 52px; padding: 0 10px; background: transparent;border: none"><i id="clickit3" onclick="myFunction3();" class="las la-eye" style="font-size: 24px; color: #757677;"></i></button>
                        </div>
                        @error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="sign-controls form-group">
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                                <label class="custom-control-label" for="rememberMe">Remember Me</label>
                            </div>
                            <a href="#" class="btn-link ">Forgot Password?</a>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Login in</button>
                        </div>
                        <p class="form-group text-center">Don't have an account? <a href="signup.html" class="btn-link">Create One</a> </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

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
@elseif (session('approve_false'))
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
    title: "{{session('approve_false')}}"
  })
</script>

@endif
<script>
    function myFunction3() {
        let x = document.getElementById("chage_type3");
        let y = document.getElementById("clickit3");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        if (y.className == "las la-eye") {
            y.className = "las la-eye-slash";
        }else {
            y.className = "las la-eye";
        }
    }
</script>

@endsection
