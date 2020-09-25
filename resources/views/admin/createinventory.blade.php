@extends('layouts.admin.form')

@section('pagetitle')
Admin | Inventory Management: {{ isset($product->productname) ? 'Edit' : 'Add' }} Variant
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-example-wrap mg-t-30">
                <form name="createinventoryfrm" id="createinventoryfrm">
                    @csrf
                    <div class="cmp-tb-hd cmp-int-hd">
                        <h2>Create {{ $product->productname }} Variant.</h2>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">Color</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="colorcode" id="colorcode" class="form-control input-sm" placeholder="Name of your category" value="{{ isset($inventory->color) ? $inventory->color : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">Size</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="size" id="size" class="form-control input-sm" placeholder="Size of your product" value="{{ isset($inventory->size) ? $inventory->size : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-example-int form-horizental">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                    <label class="hrzn-fm">Stock</label>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                    <div class="nk-int-st">
                                        <input type="text" name="stock" id="stock" class="form-control input-sm" placeholder="Stock for your product" value="{{ isset($inventory->stock) ? $inventory->stock : '' }}">
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
                                <input type="hidden" name="inventoryid" id="inventoryid" value="{{ isset($inventory->id) ? $inventory->id : 0 }}">
                                <input type="hidden" name="productid" id="productid" value="{{ $product->id }}">
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
<script type="text/javascript">
    var productid = "{{ $product->id }}";
    var productslug = "{{ $product->productslug }}";
</script>
<script src="{{ asset('adminassets/js/module-scripts/inventory.js') }}"></script>
@endsection
