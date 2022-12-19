<?php
  if ( !isset($page) ) exit;
  include 'config.php';
  protectPage();

  $result = addUser($_REQUEST['name'], $_REQUEST['userName'], $_REQUEST['pwd'], $_REQUEST['userTypeId']);
?>

  <header class="container-fluid px-0 pb-5">
    <?php include 'components/topHeader.php'; ?>
    <div class="container my-4 d-flex flex-column align-items-center align-items-sm-start justify-content-center justify-content-sm-start">
      <h1 class="display-6">Bem vindo ao <strong>meuIMC</strong></h1>
      <p class="text-center text-sm-start">Consulte o histórico de IMC de seus alunos e adicione novos registros.</p>
    </div>
  </header>
  <main class="container mt-n5">
    <div class="card p-5">
      <?php
        if ($result === 'duplicated') {
      ?>

        <h2 class="display-6">Oops.</h2>
        <p>Parece que o nome de usuário que você digitou já existe. Por favor, tente novamente.</p>
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

      <?php
        } else if ($result == true){
      ?>
        <h2 class="display-6 mb-4">Novo <?php echo $result ?> cadastrado com sucesso</h2>

        <p class="lh-lg">
          <strong class="bg-success py-1 px-2 bg-opacity-25"><?php echo $_REQUEST['name'] ?></strong>
          já pode acessar o sistema com o nome de usuário
          <strong class="bg-danger py-1 px-2 bg-opacity-25"><?php echo $_REQUEST['userName'] ?></strong>
        </p>

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
      <?php
        } else {
          ?>
        <h2 class="display-6">Ai não...</h2>
        <p>Algo de errado não está certo por aqui... Não foi possível cadastrar. Por favor, tente novamente.</p>
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
      <?php
        }
      ?>
    </div>
  </main>

<?php include 'components/newUserModal.php'; ?>
