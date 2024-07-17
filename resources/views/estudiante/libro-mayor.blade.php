<x-app-layout>
    @section('main')
    <x-layouts.dashboard>
        <div class="app-wrapper">
            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h1 class="app-page-title">Libro Mayor - {{ $exercise->titulo }}</h1>
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
                                printable: 'libro-mayor', type: 'html',
                                css: ['{{ asset('../resources/css/app.css') }}'],
                                documentTitle: 'Libro Mayor - {{ $exercise->titulo }}'
                            })">
                            <i class="fa-solid fa-file-pdf"></i> Imprimir
                        </x-primary-button>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive" id="libro-mayor">
                                <div class="only-print">
                                    <div class="d-flex justify-content-end">
                                        <p><strong>Estudiante:</strong> {{ $exercise->asignaciones->estudiante->name }}</p>
                                    </div>
                                </div>
                                <table class="table table-hover">
                                    <tbody>
                                        @foreach($cuentas as $cuenta)
                                            <tr>
                                                <td colspan="5" class="pt-4"><strong>{{ $cuenta['cuenta'] }}</strong></td>
                                            </tr>
                                            <tr class="table-active">
                                                <th>Fecha</th>
                                                <th>Concepto</th>
                                                <th>Debe</th>
                                                <th>Haber</th>
                                                <th>Saldo</th>
                                            </tr>
                                            @foreach($cuenta['movimientos'] as $movimiento)
                                                <tr>
                                                    <td>{{ $movimiento['fecha'] }}</td>
                                                    <td>{{ $movimiento['concepto'] }}</td>
                                                    <td>$ {{ number_format($movimiento['debe'], 2) }}</td>
                                                    <td>$ {{ number_format($movimiento['haber'], 2) }}</td>
                                                    <td>$ {{ number_format($movimiento['debe'] - $movimiento['haber'], 2) }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
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
