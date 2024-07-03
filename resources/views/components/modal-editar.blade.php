<div class="modal fade" id="modalEditar{{ $id }}" tabindex="-1"
  aria-labelledby="modalEditarLabel{{ $id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarLabel{{ $id }}">Editar
          Ejercicio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('exercise.update', $id) }}" method="POST"
          class="p-3">
          @csrf
          @method('PUT')

          <div class="form-group mb-3">
            <label for="titulo{{ $id }}">Título</label>
            <input type="text" class="form-control"
              id="titulo{{ $id }}" name="titulo"
              value="{{ $titulo }}">
          </div>
          <div class="form-group mb-3">
            <label for="desc{{ $id }}">Descripción</label>
            <textarea class="form-control" id="desc{{ $id }}" name="desc"
              rows="5" cols="30" style="width: 100%; height: 100%;">{{ $desc }}</textarea>
          </div>

          <button type="submit" class="btn btn-primary">actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>
