<!--//nav-item-->
<li class="nav-item">
<li class="nav-item has-submenu">
  <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
  <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
    data-bs-target="#submenu-1" aria-expanded="false" aria-controls="submenu-1">
    <span class="nav-icon">
      <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
      <svg width="1em" height="1em" viewBox="0 0 16 16"
        class="bi bi-columns-gap" fill="currentColor"
        xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
          d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z" />
      </svg>
    </span>
    <span class="nav-link-text">Gestión Estudiantes</span>
    <span class="submenu-arrow">
      <svg width="1em" height="1em" viewBox="0 0 16 16"
        class="bi bi-chevron-down" fill="currentColor"
        xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
          d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
      </svg> </span><!--//submenu-arrow--> </a><!--//nav-link-->
  <div id="submenu-1" class="collapse submenu submenu-1"
    data-bs-parent="#menu-accordion">
    <ul class="submenu-list list-unstyled">
      <li class="submenu-item">
        <a class="submenu-link" href="{{ route('student.create') }}">Crear</a>
      </li>
      <li class="submenu-item">
        <a class="submenu-link" href="{{ route('student.index') }}">Lista</a>
      </li>
    </ul>
  </div>
</li>

<li class="nav-item has-submenu">
  <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
  <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse"
    data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">
    <span class="nav-icon">
      <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
      <svg width="1em" height="1em" viewBox="0 0 16 16"
        class="bi bi-columns-gap" fill="currentColor"
        xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
          d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z" />
      </svg>
    </span>
    <span class="nav-link-text">Gestión de Ejercicios</span>
    <span class="submenu-arrow">
      <svg width="1em" height="1em" viewBox="0 0 16 16"
        class="bi bi-chevron-down" fill="currentColor"
        xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
          d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
      </svg> </span><!--//submenu-arrow--> </a><!--//nav-link-->
  <div id="submenu-2" class="collapse submenu submenu-2"
    data-bs-parent="#menu-accordion">
    <ul class="submenu-list list-unstyled">
      <li class="submenu-item">
        <a class="submenu-link" href="{{ route('exercise.create') }}">Crear</a>
      </li>
      <li class="submenu-item">
        <a class="submenu-link" href="{{ route('exercise.index') }}">Lista</a>
      </li>

    </ul>
  </div>
</li>
</li>
