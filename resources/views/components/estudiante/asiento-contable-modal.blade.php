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
        <div class="col-12">
            <p>Total Debe: <span id="totalDebe">0</span></p>
            <p>Total Haber: <span id="totalHaber">0</span></p>
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

        function initializeSelect2ForRow(index) {
            $(`.account-select-${index}`).select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#asientoModal'),
                // placeholder: 'Buscar una cuenta',
                minimumInputLength: 1,
                ajax: {
                    url: "{{ route('plancuentas.search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // término de búsqueda
                            page: params.page || 1
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;

                        return {
                            results: data.results.map(function (item) {
                                return {
                                    id: item.id,
                                    text: item.cuenta + ' - ' + item.text,
                                    signo: item.signo,
                                    tipoCuenta: item.tipoCuenta,
                                    disabled: item.tipoCuenta === 'T'
                                };
                            }),
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) { return markup; },
                templateResult: function (data) {
                    if (data.loading) {
                        return data.text;
                    }

                    var icon = '';
                    switch (data.signo) {
                        case 'P':
                            icon = '<i class="fas fa-solid fa-circle-plus text-success"></i>';
                            break;
                        case 'D':
                            icon = '<i class="fas fa-solid fa-circle-minus text-danger"></i>';
                            break;
                        case 'N':
                            icon = '<i class="fas fa-solid fa-circle-dot text-warning"></i>';
                            break;
                        default:
                            icon = '';
                            break;
                    }

                    // Markup para la lista de resultados
                    var markup = "<div class='select2-result-repository clearfix'>";
                    if (data.tipoCuenta === 'T') {
                        markup += "<div class='select2-result-repository__title font-weight-bold'>" + icon + data.text + "</div>";
                    } else {
                        markup += "<div class='select2-result-repository__title'>" + icon + data.text + "</div>";
                    }
                    markup += "</div>";

                    return markup;
                },
                templateSelection: function (data) {
                    if (!data.id) return data.text;

                    var icon = '';
                    switch (data.signo) {
                        case 'P':
                            icon = '<i class="fas fa-plus text-success"></i> ';
                            break;
                        case 'D':
                            icon = '<i class="fas fa-minus text-danger"></i> ';
                            break;
                        case 'N':
                            icon = '<i class="fas fa-asterisk text-warning"></i> ';
                            break;
                    }

                    return icon + data.text;
                },
                matcher: function (params, data) {
                    // No permitir selección de cuentas de tipo 'T'
                    if (data.tipoCuenta === 'T') {
                        return null;
                    }

                    // Lógica de búsqueda por defecto
                    if ($.trim(params.term) === '') {
                        return data;
                    }

                    if (typeof data.text === 'undefined') {
                        return null;
                    }

                    if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                        return data;
                    }

                    return null;
                }
            });
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
        }

        $(document).ready(function () {
            $('#addCuentaBtn').click(addCuentaRow);

            $(document).on('click', '.remove-cuenta', function () {
                $(this).closest('.cuenta-row').remove();
                updateTotals();
            });

            $(document).on('change', '.transaction-type, .amount', updateTotals);
        });
    </script>
@endpush