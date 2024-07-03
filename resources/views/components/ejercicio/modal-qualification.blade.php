<div class="modal fade" id="qualificationModal{{ $exercise->id }}" tabindex="-1"
  aria-labelledby="qualificationModalLabel{{ $exercise->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qualificationModalLabel{{ $exercise->id }}">
          Calificar Ejercicio: {{ $exercise->title }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <form action="{{ route('exercise.save-grades', $exercise->id) }}"
        method="POST">
        @csrf
        <div class="modal-body">
          <table class="table">
            <thead>
              <tr>
                <th>Estudiante</th>
                <th>Email</th>
                <th>Calificación</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($assignedStudents as $assignment)
                <tr>
                  <td>{{ $assignment->estudiante->name }}</td>
                  <td>{{ $assignment->estudiante->email }}</td>
                  <td>
                    <input type="number" class="form-control"
                      name="grades[{{ $assignment->estudiante->id }}]"
                      value="{{ $assignment->grade }}" min="0"
                      max="10" step="0.01">
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"
            data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar
            calificaciones</button>
        </div>
      </form>
    </div>
  </div>
</div>
