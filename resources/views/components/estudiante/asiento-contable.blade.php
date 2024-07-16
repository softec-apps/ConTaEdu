@props(['asiento'])

@php
    $detallesGrouped = $asiento->detalles->groupBy('tipo_movimiento');
@endphp

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-primary text-white">
                <p class="m-0">{{ $asiento->fecha }}</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 border-end">
                        <h5 class="text-center text-muted mb-3 border-bottom">Debe</h5>
                        @forelse ($detallesGrouped['debe'] ?? [] as $detalle)
                            <div class="card my-2 p-2 border-0 shadow-sm">
                                <h6 class="card-title mb-1 text-primary">{{ $asiento->concepto }}</h6>
                                <p class="mb-1"><strong>Cuenta:</strong> <span
                                        class="text-muted">{{ $detalle->cuenta->cuenta }}</span></p>
                                <p class="mb-1"><strong>Descripción:</strong> <span
                                        class="text-muted">{{ $detalle->cuenta->description }}</span></p>
                                <p class="mb-1"><strong>Monto:</strong> <span
                                        class="text-success">{{ Number::currency($detalle->monto, 'USD', 2) }}</span></p>
                            </div>
                        @empty
                            <p class="text-center text-muted">No hay movimientos en "Debe"</p>
                        @endforelse
                    </div>
                    <div class="col-6">
                        <h5 class="text-center text-muted mb-3 border-bottom">Haber</h5>
                        @forelse ($detallesGrouped['haber'] ?? [] as $detalle)
                            <div class="card my-2 p-2 border-0 shadow-sm">
                                <h6 class="card-title mb-1 text-primary">{{ $asiento->concepto }}</h6>
                                <p class="mb-1"><strong>Cuenta:</strong> <span
                                        class="text-muted">{{ $detalle->cuenta->cuenta }}</span></p>
                                <p class="mb-1"><strong>Descripción:</strong> <span
                                        class="text-muted">{{ $detalle->cuenta->description }}</span></p>
                                <p class="mb-1"><strong>Monto:</strong> <span
                                        class="text-success">{{ Number::currency($detalle->monto, 'USD', 2) }}</span></p>
                            </div>
                        @empty
                            <p class="text-center text-muted">No hay movimientos en "Haber"</p>
                        @endforelse
                    </div>
                </div>
            </div>
            @if ( \Auth::user()->role == 3 )
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <x-primary-button class="btn-sm me-2 update-asiento-btn" data-id="{{ $asiento->id }}" data-bs-toggle="modal" data-bs-target="#updateAsientoModal">Editar</x-primary-button>
                        <x-primary-button :custom="true" class="btn-sm btn-danger delete-asiento-btn" data-id="{{ $asiento->id }}" data-bs-toggle="modal" data-bs-target="#deleteAsientoModal">Eliminar</x-primary-button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>