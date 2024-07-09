<!-- Modal de confirmación -->
<div id="confirm-user-deletion" class="modal fade" tabindex="-1"
  aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">
          {{ __('¿Estás seguro de que quieres eliminar tu cuenta?') }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ route('profile.destroy') }}"
        id="delete-account-form">
        @csrf
        @method('DELETE')
        <div class="modal-body">
          <p class="mt-2 text-sm text-gray-500">
            {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. Por favor, ingresa tu contraseña para confirmar que deseas eliminar permanentemente tu cuenta.') }}
          </p>
          <div class="mt-4">
            <x-input-label for="password" value="{{ __('Contraseña') }}"
              class="sr-only" />
            <x-text-input id="password" name="password" type="password"
              class="mt-1 block w-full" placeholder="{{ __('Contraseña') }}"
              autocomplete="current-password" required />
            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">
            {{ __('Eliminar Cuenta') }}
          </button>
          <button type="button" class="btn btn-secondary"
            data-bs-dismiss="modal">
            {{ __('Cancelar') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
