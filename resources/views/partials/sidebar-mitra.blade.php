<div class="navbar-toggle shadow">
    <i class='bx bx-chevrons-right align-middle' data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-expanded="false" aria-controls="sidebarCollapse"></i>
</div>
<div class="shadow navbar-wrapper mr-5 show collapse-horizontal" id="sidebarCollapse">
    <div class="py-2">
        <a class="text-decoration-none text-black navbar-close text-center d-block py-md-3 py-2 my-2 my-md-0" href="#" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-expanded="false" aria-controls="sidebarCollapse">
            <i class='bx bx-x align-middle text-center d-block'></i>
        </a>
        <a class="text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="{{route('home')}}">
            <i class='bx bx-home-alt align-middle text-center d-block'></i>
            <span style="font-size: 12px;">Home</span>
        </a>
        <a class="{{ ($active == 'dashboard') ? 'nav-active ': '' }} text-decoration-none text-black navbar-item text-center d-block py-md-3 py-2 my-2 my-md-0" href="/mt/main">
            <i class='bx bx-grid-alt align-middle text-center d-block'></i>
            <span style="font-size: 12px;">Dashboard</span>
        </a>
        <a class="{{ ($active == 'profil') ? 'nav-active ': '' }} text-decoration-none text-black navbar-item text-center d-block py-md-3 py-2 my-2 my-md-0" href="/mt/profil">
            <i class='bx bx-user-circle align-middle text-center d-block'></i>
            <span style="font-size: 12px;">Profile</span>
        </a>
        <a class="{{ ($active == 'loker') ? 'nav-active ': '' }} text-decoration-none text-black navbar-item text-center d-block py-md-3 py-2 my-2 my-md-0" href="/mt/lk/main">
            <i class='bx bx-briefcase-alt-2 align-middle text-center d-block'></i>
            <span style="font-size: 12px;">Vacancy</span>
        </a>
        <a class="{{ ($active == 'rekomendasi') ? 'nav-active ': '' }} text-decoration-none text-black navbar-item text-center d-block py-md-3 py-2 my-2 my-md-0" href="/mt/re/main">
            <i class='bx bx-star align-middle text-center d-block'></i>
            <span style="font-size: 12px;">Recommend</span>
        </a>
    </div>
</div>

