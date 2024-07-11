<x-app-layout>
    @section('main')
    <x-layouts.dashboard>
        <div class="app-wrapper">
            <div class="app-content pt-3 p-md-3 p-lg-4">
                <div class="container-xl">
                    <h1 class="app-page-title mb-4">Libro Diario - {{ $exercise->titulo }}</h1>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Cuenta</th>
                                        <th>Descripción</th>
                                        <th>Debe</th>
                                        <th>Haber</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($libroDiario as $asiento)
                                        <tr>
                                            <td colspan="5"><strong>{{ $asiento['fecha'] }} - {{ $asiento['concepto'] }}</strong></td>
                                        </tr>
                                        @foreach($asiento['detalles'] as $detalle)
                                            <tr>
                                                <td></td>
                                                <td>{{ $detalle['cuenta'] }}</td>
                                                <td>{{ $detalle['descripcion'] }}</td>
                                                <td>{{ number_format($detalle['debe'], 2) }}</td>
                                                <td>{{ number_format($detalle['haber'], 2) }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    <tr>
                                        <td colspan="3"><strong>Totales</strong></td>
                                        <td><strong>{{ number_format($totalDebe, 2) }}</strong></td>
                                        <td><strong>{{ number_format($totalHaber, 2) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.dashboard>
    @endsection
</x-app-layout>
