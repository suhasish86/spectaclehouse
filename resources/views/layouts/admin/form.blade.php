@extends('layouts.admin')

@section('specific_style')
<!-- bootstrap select CSS
============================================ -->
<link rel="stylesheet" href="{{ asset('adminassets/css/bootstrap-select/bootstrap-select.css') }}">
<!-- summernote CSS
============================================ -->
<link rel="stylesheet" href="{{ asset('adminassets/css/summernote/summernote.css') }}">
<!-- datapicker CSS
============================================ -->
<link rel="stylesheet" href="{{ asset('adminassets/css/datapicker/datepicker3.css') }}">
<!-- Color Picker CSS
============================================ -->
<link rel="stylesheet" href="{{ asset('adminassets/css/color-picker/farbtastic.css') }}">
<!-- main CSS
============================================ -->
<link rel="stylesheet" href="{{ asset('adminassets/css/chosen/chosen.css') }}">
<!-- notification CSS
============================================ -->
<link rel="stylesheet" href="{{ asset('adminassets/css/notification/notification.css') }}">
<!-- dropzone CSS
============================================ -->
<link rel="stylesheet" href="{{ asset('adminassets/css/dropzone/dropzone.css') }}">

@endsection

@section('specific_scrypt')

<!-- datapicker JS
============================================ -->
<script src="{{ asset('adminassets/js/datapicker/bootstrap-datepicker.js') }}"></script>
<!-- bootstrap select JS
============================================ -->
<script src="{{ asset('adminassets/js/bootstrap-select/bootstrap-select.js') }}"></script>
<!--  color-picker JS
============================================ -->
<script src="{{ asset('adminassets/js/color-picker/farbtastic.min.js') }}"></script>
<script src="{{ asset('adminassets/js/color-picker/color-picker.js') }}"></script>
<!--  summernote JS
============================================ -->
<script src="{{ asset('adminassets/js/summernote/summernote-updated.min.js') }}"></script>
<!-- dropzone JS
============================================ -->
<script src="{{ asset('adminassets/js/dropzone/dropzone.js') }}"></script>


<!-- Validation Script
============================================ -->
<script src="{{ asset('adminassets/js/form.validate.js') }}"></script>
@endsection
