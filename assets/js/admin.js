$(document).ready(function () {
  $('#tabela-admin').DataTable({
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json',
    },
    columns: [
      null,
      null,
      {
        orderable: false,
        className: 'dt-center',
      },
    ],
  });
});
