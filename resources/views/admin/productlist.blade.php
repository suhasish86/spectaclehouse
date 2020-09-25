@extends('layouts.admin.list')

@section('pagetitle')
Admin | Product Management: {{ ucfirst($product->genre) }}list
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
                                    <h2>Product: {{ Illuminate\Support\Str::plural(ucfirst($product->genre))}} List</h2>
                                    <p>Manage your {{ Illuminate\Support\Str::plural($product->genre)}} here, you can publish, edit or delete {{ Illuminate\Support\Str::plural($product->genre)}} from the below list.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                            <div class="breadcomb-report">
                                <button data-toggle="tooltip" data-placement="left" title="Add {{ Illuminate\Support\Str::plural(ucfirst($product->genre))}}" class="btn" id="listadd"><i class="notika-icon notika-plus-symbol"></i></button>
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
                        <table id="table-productlist" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    @php if($product->genre != 'accessories') echo '<th>Style</th>'; @endphp
                                    @php if($product->genre != 'accessories' && $product->genre != 'contactlense') echo '<th>Material</th>'; @endphp
                                    <th>Price</th>
                                    <th>Inventory</th>
                                    <th>Publish</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    @php if($product->genre != 'accessories') echo '<th>Style</th>'; @endphp
                                    @php if($product->genre != 'accessories' && $product->genre != 'contactlense') echo '<th>Material</th>'; @endphp
                                    <th>Price</th>
                                    <th>Inventory</th>
                                    <th>Publish</th>
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

<!-- Inventory Modal -->

<div class="modal fade" id="inventoryModal" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form name="createinventory" id="createinventory">
                @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-example-int form-horizental colorsection" id="colordiv-1">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                <label class="hrzn-fm" id="colorLabel">Product Colour</label>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-9">
                                                <div class="nk-int-st">
                                                    <input type="text" name="colorcode[]" id="colorcode-1" class="form-control input-sm color-picker" placeholder="Product Colour" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                                <div class="nk-int-st">
                                                    <button type="button" id="coloradd" data-color-count="1" class="btn"><i class="notika-icon notika-plus-symbol"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-example-int form-horizental sizesection" id="sizediv-1">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                <label class="hrzn-fm" id="sizeLabel">Product Size</label>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-9">
                                                <div class="nk-int-st">
                                                    <input type="text" name="size[]" id="size-1" class="form-control input-sm" placeholder="Product Size" value="">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
                                                <div class="nk-int-st">
                                                    <button type="button" id="sizeadd" data-size-count="1" class="btn"><i class="notika-icon notika-plus-symbol"></i></button>
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
                    <input type="hidden" name="productid" id="productid" >
                    <button type="submit" class="btn btn-default">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Inventory Modal -->
@endsection

@section('page_scrypt')
<script type="text/javascript">
    var genre = "{{ $product->genre }}";
</script>
<script src="{{ asset('adminassets/js/module-scripts/product.js') }}"></script>
@endsection


