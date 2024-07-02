<li class="nav-item">
    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
    <a class="nav-link" href="{{ route('users.index') }}">
        <span class="nav-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" id="user">
                <path fill="#000" fill-rule="evenodd" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10Zm3-12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 7a7.489 7.489 0 0 1 6-3 7.489 7.489 0 0 1 6 3 7.489 7.489 0 0 1-6 3 7.489 7.489 0 0 1-6-3Z" clip-rule="evenodd"></path>
            </svg>
        </span>
        <span class="nav-link-text">Usuarios</span> </a><!--//nav-link-->
</li>
<!--//nav-item-->
<li class="nav-item has-submenu">
    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
    <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-2"
        aria-expanded="false" aria-controls="submenu-2">
        <span class="nav-icon">
            <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-columns-gap" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z" />
            </svg>
        </span>
        <span class="nav-link-text">External</span>
        <span class="submenu-arrow">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
            </svg> </span><!--//submenu-arrow--> </a><!--//nav-link-->
    <div id="submenu-2" class="collapse submenu submenu-2" data-bs-parent="#menu-accordion">
        <ul class="submenu-list list-unstyled">
            <li class="submenu-item">
                <a class="submenu-link" href="login.html">Login</a>
            </li>
            <li class="submenu-item">
                <a class="submenu-link" href="signup.html">Signup</a>
            </li>
            <li class="submenu-item">
                <a class="submenu-link" href="reset-password.html">Reset password</a>
            </li>
            <li class="submenu-item">
                <a class="submenu-link" href="404.html">404 page</a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item">
    <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
    <a class="nav-link" href="help.html">
        <span class="nav-icon">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-question-circle" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path
                    d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
            </svg>
        </span>
        <span class="nav-link-text">Help</span> </a><!--//nav-link-->
</li>
