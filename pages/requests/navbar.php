<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">

    <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder text-white mb-0">Dashboard - Posicionamentos</h6>
    </nav>

    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <div class="input-group">
            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
            <input type="text" class="form-control" placeholder="Escreva aqui...">
        </div>
        </div>
        <ul class="navbar-nav  justify-content-end">
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
                <i class="sidenav-toggler-line bg-white"></i>
            </div>
            </a>
        </li>
        <li class="nav-item px-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white p-0">
            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
            </a>
        </li>

        </ul>
    </div>
    </div>
</nav>
<!-- End Navbar -->

<div class="fixed-plugin">
<a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
    <i class="fa fa-cog py-2"> </i>
</a>
<div class="card shadow-lg">
    <div class="card-header pb-0 pt-3 ">
    <div class="float-start">
        <h5 class="mt-3 mb-0">Configuração de Estilo</h5>
        <p> Veja as opções no painel </p>
    </div>
    <div class="float-end mt-4">
        <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
        <i class="fa fa-close"></i>
        </button>
    </div>
    <!-- End Toggle Button -->
    </div>
    <hr class="horizontal dark my-1">
    <div class="card-body pt-sm-3 pt-0 overflow-auto">
    <!-- Sidebar Backgrounds -->
    <div>
        <h6 class="mb-0">Cor da Navegação Lateral</h6>
    </div>
    <a href="javascript:void(0)" class="switch-trigger background-color">
        <div class="badge-colors my-2 text-start">
        <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
        <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
        </div>
    </a>
    <!-- Sidenav Type -->
    <div class="mt-3">
        <h6 class="mb-0">Tipo de Navegação Lateral</h6>
        <p class="text-sm">Escolha entre 2 tipos diferentes de sidenav.</p>
    </div>
    <div class="d-flex">
        <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
    </div>
    <!-- Navbar Fixed -->
    <div class="d-flex my-3">
        <h6 class="mb-0">NavBar Fixa</h6>
        <div class="form-check form-switch ps-0 ms-auto my-auto">
        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
    </div>
    <hr class="horizontal dark my-sm-4">
    <div class="mt-2 mb-5 d-flex">
        <h6 class="mb-0">Claro / Escuro</h6>
        <div class="form-check form-switch ps-0 ms-auto my-auto">
        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
        </div>
    </div>
    </div>
</div>
</div>