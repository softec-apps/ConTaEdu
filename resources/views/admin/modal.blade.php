<!-- resources/views/modal.blade.php -->
<div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="miModalLabel">Registro sde datos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <form id="settings-form" class="settings-form">
                            @csrf

                            <input type="hidden" id="id" name="id" value="{{ old('id') }}">

                            <div class="mb-3">
                                <label for="setting-input-2" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Escriba..." value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="setting-input-2" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Escriba..." value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="setting-input-2" class="form-label">Cédula</label>
                                <input type="text" class="form-control" id="ci" name="ci"
                                    placeholder="Escriba..." value="{{ old('ci') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Rol</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="1" @if (old('role') == 1) selected @endif>
                                        Administrador</option>
                                    <option value="2" @if (old('role') == 2) selected @endif>Docente
                                    </option>
                                    <option value="3" @if (old('role') == 3) selected @endif>Estudiante
                                    </option>
                                </select>
                            </div>
                            <button type="button" id="submit-button" class="btn app-btn-primary">Guardar los
                                cambios</button>
                        </form>

                        <script>
                            document.getElementById('submit-button').addEventListener('click', function() {
                                var form = document.getElementById('settings-form');
                                var name = document.getElementById('name').value;
                                var email = document.getElementById('email').value;
                                var ci = document.getElementById('ci').value;
                                var role = document.getElementById('role').value;

                                var id = document.getElementById('id').value;

                                if (name && email && ci && role) {
                                    if (id === "") {
                                        form.action = "{{ route('users.store') }}";
                                        form.method = 'POST';
                                    } else {
                                        form.action = "{{ route('users.update', '') }}" + '/' + id;
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
                                    alert('Por favor complete todos los campos antes de enviar el formulario.');
                                }
                            });
                        </script>



                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
