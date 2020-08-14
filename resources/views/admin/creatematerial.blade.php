@extends('layouts.admin.form')

@section('pagetitle')
Admin | Frame Materials Management: {{ ($material->materialslug != '') ? 'Edit' : 'Add' }} Frame Material
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-example-wrap mg-t-30">
                <form name="creatematerialfrm" id="creatematerialfrm">
                    @csrf
                    <div class="cmp-tb-hd cmp-int-hd">
                        <h2>{{ ($material->materialslug != '') ? 'Edit' : 'Create' }} Frame Material.</h2>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">Material Name</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="materialname" id="materialname" class="form-control input-sm" placeholder="Name of your material" value="{{ isset($material->materialname) ? $material->materialname : '' }}">
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
                                        <input type="text" name="browsertitle" id="browsertitle" class="form-control input-sm" placeholder="Title for your browser" value="{{ isset($material->browsertitle) ? $material->browsertitle : '' }}">
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
                                        <input type="text" name="metakeyword" id="metakeyword" class="form-control input-sm" placeholder="Keywords for your material" value="{{ isset($material->metakeyword) ? $material->metakeyword : '' }}">
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
                                        <input type="text" name="metadescription" id="metadescription" class="form-control input-sm" placeholder="Description of your material" value="{{ isset($material->metadescription) ? $material->metadescription : '' }}">
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
                                        <div class="dropzone dropzone-nk needsclick dz-clickable" id="bannerUploader" data-file="{{ isset($material->banner) ? $material->banner : '' }}" data-link="{{ isset($material->banner_link) ? asset($material->banner_link) : '' }}" data-size="{{ isset($material->banner_size) ? $material->banner_size : '' }}">
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
                                <input type="hidden" name="product" id="product" value="{{ $material->product }}">
                                <input type="hidden" name="materialslug" id="materialslug" value="{{ isset($material->materialslug) ? $material->materialslug : '' }}">
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
<script src="{{ asset('adminassets/js/module-scripts/material.js') }}"></script>
@endsection
