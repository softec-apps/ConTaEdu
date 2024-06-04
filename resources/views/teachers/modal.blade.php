<!-- resources/views/modal.blade.php -->
{{-- <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModalLabel" aria-hidden="true"> --}}
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="settingsModalLabel">Registro de datos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body">
                    <form class="settings-form"
                        action="@if (empty(old('id'))) {{ route('teachers.store') }}@else{{ route('teachers.update', old('id')) }} @endif"
                        method="POST">
                        @csrf

                        <input type="text" class="form-control" id="id" name="id">
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Escriba..." required>
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Escriba..." required>
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Cédula</label>
                            <input type="text" class="form-control" id="ci" name="ci"
                                placeholder="Escriba..." required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Rol</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="1">Administrador</option>
                                <option value="2">Docente</option>
                                <option value="3">Estudiante</option>
                            </select>
                        </div>
                        <button type="submit" class="btn app-btn-primary">Guardar los cambios</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
{{-- </div> --}}
