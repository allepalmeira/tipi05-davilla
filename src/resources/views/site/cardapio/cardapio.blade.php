@extends('layout.site')

@section('content')

@include('site.cardapio.page-title')
@include('site.cardapio.portfolio-section')

@endsection


{{-- Plugin usado apenas nesta página.

    O mixitup.js é responsável pelos filtros/animações da galeria.
    Ele não deve ficar no script global para evitar carregar código desnecessário em páginas que não usam galeria.
--}}

@push('plugins')
<script src="{{ asset('davilla/js/mixitup.js') }}"></script>
@endpush