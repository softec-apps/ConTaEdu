<x-app-layout>
  @section('main')
    <x-layouts.dashboard>
      <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
          <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
              <div class="col-auto">
                <h1 class="app-page-title mb-0">Templates Registrados</h1>
              </div>
              <div class="col-auto">
                <div class="page-utilities">
                  <div
                    class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    {{-- <div class="col-auto">
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
                    </div> --}}
                    <div class="col-auto">
                      <a class="btn app-btn-primary" href="#"
                        data-bs-toggle="modal"
                        data-bs-target="#modalCreateTemplate">
                        <svg width="1em" height="1em" viewBox="0 0 16 16"
                          class="bi bi-file-earmark-plus me-2" fill="currentColor"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M8 6a.5.5 0 0 1 .5.5V8h1.5a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V9H6a.5.5 0 0 1 0-1h1.5V6.5A.5.5 0 0 1 8 6z" />
                          <path
                            d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM13.5 4H9a1 1 0 0 1-1-1V.5L13.5 4z" />
                        </svg>
                        Crear Template
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif

            <div class="row g-4">
              @foreach ($templates as $template)
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-body">
                      <i class="fas fa-book fa-3x"></i>
                      <h5 class="card-title">{{ $template->name }}</h5>
                      <p class="card-text">{{ $template->description }}</p>
                      <a href="{{ route('template.accounts', $template->id) }}"
                        class="btn btn-info">Ver Cuentas</a>
                      <a href="#" class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#editTemplateModal{{ $template->id }}">Editar</a>
                      <form action="{{ route('template.destroy', $template) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                          class="btn btn-danger">Eliminar</button>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- Modal para editar template -->
                <div class="modal fade" id="editTemplateModal{{ $template->id }}"
                  tabindex="-1"
                  aria-labelledby="editTemplateModalLabel{{ $template->id }}"
                  aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title"
                          id="editTemplateModalLabel{{ $template->id }}">Editar
                          Template</h5>
                        <button type="button" class="btn-close"
                          data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('template.update', $template) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                          <div class="mb-3">
                            <label for="name" class="form-label">Nombre del
                              Template</label>
                            <input type="text" class="form-control"
                              id="name" name="name"
                              value="{{ $template->name }}" required>
                          </div>
                          <div class="mb-3">
                            <label for="description"
                              class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description"
                              rows="3" required>{{ $template->description }}</textarea>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary">Guardar
                            Cambios</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </x-layouts.dashboard>
  @endsection
</x-app-layout>
<x-card-template />
