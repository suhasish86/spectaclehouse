@extends('layouts.admin.list')

@section('pagetitle')
Admin | Brands Management: {{ @ucfirst($brand->product) }} Brands List
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
                                    <h2>{{ @ucfirst($brand->product) }} Brands List</h2>
                                    <p>Manage your {{ $brand->product }} {{ Illuminate\Support\Str::plural('brand')}} here, you can publish, edit or delete {{ $brand->product }} {{ Illuminate\Support\Str::plural('brand')}} from the below list.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                            <div class="breadcomb-report">
                                <button data-toggle="tooltip" data-placement="left" title="Add {{ @ucfirst($brand->product) }} Brand" class="btn" id="listadd"><i class="notika-icon notika-plus-symbol"></i></button>
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
                        <table id="table-brandlist" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Name</th>
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
    var product = "{{ $brand->product }}";
</script>
<script src="{{ asset('adminassets/js/module-scripts/brand.js') }}"></script>
@endsection


