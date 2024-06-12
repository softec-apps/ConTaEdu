<!-- resources/views/components/docente/modal-editar.blade.php -->
<div class="modal fade" id="modalEditar" tabindex="-1"
  aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarLabel">Editar Estudiante</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <form id="formEditar" action="" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="edit_ci" class="form-label">Número de cédula</label>
            <input type="text" class="form-control" id="edit_ci"
              name="ci" required>
          </div>
          <div class="mb-3">
            <label for="edit_name" class="form-label">Nombre y Apellido</label>
            <input type="text" class="form-control" id="edit_name"
              name="name" required>
          </div>
          <div class="mb-3">
            <label for="edit_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="edit_email"
              name="email" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"
            data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar
            cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>
