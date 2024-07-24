<x-app-layout>
    @section('main')
    <!-- Join/leave to exercise -->
    <x-estudiante.joinToExercise />
    <x-ejercicio.modal-leave />

    <x-layouts.dashboard>
        <div class="app-wrapper">
            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h1 class="app-page-title">Libro Diario - {{ $exercise->titulo }}</h1>
                        @if (\Auth::user()->role == 3)
                            <!-- Mostrar botón para regresar -->
                            <a href="{{ route('estudiante.see_exercise', ['id' => $exercise->id]) }}" class="btn btn-primary text-white">Volver</a>
                            <!-- Join to exercise -->
                            <x-estudiante.joinToExercise />
                        @elseif (\Auth::user()->role == 2)
                            <!-- Mostrar botón para regresar -->
                            <a href="{{ route('exercise.view-submission', ['exerciseId' => $exercise->id, 'studentId' => $exercise->asignaciones->estudiante->id]) }}" class="btn btn-primary text-white">Volver</a>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end mb-3">
                        <x-primary-button :custom="true" class="btn btn-danger text-white"
                            onclick="printJS({
                                printable: 'libro-diario', type: 'html',
                                css: ['{{ asset('../resources/css/app.css') }}'],
                                documentTitle: 'Libro Diario - {{ $exercise->titulo }}'
                            })">
                            <i class="fa-solid fa-file-pdf"></i> Imprimir
                        </x-primary-button>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive" id="libro-diario">
                                <div class="only-print">
                                    <div class="d-flex justify-content-end">
                                        <p><strong>Estudiante:</strong> {{ $exercise->asignaciones->estudiante->name }}</p>
                                    </div>
                                </div>
                                <table class="table table-hover">
                                    <tbody>
                                        @foreach($libroDiario as $asiento)
                                            <tr class="table-active">
                                                <td colspan="5"><strong>{{ $asiento['fecha'] }} - {{ $asiento['concepto'] }}</strong></td>
                                            </tr>
                                            @foreach($asiento['detalles'] as $detalle)
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $detalle['cuenta'] }}</td>
                                                    <td>{{ $detalle['descripcion'] }}</td>
                                                    <td>$ {{ number_format($detalle['debe'], 2) }}</td>
                                                    <td>$ {{ number_format($detalle['haber'], 2) }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                        <tr class="table-active">
                                            <td colspan="3"><strong>Totales</strong></td>
                                            <td><strong>$ {{ number_format($totalDebe, 2) }}</strong></td>
                                            <td><strong>$ {{ number_format($totalHaber, 2) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.dashboard>
    @endsection
</x-app-layout>
