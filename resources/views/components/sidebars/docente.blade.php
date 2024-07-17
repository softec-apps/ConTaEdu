<li class="nav-item">
  <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
  @php
    $activeRoutes = [
      'template.index',
      'template.accounts',
    ];
  @endphp
  <a class="nav-link {{ in_array(request()->route()->getName(), $activeRoutes) ? 'active' : '' }}" href="{{ route('template.index') }}">
    <span class="nav-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
        fill="currentColor" class="bi bi-journal-bookmark-fill"
        viewBox="0 0 16 16">
        <path fill-rule="evenodd"
          d="M6 8V1h1v6.117L8.743 6.07a.5.5 0 0 1 .514 0L11 7.117V1h1v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8z" />
        <path
          d="M3.5 0A1.5 1.5 0 0 0 2 1.5v13A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-13A1.5 1.5 0 0 0 12.5 0h-9zM1 1.5A2.5 2.5 0 0 1 3.5 4h9A2.5 2.5 0 0 1 15 1.5v13A2.5 2.5 0 0 1 12.5 17h-9A2.5 2.5 0 0 1 1 14.5v-13z" />
      </svg>
    </span>
    <span class="nav-link-text">Plan de Cuentas</span> </a><!--//nav-link-->
</li>
<li class="nav-item">
  <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
  <a class="nav-link {{ request()->routeIs('student.index') ? 'active' : '' }}" href="{{ route('student.index') }}">
    <span class="nav-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
        fill="currentColor" class="bi bi-journal-bookmark-fill"
        viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
        <path
          d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z" />
      </svg>
    </span>
    <span class="nav-link-text">Gestión Estudiantes</span> </a><!--//nav-link-->
</li>
<li class="nav-item">
  <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
  <a class="nav-link {{ request()->routeIs('exercise.index') ? 'active' : '' }}" href="{{ route('exercise.index') }}">
    <span class="nav-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
        fill="currentColor" class="bi bi-journal-bookmark-fill"
        viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
        <path
          d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z" />
      </svg>
    </span>
    <span class="nav-link-text">Gestión de Ejercicios</span>
  </a><!--//nav-link-->
</li>
