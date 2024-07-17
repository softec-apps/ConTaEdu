<x-app-layout>
    <x-slot name="title">Usuarios</x-slot>

    @section('main')
        <x-layouts.dashboard>
            <div class="app-wrapper">
                <div class="app-content pt-3 p-md-3 p-lg-4">
                    <div class="container-xl">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <div class="row g-3 mb-4 align-items-center justify-content-between">
                            <div class="col-auto">
                                <h1 class="app-page-title mb-0">Administracion de Usuarios</h1>
                            </div>
                        </div>

                        <div class="tab-content" id="users-table-tab-content">
                            <div class="tab-pane fade show active" id="users-all" role="tabpanel"
                                aria-labelledby="users-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body">
                                       <div class="m-4">
                                        <label for="userTypeSelect" class="form-label">Seleccionar Tipo de Usuario:</label>
                                        <select id="userTypeSelect" class="form-select">
                                            <option value="1" selected>Administrador</option>
                                            <option value="2">Docente</option>
                                            <option value="3">Estudiante</option>
                                        </select>
                                       </div>
                                        

                                        <table id="usersTable" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Cédula</th>
                                                    <th>Nombre y Apellido</th>
                                                    <th>Email</th>
                                                    <th>Inscrito</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Aquí se cargarán los datos del DataTable -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.modal')
            </div>
        </x-layouts.dashboard>
    @endsection

    @push('scripts')
        <script>
            $(document).ready(function() {
                let userType = $('#userTypeSelect').val();
                let miTabla = $('#usersTable').DataTable(setDataTableConfig({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: `{{ url('admin/getUsers') }}/${userType}`, // URL corregida
                            dataSrc: function(json) {
                                return json.data; // Asegura que los datos se extraen correctamente
                            }
                        },
                        columns: [{
                                data: 'ci',
                                name: 'ci'
                            },
                            {
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'email',
                                name: 'email'
                            },
                            {
                                data: 'created_at',
                                name: 'created_at',
                                render: function(data, type, row) {
                                    return new Date(data).toLocaleDateString();
                                }
                            },
                            {
                                data: 'est',
                                name: 'est',
                                render: function(data, type, row) {
                                    return data == '1' ?
                                        '<button type="button" class="badge bg-success btnEst" data-id="' +
                                        row.id + '">Activo</button>' :
                                        '<button type="button" class="badge bg-danger btnEst" data-id="' +
                                        row.id + '">Desactivado</button>';
                                }
                            },
                            {
                                data: null,
                                title: "Acciones",
                                render: function(data, type, row) {
                                    return '<button type="button" class="btn btn-outline-warning btnEditar" data-id="' +
                                        row.id + '"><i class="fa-solid fa-pen-to-square"></i></button>';
                                }
                            }
                        ],


                    },
                    [{
                        text: '<i class="fa-solid fa-circle-plus"></i> Agregar',
                        className: 'btn bg-success text-white',
                        action: function() {
                            $('#miModal').modal('show');
                        }
                    }]));

                $('#userTypeSelect').on('change', function() {
                    userType = this.value;
                    miTabla.ajax.url(`{{ url('admin/getUsers') }}/${userType}`).load();
                });

                $(document).on("click", ".btnEditar", function() {
                    var rowData = miTabla.row($(this).closest("tr")).data();
                    $("#miModal").modal("show");
                    $("#id").val(rowData.id);
                    $("#ci").val(rowData.ci);
                    $("#name").val(rowData.name);
                    $("#email").val(rowData.email);
                });

                $(document).on("click", ".btnEst", function() {
                    var rowData = miTabla.row($(this).closest("tr")).data();
                    var id = rowData.id;

                    const form = new FormData();
                    form.append('_token', '{{ csrf_token() }}');

                    fetch(`{{ route('users.est', '') }}/${id}`, {
                            method: 'POST',
                            body: form
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error al enviar la solicitud.');
                            }
                            miTabla.ajax.reload();
                        })
                        .catch(error => {
                            console.error('Error al enviar la solicitud:', error.message);
                        });
                });
            });
        </script>
    @endpush

</x-app-layout>
