<?php 
session_start();
require_once '../assets/conexao.php';

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
  echo "";
} else {
  header("Location: ../login.php");
  exit();
}

if ($permissao_user == 'Administrador' or $permissao_user == 'Moderador') {
  echo "";
} else {
  header("Location: dashboard.php");
}

$Pagina = "Controle Usuario";

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
                <h6>Controle de Usuarios</h6>
                <button type="button" class="btn bg-gradient-info btn-block ms-auto btn-sm" data-bs-toggle="modal" data-bs-target="#CadastrarUsuario">Adicionar Usuario</button>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 dataTable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Login</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Area</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Armazem</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cargo</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Permissão</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php $web_login = mysqli_query($conn,"SELECT * FROM web_login"); 
                            while($row = mysqli_fetch_assoc($web_login)) {
                              $id = $row['id'];      
                              $nome = $row['nome'];      
                              $login = $row['login'];
                              $email = $row['email'];
                              $cargo = $row['cargo'];
                              $area = $row['area'];
                              $armazem = $row['armazem'];
                              $status = $row['status'];
                              $permissao = $row['permissao'];
                              $armazem = $row['armazem'];
                              $foto = $row['foto'];
                        ?>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="<?php echo $foto; ?>" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $nome; ?></h6>
                            <p class="text-xs text-secondary mb-0"><?php echo $email; ?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0"><?php echo $login;?></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span <?php if($status == "Pendente") { echo 'class="badge badge-sm bg-gradient-danger"';} ?> class="badge badge-sm bg-gradient-success"><?php echo $status;?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $area;?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php if($area == "Patio") { echo "N/A"; } else { echo $armazem; }?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $cargo;?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?php echo $permissao;?></span>
                      </td>
                      <td class="align-middle text-center">
                        <button data-id='<?php echo $id ?>' data-login='<?php echo $login ?>' data-nome='<?php echo $nome ?>' data-email='<?php echo $email ?>' data-cargo='<?php echo $cargo ?>' data-area='<?php echo $area ?>' data-status='<?php echo $status ?>' data-permissao='<?php echo $permissao ?>'  data-armazem='<?php echo $armazem ?>' data-bs-toggle="modal" data-bs-target="#exampleModalSignUp" class="btn bg-gradient-info btn-block ms-auto btn-sm" data-toggle="tooltip" data-original-title="Confirmar">
                          Editar Usuario
                        </button>
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

    <div class="modal fade" id="exampleModalSignUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="card card-plain">
                <div class="card-header pb-0 text-left">
                    <h3 class="font-weight-bolder text-primary text-gradient">Edição de Usuario</h3>
                    <p class="mb-0">Insira as informações para a seguir com a edição de usuario</p>
                </div>
                <div class="card-body pb-3">
                  <form role="form text-left" method="POST" action="requests/editar_usuario_administrador.php">

                    <label>Login</label>
                    <div class="input-group mb-3">

                    <?php if($permissao_user == "Moderador") { ?>
                      <input type="text" class="form-control login" placeholder="Insira o login" name="login" required>
                    <?php }else { ?>
                      <input type="text" class="form-control login" placeholder="Insira o login" name="login" readonly>
                    <?php } ?>

                    </div>

                    <label>Nome</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control nome" placeholder="Insira o nome" name="nome" required>
                    </div>

                    <label>Email</label>
                    <div class="input-group mb-3">
                      <input type="email" class="form-control email" placeholder="Insira o email" name="email" required>
                    </div>

                    <?php if($permissao_user == "Moderador") { echo "";}else { ?>

                      <label>Cargo</label>
                      <div class="input-group mb-3">
                        <select name="cargo" class="form-control cargo" >
                          <option value="" selected>Selecione uma opção</option>
                          <option value="Jovem Aprendiz">Jovem Aprendiz</option>
                          <option value="Assistente de Operações">Assistente de Operações</option>
                          <option value="Líder de Operações">Líder de Operações</option>
                          <option value="Analista de Operações">Analista de Operações</option>
                          <option value="Supervisor de Operações">Supervisor de Operações</option>
                          <option value="Coordenador de Operações">Coordenador de Operações</option>
                          <option value="Gerente de Operações">Gerente de Operações</option>
                          <option value="Analista Aduaneiro">Analista Aduaneiro</option>
                          <option value="Assistente Aduaneiro">Assistente Aduaneiro</option>
                        </select>
                      </div>

                    <?php } ?>

                    <label>Area</label>
                    <div class="input-group mb-3">
                      <select name="area" class="form-control area" name="area" required>
                        <option value="" disabled selected>Selecione a area</option>
                        <option value="Patio">Patio</option>
                        <option value="Armazem">Armazem</option>
                        <option value="Aduaneiro">Aduaneiro</option>
                      </select>
                    </div>

                    <?php if($permissao_user == "Moderador") { echo "";}else { ?>

                      <label>Status</label>
                      <div class="input-group mb-3">
                        <select name="status" class="form-control status" name="status" required>
                          <option value="" disabled selected>Selecione o Status</option>
                          <option value="Aprovado">Aprovado</option>
                          <option value="Pendente">Pendente</option>
                        </select>
                      </div>

                    <?php } ?>

                    <?php if($permissao_user == "Moderador") { echo "";}else { ?>

                    <label>Permissao</label>
                    <div class="input-group mb-3">
                      <select name="permissao" class="form-control permissao" name="permissao" required>
                        <option value="" disabled selected>Selecione a Permissao</option>
                        <option value="Padrao">Padrão</option>
                        <option value="Administrador">Administrador</option>
                      </select>
                    </div>

                    <?php } ?>

                    <label>Armazem Destinado</label>
                    <div class="input-group mb-3">
                      <?php 
                        $sql_m_armazem = mysqli_query($conn, "SELECT id, armazem FROM armazem");

                        echo "<select class='form-control armazem' name='armazem' required>";
                        echo '<option value="" disabled selected>Selecione uma opção</option>';
                            while ($opcao = mysqli_fetch_assoc($sql_m_armazem)) {
                            echo "<option value='" . $opcao['armazem'] . "'>" . $opcao['armazem'] . "</option>";
                            }    
                        echo "</select>";

                      ?>
                    </div>

                    <input type="text" name="id-user" id="id-user" hidden>

                    <div class="form-check form-check-info text-left">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked="" required>
                      <label class="form-check-label" for="flexCheckDefault">
                        Eu confirmo os dados inseridos acima
                      </label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">Editar</button>
                    </div>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

          <div class="modal fade" id="CadastrarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalSignTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="card card-plain">
                <div class="card-header pb-0 text-left">
                    <h3 class="font-weight-bolder text-primary text-gradient">Edição de Usuario</h3>
                    <p class="mb-0">Insira as informações para a seguir com a edição de usuario</p>
                </div>
                <div class="card-body pb-3">
                  <form role="form text-left" method="POST" action="requests/enviar_usuario-db.php">

                    <label>Login</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control login" placeholder="Insira o login" name="login" required>
                    </div>

                    <label>Nome</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control nome" placeholder="Insira o nome" name="nome" required>
                    </div>

                    <label>Email</label>
                    <div class="input-group mb-3">
                      <input type="email" class="form-control email" placeholder="Insira o email" name="email" required>
                    </div>

                    <label>Senha Temporaria</label>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control senha" placeholder="Insira a senha temporaria" name="senha" required>
                    </div>

                    <label>Cargo</label>
                    <div class="input-group mb-3">
                        <select name="cargo" class="form-control cargo" >
                          <option value="" selected>Selecione uma opção</option>
                          <option value="Jovem Aprendiz">Jovem Aprendiz</option>
                          <option value="Assistente de Operações">Assistente de Operações</option>
                          <option value="Líder de Operações">Líder de Operações</option>
                          <option value="Analista de Operações">Analista de Operações</option>
                          <option value="Supervisor de Operações">Supervisor de Operações</option>
                          <option value="Coordenador de Operações">Coordenador de Operações</option>
                          <option value="Gerente de Operações">Gerente de Operações</option>
                          <option value="Analista Aduaneiro">Analista Aduaneiro</option>
                          <option value="Assistente Aduaneiro">Assistente Aduaneiro</option>
                        </select>
                    </div>

                    <label>Area</label>
                    <div class="input-group mb-3">
                      <select name="area" class="form-control area" name="area" required>
                        <option value="" disabled selected>Selecione a area</option>
                        <option value="Patio">Patio</option>
                        <option value="Armazem">Armazem</option>
                        <option value="Aduaneiro">Aduaneiro</option>
                      </select>
                    </div>

                    <label>Status</label>
                    <div class="input-group mb-3">
                      <select name="status" class="form-control status" name="status" required>
                        <option value="" disabled selected>Selecione o Status</option>
                        <option value="Aprovado">Aprovado</option>
                        <option value="Pendente">Pendente</option>
                      </select>
                    </div>
                    

                    <label>Permissao</label>
                    <div class="input-group mb-3">
                      <select name="permissao" class="form-control permissao" name="permissao" required>
                        <option value="" disabled selected>Selecione a Permissao</option>
                        <option value="Padrao">Padrão</option>
                        <?php if($permissao_user == "Moderador") { echo "";}else { ?>
                        <option value="Administrador">Administrador</option>
                        <option value="Moderador">Moderador</option>
                        <?php }?>
                      </select>
                    </div>

                    <label>Armazem Destinado</label>
                    <div class="input-group mb-3">
                      <?php 
                        $sql_m_armazem = mysqli_query($conn, "SELECT id, armazem FROM armazem");

                        echo "<select class='form-control armazem' name='armazem' required>";
                        echo '<option value="" disabled selected>Selecione uma opção</option>';
                            while ($opcao = mysqli_fetch_assoc($sql_m_armazem)) {
                            echo "<option value='" . $opcao['armazem'] . "'>" . $opcao['armazem'] . "</option>";
                            }    
                        echo "</select>";

                      ?>
                    </div>

                    <input type="text" name="id-user" id="id-user" hidden>

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

  </main>

  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
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
    $('a[id^="ConfirmarServico_"]').click(function(e) {
        console.log('teste');
        e.preventDefault();
        var id = $(this).data('id');

        Swal.fire({
            title: 'Tem certeza?',
            text: 'Você deseja confirmar esse posicionamento ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, Confirmar!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'requests/confirmar_posicionamento.php?id=' + id;
            }
        }) 
    });
  </script>
    <script>
        if ("<?php echo isset($_SESSION['msg']) ? $_SESSION['msg'] : ''; ?>" != "") {

            var msg = "<?php echo $_SESSION['msg']; ?>";

            if (msg == "Posicionamento confirmado, já notificamos o armazem responsavel") {
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
    $(document).ready(function() {
      $('.dataTable').DataTable({
        // dom: 'Bfrtip',
        buttons: [
            'excel'
        ],
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

  <script type="text/javascript">
		$('#exampleModalSignUp').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) 

		  var id = button.data('id') 

		  var login = button.data('login') 
		  var nome = button.data('nome')
		  var email = button.data('email')
		  var cargo = button.data('cargo')
		  var area = button.data('area')
		  var status = button.data('status')
		  var permissao = button.data('permissao')
      var armazem = button.data('armazem')

		  var modal = $(this)

		  modal.find('#id-user').val(id)
		  modal.find('.login').val(login)
		  modal.find('.nome').val(nome)
		  modal.find('.email').val(email)
		  modal.find('.cargo').val(cargo)
		  modal.find('.area').val(area)
		  modal.find('.status').val(status)
		  modal.find('.permissao').val(permissao)
		  modal.find('.armazem').val(armazem)
		  
		})
	</script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>