<x-app-layout>
    <x-slot:title>Tablero</x-slot>

        @section('main')
        <x-layouts.dashboard>
            <div class="app-wrapper">
                <div class="app-content pt-3 p-md-3 p-lg-4">
                    <div class="container-xl">
                        <h1 class="app-page-title">Tablero</h1>

                        <div class="row g-4 mb-4">
                            <x-dashboard-stat :stat="'Ejercicios totales'" :value="$stats['total_exercises']"></x-dashboard-stat>

                            <x-dashboard-stat :stat="'Ejercicios enviados'" :value="$stats['exercises_sent']"></x-dashboard-stat>

                            <x-dashboard-stat :stat="'Ejercicios calificados'" :value="$stats['graded_exercises']"></x-dashboard-stat>

                            <div class="col-6 col-lg-3">
                                <div class="app-card app-card-stat shadow-sm h-100 bg-success">
                                    <div
                                        class="app-card-body p-3 p-lg-4 d-flex align-items-center justify-content-between">
                                        <h4 class="text-dark">Nuevo ejercicio</h4>
                                        <div class="stats-figure text-dark"><i class="fa-solid fa-circle-plus"></i>
                                        </div>
                                    </div>
                                    <!--//app-card-body-->
                                    <a class="app-card-link-mask" href="#" data-bs-toggle="modal" data-bs-target="#accessToExercise"></a>
                                </div>
                                <!--//app-card-->
                            </div>
                            <!--//col-->
                        </div>
                        <!--//row-->

                        <div class="row g-4 mb-4">
                            <div class="col-12 col-lg-12">
                                <div class="app-card app-card-chart h-100 shadow-sm">
                                    <div class="app-card-header p-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <h4 class="app-card-title">
                                                    Ejercicios contables pendientes
                                                </h4>
                                            </div>
                                        </div>
                                        <!--//row-->
                                    </div>
                                    <!--//app-card-header-->
                                    <div class="app-card-body p-3 p-lg-4">
                                        <div id="active-courses">
                                            <x-loader/>
                                        </div>
                                    </div>
                                    <!--//app-card-body-->
                                </div>
                                <!--//app-card-->
                            </div>
                            <!--//col-->

                            <div class="col-12 col-lg-12">
                                <div class="app-card app-card-chart h-100 shadow-sm">
                                    <div class="app-card-header p-3">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <h4 class="app-card-title">
                                                    Tus ejercicios enviados/calificados
                                                </h4>
                                            </div>
                                        </div>
                                        <!--//row-->
                                    </div>
                                    <!--//app-card-header-->
                                    <div class="app-card-body p-3 p-lg-4">
                                        <div id="active-courses">
                                            <x-loader/>
                                        </div>
                                    </div>
                                    <!--//app-card-body-->
                                </div>
                                <!--//app-card-->
                            </div>
                            <!--//col-->
                        </div>
                        <!--//row-->
                    </div>

                    <x-modal :name="'accessToExercise'" :size="__('sm')" :show="true" :title="__('Nuevo ejercicio')" :form="true">
                        <div class="mb-3">
                            <x-input-label for="access-code" :value="__('Código de acceso')"/>
                            <x-text-input name="access-code" id="access-code" placeholder="XXXXXX" autocomplete="off" required minlength="6" maxlength="6"/>
                            <x-input-error :messages="null" id="searchExerciseError"/>
                        </div>
                        <small class="text-info">El código de ejercicio está formado con 6 dígitos. Solicita a tu docente el código.</small>

                        <x-slot:footer>
                            <x-primary-button :custom="true" class="btn-secondary" data-bs-dismiss="modal" id="cancelSearch-btn">Cancelar</x-primary-button>
                            <x-primary-button form="accessToExerciseForm" type="submit" id="searchExercise-btn">Buscar</x-primary-button>
                        </x-slot>
                    </x-modal>

                    @php
                        $formAction = route('estudiante.join_exercise');
                    @endphp
                    <x-modal :name="'exerciseFound'" :show="false" :title="__('Unirse al ejercicio')"
                    :form="true" :form_action="$formAction" :submit_text="__('Unirse')">
                        <div class="mb-3">
                            <input type="hidden" name="access-code" id="access-code" value="">
                            <input type="hidden" name="exercise-id" id="exercise-id" value="">
                            <div class="row my-3">
                                <div class="col-12">
                                    <h5 id="exerciseTitle">Ejercicio</h5>
                                    <details class="mb-3">
                                        <div class="row">
                                            <small class="col-12">Docente: <span id="exerciseTeacher" class="badge bg-info"></span></small>
                                            <small class="col-12">Código: <span id="exerciseAccessCode" class="badge bg-info">XXXXXX</span></small>
                                        </div>
                                    </details>
                                </div>
                                <div class="col-5">
                                    <div class="app-card app-card-doc shadow-sm h-100">
                                        <div class="app-card-thumb-holder p-3">
                                            <span class="icon-holder text-info">
                                                <i class="fa-solid fa-file-invoice-dollar"></i>
                                            </span>

                                            <a class="app-card-link-mask" href="#"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <p id="exerciseDescription">Descripción</p>
                                </div>
                            </div>
                        </div>
                    </x-modal>
                    <!--//container-fluid-->
                </div>
                <!--//app-content-->

            </div>
            <!--//app-wrapper-->
        </x-layouts.dashboard>
    @endsection

    @section('scripts')
    <script>
        $(document).ready(function() {
            function searchExercise(formData) {
                // Realizar la consulta de ejercicio
                return $.ajax({
                    type:'POST',
                    url: '{{ route('estudiante.search_exercise') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                });
            }

            $('#accessToExerciseForm').submit(function(e) {
                e.preventDefault();
                const modal1 = $('#accessToExercise')[0];
                const modal2 = $('#exerciseFound')[0];
                const searchExerciseBtn = $('#searchExercise-btn')[0];
                const cancelSearchBtn = $('#cancelSearch-btn')[0];
                const searchExerciseError = $('#searchExerciseError')[0];
                // Deshabilitar botones
                Alpine.$data(searchExerciseBtn).loading = true;
                Alpine.$data(cancelSearchBtn).disabled = true;

                // Limpiar errores del input
                Alpine.$data(searchExerciseError).clearMessages();

                // Simula una operación (p. ej., una llamada a una API)
                searchExercise($(this).serialize()).then(function (response) {
                    if (response.success) {
                        Alpine.$data(searchExerciseBtn).loading = false;
                        Alpine.$data(cancelSearchBtn).disabled = false;
                        Alpine.$data(modal1).show = false;
                        Alpine.$data(modal2).show = true;

                        // Cargar los datos del ejercicio
                        $(modal2).find('#access-code').val(response.data.access_code);
                        $(modal2).find('#exercise-id').val(response.data.id);
                        $(modal2).find('#exerciseName').text(response.data.name);
                        $(modal2).find('#exerciseAccessCode').text(response.data.access_code);
                        $(modal2).find('#exerciseDescription').text(response.data.desc);
                    } else {
                        Alpine.$data(searchExerciseError).setMessages(['Ocurrió un error inesperado']);
                        Alpine.$data(searchExerciseBtn).loading = false;
                        Alpine.$data(cancelSearchBtn).disabled = false;
                    }
                }).catch(function (error) {
                    // En caso de un error inesperado, también habilitar los botones y mostrar la alerta
                    Alpine.$data(searchExerciseError).setMessages(['No se pudo encontrar ningún ejercicio']);
                    Alpine.$data(searchExerciseBtn).loading = false;
                    Alpine.$data(cancelSearchBtn).disabled = false;
                });
            })
        })
    </script>
    @endsection
</x-app-layout>