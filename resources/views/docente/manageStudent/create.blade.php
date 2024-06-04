<x-app-layout>
  @section('main')
    <x-layouts.dashboard>
      <div class="container-xl">
        <h1 class="app-page-title"></h1>
        <div class="row g-4 settings-section">
          <div class="col-12 col-md-8 offset-md-2">
            <div class="app-card app-card-settings shadow-sm p-4">
              <div class="app-card-body">
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <form class="settings-form" method="POST"
                  action="{{ route('student.store') }}">
                  @csrf
                  <div class="mb-3">
                    <label for="ci" class="form-label">Número de
                      cédula</label>
                    <input type="text" class="form-control" id="ci"
                      name="ci" required>
                  </div>
                  <div class="mb-3">
                    <label for="name" class="form-label">Nombre y
                      Apellido</label>
                    <input type="text" class="form-control" id="name"
                      name="name" required>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email"
                      name="email" required>
                  </div>
                  {{-- <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password"
                      name="password" required>
                  </div>
                  <div class="mb-3">
                    <label for="password_confirmation"
                      class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control"
                      id="password_confirmation" name="password_confirmation"
                      required>
                  </div> --}}
                  <button type="submit"
                    class="btn app-btn-primary">Guardar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </x-layouts.dashboard>
  @endsection
</x-app-layout>
