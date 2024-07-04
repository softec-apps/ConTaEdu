<x-app-layout>
    <x-slot:title>Tablero</x-slot>

    @section('main')
    <!-- Join to exercise -->
    <x-estudiante.joinToExercise />

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
                                        <h4 class="text-white">Nuevo ejercicio</h4>
                                        <div class="stats-figure text-white"><i class="fa-solid fa-circle-plus"></i>
                                        </div>
                                    </div>
                                    <!--//app-card-body-->
                                    <!-- <a class="app-card-link-mask" href="#" data-bs-toggle="modal" data-bs-target="#accessToExercise"></a> -->
                                    <a class="app-card-link-mask" href="#" @click="showAccessModal = !showAccessModal"></a>
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
                                            <x-loading-items :items="$pending_exercises">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ route('estudiante.pending_exercises') }}" class="btn btn-secondary">Ver todo</a>
                                                </div>
                                            </x-loading-items>
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
                                            <x-loading-items :items="$sent_graded_exercises" :graded="true">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ route('estudiante.sent_graded_exercises') }}" class="btn btn-secondary">Ver todo</a>
                                                </div>
                                            </x-loading-items>
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
                    <!--//container-fluid-->
                </div>
                <!--//app-content-->

            </div>
            <!--//app-wrapper-->
        </x-layouts.dashboard>
    @endsection
</x-app-layout>