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
@endsection

@section('page_scrypt')
<script type="text/javascript">
    var genre = "{{ $product->genre }}";
</script>
<script src="{{ asset('adminassets/js/module-scripts/product.js') }}"></script>
@endsection


