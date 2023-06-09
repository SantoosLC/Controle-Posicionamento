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

if ($area_user == 'Patio' or $permissao_user == 'Administrador') {
  echo "";
} else {
  header("Location: dashboard.php");
}

$Pagina = "Patio Posicionamento 2";

require_once 'requests/head.php'
?>

<body class="g-sidenav-show   bg-gray-100">
    <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://www.logweb.com.br/wp-content/uploads/2022/12/Multilog-OEA.jpg'); background-position-y: 50%;">
    <span class="mask bg-primary opacity-6"></span>
  </div>

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
                <h6>Unidades posicionadas no ano de 2023</h6>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 dataTable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Armazem/doca</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Container</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Endereco</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sob Rodas</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cliente</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data Planejado</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data Posicionado</th>
                      <th style="display:none;">id</th>
                      <th style="display:none;">Solicitado Por</th>
                      <th style="display:none;">Prioridade</th>
                      <th style="display:none;">Priorizado Por</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php $posicionamento_sql = mysqli_query($conn,"SELECT posicionamentos.*, web_login.nome, web_login.foto FROM posicionamentos INNER JOIN web_login ON posicionamentos.solicitado_por = web_login.email WHERE posicionamentos.status = 'Realizado'"); 
                            while($row = mysqli_fetch_assoc($posicionamento_sql)) {
                              $data_solicitado = $row['data_solicitado'];      
                              $data_realizado_1 = $row['data_realizado'];

                              $data_solicitado = date("d/m/Y H:i:s", strtotime($data_solicitado));
                              $data_realizado = date("d/m/Y H:i:s", strtotime($data_realizado_1));

                              $solicitado_por = $row['solicitado_por'];
                              $solicitado_por_nome = $row['nome'];

                              $realizado_por = $row['realizado_por'];
                              $prioridade = $row['prioridade'];

                              $containers = $row['containers'];
                              $tamanho = $row['tamanho'];

                              $armazem = $row['armazem'];
                              $doca = $row['doca'];
                              $sobrodas = $row['sobrodas'];

                              $prioridade = $row['prioridade'];
                              $prioridade_gestor = $row['prioridade_gestor'];
                              $priorizado_por = $row['priorizado_por'];

                              $status = $row['status'];

                              $foto = $row['foto'];
                              $id = $row['id'];

                              $containers_Loc = array_map('trim', explode(',', $row['containers']));
                              $localizacao = loc_cntr($containers_Loc);

                              $cliente_cntr = cliente_cntr($containers_Loc);
                        ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="<?php echo $foto ?>" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $armazem.'-'.$doca;?></h6>
                            <p class="text-xs text-secondary mb-0"><?php echo $solicitado_por;?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0 text-center text-uppercase"><?php echo $containers;?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0 text-center"><?php if($localizacao == '') { echo "Baixa no Sistema"; } else { echo $localizacao; } ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0 text-center"><?php echo $sobrodas ?></p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0 text-center"><?php if($cliente_cntr == '') { echo "Baixa no Sistema"; } else { echo $cliente_cntr; } ?></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span <?php if($status == "Pendente") { echo 'class="badge badge-sm bg-gradient-warning"';} elseif($status == "Pendente - Prioridade Gestor") { echo 'class="badge badge-sm bg-gradient-danger"'; } ?> class="badge badge-sm bg-gradient-success"><?php echo $status;?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $data_solicitado;?></span>
                      </td>
                      <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?php if($data_realizado_1 == null) {echo 'Aguardando'; } else { echo $data_realizado; }?></span>
                      </td>
                      <?php if($status == "Realizado") { echo '<td class="align-middle text-center"> </td>'; } else {

                      ?>
                      <td style="display:none;"> 
                        <?php echo $id ?>
                      </td>
                      <!-- <td class="align-middle text-center">
                        <a id="ConfirmarServico_<?php echo $row['id']; ?>" data-id="<?php echo $row['id']; ?>" class="font-weight-bold text-xs btn btn-primary" data-toggle="tooltip" data-original-title="Confirmar">
                          Finalizar Serviço
                        </a>

                        <a id="PriorizarPosicionamento_<?php echo $row['id']; ?>" data-id="<?php echo $row['id']; ?>" class="font-weight-bold text-xs btn btn-primary" data-toggle="tooltip" data-original-title="Confirmar">
                          Priorizar
                        </a>
                      </td> -->
                      <?php } ?>
                      <td style="display:none;">
                       <span> <?php echo $solicitado_por_nome; ?> </span>
                      </td>
                      <td style="display:none;">
                       <span> <?php if($prioridade_gestor == 'Sim') { echo 'Muito Alta - Gestor';} else { echo $prioridade; } ?> </span>
                      </td>
                      <td style="display:none;">
                       <span> <?php if($prioridade_gestor == 'Sim') { echo $priorizado_por;} ?> </span>
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
                  $status_desempenho = mysqli_query($conn, "SELECT armazem, COUNT(*) AS total_solicitados, COUNT(data_realizado) AS total_realizados FROM posicionamentos GROUP BY armazem");

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

  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
  
  <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.colVis.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/datetime/1.3.1/js/dataTables.dateTime.min.js"></script>

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

<script>
    $('a[id^="PriorizarPosicionamento_"]').click(function(e) {
        console.log('teste');
        e.preventDefault();
        var id = $(this).data('id');

        Swal.fire({
            title: 'Tem certeza?',
            text: 'Você deseja priorizar esse posicionamento ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'requests/confirmar_posicionamento.php?priorizar=' + id;
            }
        }) 
    });
  </script>

  <script>
    $(document).ready(function() {
      tabela = $('.dataTable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'excelHtml5',
            text: 'Baixar Planilha',
            className: 'btn bg-gradient-info ml-auto btn-sm font-weight-bold text-xs',
            exportOptions: {
              columns: [1, 3, 0, 2, 4, 6, 8, 11, 9],
              customizeData: function ( data ) {
                for (var i=0; i<data.body.length; i++) {
                  data.body[i][2] = data.body[i][2].substring(0,8);
                }
              }
            },
          }
        ],
        order: [[6, 'asc']],
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