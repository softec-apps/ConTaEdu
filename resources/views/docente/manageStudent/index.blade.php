{{-- <x-app-layout>
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
                <h1 class="app-page-title mb-0">Estudiantes Registrados</h1>
              </div>
              <div class="col-auto">
                <button class="btn bg-success text-white" data-bs-toggle="modal"
                  data-bs-target="#modalRegister">
                  <i class="fa-solid fa-circle-plus"></i> Agregar
                </button>
              </div>
            </div>

            <div class="tab-content" id="users-table-tab-content">
              <div class="tab-pane fade show active" id="users-all"
                role="tabpanel" aria-labelledby="users-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                  <div class="app-card-body">
                    <x-loader />
                    <table id="usersTable"
                      class="table table-striped table-bordered d-none"
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
      </div>
    </x-layouts.dashboard>
  @endsection

  @section('scripts')
    <script type="module">
      $(document).ready(function() {
        $('#usersTable').DataTable(setDataTableConfig({
          processing: true,
          ajax: {
            url: "{{ route('student.index') }}"
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
            {
              data: null,
              orderable: false,
              searchable: false,
              render: function(data, type, row) {
                return `
                      <button class="btn btn-primary btn-update" data-id="${row.id}" data-ci="${row.ci}" data-name="${row.name}" data-email="${row.email}">Actualizar</button>
                      <button class="btn btn-danger btn-delete" data-id="${row.id}">Eliminar</button>
                    `;
              }
            }
          ],
        }, ));
      });

      // Event listener for the update button
      $('#usersTable').on('click', '.btn-update', function() {
        var id = $(this).data('id');
        var ci = $(this).data('ci');
        var name = $(this).data('name');
        var email = $(this).data('email');

        $('#edit_ci').val(ci);
        $('#edit_name').val(name);
        $('#edit_email').val(email);
        $('#formEditar').attr('action', '/managetStudent/' + id + '/edit');

        $('#modalEditar').modal('show');
      });

      // Event listener for the delete button
      $('#usersTable').on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        // Lógica para manejar la eliminación
      });
    </script>
  @endsection
</x-app-layout>

<!-- Incluir el modal-register y modal-editar en el layout -->
<x-docente.modal-register />
<x-docente.modal-edit /> --}}

<x-app-layout>
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
                <h1 class="app-page-title mb-0">Estudiantes Registrados</h1>
              </div>
            </div>

            <div class="tab-content" id="users-table-tab-content">
              <div class="tab-pane fade show active" id="users-all" role="tabpanel"
                aria-labelledby="users-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                  <div class="app-card-body">
                    <x-loader />
                    <table id="usersTable"
                      class="table table-striped table-bordered d-none"
                      style="width:100%">
                      <thead>
                        <tr>
                          <th>Cédula</th>
                          <th>Nombre y Apellido</th>
                          <th>Email</th>
                          <th>Inscrito</th>
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
      </div>
    </x-layouts.dashboard>
  @endsection

  @section('scripts')
    <script type="module">
      $(document).ready(function() {
        $('#usersTable').DataTable(setDataTableConfig({
            processing: true,
            ajax: {
              url: "{{ route('student.index') }}"
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
              {
                data: null,
                render: function(data, type, row) {
                  return `
            <div class="d-flex justify-content-center">
                <a href="#" class="btn btn-sm btn-primary me-2 btn-edit" data-id="${data.id}" data-bs-toggle="modal" data-bs-target="#modalEditar"><i class="fa-solid fa-pen"></i></a>
                <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
            </div>
        `;
                }
              }
            ],
          },
          [{
            text: '<i class="fa-solid fa-circle-plus"></i> Agregar',
            className: 'btn bg-success text-white',
            // Aquí link de redirection y funciones
          }, ],
        ));

        $('#usersTable').on('click', '.btn-edit', function(e) {
          e.preventDefault();

          var id = $(this).data('id');

          $.ajax({
            url: '/managetStudent/' +
              id, // Asegúrate de que esta URL es correcta
            method: 'GET',
            success: function(data) {
              // Aquí asumimos que el servidor devuelve un objeto JSON con los datos del usuario
              $('#edit_ci').val(data.ci);
              $('#edit_name').val(data.name);
              $('#edit_email').val(data.email);

              // Actualiza la acción del formulario con la URL correcta para la actualización
              $('#formEditar').attr('action', '/managetStudent/' +
                id + '/update');

              // Muestra el modal
              $('#modalEditar').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
              // Maneja cualquier error aquí
              console.error(textStatus, errorThrown);
            }
          });
        });

      });
    </script>
  @endsection
</x-app-layout>
<x-docente.modal-edit />
