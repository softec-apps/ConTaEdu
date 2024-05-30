<x-app-layout>
    <main class="app app-login p-0">
        <div class="row g-0 app-auth-wrapper">
            <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
                <div class="d-flex flex-column align-content-end">
                    {{$slot}}
                    <x-app-footer></x-app-footer>
                </div><!--//flex-column-->
            </div><!--//auth-main-col-->
            <style>
                .new-auth-background-holder {
                    background:url("{{ asset('logo.png') }}") no-repeat center center;
                    background-size:cover;
                    height:100vh;
                    min-height:100%
                }
            </style>
            <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
                <div class="new-auth-background-holder">
                </div>
                <div class="auth-background-mask"></div>
            </div><!--//auth-background-col-->

        </div><!--//row-->
    </main>
</x-app-layout>