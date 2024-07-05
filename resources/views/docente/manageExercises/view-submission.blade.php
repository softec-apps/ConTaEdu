<x-app-layout>
  @section('main')
    <x-layouts.dashboard>
      <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
          <div class="container-xl">
            <div class="row g-3 mb-4 align-items-center justify-content-between">
              <div class="col-auto">
                <h1 class="app-page-title mb-0">Entrega del Ejercicio:
                  {{ $exercise->title }}</h1>
                <h3>Estudiante: {{ $student->name }}</h3>
              </div>
            </div>

            <div class="row g-4">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Respuesta del estudiante:</h5>
                    <p class="card-text">{{ $assignment->getStudentResponse() }}
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-12 mt-3">
                <a href="{{ url()->previous() }}"
                  class="btn btn-primary mt-3">Volver</a>
              </div>
            </div>
          </div>
        </div>
    </x-layouts.dashboard>
  @endsection
</x-app-layout>
<x-modal-register />
