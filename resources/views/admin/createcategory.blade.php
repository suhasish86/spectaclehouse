@extends('layouts.admin.form')

@section('pagetitle')
Admin | Category Management: {{ isset($category->categoryslug) ? 'Edit' : 'Add' }} Category
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-example-wrap mg-t-30">
                <form name="createcategoryfrm" id="createcategoryfrm">
                    @csrf
                    <div class="cmp-tb-hd cmp-int-hd">
                        <h2>Create Category.</h2>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">Category Name</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="categoryname" id="categoryname" class="form-control input-sm" placeholder="Name of your category" value="{{ isset($category->categoryname) ? $category->categoryname : '' }}">
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
                                        <input type="text" name="browsertitle" id="browsertitle" class="form-control input-sm" placeholder="Title for your browser" value="{{ isset($category->browsertitle) ? $category->browsertitle : '' }}">
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
                                        <input type="text" name="metakeyword" id="metakeyword" class="form-control input-sm" placeholder="Keywords for your category" value="{{ isset($category->metakeyword) ? $category->metakeyword : '' }}">
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
                                        <input type="text" name="metadescription" id="metadescription" class="form-control input-sm" placeholder="Description of your category" value="{{ isset($category->metadescription) ? $category->metadescription : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                        <label class="hrzn-fm">Category Banner</label>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                        <div class="dropzone dropzone-nk needsclick dz-clickable bannerThumbUpload" id="bannerUploader" data-file="{{ isset($category->banner) ? $category->banner : '' }}" data-link="{{ isset($category->banner_link) ? asset($category->banner_link) : '' }}" data-size="{{ isset($category->banner_size) ? $category->banner_size : '' }}">
                                            <div class="dz-message needsclick download-custom">
                                                <i class="notika-icon notika-cloud"></i>
                                                <h2>Drop files here or click to upload.</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int mg-t-15">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                <input type="hidden" name="banner" id="banner">
                                <input type="hidden" name="categoryslug" id="categoryslug" value="{{ isset($category->categoryslug) ? $category->categoryslug : '' }}">
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
<script src="{{ asset('adminassets/js/module-scripts/category.js') }}"></script>
@endsection
