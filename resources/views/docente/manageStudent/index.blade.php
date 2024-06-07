<x-app-layout>
  @section('main')
  <x-layouts.dashboard>
    <!-- <link
        href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap5.min.css"
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
</x-app-layout>