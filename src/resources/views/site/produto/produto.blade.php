@extends('layout.site')

@section('content')

@include('site.produto.page-title')
@include('site.produto.sidebar')

@endsection


@push('plugins')
<script src="{{ asset('davilla/js/sticky_sidebar.min.js') }}"></script>
@endpush