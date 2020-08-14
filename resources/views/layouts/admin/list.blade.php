@extends('layouts.admin')

@section('specific_style')
<!-- Data Table JS
============================================ -->
<link rel="stylesheet" href="{{ asset('adminassets/css/jquery.dataTables.min.css') }}">
@endsection

@section('specific_scrypt')
<!-- Data Table JS
============================================ -->
<script src="{{ asset('adminassets/js/data-table/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminassets/js/data-table/data-table-act.js') }}"></script>
@endsection
