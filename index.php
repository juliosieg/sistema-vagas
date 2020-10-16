<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Link - Pessoas & Negócios</title>

  
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/custom.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="plugins/datatables/datatables.min.css">
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/waitme/waitMe.min.css">
  <link rel="stylesheet" href="plugins/icheck/skins/all.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="node_modules/@fortawesome/fontawesome-free/css/all.css"> 

  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/icheck/icheck.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/jquery-mask/dist/jquery.mask.min.js"></script>
  <script src="plugins/toastr/toastr.min.js"></script>
  <script src="plugins/datatables/datatables.js"></script>
  <script src="dist/js/adminlte.js"></script>
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="plugins/select2/js/select2.min.js"></script>
  <script src="plugins/waitme/waitMe.min.js"></script>
  <script src="pages/functions/js/funcoesGerais.js"></script>
  <script src="node_modules/moment/moment.js"></script>
  <script src="node_modules/@fortawesome/fontawesome-free/js/all.js"></script>
  

</head>

<body class="hold-transition sidebar-mini">

  <? session_start(); ?>

  <? if(isset($_GET['registrar']) && $_GET['registrar'] == 1) {

    require_once('registrar.php');

  } elseif(isset($_GET['esqueciSenha']) && $_GET['esqueciSenha'] == 1) {

    require_once('esqueciSenha.php');

  } elseif(isset($_SESSION['senhaAlterada']) && $_SESSION['senhaAlterada'] == 1) {

    require_once('senhaAlterada.php');

  } elseif(isset($_SESSION['logged']) && $_SESSION['logged'] == true) {

    $now = time(); // Checking the time now when home page starts.

    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo"<script language='javascript' type='text/javascript'>alert('Sua sessão expirou! É necessário entrar novamente.');window.location.href='index.php';</script>";
    }?>

    <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-orange navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
      </nav>

      <aside class="main-sidebar sidebar-light-orange elevation-4">
  
        <a href="index3.html" class="brand-link" style='text-align: center;'>
          <img src="dist/img/logo.png" alt="Link Pessoas e Negócios" class="brand-image" style="float: unset !important; margin: 0 auto !important">
        </a>
  
        <div class="sidebar">
          <nav class="mt-2">
            <?php
            require_once("menu.php");
            ?>
          </nav>
        </div>
      </aside>

      <div class="content-wrapper">

        <?php
          require_once("pages.php");
        ?>

      </div>
      <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

  <? } else { 

    require_once("login.php");  

  } ?>

</body>
</html>
