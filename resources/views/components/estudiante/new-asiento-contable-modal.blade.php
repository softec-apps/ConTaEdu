@props(['exercise'])

@php
    $formAction = route('estudiante.new_asiento', ['id' => $exercise->id]);
@endphp
<x-modal :name="__('asientoModal')" :size="__('xl')" :show="false" :title="__('Nuevo asiento contable')"
    :form_action="$formAction" :form="true">
    <input type="hidden" name="exercise_id" value="{{ $exercise->id }}">
    <div class="row">
        <div class="form-floating col-12 mb-3">
            <input type="date" class="form-control" id="date" name="date" required value="{{ old('date') }}">
            <label for="date" class="form-label">Fecha</label>
        </div>
        <div class="form-floating col-12 mb-3">
            <input type="text" class="form-control" id="concept" name="concept" value="{{ old('concept') }}">
            <label for="concept" class="form-label">Concepto</label>
        </div>
    </div>
    <button type="button" class="btn btn-secondary mb-3" id="addCuentaBtn">Agregar Cuenta</button>
    <div class="row" id="cuentasContainer">
        <!-- Las filas de cuentas se agregarán aquí dinámicamente -->
    </div>
    <div class="row">
        <div class="col-12 px-5 text-sm-start text-lg-end text-success" id="new-totales">
            <p class="display-6">Total Debe: $ <span id="totalDebe">0</span></p>
            <p class="display-6">Total Haber: $ <span id="totalHaber">0</span></p>
        </div>
    </div>
</x-modal>

@push('scripts')
    <script>
        // Cuentas y asientos contables
        let cuentaIndex = 0;

        function addCuentaRow() {
            const url = '{{ route('estudiante.new_detalle_asiento') }}';
            const params = new URLSearchParams({
                index: cuentaIndex
            })
            fetch(`${url}?${params.toString()}`)
                .then(response => response.text())
                .then(html => {
                    $('#cuentasContainer').append(html);
                    initializeSelect2ForRow(cuentaIndex);
                    cuentaIndex++;
                })
                .catch(error => console.error('Error al cargar el componente:', error));
        }

        function updateTotals() {
            let totalDebe = 0;
            let totalHaber = 0;
            $('.cuenta-row').each(function () {
                const type = $(this).find('.transaction-type').val();
                const amount = parseFloat($(this).find('.amount').val()) || 0;
                if (type === 'debe') {
                    totalDebe += amount;
                } else {
                    totalHaber += amount;
                }
            });
            $('#totalDebe').text(totalDebe.toFixed(2));
            $('#totalHaber').text(totalHaber.toFixed(2));
            if (totalDebe != totalHaber) {
                $('#new-totales').addClass('text-danger');
                $('#new-totales').removeClass('text-success');
            } else {
                $('#new-totales').addClass('text-success');
                $('#new-totales').removeClass('text-danger');
            }
        }

        $(document).ready(function () {
            $('#addCuentaBtn').click(addCuentaRow);

            $(document).on('click', '.remove-cuenta', function () {
                $(this).closest('.cuenta-row').remove();
                updateTotals();
            });

            $(document).on('change', '.transaction-type, .amount', updateTotals);
            $(document).on('input', '.amount', updateTotals);
        });
    </script>
@endpush