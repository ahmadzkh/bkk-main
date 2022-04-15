<nav class="navbar py-4 navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand bold" href="{{route('home')}}">
            <img src="{{ asset('/assets/img/imp/logoobkk.png')}}" alt="bkk_logo" style="width: 120px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav medium text-center mx-auto">
                <li class="nav-item ms-lg-5">
                    <a class="nav-link {{ ($active === 'home') ? 'active' : ''}}" aria-current="page" href="{{route('home')}}">Home</a>
                </li>
                @auth
                <li class="nav-item ms-lg-5">
                    <a class="nav-link {{ ($active === 'alumni') ? 'active' : ''}}" href="{{route('bkk.alumni')}}">Alumni</a>
                </li>
                @endauth
                <li class="nav-item ms-lg-5">
                    <a class="nav-link {{ ($active === 'vacancy') ? 'active' : ''}}" href="{{route('bkk.loker')}}">Job Vacancy</a>
                </li>
                <li class="nav-item ms-lg-5">
                    <a class="nav-link {{ ($active === 'mitra') ? 'active' : ''}}" href="{{route('bkk.mitra')}}">Partners</a>
                </li>
                <li class="nav-item ms-lg-5">
                    <a class="nav-link {{ ($active === 'information') ? 'active' : ''}}" href="{{(route('bkk.informasi'))}}">Information</a>
                </li>
            </ul>
            @auth
                <ul class="navbar-nav ms-auto mt-3 text-white">
                    <div class="dropdown">
                        <div class="row user" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="col" style="width: 250px;">
                                @if (auth()->user()->username === null)
                                <p>{{auth()->user()->email}}</p>
                                @else
                                <p>{{auth()->user()->username}}</p>
                                @endif
                            </div>
                            <div class="col dropdown-toggle"></div>
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @if (auth()->user()->level_id === 'LVL00001')
                            <li><a class="dropdown-item" href="{{route('admin.profile')}}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{route('admin.home')}}">Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                            @endif
                            @if (auth()->user()->level_id === 'LVL00002')
                            <li><a class="dropdown-item" href="{{route('alumni.profile')}}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{route('alumni.rekomendasi')}}">Rekomendation</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                            @endif
                            @if (auth()->user()->level_id === 'LVL00003')
                            <li><a class="dropdown-item" href="{{route('mitra.profile')}}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{route('mitra.home')}}">Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                            @endif
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit"><i class="bx bx-log-out-circle me-3"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </ul>
                @else
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn-login text-decoration-none semibold text-primary">Login</a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>
