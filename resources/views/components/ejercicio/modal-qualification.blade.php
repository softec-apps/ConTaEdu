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
          {{-- <table class="table">
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
          </table> --}}
          <table class="table table-bordered w-100" id="qualificationTable">
            <thead>
              <tr>
                <th>Estudiante</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Calificación</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($assignedStudents as $assignment)
                <tr>
                  <td>{{ $assignment->estudiante->name }}</td>
                  <td>{{ $assignment->estudiante->email }}</td>
                  <td>
                    @if ($assignment->sent)
                      <a href="{{ route('exercise.view-submission', ['exerciseId' => $exercise->id, 'studentId' => $assignment->estudiante->id]) }}"
                        class="btn btn-sm btn-primary"
                        target="_blank">Entregado</a>
                    @else
                      <span class="text-warning">Pendiente</span>
                    @endif
                  </td>
                  <td>
                    <input type="number" class="form-control"
                      name="grades[{{ $assignment->estudiante->id }}]"
                      value="{{ $assignment->grade ?? 0 }}" min="0"
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

@push('scripts')
  <script>
    $(document).ready(function() {
      let miTabla = $('#qualificationTable').DataTable(setDataTableConfig({
                        processing: false,
                        serverSide: false,
                    },
                    [{
                        text: '<i class="fa-solid fa-circle-plus"></i> Agregar',
                        className: 'btn bg-success text-white',
                        action: function() {
                            $('#miModal').modal('show');
                        }
                    }]));
    })
  </script>
@endpush
