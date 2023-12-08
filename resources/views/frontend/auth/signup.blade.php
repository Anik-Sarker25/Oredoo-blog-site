@extends('layouts.master')


@section('content')
    <!--Login-->
    <section class="login" style="margin: 20px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-8 m-auto">
                    <div class="login-content">
                        <h4>Sign up</h4>
                        <!--form-->
                        <form  class="sign-form widget-form " action="{{ route('signup') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username*" name="name" value="{{ old('name')}}">
                            </div>
                            @error('name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email Address*" name="email" value="{{ old('email')}}">
                            </div>
                            @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="form-group input-group" style="border: 1px solid #E6E7E7;">
                                <input id="chage_type" type="password" class="form-control m-0" placeholder="Password*" name="password" value="" style="border: none;">
                                <button type="button" style="height: 52px; padding: 0 10px; background: transparent;border: none"><i id="clickit" onclick="myFunction();" class="las la-eye" style="font-size: 24px; color: #757677;"></i></button>
                            </div>

                            @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="form-group input-group" style="border: 1px solid #E6E7E7;">
                                {{-- <input type="password" class="form-control" placeholder="Confirm Password*" name="password_confirmation" value=""> --}}
                                <input id="chage_type2" type="password" class="form-control m-0" placeholder="Confirm Password*" name="password_confirmation" value="" style="border: none;">
                                <button type="button" style="height: 52px; padding: 0 10px; background: transparent;border: none"><i id="clickit2" onclick="myFunction2();" class="las la-eye" style="font-size: 24px; color: #757677;"></i></button>
                            </div>
                            <div class="sign-controls form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="rememberMe" name="rememberme">
                                    <label class="custom-control-label" for="rememberMe">Agree to our <a href="#" class="btn-link">terms & conditions</a> </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-custom">Sign Up</button>
                            </div>
                            <p class="form-group text-center">Already have an account? <a href="{{ route('signin.view') }}" class="btn-link">Login</a> </p>
                        </form>

                           <!--/-->
                    </div>
                </div>
             </div>
        </div>
    </section>

@endsection

@section('scripts_content')

<script>
    // let changeit = document.querySelector('#chenge_type');
    function myFunction() {
        let x = document.getElementById("chage_type");
        let y = document.getElementById("clickit");
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
    function myFunction2() {
        let x = document.getElementById("chage_type2");
        let y = document.getElementById("clickit2");
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


