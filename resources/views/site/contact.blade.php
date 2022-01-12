@extends('layouts.site')

@section('banner-content-area')
    @include('site.partials.banner')
@endsection

@section('page-content-area')

    <!---------------------- Eye Clinic Start ---------------------------->
    <section class="p-5">
        <div class="container">
            <h2 class="text-center mb-5">Contact Us</h2>
            <div class="row">
                <div class="col-md-7 col-lg-7 col-xl-7">
                    <div class="whiteBox mb-2">
                        <form name="contact-frm" id="contact-frm">
                            @csrf
                            <div class="form-group">
                                <div class="iconField"><input type="text" name="contact_name" id="contact_name" class="form-control"
                                        placeholder="Full Name"><span class="fieldIcon"><i
                                            class="lni lni-user"></i></span></div>
                            </div>
                            <div class="form-group">
                                <div class="iconField"><input type="text" name="contact_email" id="contact_email" class="form-control"
                                        placeholder="Email"><span class="fieldIcon"><i
                                            class="lni lni-envelope"></i></span></div>
                            </div>
                            <div class="form-group">
                                <div class="iconField"><input type="text" name="contact_phone" id="contact_phone" class="form-control"
                                        placeholder="Phone"><span class="fieldIcon"><i
                                            class="lni lni-phone"></i></span></div>
                            </div>
                            <div class="form-group">
                                <div class="iconField"> <textarea name="contact_message" id="contact_message" cols="30" rows="10"
                                        class="form-control" placeholder="Comments"></textarea> <span
                                        class="fieldIcon"><i class="lni lni-comments"></i></span></div>
                            </div>

                            <div><input type="submit" class="btn btn-primary" value="Send"></div>
                        </form>
                    </div>
                </div>
                <div class="col-md-5 col-lg-5 col-xl-5">
                    <div class="whiteBox whiteBox2">
                        <div class="mb-2">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d117788.94875855595!2d88.33824422598114!3d22.694593237319335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e3!4m5!1s0x39f882db4908f667%3A0x43e330e68f6c2cbc!2sKolkata%2C%20West%20Bengal!3m2!1d22.572646!2d88.363895!4m3!3m2!1d22.816332199999998!2d88.372267!5e0!3m2!1sen!2sin!4v1593624767335!5m2!1sen!2sin"
                                width="100%" height="200" frameborder="0" style="border:0;" allowfullscreen=""
                                aria-hidden="false" tabindex="0"></iframe>
                        </div>
                        <div class="mb-2">
                            <h5 class="mb-1">Location:</h5>
                            <p>705E,<br />
                                IBN Batuta Gate Office Complex,<br />
                                Jebel Ali, Dubai, UAE</p>
                        </div>
                        <div class="mb-2">
                            <h5 class="mb-1">Email:</h5>
                            <p><a href="mailto:lorem@gmail.com" class="text-primary">lorem@gmail.com</a> <br />
                                <a href="mailto:lorem@gmail.com" class="text-primary">lorem@gmail.com</a>
                            </p>
                        </div>
                        <div class="">
                            <h5 class="mb-1">Call:</h5>
                            <p><a href="tel:+9158796598123" class="text-primary">+9158796598123</a><br />
                                <a href="tel:+9158796598123" class="text-primary">+9158796598123</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!---------------------- Eye Clinic End ---------------------------->
@endsection

@push('javascript')
    <script defer src="{{ asset('siteassets/js/app/contact.js') }}"></script>
@endpush
