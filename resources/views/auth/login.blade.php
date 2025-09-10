@extends('auth.layouts.app')
@section('title', 'Login')

@section('content')
    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="auth-header">
                    <img src="{{ asset('uploads/images/petshop.PNG') }}" width="70px" alt="img">
                </div>
                <div class="card my-5">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-between align-items-end mb-4">
                                <h3 class="mb-0"><b>Login</b></h3>
                                <a href="{{ route('register') }}" class="link-primary">Don't have an account?</a>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="d-flex mt-1 justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input input-primary" type="checkbox" name="remember"
                                        id="remember">
                                    <label class="form-check-label text-muted" for="remember">Remember Password</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="text-secondary f-w-400">Forgot
                                    Password?</a>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div class="saprator mt-3">
                                <span>Login with</span>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="d-grid">
                                        <a href="{{ route('auth.google.redirect') }}"
                                            class="btn mt-2 btn-light-primary bg-light text-muted">
                                            <img src="{{ asset('assets/images/authentication/google.svg') }}"
                                                alt="Google">
                                            <span class="d-none d-sm-inline-block">Google</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-grid">
                                        <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                            <img src="../assets/images/authentication/twitter.svg" alt="img"> <span
                                                class="d-none d-sm-inline-block"> Twitter</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-grid">
                                        <a href="{{ route('auth.facebook.redirect') }}"
                                            class="btn mt-2 btn-light-primary bg-light text-muted">
                                            <img src="{{ asset('assets/images/authentication/facebook.svg') }}"
                                                alt="Facebook">
                                            <span class="d-none d-sm-inline-block">Facebook</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="auth-footer row">
                    <div class="col my-1">
                        <p>Design & Development by <strong>Nguyen Bao Anh.</strong></p>
                    </div>
                    {{-- <div class="col-auto my-1">
                        <ul class="list-inline footer-link mb-0">
                            <li class="list-inline-item"><a href="#">Home</a></li>
                            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="#">Contact us</a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
