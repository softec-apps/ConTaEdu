{{-- <x-app-layout>
  @section('main')
    <x-layouts.dashboard>

    </x-layouts.dashboard>
  @endsection
</x-app-layout> --}}
<div class="modal fade" id="viewModal" tabindex="-1"
  aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel">Detalle del Ejercicio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{ $exercise->desc ?? 'No hay descripción disponible' }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"
          data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
