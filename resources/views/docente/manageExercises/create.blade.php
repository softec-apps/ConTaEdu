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
                  action="{{ route('exercise.store') }}">
                  @csrf
                  <div class="mb-3">
                    <label for="desc" class="form-label">Registrar
                      Ejercicio</label>
                    <textarea class="form-control" id="desc" name="desc" required
                      cols="30" rows="5" style="width: 100%; height: 100%;"></textarea>
                  </div>
                  {{-- <div class="mb-3">
                    <label for="access_code" class="form-label">Código de
                      Acceso</label>
                    <input type="text" class="form-control" id="access_code"
                      name="access_code" required>
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
