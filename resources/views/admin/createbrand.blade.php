@extends('layouts.admin.form')

@section('pagetitle')
Admin | Frame Brands Management: {{ ($brand->brandslug != '') ? 'Edit' : 'Add' }} Frame Brand
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-example-wrap mg-t-30">
                <form name="createbrandfrm" id="createbrandfrm">
                    @csrf
                    <div class="cmp-tb-hd cmp-int-hd">
                        <h2>{{ ($brand->brandslug != '') ? 'Edit' : 'Create' }} Frame Brand.</h2>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">Brand Name</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="brandname" id="brandname" class="form-control input-sm" placeholder="Name of your brand" value="{{ isset($brand->brandname) ? $brand->brandname : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">Browser Title</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="browsertitle" id="browsertitle" class="form-control input-sm" placeholder="Title for your browser" value="{{ isset($brand->browsertitle) ? $brand->browsertitle : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">Meta Keyword</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="metakeyword" id="metakeyword" class="form-control input-sm" placeholder="Keywords for your brand" value="{{ isset($brand->metakeyword) ? $brand->metakeyword : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">Meta Description</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="metadescription" id="metadescription" class="form-control input-sm" placeholder="Description of your brand" value="{{ isset($brand->metadescription) ? $brand->metadescription : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Type Banner</label>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <div class="dropzone dropzone-nk needsclick dz-clickable" id="bannerUploader" data-file="{{ isset($brand->banner) ? $brand->banner : '' }}" data-link="{{ isset($brand->banner_link) ? asset($brand->banner_link) : '' }}" data-size="{{ isset($brand->banner_size) ? $brand->banner_size : '' }}">
                                            <div class="dz-message needsclick download-custom">
                                                <i class="notika-icon notika-cloud"></i>
                                                <h2>Drop files here or click to upload.</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  --}}
                    <div class="form-example-int mg-t-15">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                <input type="hidden" name="banner" id="banner">
                                <input type="hidden" name="product" id="product" value="{{ $brand->product }}">
                                <input type="hidden" name="brandslug" id="brandslug" value="{{ isset($brand->brandslug) ? $brand->brandslug : '' }}">
                                <button class="btn btn-success notika-btn-success waves-effect">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_scrypt')
<script src="{{ asset('adminassets/js/module-scripts/brand.js') }}"></script>
@endsection
