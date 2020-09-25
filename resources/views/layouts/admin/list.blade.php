@extends('layouts.admin')

@section('specific_style')
<!-- Data Table JS
============================================ -->
<link rel="stylesheet" href="{{ asset('adminassets/css/jquery.dataTables.min.css') }}">

<!-- Color Picker CSS
============================================ -->
<link rel="stylesheet" href="{{ asset('adminassets/css/color-picker/spectrum.css') }}">
@endsection

@section('specific_scrypt')
<!-- Data Table JS
============================================ -->
<script src="{{ asset('adminassets/js/data-table/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminassets/js/data-table/data-table-act.js') }}"></script>

<!--  color-picker JS
============================================ -->
<script src="{{ asset('adminassets/js/color-picker/spectrum.js') }}"></script>

<!-- Validation Script
============================================ -->
<script src="{{ asset('adminassets/js/form.validate.js') }}"></script>
@endsection
