<x-app-layout>
  @section('main')
    <x-layouts.dashboard>
      <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
          <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
              <div class="col-auto">
                <h1 class="app-page-title mb-0">Ejercicios Registrados</h1>
              </div>
              <div class="col-auto">
                <div class="page-utilities">
                  <div
                    class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                      <form class="docs-search-form row gx-1 align-items-center"
                        action="{{ route('exercise.search') }}" method="GET">
                        <div class="col-auto">
                          <input type="text" id="search-docs" name="searchdocs"
                            class="form-control search-docs"
                            placeholder="Ingrese el título">
                        </div>
                        <div class="col-auto">
                          <button type="submit"
                            class="btn app-btn-secondary">Buscar</button>
                        </div>
                      </form>
                    </div>
                    <div class="col-auto">
                      <a class="btn app-btn-primary" href="#"
                        data-bs-toggle="modal" data-bs-target="#modalRegister">
                        <svg width="1em" height="1em" viewBox="0 0 16 16"
                          class="bi bi-file-earmark-plus me-2" fill="currentColor"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M8 6a.5.5 0 0 1 .5.5V8h1.5a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V9H6a.5.5 0 0 1 0-1h1.5V6.5A.5.5 0 0 1 8 6z" />
                          <path
                            d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM13.5 4H9a1 1 0 0 1-1-1V.5L13.5 4z" />
                        </svg>
                        Crear Ejercicio
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row g-4">
              @foreach ($exercises as $exercise)
              <div class="col-6 col-md-4 col-xl-4 col-xxl-3">
                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                  data-bs-target="#qualificationModal{{ $exercise->id }}"
                  data-access-code="{{ $exercise->access_code ?? 'error al obtener el código' }}">
                @component('components.card-item', [
                    'title' => $exercise->titulo,
                    'autor' => $exercise->autor,
                    'created_at' => $exercise->created_at,
                    'viewed' => $exercise->viewed,
                    'calificado' => $exercise->calificado,
                    'nota' => $exercise->nota,
                    'role' => 2,
                    'exercise' => $exercise,
                    'viewed' => true,
                    'graded' => true,
                    'grid' => false
                ])
                @endcomponent
                </a>
              </div>
              @endforeach

              <nav class="app-pagination mt-5">
                <ul class="pagination justify-content-center">
                  {{ $exercises->links('vendor.pagination.bootstrap-4') }}
                </ul>
              </nav>
            </div>
          </div>
        </div>
    </x-layouts.dashboard>
  @endsection
</x-app-layout>
<x-modal-register />
