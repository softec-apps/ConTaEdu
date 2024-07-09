<x-app-layout>
  <x-slot:title>Enviados y calificados</x-slot>
  @section('main')
  <!-- Join to exercise -->
  <x-estudiante.joinToExercise />
    <x-layouts.dashboard>
      <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
          <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
              <div class="col-auto">
                <h1 class="app-page-title mb-0">Ejercicios Enviados y Calificados</h1>
              </div>
              <div class="col-auto">
                <div class="page-utilities">
                  <div
                    class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">
                      <form class="docs-search-form row gx-1 align-items-center"
                        action="{{ route('estudiante.search_sent') }}" method="GET">
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
                  </div>
                </div>
              </div>
            </div>

            <div class="row g-4">
              @if(isset($exercises) && count($exercises) > 0)
                @foreach ($exercises as $exercise)
                  <x-card-item :exercise="$exercise"></x-card-item>
                @endforeach
              @else
                <p>No hay nada por el momento</p>
              @endif

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
