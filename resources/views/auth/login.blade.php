@extends('layouts.site')

@section('page-content-area')
    <section class="p-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-5">
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="whiteBox mb-2">
                        <h3 class="text-center mb-3">Login</h3>
                        <div class="form-group">
                            <div class="iconField"><input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="User ID"><span
                                    class="fieldIcon"><i class="lni lni-user"></i></span></div>
                            @error('email')
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="iconField"><input type="password" id="password" name="password" class="form-control"
                                    placeholder="Password"><span class="fieldIcon"><i
                                        class="lni lni-key"></i></span></div>
                            @error('password')
                            <div class="alert alert-danger text-center" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center"><input type="submit" class="btn btn-primary" value="Login"></div>
                    </div>
                    </form>
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <p class="mb-0"><a href="{{ route('password.request') }}" class="text-primary">Forgot
                                    Password?</a></p>
                        </div>
                        <div>
                            <p class="mb-0"><a href="{{ route('register') }}" class="text-primary">Sign Up</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
