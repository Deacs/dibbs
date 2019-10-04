<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">DIBBS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
        @if (Auth::guest())
            <li class="nav_item">
                <a href="/login" class="nav-link">Login</a>
            </li>
            <li class="nav_item">
                <a href="/register" class="nav-link">Register</a>
            </li>
        @else
            <li class="nav_item">
                <a href="/dashboard" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item dropdown">      
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Wardrobe
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a href="/wardrobe" class="dropdown-item">Your Wardrobe</a>
                    <a href="/reservations" class="dropdown-item">Reservations</a>
                    <a href="/wardrobe/history" class="dropdown-item">Your History</a>
            </li>
            <li class="nav_item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="nav-link">
                    Logout
                </a>    
            </li>
        </ul>
        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        @endif
    </div>
</nav>
