@extends('layouts.site')

@section('page-content-area')
    <section class="p-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-5">
                    @if (session('status'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="whiteBox mb-2">
                            <h3 class="text-center mb-3">{{ __('Reset Password') }}</h3>
                            <div class="form-group">
                                <div class="iconField"><input type="email" name="email" id="email"
                                        value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="{{ __('E-Mail Address') }}"><span class="fieldIcon"><i
                                            class="lni lni-user"></i></span></div>
                                @error('email')
                                    <div class="alert alert-danger text-center" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="text-center"><input type="submit" class="btn btn-primary"
                                    value="{{ __('Send Password Reset Link') }}"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
