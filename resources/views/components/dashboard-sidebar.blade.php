<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo"
                @switch(Auth::user()->role ?? '')
                    @case(1)
                        href="{{ route('admin.dashboard') }}"
                        @break
                    @case(2)
                        href="{{ route('docente.dashboard') }}"
                        @break
                    @case(3)
                        href="{{ route('estudiante.dashboard') }}"
                        @break
                    @default
                        href="{{ route('admin.dashboard') }}"
                        @break
                @endswitch
                ><x-application-logo></x-application-logo>
                <span class="logo-text">ConTaEdu</span></a>
        </div>
        <!--//app-branding-->

        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                <li class="nav-item">
                    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                    <a class="nav-link active"
                        @switch(Auth::user()->role ?? '')
                            @case(1)
                                href="{{ route('admin.dashboard') }}"
                                @break
                            @case(2)
                                href="{{ route('docente.dashboard') }}"
                                @break
                            @case(3)
                                href="{{ route('estudiante.dashboard') }}"
                                @break
                            @default
                                href="{{ route('admin.dashboard') }}"
                                @break
                        @endswitch
                    >
                        <span class="nav-icon">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                                <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                            </svg>
                        </span>
                        <span class="nav-link-text">Tablero</span> </a><!--//nav-link-->
                </li>

                <!-- Load Sidebar links -->
                @if(Auth::user()->role == 1)
                    <x-sidebars.admin></x-sidebars.admin>
                @elseif(Auth::user()->role == 2)
                    <x-sidebars.docente></x-sidebars.docente>
                @elseif(Auth::user()->role == 3)
                    <x-sidebars.estudiante></x-sidebars.estudiante>
                @endif

            </ul>
            <!--//app-menu-->
        </nav>
        <!--//app-nav-->
    </div>
    <!--//sidepanel-inner-->
</div>