{{-- <x-app-layout>
  @section('main')
  <x-layouts.dashboard>
    <!-- <link
        href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap5.min.css"
        rel="stylesheet">
      <link
        href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css"
        rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js">
      </script>
      <script
        src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap5.min.js">
      </script> -->

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
            <div class="tab-pane fade show active" id="users-all" role="tabpanel" aria-labelledby="users-all-tab">
              <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                  <x-loader/>
                  <table id="usersTable" class="table table-striped table-bordered d-none" style="width:100%">
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
    $(document).ready(function () {
      $('#usersTable').DataTable(setDataTableConfig(
        {
          processing: true,
          ajax: {
            url: "{{ route('docente.students') }}"
          },
          columns: [
            { data: 'ci' },
            { data: 'name' },
            { data: 'email' },
            { data: 'created_at' }
          ],
        },
        [
          {
            text: '<i class="fa-solid fa-circle-plus"></i> Agregar',
            className: 'btn bg-success text-white',
            // Aquí link de redirection y funciones
          },
        ],
      ));
    });
  </script>
  @endsection
</x-app-layout> --}}


<x-app-layout>
  <x-slot name="title">Estudiantes registrados</x-slot>
  @section('main')
    <x-layouts.dashboard>
      <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
          <div class="container-xl">
            <h1 class="app-page-title">Estudiantes Registrados</h1>
            <div class="app-card app-card-orders-table mb-5">
              <div class="app-card-body">
                <div class="table-responsive">
                  <x-loader></x-loader>
                  <table class="table mb-0 text-left d-none" id="usersTable"
                    style="width: 100%;">
                    <thead>
                      <tr>
                        <th>CI</th>
                        <th>Nombre y Apellido</th>
                        <th>Email</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div><!--//table-responsive-->
              </div><!--//app-card-body-->
            </div><!--//app-card-->
          </div><!--//container-fluid-->
        </div><!--//app-content-->
      </div><!--//app-wrapper-->
    </x-layouts.dashboard>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  @endsection

  @section('scripts')
  <script type="module">
    $(document).ready(function () {
      // $('#exampleModal').modal('show');
    })
  </script>
  <script type="module">
    $(document).ready(function () {
      $('#usersTable').DataTable(setDataTableConfig(
        {
          processing: true,
          ajax: {
            url: "{{ route('docente.students') }}"
          },
          columns: [
            { data: 'ci' },
            { data: 'name' },
            { data: 'email' },
            { data: 'created_at' },
            {
                data: null,
                title: "Acciones",
                render: function(data, type, row) {
                  return `<button type="button" class="btn btn-outline-warning border border-warning btnEditar" data-id="${row.id}">
                      <i class="fa-solid fa-pen-to-square"></i>
                      </button>`;
                }
            }
          ],
        },
        [
          {
            text: '<i class="fa-solid fa-circle-plus"></i> Agregar',
            className: 'btn bg-success text-white',
            action: function () {
              $("#exampleModal").modal("show");
            },
          },
          {
            text: '<i class="fa-solid fa-circle-plus"></i> Agregar',
            className: 'btn bg-secondary text-white',
            // Aquí link de redirection y funciones
          },
        ],
      ));
    });
  </script>
  @endsection
</x-app-layout>
<x-docente.modal-edit />
