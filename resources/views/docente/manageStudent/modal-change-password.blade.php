<div class="modal fade" id="modalChangePassword" tabindex="-1"
  aria-labelledby="modalChangePasswordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalChangePasswordLabel">Cambiar Contraseña
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <form id="formChangePassword" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="new_password" class="form-label">Nueva
              Contraseña</label>
            <input type="password" class="form-control" id="new_password"
              name="new_password" required>
          </div>
          <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirmar
              Nueva Contraseña</label>
            <input type="password" class="form-control"
              id="new_password_confirmation" name="new_password_confirmation"
              required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"
            data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Cambiar
            Contraseña</button>
        </div>
      </form>
    </div>
  </div>
</div>
