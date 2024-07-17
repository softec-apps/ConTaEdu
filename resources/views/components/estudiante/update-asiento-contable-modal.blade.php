<x-modal :name="__('updateAsientoModal')" :size="__('xl')" :show="false" :title="__('Editar asiento contable')"
    :form="true" :form_action="route('estudiante.update_asiento')">
    @method('PUT')
    <input type="hidden" name="exercise_id" value="{{ $exercise->id }}">
    <input type="hidden" name="asiento_id" id="edit_asiento_id" value="">
    <div class="row">
        <div class="form-floating col-12 mb-3">
            <input type="date" class="form-control" id="edit_date" name="date" required value="">
            <label for="date" class="form-label">Fecha</label>
        </div>
        <div class="form-floating col-12 mb-3">
            <input type="text" class="form-control" id="edit_concept" name="concept" value="">
            <label for="concept" class="form-label">Concepto</label>
        </div>
    </div>
    <button type="button" class="btn btn-secondary mb-3" id="addUpdateCuentaBtn">Agregar Cuenta</button>
    <div class="row" id="updateCuentasContainer">
        <!-- Las filas de cuentas se agregarán aquí dinámicamente -->
    </div>
    <div class="row">
        <div class="col-12 px-5 text-sm-start text-lg-end" id="update-totales">
            <p class="display-6">Total Debe: $ <span id="update-totalDebe">0</span></p>
            <p class="display-6">Total Haber: $ <span id="update-totalHaber">0</span></p>
        </div>
    </div>
</x-modal>

@push('scripts')
    <script>
        let updateCuentaIndex = 0;

        function addUpdateCuentaRow(detalle = null) {
            return new Promise((resolve, reject) => {
                const url = '{{ route('estudiante.new_detalle_asiento') }}';
                const params = new URLSearchParams({
                    index: updateCuentaIndex,
                    update: true,
                })
                fetch(`${url}?${params.toString()}`)
                    .then(response => response.text())
                    .then(html => {
                        $('#updateCuentasContainer').append(html);
                        if (detalle) {
                            const $select = $(`#update-cuentas_${updateCuentaIndex}_account_id`);

                            $.ajax({
                                url: "{{ route('plancuentas.search') }}",
                                dataType: 'json',
                                data: {
                                    id: detalle.cuenta_id,
                                    exact: true, // Añade este parámetro para indicar que quieres una coincidencia exacta
                                    template_id: '{{ $exercise->template_id }}'
                                },
                                success: function (data) {
                                    if (data.results && data.results.length > 0) {
                                        const cuentaData = data.results[0];

                                        // Crear la opción con el formato correcto
                                        const newOption = new Option(
                                            accountIconFormat(cuentaData.signo) + cuentaData.cuenta + ' - ' + cuentaData.text,
                                            cuentaData.id,
                                            true,
                                            true
                                        );

                                        // Agregar la opción al select y actualizar select2
                                        $select.append(newOption).trigger('change');

                                        // Forzar la actualización del texto mostrado
                                        $select.trigger('select2:select');
                                    }
                                }
                            });

                            // Actualizar los otros valores
                            $(`#update-cuentas_${updateCuentaIndex}_type`).val(detalle.tipo_movimiento);
                            $(`#update-cuentas_${updateCuentaIndex}_amount`).val(detalle.monto);
                        }
                        initializeSelect2ForRow(updateCuentaIndex, true);
                        updateCuentaIndex++;
                        updateEditTotals();
                        resolve()
                    })
                    .catch(error => {
                        console.error('Error al cargar el componente:', error);
                        reject(error);
                    });
            });
        }

        function updateEditTotals() {
            let totalDebe = 0;
            let totalHaber = 0;
            $('.update-cuenta-row').each(function () {
                const type = $(this).find('.update-transaction-type').val();
                const amount = parseFloat($(this).find('.update-amount').val()) || 0;
                if (type === 'debe') {
                    totalDebe += amount;
                } else {
                    totalHaber += amount;
                }
            });
            $('#update-totalDebe').text(totalDebe.toFixed(2));
            $('#update-totalHaber').text(totalHaber.toFixed(2));
            if (totalDebe != totalHaber) {
                $('#update-totales').addClass('text-danger');
                $('#update-totales').removeClass('text-success');
            } else {
                $('#update-totales').addClass('text-success');
                $('#update-totales').removeClass('text-danger');
            }
        }

        $(document).ready(function () {
            $('#addUpdateCuentaBtn').click(addUpdateCuentaRow);

            $(document).on('click', '.update-remove-cuenta', function () {
                $(this).closest('.update-cuenta-row').remove();
                updateEditTotals();
            });

            $(document).on('change', '.update-transaction-type, .update-amount', updateEditTotals);
            $(document).on('input', '.update-amount', updateEditTotals);

            // Update Asiento
            $(document).on('click', '.update-asiento-btn', async function () {
                const asientoId = $(this).data('id');

                // Limpiar el contenedor de cuentas
                $('#updateCuentasContainer').empty();
                updateCuentaIndex = 0;

                // Construir la URL de la ruta
                let routeUrl = '{{ route('estudiante.get_asiento', ['asiento_id' => '__ASIENTO_ID__']) }}';
                routeUrl = routeUrl.replace('__ASIENTO_ID__', asientoId);

                try {
                    // Cargar los datos del asiento
                    const response = await $.ajax({
                        url: routeUrl,
                        method: 'GET'
                    });

                    let data = response.data;

                    $('#edit_asiento_id').val(asientoId);
                    $('#edit_date').val(data.fecha);
                    $('#edit_concept').val(data.concepto);

                    // Cargar los detalles del asiento
                    for (const detalle of data.detalles) {
                        await addUpdateCuentaRow(detalle);
                    }

                    updateEditTotals();
                } catch (error) {
                    console.error('Error al cargar los datos del asiento:', error);
                }
            })
        });
    </script>
@endpush