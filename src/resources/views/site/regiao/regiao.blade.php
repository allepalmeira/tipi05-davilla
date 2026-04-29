@extends('layout.site')

@section('content')

@include('site.regiao.page-title')
@include('site.regiao.recipes-section')

@endsection


@push('plugins')
<script src="{{ asset('davilla/js/select2.min.js') }}"></script>
@endpush