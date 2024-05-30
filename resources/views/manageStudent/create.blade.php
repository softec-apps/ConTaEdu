<x-app-layout>
  @section('main')
    <x-layouts.dashboard>
      <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Ingreso de Capacitaciones') }}
        </h2>
      </x-slot>

      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

              <form method="POST" action="{{ route('student.store') }}">
                @csrf

                <div class="lg:col-span-2">
                  <div
                    class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-3">
                    <!-- Evento -->
                    <div class="mt-2">
                      <x-input-label for="evento" :value="__('Evento')" />
                      <x-text-input id="evento" class="block mt-1 w-full"
                        type="text" name="evento" :value="old('evento')"
                        autocomplete="evento" autofocus />
                      <x-input-error :messages="$errors->get('evento')" class="mt-2" />
                    </div>
                    <!-- Tipo de Evento -->
                    <div class="mt-2">
                      <x-input-label for="tipo_evento" :value="__('Tipo de Evento')" />
                      <x-text-input id="tipo_evento" class="block mt-1 w-full"
                        type="text" name="tipo_evento" :value="old('tipo_evento')"
                        autocomplete="tipo_evento" autofocus />
                      <x-input-error :messages="$errors->get('tipo_evento')" class="mt-2" />
                    </div>
                    <!-- Fecha del Evento -->
                    <div class="mt-2">
                      <x-input-label for="fecha_evento" :value="__('Fecha del Evento')" />
                      <x-text-input id="fecha_evento" class="block mt-1 w-full"
                        type="date" name="fecha_evento" :value="old('fecha_evento')"
                        autocomplete="fecha_evento" autofocus />
                      <x-input-error :messages="$errors->get('fecha_evento')" class="mt-2" />
                    </div>
                    <!-- Institucion que Organiza -->
                    <div class="mt-2">
                      <x-input-label for="institucion_organizadora"
                        :value="__('Institucion que Organiza')" />
                      <x-text-input id="institucion_organizadora"
                        class="block mt-1 w-full" type="text"
                        name="institucion_organizadora" :value="old('institucion_organizadora')"
                        autocomplete="institucion_organizadora" autofocus />
                      <x-input-error :messages="$errors->get('institucion_organizadora')" class="mt-2" />
                    </div>
                    <!-- Pais -->
                    <div class="mt-2">
                      <x-input-label for="pais" :value="__('Pais')" />
                      <x-text-input id="pais" class="block mt-1 w-full"
                        type="text" name="pais" :value="old('pais')"
                        autocomplete="pais" />
                      <x-input-error :messages="$errors->get('pais')" class="mt-2" />
                    </div>

                    <!-- Modalidad -->
                    <div class="mt-2">
                      <x-input-label for="modalidad" :value="__('Modalidad')" />

                      <x-text-input id="modalidad" class="block mt-1 w-full"
                        type="text" name="modalidad" :value="old('modalidad')"
                        autocomplete="modalidad" />

                      <x-input-error :messages="$errors->get('modalidad')" class="mt-2" />
                    </div>

                    <!-- Numero de Horas -->
                    <div class="mt-2">
                      <x-input-label for="num_horas" :value="__('Numero de Horas')" />

                      <x-text-input id="num_horas" class="block mt-1 w-full"
                        type="text" name="num_horas" :value="old('num_horas')"
                        autocomplete="num_horas" />

                      <x-input-error :messages="$errors->get('num_horas')" class="mt-2" />
                    </div>



                  </div>
                </div>
                <div class="flex items-center justify-end mt-4">
                  <x-primary-button class="ml-4">
                    {{ __('Registrar') }}
                  </x-primary-button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </x-layouts.dashboard>
  @endsection
</x-app-layout>
