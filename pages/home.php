<?php if ( !isset($page) ) exit; ?>

  <header class="container-fluid d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-5 col-lg-4 d-flex justify-content-center justify-content-sm-start">
          <img id="primary-logo" src="assets/img/logo_meuimc.svg" alt="Logotipo Meu IMC" />
        </div>
        <div class="col d-flex align-items-center mt-5 mt-sm-0">
          <h1 class="mb-0 text-center text-sm-start display-5">Calcule e acompanhe o IMC de seus
            clientes de forma fácil e segura.</h1>
        </div>
      </div>
    </div>
  </header>
  <main class="container mt-5 text-center">
    <button type="button" class="btn btn-primary btn-lg px-5" data-bs-toggle="modal" data-bs-target="#loginModal">
      <i class="fa-solid fa-person-walking-arrow-right me-2"></i>
      Acessar</button>
  </main>

 <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="loginModalLabel">Acesse o sistema</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action="./validate.php" class="form-floating">
          <div class="modal-body">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="inputUserName" name="userName" placeholder="Nome de usuário" required>
              <label for="inputUserName">Usuário</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control" id="inputPassword" name="pwd" placeholder="Senha" required>
              <label for="inputPassword">Senha</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary px-5" href="dashboard"><i class="fa-solid fa-arrow-right-to-bracket me-2"></i>
              Entrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
