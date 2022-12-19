<div class="modal fade" id="newUserImc" tabindex="-1" aria-labelledby="newUserImcLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="newUserImcLabel">Cálculo de IMC</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="addImc" class="form-floating">
        <div class="modal-body">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="inputUser" name="name" placeholder="Nome do aluno" disabled readonly value="<?=$user['name'];?>">
            <label for="inputUser">Aluno</label>
          </div>
          <div class="form-floating mb-3">
            <input type="number" step="any" min="0" class="form-control" id="inputWeight" name="weight" placeholder="Peso" required>
            <label for="inputWeight">Peso (kg)</label>
          </div>
          <div class="form-floating mb-3">
            <input type="number" step="any" min="0" class="form-control" id="inputHeight" name="height" placeholder="Altura" required>
            <label for="inputHeight">Altura (m)</label>
          </div>
          <div id="calcAlert" class="alert alert-warning alert-dismissible" role="alert" style="display: none;">
            Por favor, preencha os campos de peso e altura corretamente.
            <button type="button" class="btn-close" aria-label="Close"></button>
          </div>
          <div class="form-floating mb-3">
            <button id="buttonCalc" type="button" class="btn btn-success px-5 w-100">
              <i class="fa-solid fa-calculator me-2"></i>
              Calcular
            </button>
          </div>
          <div id="calcResult" class="alert text-center" role="alert" style="display: none;">
            <h4 class="mb-0"><strong>IMC <span id="calcImc"></span></strong>: <span id="calcDesc"></span></h4>
          </div>

          <input hidden type="number" step="any" id="inputImc" name="imc" required>
          <input hidden type="number" id="userId" name="userId" required value="<?=$user['id'];?>">

        </div>
        <div class="modal-footer">
          <button id="submitImc" type="submit" class="btn btn-primary px-5" disabled>
            <i class="fa-solid fa-plus me-2"></i>
            Gravar</button>
        </div>
      </form>
    </div>
  </div>
</div>
