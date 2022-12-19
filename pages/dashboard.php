<?php
if ( !isset($page) ) exit;
include 'config.php';
protectPage();

if ($isClient) {
  header('Location: client?id='.$_SESSION['userId']);
}
?>

  <header class="container-fluid px-0 pb-5">
    <?php include 'components/topHeader.php'; ?>
    <div class="container my-4">
      <div class="row">
        <div class="col-12 col-sm-7 d-flex flex-column align-items-center align-items-sm-start justify-content-center justify-content-sm-start">
          <h1 class="display-6">Bem vindo ao <strong>meuIMC</strong></h1>
          <p class="text-center text-sm-start">Consulte o histórico de IMC de seus alunos e adicione novos registros.</p>
        </div>
        <div class="col-12 col-sm-5 d-flex align-items-end justify-content-center justify-content-sm-end">
          <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#newUserModal">
            <i class="fa-solid fa-user-plus me-2"></i>
            Novo cadastro</button>
        </div>
      </div>
    </div>
  </header>
  <main class="container mt-n5">
    <div class="card p-3">

      <?php
      $query = listUsersByTypeId(3);
      $line = mysqli_fetch_assoc($query);
      $total = mysqli_num_rows($query);

      if ($total == 0) {
      ?>
        <div class="m-5">
          <h2 class="display-6 mb-3">Ainda não há alunos cadastrados</h2>
          <p>Adicione um novo aluno para registrar e acompanhar as medições de IMC.</p>
        </div>
      <?php
      } else {
      ?>
        <table id="tabela-alunos" class="display" style="width: 100%">
          <thead>
            <tr>
              <th>Nome</th>
              <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>

          <?php
          do {
            ?>
            <tr id="id_<?php echo $line['id'] ?>">
              <td><?php echo $line['name'] ?></td>
              <td class="text-center">
                <a href="client?id=<?= $line['id'] ?>" data-bs-offset="[10,0]" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Histórico do aluno">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </a>
              </td>
            </tr>

          <?php
          } while ($line = mysqli_fetch_assoc($query));
          ?>
          </tbody>
        </table>
      <?php
      }
      ?>

    </div>
  </main>

  <?php include 'components/newUserModal.php'; ?>
  <?php include 'components/adminButton.php'; ?>
