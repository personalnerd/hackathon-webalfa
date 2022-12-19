<?php
if ( !isset($page) ) exit;
include 'config.php';
protectPage();

$params = explode('=', parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY));
if ($params[0] !== 'id') oops();
$clientId = $params[1];

$userData = getUserData($clientId);
if($userData) $user = mysqli_fetch_assoc($userData);

$lastImc = getLastImc($clientId);

?>

  <header class="container-fluid px-0 pb-5">
    <?php include 'components/topHeader.php'; ?>
    <div class="container my-4">
      <div class="row">
        <div class="col-12 col-sm-7 d-flex flex-column align-items-center align-items-sm-start justify-content-center justify-content-sm-start">
          <h1 class="display-6">Registro individual</h1>
          <p class="text-center text-sm-start">Adicione registros e consulte o histórico do usuário.</p>
        </div>
        <div class="col-12 col-sm-5 d-flex flex-column align-items-center align-items-sm-end justify-content-center justify-content-sm-end">
          <?php if ($userData) {
            if ($user['id'] != 1) { ?>
            <div class="mb-3">
              <a type="button" href="javascript:deleteUser(<?= $user['id'] ?>)" class="btn btn-link text-light" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Excluir Cadastro">
                <i class="fa-solid fa-trash-can"></i>
              </a>
            </div>
            <?php } ?>
            <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#newUserImc">
            <i class="fa-solid fa-check me-2"></i>
            Novo registro</button>
            <?php } ?>
        </div>
      </div>
    </div>
  </header>
  <main class="container mt-n5">
    <div class="card p-3">

    <?php if (!$userData) { ?>
        <div class="m-5">
          <h2 class="display-6 mb-3">Eita...</h2>
          <p>Parece que você tentou abrir um usuário que não está cadastrado no Meu IMC. Volte para o dashboard e tente novamente.</p>

          <div class="row mt-1 mt-sm-2 gy-3">
          <div class="col-12 col-sm-6 d-flex align-items-end justify-content-center justify-content-sm-start">
            <a type="button" class="btn btn-secondary px-5 w-100" href="dashboard">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Voltar para a lista</a>
          </div>
          <div class="col-12 col-sm-6 d-flex align-items-end justify-content-center justify-content-sm-end">
            <button type="button" class="btn btn-primary px-5 w-100" data-bs-toggle="modal" data-bs-target="#newUserModal">
            <i class="fa-solid fa-user-plus me-2"></i>
            Novo cadastro</button>
          </div>
        </div>
        </div>
      <?php } else {

      $query = listUserImc($clientId);
      $line = mysqli_fetch_assoc($query);
      $total = mysqli_num_rows($query);

      if ($total == 0) {
      ?>
        <div class="mx-5 my-3">
          <p class="display-6 text-center mt-1 mb-0"><?=$user['name'];?></p>
          <hr class="mt-4 mb-3">
          <h2 class="display-6 mb-3">Ué... Nada por aqui?</h2>
          <p>Parece que o aluno é novo por aqui. Que tal cadastrar sua primeira medição?</p>
        </div>
      <?php
      } else {
      ?>
        <p class="display-6 text-center mt-1 mb-0"><?=$user['name'];?></p>
        <small class="text-center text-secondary opacity-50">Usuário: <?= $user['user_name'];?></small>
        <hr class="mt-4 mb-3">
        <div class="row mt-3">
          <div class="col-12 col-sm-6 d-flex align-items-center justify-content-center">
            <p class="display-6 text-center mb-sm-0">Seu IMC é <strong id="userImc"><?=$lastImc[0];?></strong></p>
          </div>
          <div class="col-12 col-sm-6">
            <p id="userImcDesc" class="display-5 alert text-center mb-0"></p>
          </div>
        </div>
        <small class="text-center text-sm-end text-secondary opacity-50 mt-2">Registrado em <?php
          $date = date_create($lastImc[1]);
          echo date_format($date, 'd/m/Y H:m:s');
        ?></small>
        <hr class="my-4">

        <table id="tabela-imc" class="display" style="width: 100%">
          <thead>
            <tr>
              <th>Data</th>
              <th>Peso</th>
              <th>Altura</th>
              <th>IMC</th>
              <th class="text-center"></th>
            </tr>
          </thead>
          <tbody>

          <?php
          do {
            ?>
            <tr id="id_<?php echo $line['id'] ?>">
              <td><?php
              $created = date_create($line['created']);
              echo date_format($created, 'd/m/Y');
              ?></td>
              <td><?php echo str_replace('.', ',', $line['weight']);  ?></td>
              <td><?php echo str_replace('.', ',', $line['height']); ?></td>
              <td><?php echo str_replace('.', ',', $line['imc']); ?></td>
              <td class="text-center">
                <a href="javascript:deleteImc(<?= $line['id'] ?>)" class="me-3" data-bs-offset="[10,0]"
                data-bs-placement="top" data-bs-toggle="tooltip" data-bs-title="Excluir registro">
                  <i class="fa-solid fa-trash-can"></i>
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
    }
      ?>

    </div>
  </main>

<?php
include 'components/newUserModal.php';
include 'components/newUserImc.php';
if (!$isClient) {
  include 'components/adminButton.php';
}
?>
