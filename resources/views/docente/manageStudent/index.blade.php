{{-- <x-app-layout>
  @section('main')
    <x-layouts.dashboard>
      <link
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
      </script>
      <script
        src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js">
      </script>
      <script
        src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js">
      </script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js">
      </script>
      <script
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js">
      </script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js">
      </script>
      <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js">
      </script>
      <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js">
      </script>

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
                <a href="{{ route('student.create') }}" class="btn btn-primary">
                  <i class="fa fa-plus me-2"></i>Nuevo Estudiante
                </a>
              </div>
            </div>

            <div class="tab-content" id="users-table-tab-content">
              <div class="tab-pane fade show active" id="users-all"
                role="tabpanel" aria-labelledby="users-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                  <div class="app-card-body">
                    <table id="usersTable"
                      class="table table-striped table-bordered"
                      style="width:100%">
                      <thead>
                        <tr>
                          <th>Cedula</th>
                          <th>Nombre y Apellido</th>
                          <th>Email</th>
                          <th>Inscrito</th>
                          <th>Acción</th>
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

      <script>
        $(document).ready(function() {
          $('#usersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('student.index') }}",
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
                name: 'created_at'
              },
              {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center'
              }
            ],
            language: {
              url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
            },
            pageLength: 10,
            order: [
              [3, 'desc']
            ],
            responsive: true,
            autoWidth: false,
            columnDefs: [{
                width: '15%',
                targets: 0
              },
              {
                width: '30%',
                targets: 1
              },
              {
                width: '25%',
                targets: 2
              },
              {
                width: '15%',
                targets: 3
              },
              {
                width: '15%',
                targets: 4
              }
            ],
            dom: 'Bfrtip',
            buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
            ]
          });
        });
      </script>
    </x-layouts.dashboard>
  @endsection
</x-app-layout> --}}


<x-app-layout>
  <x-slot name="title">Tablero</x-slot>
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
                  <table class="table mb-0 text-left" id="myTable"
                    style="width: 100%;">
                    <thead>
                      <tr>
                        <th>CI</th>
                        <th>Nombre y Apellido</th>
                        <th>Email</th>
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
  @endsection
</x-app-layout>
