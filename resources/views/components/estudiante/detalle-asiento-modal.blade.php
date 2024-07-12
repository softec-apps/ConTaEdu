@props([
    'index',
    'update' => false
])

@php
    // Clases de las filas
    $cuentaRowClass = 'cuenta-row';
    $cuentaRowClass = $update ? 'update-' . $cuentaRowClass : $cuentaRowClass;

    $accountTypeClass = 'account-type';
    $accountTypeClass = $update ? 'update-' . $accountTypeClass : $accountTypeClass;

    $transactionTypeClass = 'transaction-type';
    $transactionTypeClass = $update ? 'update-' . $transactionTypeClass : $transactionTypeClass;

    $amountClass = 'amount';
    $amountClass = $update ? 'update-' . $amountClass : $amountClass;

    $removeCuentaClass = 'remove-cuenta';
    $removeCuentaClass = $update ? 'update-' . $removeCuentaClass : $removeCuentaClass;

    // IDs de los inputs
    $accountIdInputID = 'cuentas_' . $index . '_account_id';
    $accountIdInputID = $update ? 'update-' . $accountIdInputID : $accountIdInputID;

    $transactionTypeInputID = 'cuentas_' . $index . '_type';
    $transactionTypeInputID = $update ? 'update-' . $transactionTypeInputID : $transactionTypeInputID;

    $amountInputID = 'cuentas_' . $index . '_amount';
    $amountInputID = $update ? 'update-' . $amountInputID : $amountInputID;
@endphp

<div class="row {{ $cuentaRowClass }} mb-3 d-flex justify-content-between align-items-center">
    <div class="col-11">
        <div class="row">
            <div class="form-floating col-lg-6">
                <select class="form-control {{ $accountTypeClass }}" id="{{ $accountIdInputID }}"
                    name="cuentas[{{ $index }}][account_id]" required style="width: 100%"></select>
                <label for="{{ $accountIdInputID }}">Cuenta</label>
            </div>
            <div class="form-floating col-lg-3">
                <select class="form-select {{ $transactionTypeClass }}" id="{{ $transactionTypeInputID }}"
                    name="cuentas[{{ $index }}][type]" required>
                    <option value="debe">Debe</option>
                    <option value="haber">Haber</option>
                </select>
                <label for="{{ $transactionTypeInputID }}">Tipo de Transacción</label>
            </div>
            <div class="form-floating col-lg-3">
                <input type="number" class="form-control {{ $amountClass }}" id="{{ $amountInputID }}"
                    name="cuentas[{{ $index }}][amount]" required step="0.01">
                <label for="{{ $amountInputID }}">Monto</label>
            </div>
        </div>
    </div>
    <div class="col-1 h-100">
        <x-primary-button :custom="true" class="btn btn-block btn-danger text-white h-100 {{ $removeCuentaClass }}">X</x-primary-button>
    </div>
</div>