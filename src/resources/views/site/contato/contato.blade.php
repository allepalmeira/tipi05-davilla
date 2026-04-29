@extends('layout.site')

@section('content')

@include('site.contato.page-title')
@include('site.contato.contact')
@include('site.contato.map')

@endsection

@push('plugins')
<script src="{{ asset('davilla/js/select2.min.js') }}"></script>
@endpush