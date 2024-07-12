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

  @push('scripts')
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
            <button class="btn btn-primary btn-update" data-id="${row.id}" data-ci="${row.ci}" data-name="${row.name}" data-email="${row.email}">
                <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-danger btn-delete" data-id="${row.id}">
                <i class="fas fa-trash"></i>
            </button>
        `;
              }
            }
          ],
        }, [{
          text: '<i class="fa-solid fa-circle-plus"></i> Agregar',
          className: 'btn bg-success text-white',
          action: function() {
            $('#modalRegister').modal('show');
          }
        }]));

        // Event listener for the update button
        $('#usersTable').on('click', '.btn-update', function() {
          var id = $(this).data('id');
          var ci = $(this).data('ci');
          var name = $(this).data('name');
          var email = $(this).data('email');

          $('#edit_ci').val(ci);
          $('#edit_name').val(name);
          $('#edit_email').val(email);
          var url = "{{ route('student.update', '') }}/" + id;
          $('#formEditar').attr('action', url);

          $('#modalEditar').modal('show');
        });

        // Event listener for the delete button
        $('#usersTable').on('click', '.btn-delete', function() {
          var id = $(this).data('id');
          $.ajax({
            url: "{{ route('student.destroy', '') }}/" + id,
            type: 'DELETE',
            data: {
              "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
              if (response.success) {
                // Recargar la tabla después de la eliminación exitosa
                location.reload();
              }
            }
          });
        });
      });
    </script>
  @endpush
</x-app-layout>

<!-- Incluir el modal-register y modal-editar en el layout -->
<x-docente.modal-register />
<x-docente.modal-edit />
