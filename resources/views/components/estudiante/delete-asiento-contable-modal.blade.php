<x-modal :name="__('deleteAsientoModal')" :size="__('md')" :show="false" :title="__('Eliminar asiento')"
    :form="true" :form_action="route('estudiante.delete_asiento')">
    @method('DELETE')
    <input type="hidden" name="exercise_id" value="{{ $exercise->id }}">
    <input type="hidden" name="asiento_id" id="delete_asiento_id" value="">
    <div class="row">
        <div class="col-12 mb-3">
            <p>Vas a eliminar este asiento contable</p>
            <p>
                ¿Estás seguro de que quieres eliminarlo? <br>
                <small class="text-danger">Esta acción no se puede deshacer</small>
            </p>
        </div>
    </div>
    <x-slot:footer>
        <x-primary-button data-bs-dismiss="modal" class="btn btn-secondary">Cancelar</x-primary-button>
        <x-primary-button type="submit" form="deleteAsientoModalForm" class="btn btn-danger">Si, estoy seguro</x-primary-button>
    </x-slot:footer>
</x-modal>

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete-asiento-btn', function() {
                const asientoId = $(this).data('id');
                $('#delete_asiento_id').val(asientoId);
            });
        });
    </script>
@endpush