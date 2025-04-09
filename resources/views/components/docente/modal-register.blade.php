<!-- resources/views/components/docente/modal-register.blade.php -->
<div class="modal fade" id="modalRegister" tabindex="-1"
  aria-labelledby="modalRegisterLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRegisterLabel">Registrar Estudiante</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <form class="settings-form" method="POST"
          action="{{ route('student.store') }}">
          @csrf
          <div class="mb-3">
            <label for="ci" class="form-label">Número de cédula</label>
            <input type="text" class="form-control" id="ci"
              name="ci" minlength="10" maxlength="10" required>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Nombre y Apellido</label>
            <input type="text" class="form-control" id="name"
              name="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email"
              name="email" required>
          </div>
          <button type="submit" class="btn app-btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
