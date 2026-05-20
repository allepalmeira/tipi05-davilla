<!DOCTYPE html>
<html lang="pt-BR">

<head>
    @include('admin.partials.head')

     @vite(['resources/js/app.js'])
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">
        @include('admin.partials.app-header')

        @include('admin.partials.app-sidebar')

        <main class="app-main">
            @include('admin.partials.content-header')
            @yield('content')
        </main>

        @include('admin.partials.app-footer')

    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>

    {{-- @include('partials.script'): Carrega os scripts usados em várias páginas --}}
    @include('admin.partials.script')

    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

            // Disable OverlayScrollbars on mobile devices to prevent touch interference
            const isMobile = window.innerWidth <= 992;

            if (
                sidebarWrapper &&
                OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
                !isMobile
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>

    @stack('plugins') {{-- @stack: Área reservada, vai permitir que uma página específica injete um script --}}

    @stack('scripts')

</body>

</html>