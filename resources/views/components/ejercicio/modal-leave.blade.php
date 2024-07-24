<x-modal :name="__('leaveExercise')" :size="__('md')" :show="false" :title="__('Abandonar ejercicio')"
    :form="true" :form_method="__('post')" :form_action="route('estudiante.leave_exercise')">
    <input type="hidden" name="exercise_id" value="">
    <div class="row">
        <div class="col-12 mb-3">
            <p>Estás a punto de abandonar el ejercicio y no podrás enviar tus respuestas ni ver tus resultados.</p>
            <p class="text-danger">
                ¿Estás seguro/a de que quieres abandonar el ejercicio?
                ¿Si enviaste el ejercicio tus datos se borrarán?
            </p>
        </div>
    </div>
    <x-slot:footer>
        <x-primary-button data-bs-dismiss="modal" class="btn btn-secondary">Cancelar</x-primary-button>
        <x-primary-button type="submit" form="leaveExerciseForm" class="btn btn-danger">Abandonar
        </x-primary-button>
    </x-slot:footer>
</x-modal>


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-leave-exercise').click(function() {
                $('#leaveExercise').modal('show');
                var exerciseId = $(this).data('exercise-id');
                $('#leaveExerciseForm').find('input[name="exercise_id"]').val(exerciseId);
            });
        });
    </script>
@endpush