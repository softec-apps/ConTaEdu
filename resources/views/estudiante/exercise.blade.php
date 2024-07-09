<x-app-layout>
    @section('main')
    <!-- Join to exercise -->
    <x-estudiante.joinToExercise />
    <x-layouts.dashboard>
        <div class="app-wrapper">
            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <div class="row g-3 mb-4 align-items-center justify-content-between">
                        <div class="d-flex justify-content-between">
                            <h1 class="app-page-title mb-0">Ejercicio: {{ $exercise->titulo }}</h1>
                            @if ( \Auth::user()->role == 3 )
                                <!-- Mostrar botón enviar para estudiantes -->
                                @if ( $exercise->asignaciones->sent )
                                    <x-primary-button :custom="true" class="btn border border-success disabled"><i class="fa-regular fa-circle-check"></i> Enviado</x-primary-button>
                                @else
                                    @if ( $asientosContables->count() > 0 )
                                        <x-primary-button data-bs-toggle="modal" data-bs-target="#sendExercise">Enviar</x-primary-button>
                                    @else
                                        <x-primary-button class="disabled" data-bs-toggle="modal" data-bs-target="#sendExercise">Enviar</x-primary-button>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>

                    <div class="row my-3 justify-content-between">
                        <!-- Detalles de ejercicio -->
                        <details class="card col-lg-9" open>
                            <summary class="card-header">Detalles</summary>
                            <div class="card-body">
                                <p class="card-text">
                                    {{ $exercise->desc }}
                                </p>
                            </div>
                        </details>

                        <div class="card col-lg-3">
                            <div class="card-header">Resultados</div>
                            <div class="card-body">
                                <div class="d-flex flex-column gap-3">
                                    <x-primary-button data-bs-toggle="modal" data-bs-target="#asientoModal" custom="true" class="btn-warning d-flex align-items-center justify-content-around w-100">
                                        <i class="fa-solid fa-file-invoice-dollar fs-4 me-2"></i>
                                        <span>Libro Diario</span>
                                    </x-primary-button>

                                    <x-primary-button data-bs-toggle="modal" data-bs-target="#asientoModal" custom="true" class="btn-info d-flex align-items-center justify-content-around w-100">
                                        <i class="fa-solid fa-book fs-4 me-2"></i>
                                        <span>Libro Mayor</span>
                                    </x-primary-button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="card col-lg-12">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6>Asientos Contables</h6>
                                    <x-primary-button data-bs-toggle="modal" data-bs-target="#asientoModal">Nuevo Asiento</x-primary-button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="entries">
                                    <!-- Los asientos contables se agregarán aquí dinámicamente -->
                                    @foreach ($asientosContables as $asiento)
                                        <x-estudiante.asiento-contable :asiento="$asiento" />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.dashboard>

    <x-estudiante.asiento-contable-modal :exercise="$exercise" />

    <x-modal :name="__('sendExercise')" :size="__('md')" :show="false" :title="__('Enviar ejercicio al docente')"
        :form="true" :form_method="__('get')" :form_action="route('estudiante.send_exercise', ['id' => $exercise->id])">
        <div class="row">
            <div class="col-12 mb-3">
                <p>Vas a enviar este ejercicio al docente.</p>
                <p>¿Estás seguro de que quieres enviar el ejercicio?</p>
            </div>
        </div>
        <x-slot:footer>
            <x-primary-button data-bs-dismiss="modal" class="btn btn-secondary">Cancelar</x-primary-button>
            <x-primary-button type="submit" form="sendExerciseForm" class="btn btn-success">Confirmar Envío</x-primary-button>
        </x-slot:footer>
    </x-modal>
    @endsection
</x-app-layout>