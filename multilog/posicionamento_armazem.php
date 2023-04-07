<?php 
session_start();
require_once '../assets/conexao.php';
require_once 'requests/planilha/estoque_containers.php';

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
  echo "";
} else {
  header("Location: ../login.php");
  exit();
}

if ($area_user == 'Armazem' or $permissao_user == 'Administrador') {
  echo "";
} else {
  header("Location: dashboard.php");
}

$Pagina = "Armazem Posicionamento";

require_once 'requests/head.php'
?>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <!-- Menu - Sidebar -->

  <?php require_once 'requests/menu.php' ?>

  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    
    <?php require_once 'requests/navbar.php' ?>

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="d-flex align-self-center">
                <h6>Meus Posicionamentos de Hoje e Posicionamentos pendentes</h6>
                <button  type="button" class="btn bg-gradient-info btn-block ms-auto btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalSignUp">Solicitar Posicionamento</button>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 dataTable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Armazem/doca</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Container</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cliente</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data Planejado</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data Posicionado</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php 
                        $posicionamento_sql = mysqli_query($conn,"SELECT * FROM posicionamentos WHERE armazem = '$armazem_responsavel' and DATE_FORMAT(data_solicitado, '%Y-%m-%d') = '$today' OR status != 'Realizado' AND armazem = '$armazem_responsavel' AND data_solicitado < '$today'"); 

                            while($row = mysqli_fetch_assoc($posicionamento_sql)) {
                              $data_solicitado = $row['data_solicitado'];      
                              $data_realizado_1 = $row['data_realizado'];

                              $data_solicitado = date("d/m/Y H:i:s", strtotime($data_solicitado));
                              $data_realizado = date("d/m/Y H:i:s", strtotime($data_realizado_1));

                              $solicitado_por = $row['solicitado_por'];
                              $realizado_por = $row['realizado_por'];

                              $containers = $row['containers'];
                              $armazem = $row['armazem'];
                              $doca = $row['doca'];

                              $prioridade = $row['prioridade'];
                              $prioridade_gestor = $row['prioridade_gestor'];

                              $status = $row['status'];

                              $containers_Loc = array_map('trim', explode(',', $row['containers']));
                              $cliente_cntr = cliente_cntr($containers_Loc);

                        ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/favicon.png" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $armazem.'-'.$doca;?></h6>
                            <p class="text-xs text-secondary mb-0"><?php echo $solicitado_por;?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-center text-uppercase text-xs font-weight-bold mb-0"><?php echo $containers;?></p>
                      </td>
                      <td>
                        <p class="text-center text-uppercase text-xs font-weight-bold mb-0"><?php if($cliente_cntr == '') { echo "Não Encontrado"; } else { echo $cliente_cntr; } ?></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span <?php if($status == "Pendente") { echo 'class="badge badge-sm bg-gradient-warning"';} elseif($status == "Pendente - Prioridade Gestor") { echo 'class="badge badge-sm bg-gradient-danger"'; } ?> class="badge badge-sm bg-gradient-success"><?php echo $status;?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $data_solicitado;?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php if($data_realizado_1 == null) {echo ''; } else { echo $data_realizado; }?></span>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Posicionamentos Armazens</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
              <table class="table align-items-center ">
                <tbody>

                <?php 
                  $status_desempenho = mysqli_query($conn, "SELECT armazem, COUNT(*) AS total_solicitados, COUNT(data_realizado) AS total_realizados FROM posicionamentos WHERE DATE_FORMAT(data_solicitado, '%Y-%m-%d') = '$today' GROUP BY armazem");

                  while ($row = mysqli_fetch_assoc($status_desempenho)) {
                  
                    $armazem = $row["armazem"];
                    $total_solicitado = $row["total_solicitados"];
                    $total_realizado = $row["total_realizados"];

                    $media = ($total_solicitado + $total_realizado) / 2
                ?>

                  <tr>
                    <td class="w-30">
                      <div class="d-flex px-2 py-1 align-items-center">
                        <div>
                        <i class="fa-solid fa-warehouse"></i>
                        </div>
                        <div class="ms-4">
                          <p class="text-xs font-weight-bold mb-0">Armazém:</p>
                          <h6 class="text-sm mb-0"><?php echo $armazem; ?></h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="text-center">
                        <p class="text-xs font-weight-bold mb-0">Solicitados:</p>
                        <h6 class="text-sm mb-0"><?php echo $total_solicitado; ?></h6>
                      </div>
                    </td>
                    <td>
                      <div class="text-center">
                        <p class="text-xs font-weight-bold mb-0">Realizados:</p>
                        <h6 class="text-sm mb-0"><?php echo $total_realizado; ?></h6>
                      </div>
                    </td>
                    <td class="align-middle text-sm">
                      <div class="col text-center">
                        <p class="text-xs font-weight-bold mb-0">Media:</p>
                        <h6 class="text-sm mb-0"><?php echo $media;?>%</h6>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="exampleModalSignUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="card card-plain">
                <div class="card-header pb-0 text-left">
                    <h3 class="font-weight-bolder text-primary text-gradient">Solicitar Posicionamento</h3>
                    <p class="mb-0">Insira as informações para a seguir com a solicitação do posicionamento</p>
                </div>
                <div class="card-body pb-3">
                  <form role="form text-left" method="POST" action="requests/solicitar_posicionamento.php">

                    <div class="form-group">
                      <label>Containers</label>
                          <div id="container-input">
                              <input type="text" class="form-control textarea cntr" name="container[]" placeholder="Insira o container" maxlength="12" minlength="11" required>
                          </div>
                        <button type="button" class="btn btn-primary" style="border-radius:55px; width:100%; margin-top:5px;" onclick="botaoMais()">Adicionar Container  <i class="bi bi-plus-circle"></i></button>
                    </div>

                    <label>Doca</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" placeholder="Insira a Doca" name="doca" required>
                    </div>

                    <label>Prioridade</label>
                    <div class="input-group mb-3">
                      <select name="prioridade" class="form-control" name="prioridade" required>
                        <option value="Baixa" disabled selected>Selecione a Prioridade</option>
                        <option value="Baixa">Baixa</option>
                        <option value="Média">Média</option>
                        <option value="Alta">Alta</option>
                      </select>
                    </div>

                    <div class="form-check form-check-info text-left">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked="" required>
                      <label class="form-check-label" for="flexCheckDefault">
                        Eu confirmo os dados inseridos acima
                      </label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">Solicitar</button>
                    </div>
                  </form>
                </div>

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
  </main>

  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
 
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  
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

  <script>
    if ("<?php echo isset($_SESSION['msg']) ? $_SESSION['msg'] : ''; ?>" != "") {

        var msg = "<?php echo $_SESSION['msg']; ?>";

        if (msg == "Solicitação realizada com sucesso.") {
            Swal.fire({
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                timer: 3000
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: msg,
                showConfirmButton: false,
                timer: 3000
            });
        }
        <?php unset($_SESSION['msg']); ?>
    }
  </script>

  <script>
    function botaoMais() {
			var div = document.getElementById("container-input");
			var container_input = document.createElement("input");
			container_input.type = "text";
            container_input.name = "container[]";
            container_input.classList.add("form-control");
            container_input.classList.add("textarea");
            container_input.classList.add("cntr");
            container_input.style.marginTop = "10px";
            container_input.placeholder = "Insira o container";
			div.appendChild(container_input);
            
		}

    $(document).ready(function() {
      $('.dataTable').DataTable({
        "paging": true, // habilita paginação
        "lengthChange": false, // desabilita opção de alterar número de registros por página
        "searching": true, // habilita pesquisa
        "ordering": true, // habilita ordenação das colunas
        "info": false, // habilita exibição de informações da tabela (por exemplo: "Showing 1 to 10 of 100 entries")
        "autoWidth": true, // desabilita ajuste automático da largura das colunas
        "language": {
          "search": "Pesquisar:",
          "paginate": {
            "first": "Primeira",
            "last": "Última",
            "next": "Próxima",
            "previous": "Anterior"
          }
        }
        // table.rows().nodes().to$().removeClass('odd');
      });
    });
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>