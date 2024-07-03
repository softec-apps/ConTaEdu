@props([
  'viewed' => false,
  'graded' => false,
  'role' => 3, // Estudiante por defecto
  'exercise' => null, // Aseguramos que la variable $exercise esté definida
])

<div class="col-6 col-md-4 col-xl-4 col-xxl-3">
  <div class="app-card app-card-doc shadow-sm h-100">
    <div class="app-card-thumb-holder p-3">
      <span class="icon-holder text-info">
        <i class="fa-solid fa-file-invoice-dollar"></i>
      </span>

      @if (!$viewed && !$exercise->asignaciones->viewed)
        <span class="badge bg-success">NEW</span>
      @endif

      <a class="app-card-link-mask" href="#file-link"></a>
    </div>
    <div class="app-card-body p-3 has-card-actions">
      <h4 class="app-doc-title truncate mb-0">
        <a href="#file-link">
          {{ $exercise->titulo ?? 'Título del Ejercicio' }}
        </a>
      </h4>
      <div class="app-doc-meta">
        <ul class="list-unstyled mb-0">
          <li><span class="text-muted">Autor:</span>
            {{ $exercise->user->name ?? 'Anónimo' }}</li>
          </li>
          <li><span class="text-muted">código:</span>
            {{ $exercise->access_code ?? 'error al obtener el código' }}</li>
          </li>
          <li><span class="text-muted">Subido:</span>
            {{ $exercise->created_at ?? '--/--/----' }}</li>
          @if ($graded)
            <li><span class="text-muted">Calificación:</span>
              {!! isset($exercise->asignaciones->grade) ?
                $exercise->asignaciones->grade . ' / 10'
                : '<span class="badge bg-danger">Pendiente</span>' !!}</li>
          @endif
        </ul>
      </div><!--//app-doc-meta-->

      @if ($role == 2)
        <div class="app-card-actions">
          <div class="dropdown">
            <div class="dropdown-toggle no-toggle-arrow"
              data-bs-toggle="dropdown" aria-expanded="false">
              <svg width="1em" height="1em" viewBox="0 0 16 16"
                class="bi bi-three-dots-vertical" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
              </svg>
            </div>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                  data-bs-target="#codeModal{{ $exercise->id }}"
                  data-access-code="{{ $exercise->access_code ?? 'error al obtener el código' }}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                    height="1em" fill="currentColor" class="bi bi-lock me-2"
                    viewBox="0 0 16 16">
                    <path
                      d="M8 1a2.5 2.5 0 0 1 2.5 2.5V6h-5v-.5A2.5 2.5 0 0 1 8 1zm3 6H5v6h6V7zm-1 1a1 1 0 1 0-2 0v1h2V8z" />
                  </svg>
                  Ver Código
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                  data-bs-target="#viewModal{{ $exercise->id }}"
                  data-desc="{{ $exercise->desc ?? 'No hay descripción disponible' }}">
                  <svg width="1em" height="1em" viewBox="0 0 16 16"
                    class="bi bi-eye me-2" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z" />
                    <path fill-rule="evenodd"
                      d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                  </svg>
                  Ver
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                  data-bs-target="#modalEditar{{ $exercise->id }}">
                  <svg width="1em" height="1em" viewBox="0 0 16 16"
                    class="bi bi-pencil me-2" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                  </svg>
                  Editar
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li>
                <form action="{{ route('exercise.destroy', $exercise->id) }}"
                  method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="dropdown-item">
                    <svg width="1em" height="1em" viewBox="0 0 16 16"
                      class="bi bi-trash me-2" fill="currentColor"
                      xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                      <path fill-rule="evenodd"
                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                    </svg>
                    Eliminar
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      @endif
    </div><!--//app-card-body-->
  </div><!--//app-card-->
</div><!--//col-->

<!-- Incluir el componente del modal -->
<x-modal-exercise id="viewModal{{ $exercise->id }}"
  title="Detalle del Ejercicio" :content="$exercise->desc ?? 'No hay descripción disponible'" />

<!-- Incluir el componente del modal -->
<x-modal-editar :id="$exercise->id" :desc="$exercise->desc" :titulo="$exercise->titulo" />

<!-- Incluir el componente del modal -->
<x-ejercicio.modal-code id="codeModal{{ $exercise->id }}"
  title="Código de Acceso" :content="$exercise->access_code ?? 'No hay codigo disponible'" />

<!-- Incluir el componente para registrar la calificacion-->


<script>
  $('#viewModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var desc = button.data('desc') // Extract info from data-* attributes
    var modal = $(this)
    modal.find('.modal-body').text(desc)
  })
</script>
