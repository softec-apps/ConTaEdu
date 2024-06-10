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
                                <h1 class="app-page-title mb-0">Usuarios Administrador</h1>
                            </div>
                        </div>

                        <div class="tab-content" id="users-table-tab-content">
                            <div class="tab-pane fade show active" id="users-all" role="tabpanel"
                                aria-labelledby="users-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body">
                                        <x-loader />
                                        <table id="usersTable" class="table table-striped table-bordered d-none"
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
                @include('teachers.modal')
            </div>
        </x-layouts.dashboard>
    @endsection

    @section('scripts')
        <script type="module">
            $(document).ready(function() {
                let miTabla = $('#usersTable').DataTable(setDataTableConfig({
                        processing: true,
                        ajax: {
                            url: "{{ route('teachers.index') }}"
                        },
                        columns: [{
                                data: 'ci'
                            },
                            {
                                data: 'name'
                            },
                            {
                                data: 'email'
                            },
                            {
                                data: 'created_at'
                            },
                            { // Esta es la corrección, añadir una coma antes de este objeto
                                data: null,
                                title: "Acciones",
                                render: function(data, type, row) {
                                    return `<button type="button" class="btn btn-outline-warning btnEditar" data-id="${row.id}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        </button>`;
                                }
                            }
                        ]
                    },
                    [{
                        
                        text: '<a href="#" class="text-white" data-bs-toggle="modal" data-bs-target="#miModal">Agregar</a>',
                        className: 'btn bg-success text-white',
                        // Aquí link de redirection y funciones
                    }]
                ));


                // Manejador de eventos para el botón de editar
                $(document).on("click", ".btnEditar", function() {
                    var id = $(this).data('id');
                    //var rowData = miTabla.row($(this).closest("tr")).data();
                    $("#miModal").modal("show");



                    //document.getElementById("title").innerText = "Editar Ocasion";
                    //$("#id").val(rowData.id);
                    //$("#name").val(rowData.nombre);
                    //$("#est").val(rowData.est);
                });
                $(document).ready(function() {
                    $('#testButton').click(function() {
                        alert('jQuery is working!');
                    });
                });
            });
        </script>
    @endsection
</x-app-layout>
