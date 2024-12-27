{{-- <header> --}}
@include('admin.sections.header')


<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            {{-- navbar --}}
            @include('admin.sections.navbar')



            {{-- sidebar --}}
            @include('admin.sections.sidebar')



            <!-- Main Content -->
            <div class="main-content">
                <section class="">
                    @include('admin.components.breadcrumb')
                    @yield('content')
                </section>

            </div>




            {{-- footer --}}
            @include('admin.sections.footer')
