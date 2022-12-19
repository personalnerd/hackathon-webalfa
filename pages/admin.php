<?php
if ( !isset($page) ) exit;
include 'config.php';
protectPage();

?>

  <header class="container-fluid px-0 pb-5">
    <?php include 'components/topHeader.php'; ?>
    <div class="container my-4">
      <div class="row">
        <div class="col-12 col-sm-7 d-flex flex-column align-items-center align-items-sm-start justify-content-center justify-content-sm-start">
          <h1 class="display-6">Administração</h1>
          <p class="text-center text-sm-start">Consulte os cadastros dos usuários 'Professor' e 'Administrador'</p>
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
    <div class="row mb-4">
        <div class="col-6 col-sm-4">
          <div class="card shadow border-0 p-3 text-center">
            <p>Administradores:</p>
            <p class="display-5 mb-0"><?php echo getCountByType(1); ?></p>
          </div>
        </div>
        <div class="col-6 col-sm-4">
          <div class="card shadow border-0 p-3 text-center">
            <p>Professores:</p>
            <p class="display-5 mb-0"><?php echo getCountByType(2); ?></p>
          </div>
        </div>
        <div class="col-6 col-sm-4 mx-auto mt-4 mt-sm-0">
          <div class="card shadow border-0 p-3 text-center">
            <p>Alunos:</p>
            <p class="display-5 mb-0"><?php echo getCountByType(3); ?></p>
          </div>
        </div>
      </div>

    <div class="card p-3">

      <?php
      $query = listUsersByTypeId(1, 2);
      $line = mysqli_fetch_assoc($query);
      ?>
        <table id="tabela-admin" class="display" style="width: 100%">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Perfil</th>
              <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>

          <?php
          do {
            ?>
            <tr id="id_<?php echo $line['id'] ?>">
              <td><?php echo $line['name'] ?></td>
              <td><?php echo getUserType($line['user_type_id']); ?></td>
              <td class="text-center">
                <?php if ($isAdmin) {?>
                <a href="client?id=<?= $line['id'] ?>" data-bs-offset="[10,0]" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Histórico">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </a>
                <?php } ?>
              </td>
            </tr>

          <?php
          } while ($line = mysqli_fetch_assoc($query));
          ?>
          </tbody>
        </table>

    </div>
  </main>

  <?php include 'components/newUserModal.php'; ?>
