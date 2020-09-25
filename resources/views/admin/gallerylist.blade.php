@extends('layouts.admin.list')

@section('pagetitle')
Admin | Gallery Management: {{ @ucfirst($product->productname) }} Gallery
@endsection


@section('content-label')
<!-- Breadcomb area Start-->
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="notika-icon notika-windows"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>{{ @ucfirst($product->productname) }} Gallery</h2>
                                    <p>Manage your product variant images here, you can publish, edit or delete {{ $product->productname }} {{ Illuminate\Support\Str::plural('gallery')}} from the below list.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                            <div class="breadcomb-report">
                                <button data-toggle="tooltip" data-placement="left" title="Upload {{ $product->productname }} Images" class="btn" id="listadd"><i class="notika-icon notika-plus-symbol"></i></button>
                                <button data-toggle="tooltip" data-placement="top" title="Back To Product Inventories" class="btn" id="listback"><i class="notika-icon notika-icon notika-app"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcomb area End-->
@endsection


@section('content')
<!-- Data Table area Start-->
<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="data-table-list">
                    <div class="table-responsive">
                        <table id="table-gallerylist" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Publish</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Publish</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inventory Modal -->

<div class="modal fade" id="galleryModal" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form name="addgalleryfrm" id="addgalleryfrm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-example-wrap mg-t-30">
                                <div class="cmp-tb-hd cmp-int-hd">
                                    <h2>Upload Images.</h2>
                                </div>
                                <div class="form-example-int form-horizental">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="dropzone dropzone-nk needsclick dz-clickable" id="galleryUploader">
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
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="gallery_image" id="gallery_image" >
                    <button type="submit" class="btn btn-default">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Inventory Modal -->

@endsection

@section('page_styles')
<!-- dropzone CSS
============================================ -->
<link rel="stylesheet" href="{{ asset('adminassets/css/dropzone/dropzone.css') }}">
@endsection

@section('page_scrypt')
<!-- dropzone JS
============================================ -->
<script src="{{ asset('adminassets/js/dropzone/dropzone.js') }}"></script>

<script type="text/javascript">
    var genre = "{{ $product->genre }}";
    var productid = "{{ $product->id }}";
    var productslug = "{{ $product->productslug }}";
    var inventoryid = "{{ $inventory->id }}";
</script>
<script src="{{ asset('adminassets/js/module-scripts/product.gallery.js') }}"></script>
@endsection


