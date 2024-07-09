<x-app-layout>
  @section('main')
    <x-layouts.dashboard>
      <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Mi Perfil') }}
        </h2>
      </x-slot>

      <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
          <div class="container-xl">
            <div class="p-6 bg-white border-b border-gray-200">
              <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900">Información del
                  Perfil</h3>
                <p class="mt-1 text-sm text-gray-600">Actualiza tu información
                  de perfil y dirección de correo electrónico.</p>
              </div>

              <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <!-- Cédula -->
                <div class="mb-4 ml-4">
                  <x-input-label for="ci" :value="__('Cédula')" />
                  <x-text-input id="ci" name="ci" type="text"
                    class="mt-1 block w-full" :value="old('ci', $user->ci)" required autofocus
                    autocomplete="ci" />
                  <x-input-error class="mt-2" :messages="$errors->get('ci')" />
                </div>

                <!-- Nombre -->
                <div class="mb-4 ml-4">
                  <x-input-label for="name" :value="__('Nombre')" />
                  <x-text-input id="name" name="name" type="text"
                    class="mt-1 block w-full" :value="old('name', $user->name)" required
                    autocomplete="name" />
                  <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <!-- Correo Electrónico -->
                <div class="mb-4 ml-4">
                  <x-input-label for="email" :value="__('Correo Electrónico')" />
                  <x-text-input id="email" name="email" type="email"
                    class="mt-1 block w-full" :value="old('email', $user->email)" required
                    autocomplete="email" />
                  <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>

                {{-- <!-- Rol (readonly) -->
                <div class="mb-4 ml-4">
                  <x-input-label for="role" :value="__('Rol')" />
                  <x-text-input id="role" name="role" type="text"
                    class="mt-1 block w-full bg-gray-100" :value="$user->role"
                    readonly />
                </div> --}}

                <div class="flex items-center justify-end mt-4">
                  <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </x-layouts.dashboard>
  @endsection
</x-app-layout>
