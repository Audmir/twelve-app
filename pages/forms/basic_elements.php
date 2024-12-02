<?php
session_start();

include "../../php/config.php";
// check if the session name and the cookie name are set. if true then keep redirecting me on my home page
if (!isset($_SESSION['unique_id']) || !isset($_COOKIE['unique_id'])) {
  header('Location: ../../index');
}
$_SESSION['unique_id'] = $_COOKIE['unique_id'];
$unique_id = $_SESSION['unique_id'];

$id = htmlspecialchars($_GET['id']);

try {
  $query = $conn->prepare("SELECT * FROM engine_identity WHERE id = '$id'");
  $query->execute();
  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  if (count($res) > 0) {
    foreach ($res as $row) {
?>

      <!DOCTYPE html>
      <html lang="en">

      <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Skydash Admin</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="../../assets/vendors/feather/feather.css">
        <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <link rel="stylesheet" href="../../assets/vendors/select2/select2.min.css">
        <link rel="stylesheet" href="../../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="../../assets/css/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="../../assets/images/favicon.png" />
      </head>

      <body>
        <div class="container-scroller">
          <!-- partial:../../partials/_navbar.html -->
          <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
              <a class="navbar-brand brand-logo me-5" href="../../index-2"><img src="../../assets/images/logo.svg"
                  class="me-2" alt="logo" /></a>
              <a class="navbar-brand brand-logo-mini" href="../../index-2"><img src="../../assets/images/logo-mini.svg"
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
                        <p class="font-weight-light small-text mb-0 text-muted"> Message privé </p>
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
                        <img src="<?php echo "../../".$row['profile_photo']; ?>" alt="profile" />
                      </a>
                      <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item">
                          <i class="ti-settings text-primary"></i> Paramètres </a>
                        <a href="../../php/logout.php" class="dropdown-item">
                          <i class="ti-power-off text-primary"></i> Se déconnecter </a>
                      </div>
                    </li>
                <?php
                  }
                }
                ?>
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
            <!-- partial:../../partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="../../index-2">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Gestions</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Graphique</span>
                    <i class="menu-arrow"></i>
                  </a>
                  <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                      <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/buttons">Buttons</a></li>
                      <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/dropdowns">Dropdowns</a>
                      </li>
                      <li class="nav-item"> <a class="nav-link" href="../../pages/ui-features/typography">Typography</a>
                      </li>
                    </ul>
                  </div>
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
                      <li class="nav-item"><a class="nav-link" href="../../pages/forms/add-engine">L'engin</a>
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
                      <li class="nav-item"> <a class="nav-link" href="../../pages/charts/chartjs">ChartJs</a></li>
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
                      <li class="nav-item"> <a class="nav-link" href="../../pages/tables/basic-table">Basic table</a>
                      </li>
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
                      <li class="nav-item"> <a class="nav-link" href="../../pages/icons/mdi">Mdi icons</a></li>
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
                      <li class="nav-item"> <a class="nav-link" href="../../pages/samples/login"> Login </a></li>
                      <li class="nav-item"> <a class="nav-link" href="../../pages/samples/register"> Register </a></li>
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
                      <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-404"> 404 </a></li>
                      <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-500"> 500 </a></li>
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
                  <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Ajouter un proprietaire</h4>
                        <!-- <p class="card-description"> Basic form layout </p> -->
                        <form class="forms-sample" action="../../php/add-proprietaire.php" method="POST" enctype="multipart/form-data" id="form1">
                          <center>
                            <p id="serial1" style="color:red;"></p>
                          </center>
                          <div class="form-group">
                            <label for="exampleInputUsername1">Nom complet</label>
                            <input type="text" name="nom_complet" class="form-control" id="exampleInputUsername1" placeholder="audrey mirindi">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Date de Naissance</label>
                            <input type="text" name="dateN" class="form-control" id="exampleInputEmail1" placeholder="07/07/2055">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Lieu de Naissance</label>
                            <input type="text" name="LieuN" class="form-control" id="exampleInputPassword1" placeholder="Kinshasa">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Adresse</label>
                            <input type="text" name="adress" class="form-control" id="exampleInputConfirmPassword1"
                              placeholder="Kinshasa av.Boulevard">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Etat civile</label>
                            <input type="text" name="etatC" class="form-control" id="exampleInputConfirmPassword1"
                              placeholder="exemple: célibataire">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Numéro de téléphone</label>
                            <input type="text" name="num" class="form-control" id="exampleInputConfirmPassword1"
                              placeholder="+243 XXX XXX XXX">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Adresse Mail</label>
                            <input type="mail" name="mail" class="form-control" id="exampleInputConfirmPassword1"
                              placeholder="exemple@gmail.com">
                          </div>
                          <div class="form-group" hidden>
                            <label for="exampleInputConfirmPassword1">ID du Proprietaire</label>
                            <input type="mail" name="prop_id" value="<?php echo $row['proprietaire_id']; ?>" class="form-control" id="exampleInputConfirmPassword1">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Photo</label>
                            <input type="file" name="photo" class="form-control" id="exampleInputConfirmPassword1"
                              placeholder="Password">
                          </div>
                          <button type="submit" class="btn btn-primary me-2" id="btn1">Valider</button>
                          <button class="btn btn-light">Annuler</button>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Ajouter un Chauffeurs</h4>
                        <!-- <p class="card-description"> Basic form layout </p> -->
                        <center>
                          <p id="serial2" style="color:red;"></p>
                        </center>
                        <form class="forms-sample" action="../../php/add-chaufffeur.php" method="POST" enctype="multipart/form-data" id="form2">
                          <div class="form-group">
                            <label for="exampleInputUsername1">Nom complet</label>
                            <input type="text" name="nom_complet" class="form-control" id="exampleInputUsername1" placeholder="audrey mirindi">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Date de Naissance</label>
                            <input type="text" name="dateN" class="form-control" id="exampleInputEmail1" placeholder="07/07/2055">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Lieu de Naissance</label>
                            <input type="text" name="LieuN" class="form-control" id="exampleInputPassword1" placeholder="Kinshasa">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Adresse</label>
                            <input type="text" name="adress" class="form-control" id="exampleInputConfirmPassword1"
                              placeholder="Kinshasa av.Boulevard">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Etat civile</label>
                            <input type="text" name="etatC" class="form-control" id="exampleInputConfirmPassword1"
                              placeholder="exemple: célibataire">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Numéro de téléphone</label>
                            <input type="text" name="num" class="form-control" id="exampleInputConfirmPassword1"
                              placeholder="+243 XXX XXX XXX">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Adresse Mail</label>
                            <input type="mail" name="mail" class="form-control" id="exampleInputConfirmPassword1"
                              placeholder="exemple@gmail.com">
                          </div>
                          <div class="form-group" hidden>
                            <label for="exampleInputConfirmPassword1">ID du Chauffeur</label>
                            <input type="mail" name="chauf_id" value="<?php echo $row['chauffeur_id']; ?>" class="form-control" id="exampleInputConfirmPassword1">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Photo</label>
                            <input type="file" name="photo" class="form-control" id="exampleInputConfirmPassword1"
                              placeholder="Password">
                          </div>
                          <button type="submit" class="btn btn-primary me-2" id="btn2">Valider</button>
                          <button class="btn btn-light">Annuler</button>
                        </form>
                      </div>
                    </div>
                  </div>
                  <a href="../success/success"><button class="btn btn-primary">Clique ici après l'enregistrement</button></a>
                </div>
              </div>
              <!-- content-wrapper ends -->
              <!-- partial:../../partials/_footer.html -->

              <!-- partial -->
            </div>
            <!-- main-panel ends -->
          </div>
          <!-- page-body-wrapper ends -->
        </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo date("Y"); ?> <a
                href="https://www.bootstrapdash.com/" target="_blank" style="text-decoration: none;">Amtech congo technology</a>. in partenership with twelve<br>
              Developed by <a href="#" style="text-decoration: none;" target="_blank">Amtech-co | software</a>. templete from BootstrapDash</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                class="ti-heart text-danger ms-1"></i></span>
          </div>
        </footer>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="../../assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
        <script src="../../assets/vendors/select2/select2.min.js"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="../../assets/js/off-canvas.js"></script>
        <script src="../../assets/js/template.js"></script>
        <script src="../../assets/js/settings.js"></script>
        <script src="../../assets/js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="../../assets/js/file-upload.js"></script>
        <script src="../../assets/js/typeahead.js"></script>
        <script src="../../assets/js/select2.js"></script>
        <!-- End custom js for this page-->
        <script>
          const serial1 = document.getElementById("serial1");
          const serial2 = document.getElementById("serial2");
          const form1 = document.getElementById("form1");
          const form2 = document.getElementById("form2");

          const valid2 = document.getElementById("btn2");
          const valid = document.getElementById("btn1");

          form1.onsubmit = (event) => {
            event.preventDefault();
          }
          form2.onsubmit = (event) => {
            event.preventDefault();
          }

          valid.addEventListener("click", () => {
            let xhr1 = new XMLHttpRequest();
            xhr1.open("POST", "../../php/add-proprietaire.php", true);
            xhr1.onload = () => {
              if (xhr1.readyState === XMLHttpRequest.DONE) {
                if (xhr1.status === 200) {
                  let data1 = xhr1.response;
                  if (data1 === "success") {
                    alert("L'ajout du propiretaire effectué avec succès!");
                  } else {
                    serial1.textContent = data1;
                    serial1.style.display = "block";
                  }
                }
              }
            }
            // we have to send form data through ajax to php
            let formData = new FormData(form1); // creating new formData
            xhr1.send(formData); //send form data to php
          });


          valid2.addEventListener("click", () => {
            let xhr2 = new XMLHttpRequest();
            xhr2.open("POST", "../../php/add-chaufffeur.php", true);
            xhr2.onload = () => {
              if (xhr2.readyState === XMLHttpRequest.DONE) {
                if (xhr2.status === 200) {
                  let data2 = xhr2.response;
                  if (data2 === "success") {
                    alert("L'ajout du chauffeur effectué avec succès!");
                  } else {
                    serial2.textContent = data2;
                    serial2.style.display = "block";
                  }
                }
              }
            }
            // we have to send form data through ajax to php
            let formData2 = new FormData(form2); // creating new formData
            xhr2.send(formData2); //send form data to php
          });
        </script>
      </body>

      </html>

<?php
    }
  }
} catch (PDOException $e) {
  throw ($e->getMessage());
  echo $e->getMessage();
}

?>