<div class="modal fade" id="modalCreateTemplate" tabindex="-1"
  aria-labelledby="modalCreateTemplateLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCreateTemplateLabel">Crear Nuevo Template
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <form action="{{ route('template.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Nombre del Template</label>
            <input type="text" class="form-control" id="name"
              name="name" required>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description"
              rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"
            data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar
            Template</button>
        </div>
      </form>
    </div>
  </div>
</div>
