@extends('layouts.site')

@section('page-content-area')
    <section class="p-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-5">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="whiteBox mb-2">
                            <h3 class="text-center mb-3">{{ __('Reset Password') }}</h3>
                            <div class="form-group">
                                <div class="iconField"><input type="email" name="email" id="email"
                                        value="{{ $email ?? old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="{{ __('E-Mail Address') }}"><span class="fieldIcon"><i
                                            class="lni lni-user"></i></span></div>
                                @error('email')
                                    <div class="alert alert-danger text-center" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="iconField"><input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="{{ __('Password') }}"><span class="fieldIcon"><i
                                            class="lni lni-key"></i></span></div>
                                @error('password')
                                    <div class="alert alert-danger text-center" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="iconField"><input id="password-confirm" type="password"
                                        class="form-control" name="password_confirmation"
                                        placeholder="{{ __('Password') }}"><span class="fieldIcon"><i
                                            class="lni lni-key"></i></span></div>
                            </div>
                            <div class="text-center"><input type="submit" class="btn btn-primary"
                                    value="{{ __('Reset Password') }}"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
