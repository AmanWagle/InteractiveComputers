@extends('admin.layouts.master-blank')
@section('content')
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="/storage/images/static/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-">Log in with your Admin Credential</p>

                    <form method="POST" action="{{ route('admin.post-login') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id='email' type="email" name="email"
                                class="form-control form-control-xl @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id='password' type="password" name="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #fff
        }

        #auth {
            height: 100vh;
            overflow-x: hidden
        }

        #auth #auth-right {
            height: 100%;
            background: url(../images/4853433.jpg), linear-gradient(90deg, #2d499d, #3f5491)
        }

        #auth #auth-left {
            padding: 5rem 8rem
        }

        #auth #auth-left .auth-title {
            font-size: 4rem;
            margin-bottom: 1rem
        }

        #auth #auth-left .auth-subtitle {
            font-size: 1.7rem;
            line-height: 2.5rem;
            color: #a8aebb
        }

        #auth #auth-left .auth-logo {
            margin-bottom: 7rem
        }

        #auth #auth-left .auth-logo img {
            height: 2rem
        }

        @media screen and (max-width:767px) {
            #auth #auth-left {
                padding: 5rem
            }
        }

    </style>
@endsection
