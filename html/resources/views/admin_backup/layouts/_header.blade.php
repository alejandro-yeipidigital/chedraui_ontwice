<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @guest('admin')
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('admin.login') }}">Login</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.home') }}">Home</a>
                </li>

                @if ( auth()->user()->email ==  "it@ontwice.com.mx" )
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('temporalities.index') }}">Temporalidades</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('querys.index') }}">Query</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('limit-tickets.index') }}">Límite tickes</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('winners.index') }}">Ganadores</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('url.index') }}">Sitio</a>
                    </li>
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tickets
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('tickets.main') }}">Todos</a>
                        <a class="dropdown-item" href="{{ route('tickets.pendientes', 1) }}">Pendientes</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item href="{{ route('tickets.validados', 2) }}">Validados</a>
                        <a class="dropdown-item" href="{{ route('tickets.rechazados', 3) }}">Rechazados</a>
                    </div>
                </li>

                

            @endguest
        </ul>
        <a class="nav-link" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Cerrar Sesión
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-door-closed-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4 1a1 1 0 0 0-1 1v13H1.5a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2a1 1 0 0 0-1-1H4zm2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
            </svg>
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>



