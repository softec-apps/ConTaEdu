<!-- resources/views/modal.blade.php -->
<div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="miModalLabel">Registro de datos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="app-card app-card-settings shadow-sm p-4">
          <div class="app-card-body">
            <form id="settings-form" class="settings-form">
              @csrf

              <input type="hidden" id="id" name="id"
                value="{{ old('id') }}">

              <input type="hidden" id="template_id" name="template_id"
                value="{{ $template->id }}">

              <div class="mb-3">
                <label for="setting-input-2" class="form-label">Número de cuenta</label>
                <input type="number" class="form-control" id="cuenta"
                  name="cuenta" placeholder="Escriba..."
                  value="{{ old('cuenta') }}" required>
              </div>
              <div class="mb-3">
                <label for="setting-input-2"
                  class="form-label">Descripción</label>
                <input type="text" class="form-control" id="description"
                  name="description" placeholder="Escriba..."
                  value="{{ old('description') }}" required>
              </div>
              <div class="mb-3">
                <label for="signo" class="form-label">Signo</label>
                <select class="form-control" id="signo" name="signo"
                  required>
                  <option value="P"
                    @if (old('signo') == 'P') selected @endif>
                    Positivo</option>
                  <option value="D"
                    @if (old('signo') == 'D') selected @endif>Doble
                  </option>
                  <option value="N"
                    @if (old('signo') == 'N') selected @endif>Negativo
                  </option>
                </select>
              </div>
              <div class="mb-3">
                <label for="tipocuenta" class="form-label">Tipo de
                  Cuenta</label>
                <select class="form-control" id="tipocuenta" name="tipocuenta"
                  required>
                  <option value="T"
                    @if (old('tipocuenta') == 'T') selected @endif>
                    Total</option>
                  <option value="D"
                    @if (old('tipocuenta') == 'D') selected @endif>Detalle
                  </option>
                </select>
              </div>
              <div class="mb-3">
                <label for="tipoestado" class="form-label">Tipo de
                  Estado</label>
                <select class="form-control" id="tipoestado" name="tipoestado"
                  required>
                  <option value="1"
                    @if (old('tipoestado') == '1') selected @endif>
                    ESTADO DE SITUACIÓN FINANCIERA</option>
                  <option value="2"
                    @if (old('tipoestado') == '2') selected @endif>ESTADO DE
                    RESULTADO INTEGRAL
                  </option>
                  <option value="3"
                    @if (old('tipoestado') == '3') selected @endif>ESTADO DE
                    FLUJOS DE EFECTIVO
                  </option>
                  <option value="5"
                    @if (old('tipoestado') == '5') selected @endif>ESTADO DE
                    CAMBIOS EN EL PATRIMONIO
                  </option>
                </select>
              </div>
              <button type="button" id="submit-button"
                class="btn app-btn-primary">Guardar los
                cambios</button>
            </form>

            <script>
              document.getElementById('submit-button').addEventListener('click',
              function() {
                var form = document.getElementById('settings-form');
                var cuenta = document.getElementById('cuenta').value;
                var description = document.getElementById('description').value;
                var tipocuenta = document.getElementById('tipocuenta').value;
                var tipoestado = document.getElementById('tipoestado').value;
                var signo = document.getElementById('signo').value;
                var id = document.getElementById('id').value;
                var template_id = document.getElementById('template_id').value;

                if (cuenta && description && tipoestado && tipocuenta && signo &&
                  template_id) {
                  if (id === "") {
                    form.action = "{{ route('plancuentas.store') }}";
                    form.method = 'POST';
                  } else {
                    form.action = "{{ route('plancuentas.update', '') }}" + '/' + id;
                    form.method = 'POST';
                    // Agregar un campo oculto _method con valor PUT
                    var hiddenMethodField = document.createElement('input');
                    hiddenMethodField.setAttribute('type', 'hidden');
                    hiddenMethodField.setAttribute('name', '_method');
                    hiddenMethodField.setAttribute('value', 'PUT');
                    form.appendChild(hiddenMethodField);
                  }
                  form.submit();
                } else {
                  alert(
                    'Por favor complete todos los campos antes de enviar el formulario.'
                    );
                }
              });
            </script>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"
          data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
