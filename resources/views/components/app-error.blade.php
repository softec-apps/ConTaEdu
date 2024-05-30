<div class="app-404-page">
    <div class="container mb-5">
        <div class="row">
            <div class="col-12 col-md-11 col-lg-7 col-xl-6 mx-auto">
                <div class="app-branding text-center mb-5">
                    <a class="d-flex justify-content-center app-logo" href="{{ route('login') }}">
                        <x-application-logo /></a>
                </div><!--//app-branding-->

                <!-- Page Content -->
                <div>
                    <div class="app-card p-5 text-center shadow-sm">
                        <h1 class="page-title mb-4">@yield('code')<br><span
                                class="font-weight-light">@yield('message')</span></h1>
                        <div class="mb-4">
                            @yield('description')
                        </div>
                        <a class="btn app-btn-primary" href="{{ route('login') }}">Página principal</a>
                    </div>
                </div>
            </div><!--//col-->
        </div><!--//row-->
    </div><!--//container-->
</div>

<x-app-footer></x-app-footer>