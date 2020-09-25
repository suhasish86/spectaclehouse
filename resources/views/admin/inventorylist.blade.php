@extends('layouts.admin.list')

@section('pagetitle')
Admin | Inventory Management: {{ @ucfirst($product->productname) }} Inventory
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
                                    <h2>{{ @ucfirst($product->productname) }} Inventory</h2>
                                    <p>Manage your product inventory here, you can publish, edit or delete {{ $product->productname }} {{ Illuminate\Support\Str::plural('variant')}} from the below list.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                            <div class="breadcomb-report">
                                <button data-toggle="tooltip" data-placement="left" title="Add New {{ $product->productname }} Variant" class="btn" id="listadd"><i class="notika-icon notika-plus-symbol"></i></button>
                                <button data-toggle="tooltip" data-placement="top" title="Back To Product List" class="btn" id="listback"><i class="notika-icon notika-icon notika-app"></i></button>
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
                        <table id="table-inventorylist" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Product</th>
                                    <th>Colour</th>
                                    <th>Size</th>
                                    <th>Stock</th>
                                    <th>Gallery</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Product</th>
                                    <th>Colour</th>
                                    <th>Size</th>
                                    <th>Stock</th>
                                    <th>Gallery</th>
                                    <th>Edit</th>
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
@endsection

@section('page_scrypt')
<script type="text/javascript">
    var genre = "{{ $product->genre }}";
    var productid = "{{ $product->id }}";
    var productslug = "{{ $product->productslug }}";
</script>
<script src="{{ asset('adminassets/js/module-scripts/inventory.js') }}"></script>
@endsection


