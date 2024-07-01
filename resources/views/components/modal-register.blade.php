<!-- resources/views/components/modal-register.blade.php -->
<div class="modal fade" id="modalRegister" tabindex="-1"
  aria-labelledby="modalRegisterLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRegisterLabel">Registrar Ejercicio</h5>
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
          action="{{ route('exercise.store') }}">
          @csrf
          <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input class="form-control" id="titulo" name="titulo" required></input>
          </div>
          <div class="mb-3">
            <label for="desc" class="form-label">Descripción</label>
            <textarea class="form-control" id="desc" name="desc" required
              cols="30" rows="5" style="width: 100%; height: 100%;"></textarea>
          </div>
          <button type="submit" class="btn app-btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
