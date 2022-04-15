<div class="shadow navbar-wrapper mr-5">
    @if (auth()->user()->level_id === 'LVL00001')
    <div class="py-2">
        <a class="text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="{{route('home')}}">
            <i class='bx bx-home-alt align-middle text-center d-block'></i>
            <span style="font-size: 12px;">Home</span>
        </a>
        <a class="{{ ($active == 'dashboard') ? 'nav-active ': '' }}text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="{{route('admin.home')}}">
            <i class='bx bx-grid-alt align-middle text-center d-block'></i>
            <span style="font-size: 12px;">Dashboard</span>
        </a>
        <a class="{{ ($active == 'alumni') ? 'nav-active ': '' }} text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="{{route('admin.alumni')}}">
            <i class='bx bx-book-reader align-middle text-center d-block'></i>
            <span style="font-size: 12px;">Alumni</span>
        </a>
        <a class="{{ ($active == 'informations') ? 'nav-active ': '' }} text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="{{route('admin.news')}}">
            <i class='bx bx-news align-middle text-center d-block'></i>
            <span style="font-size: 12px;">Informations</span>
        </a>
        <a class="{{ ($active == 'mitra') ? 'nav-active ': '' }} text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="{{route('admin.mitra')}}">
            <i class='bx bx-building-house align-middle text-center d-block'></i>
            <span style="font-size: 12px;">Mitra</span>
        </a>
        <a class="{{ ($active == 'vacancy') ? 'nav-active ': '' }} text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="{{route('admin.loker')}}">
            <i class='bx bx-briefcase-alt-2 align-middle text-center d-block'></i>
            <span style="font-size: 12px;">Job</span>
        </a>
        <a class="{{ ($active == 'users') ? 'nav-active ': '' }} text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="{{route('admin.users')}}">
            <i class='bx bx-user-circle align-middle text-center d-block'></i>
            <span style="font-size: 12px;">Users</span>
        </a>
        <form action="{{route('logout')}}" method="POST" class="navbar-logout text-center d-block py-3">
            @csrf
            <button class="btn btn-primary">
                <i class='bx bx-log-out-circle align-middle text-center d-block'></i>
                <span style="font-size: 12px;">Logout</span>
            </button>
        </form>
    </div>
    @endif
</div>
