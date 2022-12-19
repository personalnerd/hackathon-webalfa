<?php
  if ( !isset($page) ) exit;
  include 'config.php';
  protectPage();

  $result = addImc($_REQUEST['userId'], $_REQUEST['imc'], $_REQUEST['weight'], $_REQUEST['height']);

  $userData = getUserData($_REQUEST['userId']);
  $user = mysqli_fetch_assoc($userData);
?>

  <header class="container-fluid px-0 pb-5">
    <?php include 'components/topHeader.php'; ?>
    <div class="container my-4 d-flex flex-column align-items-center align-items-sm-start justify-content-center justify-content-sm-start">
      <h1 class="display-6">Registro individual</h1>
      <p class="text-center text-sm-start">Adicione registros e consulte o histórico do aluno.</p>
    </div>
  </header>
  <main class="container mt-n5">
    <div class="card p-5">
      <?php
        if ($result == true){
      ?>
        <h2 class="display-6 mb-4">Tudo certo!</h2>
        <?php if (!$isClient) { ?>
        <p class="lh-lg">
            Confira agora a página do aluno e o seu histórico de IMC ou volte para a lista de alunos.
        </p>

        <div class="row mt-1 mt-sm-2 gy-3">
          <div class="col-12 col-sm-6 d-flex align-items-end justify-content-center justify-content-sm-start">
            <a type="button" class="btn btn-secondary px-5 w-100" href="dashboard">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Voltar para a lista</a>
          </div>
          <div class="col-12 col-sm-6 d-flex align-items-end justify-content-center justify-content-sm-end">
            <a type="button" class="btn btn-primary px-5 w-100" href="client?id=<?= $user['id'] ?>">
            <i class="fa-solid fa-user me-2"></i>
            Ver cadastro do aluno</a>
          </div>
        </div>
        <?php } else { ?>
          <p class="lh-lg">
            Confira agora o seu histórico de IMC.
        </p>
          <button type="button" class="btn btn-primary px-5 mt-3" onclick="history.back()">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Voltar
          </button>

        <?php } ?>
      <?php
        } else { ?>
        <h2 class="display-6">Ai não...</h2>
        <p>Algo de errado não está certo por aqui... Não foi possível cadastrar. Por favor, tente novamente.</p>
        <button type="button" class="btn btn-primary px-5 mt-3" onclick="history.back()">
          <i class="fa-solid fa-arrow-left me-2"></i>
          Voltar
        </button>
      <?php } ?>
    </div>
  </main>

<?php include 'components/newUserImc.php'; ?>
