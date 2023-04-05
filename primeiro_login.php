<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title> Multilog - Armazem x Patio </title>
  
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>

<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Seja bem vindo a plataforma!</h4>
                  <p class="mb-0">Como é seu primeiro login, precisamos que você escolha uma nova senha.</p>
                </div>
                <div class="card-body">
                <?php 
                                    
                    if(isset($_SESSION['login_error'])) {
                        echo "<div class='alert alert-danger my-4 p-3 border'><p>".$_SESSION['login_error']."</p></div>";
                        unset($_SESSION['login_error']);
                    }
  
                    if(isset($_SESSION['login_success'])) {
                        echo "<div class='alert alert-success my-4 p-3 border'><p>".$_SESSION['login_success']."</p></div>";
                        unset($_SESSION['login_success']);
                        echo '<script>setTimeout(function() { window.location.href = "multilog/dashboard.php"; }, 3000);</script>';
                    }
  
                  ?>
                  <form role="form" method="POST" action="multilog/requests/primeiro_login.php">
                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg" placeholder="Senha" aria-label="Password" name="senha">
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg" placeholder="Senha" aria-label="Password" name="confirmar-senha">
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="confirmar" required>
                      <label class="form-check-label" for="confirmar">Confirmar</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Entrar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('assets/img/background-mlt.jpg');
          background-size: cover;">
                <span class="mask bg-gradient-primary opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative"></h4>
                <p class="text-white position-relative"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
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