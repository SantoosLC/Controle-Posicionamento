<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="dashboard.php">
        <img class="" style="width:60%;" src="../assets/img/logo_azul.png" alt="">
        </a>
    </div>

    <hr class="horizontal dark mt-0">

    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a <?php if ($Pagina == 'Dashboard') { echo ' class="nav-link active"'; } ?> class="nav-link" href="../multilog/dashboard.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a <?php if ($Pagina == 'Meu Perfil') { echo ' class="nav-link active"'; } ?> class="nav-link " href="../multilog/meu_perfil.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-single-02 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Meu Perfil</span>
            </a>
        </li>

        <!-- <li class="nav-item"> 
            <a class="nav-link" href="../multilog/billing.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Billing</span>
            </a>
        </li> -->

        <?php if($area_user == "Armazem" or $permissao_user == "Administrador") { ?>

        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Armazem</h6>
        </li>

        <li class="nav-item">
            <a <?php if ($Pagina == 'Armazem Posicionamento') { echo ' class="nav-link active"'; } ?> class="nav-link " href="../multilog/posicionamento_armazem.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-calendar-grid-58 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Posicionamentos</span>
            </a>
        </li>

        <?php } ?>

        <?php if($area_user == "Patio" or $permissao_user == "Administrador") { ?>

        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pátio</h6>
        </li>

        <li class="nav-item">
            <a <?php if ($Pagina == 'Patio Posicionamento') { echo ' class="nav-link active"'; } ?> class="nav-link " href="../multilog/posicionamento_patio.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-list text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Gestão de Posicionamentos</span>
            </a>
        </li>

        <li class="nav-item">
            <a <?php if ($Pagina == 'Patio Posicionamento 2') { echo ' class="nav-link active"'; } ?> class="nav-link " href="../multilog/posicionamentos_realizados.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-list text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Posicionamentos Anual</span>
            </a>
        </li>

        <?php } ?>

        <?php if($permissao_user == "Administrador") {?>

        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Administradores</h6>
        </li>

        <li class="nav-item">
            <a <?php if ($Pagina == 'Controle Usuario') { echo ' class="nav-link active"'; } ?> class="nav-link " href="../multilog/controle_usuario.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-screwdriver-wrench text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Controle de Usuarios</span>
            </a>
        </li>

        <?php }?>
        
        </ul>
    </div>

    <div class="sidenav-footer mx-3">
        <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="../assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
            <div class="docs-info">
            <h6 class="mb-0">Lucas Santos</h6>
            <p class="text-xs font-weight-bold mb-0">Desenvolvedor</p>
            </div>
        </div>
        </div>
        <a href="https://www.linkedin.com/in/santosluca/" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Linked-in</a>
    </div>

</aside>