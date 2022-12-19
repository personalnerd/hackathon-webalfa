<?php
  $page = $_GET["param"] ?? "home";
  $urlPage = "pages/{$page}.php";

  if (!file_exists($urlPage)) {
    $page = "404";
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meu IMC</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  <link href="./assets/css/style.css" rel="stylesheet" />
</head>

<body class="d-flex flex-column min-vh-100" data-page="<?php echo($page)?>">
    <?php
      if (file_exists($urlPage)) {
          include $urlPage;
      } else {
          include "pages/404.php";
      }
    ?>

  <footer class="mt-auto p-3 text-center">
    <small>Desenvolvido por Tarcisio Uchoa para o Hackathon do <br class="d-none d-sm-block">
      Curso de Pós-Graduação em Desenvolvimento de Aplicações para Internet e Dispositivos Móveis - UniAlfa
      Umuarama</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.2.min.js"
    integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css"></script>

  <script src="./assets/js/scripts.js"></script>
</body>

<?php
  $script = $_GET["param"] ?? "home";
  $urlScript = "./assets/js/{$script}.js";

  if (file_exists($urlScript)) {
    echo '<script src="' . $urlScript . '"></script>';
  }

?>

</html>
