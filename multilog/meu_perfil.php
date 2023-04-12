<?php 
session_start();
require_once '../assets/conexao.php';

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
  echo "";
} else {
  header("Location: ../login.php");
  exit();
}

$Pagina = "Meu Perfil";

$id = $_SESSION['id'];
$sql = mysqli_query($conn, "SELECT * FROM web_login WHERE id = '$id' ");
$row = mysqli_fetch_assoc($sql);
                
require_once 'requests/head.php';
?>

<body class="g-sidenav-show bg-gray-100">
  <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://www.logweb.com.br/wp-content/uploads/2022/12/Multilog-OEA.jpg'); background-position-y: 50%;">
    <span class="mask bg-primary opacity-6"></span>
  </div>

  <!-- Menu - Sidebar -->

  <?php require_once 'requests/menu.php' ?>
  
  <div class="main-content position-relative max-height-vh-100 h-100">

  <?php require_once 'requests/navbar.php' ?>

    <div class="card shadow-lg mx-4 card-profile-bottom">
      <div class="card-body p-3">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="<?php echo $row['foto']; ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php echo $row['nome']; ?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                <?php echo $row['cargo']; ?>
              </p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1" role="tablist">
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 active py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <i class="ni ni-email-83"></i>
                    <span class="ms-2">Mensagens</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                    <i class="ni ni-settings-gear-65"></i>
                    <span class="ms-2">Ajustes</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
              
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Editar Perfil</p>
                <button class="btn btn-primary btn-sm ms-auto">Ajustes</button>
              </div>
            </div>
            <div class="card-body">
            <form action="requests/editar_usuario.php" method="post">
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Usuario</label>
                      <input class="form-control" type="text" name="usuario" value="<?php echo $row['login']; ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">E-Mail</label>
                      <input class="form-control" type="email" value="<?php echo $row['email']; ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Nome</label>
                      <input class="form-control" type="text" name="nome" value="<?php echo $row['nome']; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Senha</label>
                      <input class="form-control" type="password" name="senha" value="<?php echo $row['senha']; ?>">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Foto de Perfil</label>
                      <input class="form-control" type="text" name="foto" value="<?php echo $row['foto']; ?>">
                    </div>
                  </div>
                </div>
                <hr class="horizontal dark">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Gestor Imediato</label>
                      <input class="form-control" type="text" value="<?php echo $row['gestor']; ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Nivel de Acesso</label>
                      <input class="form-control" type="text" value="<?php echo $permissao_user; ?>" disabled>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Empresa</label>
                      <input class="form-control" type="text" value="Multilog SA" disabled>
                    </div>
                  </div>
                  
                  <?php if($area_user == "Patio") { ?>
                  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Posto de Trabalho</label>
                      <input class="form-control" type="text" value="Patio" disabled>
                    </div>
                  </div>
                  
                  <?php }else { ?>
                  
                   <div class="col-md-4">
                    <div class="form-group">
                      <label for="example-text-input" class="form-control-label">Posto de Trabalho</label>
                      <input class="form-control" type="text" value="<?php echo $armazem_responsavel ?>" disabled>
                    </div>
                  </div>
                  
                  <?php }?>
                  
                  <div class="col-md-6">
                    <br><br>
                      <?php $id_usuario = $_SESSION['id']; ?>
                      <button type="submit" class="btn btn-primary ml-auto">Editar Perfil</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer pt-3">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script> document.write(new Date().getFullYear()) </script>, Funções desenvolvidas por: 
                <a href="https://www.linkedin.com/in/santosluca/" class="font-weight-bold" target="_blank">Lucas Santos </a>
                para a Multilog
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>