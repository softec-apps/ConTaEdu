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
            <div class="py-12">
              <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                  <div class="max-w-xl">
                    @if (session('status'))
                      <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                      </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}"
                      id="update-profile-form">
                      @csrf
                      @method('PATCH')

                      <!-- Cédula -->
                      <div class="mt-4">
                        <x-input-label for="ci" :value="__('Cédula')" />
                        <x-text-input id="ci" name="ci" type="text"
                          class="mt-1 block w-full" :value="old('ci', $user->ci)" required
                          autofocus autocomplete="ci" />
                        <x-input-error :messages="$errors->get('ci')" class="mt-2" />
                      </div>

                      <!-- Nombre -->
                      <div class="mt-4">
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input id="name" name="name" type="text"
                          class="mt-1 block w-full" :value="old('name', $user->name)" required
                          autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                      </div>

                      <!-- Correo Electrónico -->
                      <div class="mt-4">
                        <x-input-label for="email" :value="__('Correo Electrónico')" />
                        <x-text-input id="email" name="email" type="email"
                          class="mt-1 block w-full" :value="old('email', $user->email)" required
                          autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                      </div>

                      <div class="flex items-center justify-end mt-4">
                        <x-primary-button
                          type="submit">{{ __('Guardar') }}</x-primary-button>
                      </div>
                    </form>
                  </div>
                </div>

                <!-- Sección para eliminar cuenta -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                  <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                      {{ __('Eliminar Cuenta') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                      {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. Antes de eliminar tu cuenta, por favor descarga cualquier dato o información que desees conservar.') }}
                    </p>

                    <div class="mt-6 flex justify-end">
                      <button type="button" class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#confirm-user-deletion">
                        Eliminar cuenta
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Incluir el componente del modal -->

              </div>
            </div>
          </div>
        </div>
      </div>

    </x-layouts.dashboard>
  @endsection
</x-app-layout>
<x-confirm-password />
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = document.getElementById('confirm-user-deletion');
    const openDeleteModalButton = document.querySelector(
      '[data-bs-target="#confirm-user-deletion"]');
    const cancelDeleteButton = document.querySelector(
      '[data-bs-dismiss="modal"]');

    if (openDeleteModalButton) {
      openDeleteModalButton.addEventListener('click', function() {
        deleteModal.classList.add('show');
        deleteModal.style.display = 'block';
      });
    }

    if (cancelDeleteButton) {
      cancelDeleteButton.addEventListener('click', function() {
        deleteModal.classList.remove('show');
        deleteModal.style.display = 'none';
      });
    }

    // Cerrar el modal si se hace clic fuera de él
    window.addEventListener('click', function(event) {
      if (event.target === deleteModal) {
        deleteModal.classList.remove('show');
        deleteModal.style.display = 'none';
      }
    });
  });
</script>
