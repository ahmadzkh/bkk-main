<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
    <div class="container">
        <a class="navbar-brand bold" href="{{route('home')}}">
            <img src="{{ asset('/assets/img/imp/logobkkbiru.png')}}" alt="bkk_logo" style="width: 120px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bkk.alumni') }}">Alumni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bkk.loker') }}">Job Vacancy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bkk.mitra') }}">Partner</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bkk.informasi') }}">Information</a>
                </li>
            </ul>

            <div class="me-4 ms-auto profile">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (auth()->user()->username == null)
                                {{ auth()->user()->email }}<i class='bx bx-user-circle ms-3 align-middle'></i>
                                @else
                                {{ auth()->user()->username }}
                                @endif
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('mitra.home') }}"><i class='bx bx-grid-alt align-middle'></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('mitra.profile') }}"><i class='bx bx-user align-middle'></i> Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{route('logout')}}" method="post">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit"><i class="bx bx-log-out-circle me-3"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
