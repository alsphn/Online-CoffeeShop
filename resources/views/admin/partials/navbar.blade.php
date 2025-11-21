<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" href="#" role="button">
                Admin Panel
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('logout') }}"
               class="nav-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        </li>
    </ul>

    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
</nav>
