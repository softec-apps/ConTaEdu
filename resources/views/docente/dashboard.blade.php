<x-app-layout>
  <x-slot name="title">Tablero</x-slot>

  @section('main')
    <x-layouts.dashboard>
      <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
          <div class="container-xl">
            {{-- <h1 class="app-page-title">Overview</h1> --}}

            <div
              class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration"
              role="alert">
              <div class="inner">
                <div class="app-card-body p-3 p-lg-4">
                  <h3 class="mb-3">Bienvenido, a ConTaEdu!</h3>
                  <div class="row gx-5 gy-3">
                    <div class="col-12 col-lg-9">
                      <div>
                        ContaEdu es una plataforma educativa innovadora diseñada
                        para optimizar la enseñanza y revisión de tareas
                        contables. Enfocado en facilitar la interacción entre
                        docentes y estudiantes, este sistema permite la gestión
                        eficiente de tareas y el seguimiento del aprendizaje en
                        contabilidad.
                      </div>
                    </div>
                    <!--//col-->
                    <div class="col-12 col-lg-3">
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
                    <!--//col-->
                  </div>
                  <!--//row-->
                  <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
                </div>
                <!--//app-card-body-->
              </div>
              <!--//inner-->
            </div>
            <!--//app-card-->

            <div class="row g-4 mb-4">

              <x-dashboard-stat stat="Ejercicios Creados" :value="App\Models\Exercise::getExerciseCountByDocente(
                  auth()->user()->id,
              )"
                :route="route('exercise.index')" />

              <x-dashboard-stat stat="Ejercicios Calificados" :value="App\Models\Exercise::getGradedExerciseCountByDocente(
                  auth()->user()->id,
              )"
                :route="route('exercise.index')" />

              <x-dashboard-stat stat="Estudiantes Asignados" :value="App\Models\Assignment::getRelatedStudentCountForTeacher(
                  auth()->user()->id,
              )"
                :route="route('student.index')" />

            </div>

            <!--//row-->
            <div class="row g-4 mb-4">
              <div class="col-12 col-lg-6">
                <div class="app-card app-card-chart h-100 shadow-sm">
                  <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                      <div class="col-auto">
                        <h4 class="app-card-title">
                          Cuadro de progreso de las tareas de los estudiantes
                        </h4>
                      </div>
                    </div>
                    <!--//row-->
                  </div>
                  <!--//app-card-header-->
                  <div class="app-card-body p-3 p-lg-4">
                    <div class="mb-3 d-flex">
                      <select
                        class="form-select form-select-sm ms-auto d-inline-flex w-auto">
                        <option value="1" selected>
                          Esta semana
                        </option>
                        <option value="2">Hoy</option>
                        <option value="3">Este mes</option>
                        <option value="3">Este año</option>
                      </select>
                    </div>
                    <div class="chart-container">
                      <canvas id="canvas-linechart"></canvas>
                    </div>
                  </div>
                  <!--//app-card-body-->
                </div>
                <!--//app-card-->
              </div>
              <!--//col-->
              <div class="col-12 col-lg-6">
                <div class="app-card app-card-chart h-100 shadow-sm">
                  <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                      <div class="col-auto">
                        <h4 class="app-card-title">
                          Gráfico de barras de ejercicios creados
                        </h4>
                      </div>
                    </div>
                    <!--//row-->
                  </div>
                  <!--//app-card-header-->
                  <div class="app-card-body p-3 p-lg-4">
                    <div class="mb-3 d-flex">
                      <select
                        class="form-select form-select-sm ms-auto d-inline-flex w-auto">
                        <option value="1" selected>
                          Esta semana
                        </option>
                        <option value="2">Hoy</option>
                        <option value="3">Este mes</option>
                        <option value="3">Este año</option>
                      </select>
                    </div>
                    <div class="chart-container">
                      <canvas id="canvas-barchart"></canvas>
                    </div>
                  </div>
                  <!--//app-card-body-->
                </div>
                <!--//app-card-->
              </div>
              <!--//col-->
            </div>

          </div>
          <!--//container-fluid-->
        </div>
        <!--//app-content-->

      </div>
      <!--//app-wrapper-->
    </x-layouts.dashboard>
  @endsection
</x-app-layout>
<x-modal-register />
