<x-app-layout>
    <x-slot name="title">Tablero</x-slot>

    @section('main')
        <x-layouts.dashboard>
            <div class="app-wrapper">
                <div class="app-content pt-3 p-md-3 p-lg-4">
                    <div class="container-xl">
                        <h1 class="app-page-title">Administradores</h1>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="app-card app-card-progress-list h-100 shadow-sm">
                            <div class="app-card-header p-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <h4 class="app-card-title">Lista de usuarios</h4>
                                    </div>

                                    <div class="col-auto">
                                        <div class="card-header-action">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#settingsModal">Agregar</a>
                                        </div>
                                    </div>
                                    <!--//col-->
                                </div>
                                <!--//row-->
                            </div>
                            <div class="app-card-body">
                                <div class="item p-3">
                                    {{-- DATATABLE --}}

                                </div>

                            </div>
                        </div>
                    </div>
                    <!--//container-fluid-->
                </div>
                <!--//app-content-->

            </div>
            @include('teachers.modal')
            <!--//app-wrapper-->
        </x-layouts.dashboard>
    @endsection
</x-app-layout>
