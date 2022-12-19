<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newUserModalLabel">Cadastre um novo usuário</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="addUser" class="form-floating">
        <div class="modal-body">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputName" name="name" placeholder="Nome completo" required>
            <label for="inputName">Nome completo</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputUserName" name="userName" placeholder="Nome de usuário" required>
            <label for="inputUserName">Nome de usuário</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="inputPassword" name="pwd" placeholder="Senha" required>
            <label for="inputPassword">Senha</label>
          </div>
          <div class="form-floating">
            <select class="form-select" id="selectUserType" name="userTypeId">
              <?php if ($isAdmin) {?>
              <option value="1">Administrador</option>
              <option value="2">Professor</option>
              <?php } ?>
              <option value="3" selected>Aluno</option>
            </select>
            <label for="selectUserType">Tipo de cadastro</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary px-5">
            <i class="fa-solid fa-user-plus me-2"></i>
            Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
