<x-app-layout>
    <x-slot name="title">Restablecer Contraseña</x-slot>

    @section('main')
        <x-layouts.auth>
            <div class="app-auth-body mx-auto">
                <div class="app-auth-branding mb-4">
                    <a class="d-flex justify-content-center app-logo" href="{{ route('login') }}">
                        <x-application-logo />
                    </a>
                </div>
                <h2 class="auth-heading text-center mb-5">Restablecer Contraseña</h2>
                <div class="auth-form-container text-start">
                    <form method="POST" action="{{ route('password') }}">
                        @csrf
                        <input type="hidden" name="token" id="token">
                        <input type="hidden" name="email" id="email">
                    
                        <div class="mb-3">
                            <x-input-label for="password" :value="__('Nueva Contraseña')" />
                            <x-text-input id="password" class="form-control" type="password" name="password" required />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    
                        <div class="mb-3">
                            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                            <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    
                        <div class="text-center">
                            <button type="submit" class="btn app-btn-primary">Restablecer Contraseña</button>
                        </div>
                    </form>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const url = window.location.href;
                            const path = new URL(url).pathname;
                            const pathSegments = path.split('/');
                            const token = pathSegments[pathSegments.length - 1];
                            const urlParams = new URLSearchParams(window.location.search);
                            const email = urlParams.get('email');
                            document.getElementById('token').value = token;
                            document.getElementById('email').value = email;
                        });
                    </script>
                    
                </div><!--//auth-form-container-->
            </div><!--//auth-body-->
        </x-layouts.auth>
    @endsection
</x-app-layout>
