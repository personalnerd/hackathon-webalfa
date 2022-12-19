$(document).ready(function () {
  $('#tabela-alunos').DataTable({
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json',
    },
    columns: [
      null,
      {
        orderable: false,
        className: 'dt-center',
      },
    ],
  });
});
