<?php
session_start();

include "./php/config.php";
// check if the session name and the cookie name are set. if true then keep redirecting me on my home page
if (!isset($_SESSION['unique_id']) || !isset($_COOKIE['unique_id'])) {
  header('Location: index');
}
$_SESSION['unique_id'] = $_COOKIE['unique_id'];
$unique_id = $_SESSION['unique_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->
  <link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
   <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo me-5" href="index-2"><img src="assets/images/logo.svg" class="me-2"
            alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index-2"><img src="assets/images/logo-mini.svg"
            alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Rechercher"
                aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
              data-bs-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
              aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Erreur d'Application</h6>
                  <p class="font-weight-light small-text mb-0 text-muted"> Maintenant </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Paramètre</h6>
                  <p class="font-weight-light small-text mb-0 text-muted"> Message privé</p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Nouveau utilisateur</h6>
                  <p class="font-weight-light small-text mb-0 text-muted"> il ya 2 jours </p>
                </div>
              </a>
            </div>
          </li>
          <?php
          $query = $conn->prepare("SELECT * FROM profile_admin WHERE unique_id = '{$unique_id}'");
          $query->execute();
          $res = $query->fetchAll(PDO::FETCH_ASSOC);
          if (count($res) > 0) {
            foreach ($res as $row) {
          ?>
              <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                  <img src="<?php echo $row['profile_photo']; ?>" alt="profile" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                  <a class="dropdown-item">
                    <i class="ti-settings text-primary"></i> Paramètres </a>
                  <a href="php/logout.php" class="dropdown-item">
                    <i class="ti-power-off text-primary"></i> Se déconnecter </a>
                </div>
              </li>
              <li class="nav-item nav-settings d-none d-lg-flex">
                <a class="nav-link" href="#">
                  <i class="icon-ellipsis"></i>
                </a>
              </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index-2">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Gestions</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
              aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Ajouter</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="pages/forms/add-engine">L'engin</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Statistique</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs">ChartJs</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Tableaux</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table">Engins</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/tables/prop">Proprietaires</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/tables/driver">Chauffeurs</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Icônes</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi">Mdi icons</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Utilisateur</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login"> Connection </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/register"> Création </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
              <i class="icon-ban menu-icon"></i>
              <span class="menu-title">Pages d'erreur</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404"> 404 </a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500"> 500 </a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../../docs/documentation">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Bienvenu <?php echo $row['nom']; ?></h3>
                  <h6 class="font-weight-normal mb-0">Tout le système fonctionne parfaitement! Vous avez <span
                      class="text-primary">3 alertes non lus!</span></h6>
                </div>
            <?php
            }
          }
            ?>
            <div class="col-12 col-xl-4">
              <div class="justify-content-end d-flex">
                <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                  <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="mdi mdi-calendar"></i> Aujourd'hui (1 Jan 2000) </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                    <p class="dropdown-item" id="h"></p>
                  </div>
                </div>
              </div>
            </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="assets/images/dashboard/people.svg" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun me-2"></i>27°C<sup></sup></h2>
                      </div>
                      <div class="ms-2">
                        <h4 class="location font-weight-normal" id="loc">Goma</h4>
                        <h6 class="font-weight-normal">Nord-kivu</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <?php
                $query = $conn->prepare("SELECT * FROM engine_identity");
                $query->execute();
                $res = $query->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                ?>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                      <div class="card-body">
                        <p class="mb-4">Nombre des engins enregistrés</p>
                        <p class="fs-30 mb-2"><?php echo count($res); ?></p>
                        <p>Vraie nombre: <?php echo count($res); ?></p>
                      </div>
                    </div>
                  </div>
                <?php
                }
                ?>
                <?php
                $query1 = $conn->prepare("SELECT * FROM engine_identity");
                $query1->execute();
                $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Engins sans documents</p>
                      <p class="fs-30 mb-2">0</p>
                      <p>Vraie nombre: 0</p>
                    </div>
                  </div>
                </div>
                <?php

                ?>
              </div>
              <div class="row">
                <?php
                $query2 = $conn->prepare("SELECT * FROM proprietaire");
                $query2->execute();
                $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                ?>
                  <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                      <div class="card-body">
                        <p class="mb-4">Nombre des proprietaires</p>
                        <p class="fs-30 mb-2"><?php echo count($res2); ?></p>
                        <p>Vraie nombre: <?php echo count($res2); ?></p>
                      </div>
                    </div>
                  </div>
                <?php
                }
                ?>
                <?php
                $query3 = $conn->prepare("SELECT * FROM infraction");
                $query3->execute();
                $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                if (count($res) > 0) {
                ?>
                  <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                        <p class="mb-4">Nombre d'infractions</p>
                        <p class="fs-30 mb-2"><?php echo count($res3); ?></p>
                        <p>Vraie nombre: <?php echo count($res3); ?></p>
                      </div>
                    </div>
                  </div>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Statistique</p>
                  <p class="font-weight-500">La Statistique de tous les données disponible dans la base de données</p>
                  <div class="d-flex flex-wrap mb-5">
                    <?php
                    $query = $conn->prepare("SELECT * FROM engine_identity");
                    $query->execute();
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                    if (count($res) > 0) {
                    ?>
                      <div class="me-5 mt-3">
                        <p class="text-muted">Nombre d'engins</p>
                        <h3 class="text-primary fs-30 font-weight-medium"><?php echo count($res); ?></h3>
                      </div>
                    <?php
                    }
                    ?>
                    <?php
                    $query2 = $conn->prepare("SELECT * FROM proprietaire");
                    $query2->execute();
                    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                    if (count($res) > 0) {
                    ?>
                      <div class="me-5 mt-3">
                        <p class="text-muted">proprietaires</p>
                        <h3 class="text-primary fs-30 font-weight-medium"><?php echo count($res2); ?></h3>
                      </div>
                    <?php
                    }
                    ?>
                    <?php
                    $query3 = $conn->prepare("SELECT * FROM chauffeur");
                    $query3->execute();
                    $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                    if (count($res3) > 0) {
                    ?>
                      <div class="me-5 mt-3">
                        <p class="text-muted">Chauffeurs</p>
                        <h3 class="text-primary fs-30 font-weight-medium"><?php echo count($res3); ?></h3>
                      </div>
                    <?php
                    }
                    ?>
                    <!-- <div class="mt-3">
                        <p class="text-muted">Downloads</p>
                        <h3 class="text-primary fs-30 font-weight-medium">34040</h3>
                      </div> -->
                  </div>
                  <canvas id="order-chart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <p class="card-title">Rapport de fonctionnement</p>
                    <a href="#" class="text-info">voir tous</a>
                  </div>
                  <p class="font-weight-500">Nombre total des engins sans et avec infractions durant les mois</p>
                  <div id="sales-chart-legend" class="chartjs-legend mt-4 mb-2"></div>
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date("Y"); ?> <a
          href="https://www.bootstrapdash.com/" target="_blank" style="text-decoration: none;">Amtech congo technology</a>. in partenership with twelve<br>
        Developed by <a href="#" style="text-decoration: none;" target="_blank">Amtech-co | software</a>. templete from BootstrapDash</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
          class="ti-heart text-danger ms-1"></i></span>
    </div>
  </footer>
  <!-- partial -->
  </div>
  <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/chart.umd.js"></script>
  <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <!-- <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script> -->
  <script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
  <script src="assets/js/dataTables.select.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="assets/js/dashboard.js"></script>
  <script src="./js/date.js"></script>
  <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
  <!-- End custom js for this page-->

</body>

</html>