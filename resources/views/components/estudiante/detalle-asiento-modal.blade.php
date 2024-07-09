@props(['index'])

<div class="row cuenta-row mb-3 d-flex justify-content-between align-items-center">
    <div class="col-11">
        <div class="row">
            <div class="form-floating col-lg-6">
                <select class="form-control account-select-{{ $index }}" id="cuentas[{{ $index }}][account_id]"
                    name="cuentas[{{ $index }}][account_id]" required style="width: 100%"></select>
                <label for="cuentas[{{ $index }}][account_id]">Cuenta</label>
            </div>
            <div class="form-floating col-lg-3">
                <select class="form-select transaction-type" id="cuentas[{{ $index }}][type]"
                    name="cuentas[{{ $index }}][type]" required>
                    <option value="debe">Debe</option>
                    <option value="haber">Haber</option>
                </select>
                <label for="cuentas[{{ $index }}][type]">Tipo de Transacción</label>
            </div>
            <div class="form-floating col-lg-3">
                <input type="number" class="form-control amount" id="cuentas[{{ $index }}][amount]"
                    name="cuentas[{{ $index }}][amount]" required step="0.01">
                <label for="cuentas[{{ $index }}][amount]">Monto</label>
            </div>
        </div>
    </div>
    <div class="col-1 h-100">
        <x-primary-button :custom="true" class="btn btn-block btn-danger text-white h-100 remove-cuenta">X</x-primary-button>
    </div>
</div>