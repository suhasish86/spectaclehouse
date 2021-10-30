@extends('layouts.site')

@section('page-content-area')
<section class="p-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-5">
                <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <div class="whiteBox mb-2">
                    <h3 class="text-center mb-3">{{ __('Confirm Password') }}</h3>
                    <div class="form-group">
                        <div class="iconField"><input id="password" type="password" name="password" required autocomplete="current-password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"><span
                                class="fieldIcon"><i class="lni lni-key"></i></span></div>
                        @error('password')
                            <div class="alert alert-danger text-center" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="text-center"><input type="submit" class="btn btn-primary" value="{{ __('Confirm Password') }}"></div>
                </div>
                </form>
                @if (Route::has('password.request'))
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <p class="mb-0"><a href="{{ route('password.request') }}" class="text-primary">Forgot
                                Password?</a></p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
