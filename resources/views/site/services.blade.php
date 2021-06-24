@extends('layouts.site')

@section('banner-content-area')
@include('site.partials.banner')
@endsection

@section('page-content-area')

<!---------------------- Services Start ---------------------------->
<section class="p-5">
    <div class="container">
      <h2 class="text-center mb-5">Services</h2>
      @if(!empty($services))
        @foreach($services as $facility)
            <div class="row align-items-center mb-5">
                <div class="col-md-6 {{ (($loop->iteration%2) == 0) ? 'order-md-2' : '' }}">
                    @if ($facility->facilityname != '')
                        <div class="mb-2"><img src="{{ $facility->facilityname }}" alt=""></div>
                    @else
                        <div class="mb-2"><img src="{{ asset('siteassets/img/services.png') }}" alt=""></div>
                    @endif
                </div>
                <div class="col-md-6 {{ (($loop->iteration%2) == 0) ? 'order-md-1' : '' }}" data-loop="{{ $loop->iteration%2 }}">
                    <h4>{{ $facility->facilityname }}</h4>
                    {!! $facility->description !!}
                </div>
            </div>
        @endforeach
    @endif

    </div>
  </section>

  <!---------------------- Services End ---------------------------->


@endsection
