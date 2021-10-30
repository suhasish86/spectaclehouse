@extends('layouts.site')

@section('page-content-area')
    <section class="p-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="whiteBox mb-2">
                            <h3 class="text-center mb-3">Sign Up</h3>
                            <div class="form-group">
                                <div class="iconField">
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="form-control" placeholder="Full Name"><span class="fieldIcon"><i
                                            class="lni lni-user"></i></span>
                                </div>
                                @error('name')
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="iconField"><input type="email" name="email" id="email"
                                        value="{{ old('email') }}" class="form-control" placeholder="Email"><span
                                        class="fieldIcon"><i class="lni lni-envelope"></i></span></div>
                                @error('email')
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="iconField"><input type="text" name="phone" id="phone"
                                        value="{{ old('phone') }}" class="form-control" placeholder="Phone"><span
                                        class="fieldIcon"><i class="lni lni-phone"></i></span></div>
                            </div>
                            <div class="form-group">
                                <div class="iconField"><input type="password" name="password" id="password"
                                        class="form-control" placeholder="Password"><span class="fieldIcon"><i
                                            class="lni lni-key"></i></span></div>
                                @error('password')
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="iconField"><input type="password" name="password_confirmation"
                                        id="password_confirmation" class="form-control"
                                        placeholder="Confirm Password"><span class="fieldIcon"><i
                                            class="lni lni-key"></i></span></div>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-center"><input type="submit" class="btn btn-primary" value="Sign Up"></div>
                        </div>
                    </form>
                    <div class="d-flex flex-row justify-content-between">
                        <div class="blankSpace"></div>
                        <div>
                            <p class="mb-0"><a href="{{ route('login') }}" class="text-primary">Sign In</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
