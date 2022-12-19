$(document).ready(function () {
  let userLastImc = $('#userImc').html();
  let imcDesc = getImcDesc(userLastImc);
  $('#userImcDesc').addClass(imcDesc[1]);
  $('#userImcDesc').html(imcDesc[0]);

  $('#tabela-imc').DataTable({
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json',
    },
    columns: [
      null,
      null,
      null,
      null,
      {
        orderable: false,
        className: 'dt-center',
      },
    ],
  });

  $('#buttonCalc').on('click', () => {
    let weight = $('#inputWeight').val();
    let height = $('#inputHeight').val();

    if (!weight || !height) {
      $('#calcAlert').show('fade');
      setTimeout(() => {
        $('#calcAlert').hide('fade');
      }, 5000);
    } else {
      let result = calcImc(weight, height);

      $('#calcImc').html(result[0].replace('.', ','));
      $('#calcDesc').html(result[1]);
      $('#calcResult').removeClass();
      $('#calcResult').addClass('alert text-center ' + result[2]);
      $('#calcResult').show('fade');
      $('#inputImc').val(result[0]);
      $('#submitImc').prop('disabled', false);
    }

    $('#calcAlert button.btn-close').on('click', () => {
      $('#calcAlert').hide('fade');
    });
  });
});

function calcImc(weight, height) {
  let imc = (weight / (height * height)).toFixed(2);
  let imcDesc = getImcDesc(imc);
  return [imc, ...imcDesc];
}

function getImcDesc(imc) {
  let imcDesc;
  let imcColor;

  if (imc < 18.5) {
    imcDesc = 'ABAIXO DO PESO';
    imcColor = 'alert-primary';
  } else if (imc < 25) {
    imcDesc = 'NORMAL';
    imcColor = 'alert-success';
  } else if (imc < 30) {
    imcDesc = 'SOBREPESO';
    imcColor = 'alert-warning';
  } else if (imc < 40) {
    imcDesc = 'OBESIDADE';
    imcColor = 'alert-danger';
  } else {
    imcDesc = 'OBESIDADE GRAVE';
    imcColor = 'alert-danger';
  }
  return [imcDesc, imcColor];
}

function deleteImc(imcId) {
  var r = confirm(
    'Tem certeza que deseja excluir o registro? Os dados serão perdidos e não será possível restaurar depois.',
  );
  if (r == true) {
    window.location.href = './delete?imcId=' + imcId;
  }
}

function deleteUser(userId) {
  var r = confirm(
    'Tem certeza que deseja excluir o cadastro de usuário? Os dados serão perdidos e não será possível restaurar depois.',
  );
  if (r == true) {
    window.location.href = './delete?userId=' + userId;
  }
}
