<?php
session_start();

include "../../php/config.php";
// check if the session name and the cookie name are set. if true then keep redirecting me on my home page
if (!isset($_SESSION['unique_id']) || !isset($_COOKIE['unique_id'])) {
    header('Location: ../../index');
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
                                    <img src="<?php echo "../../" . $row['profile_photo']; ?>" alt="profile" />
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
                                <li class="nav-item"> <a class="nav-link" href="../../pages/tables/basic-table">Engins</a></li>
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../../pages/tables/prop">Proprietaires</a></li>
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="../../pages/tables/driver">Chauffeurs</a></li>
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
                        <center>
                            <div class="col-md-8 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Ajouter un engin</h4>
                                        <!-- <p class="card-description"> Basic form layout </p> -->
                                        <center>
                                            <p id="serial" style="color:red;"></p>
                                        </center>
                                        <form class="forms-sample" action="../../php/add-engine.php" method="POST" enctype="multipart/form-data"
                                            style="display: flex; flex-wrap:wrap; gap:0px; justify-content:space-between;" id="form">
                                            <div class="form1">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Numéro de chassie</label>
                                                    <input type="text" name="num_ch" class="form-control" id="exampleInputUsername1" placeholder="34534534" style="width:300px;">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Anné de fabrication</label>
                                                    <input type="text" name="annee_fab" class="form-control" id="exampleInputEmail1" placeholder="Ex: 2050">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Marque</label>
                                                    <input type="text" name="marque" class="form-control" id="exampleInputPassword1" placeholder="Ex: Tesla">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputConfirmPassword1">Nombre de roues</label>
                                                    <input type="text" name="nombre_roue" class="form-control" id="exampleInputConfirmPassword1"
                                                        placeholder="4">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputConfirmPassword1">Pays d'origine</label>
                                                    <input type="text" name="pays_orig" class="form-control" id="exampleInputConfirmPassword1"
                                                        placeholder="Ex: Rép. Dem. Du Congo">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputConfirmPassword1">Nombre de portes</label>
                                                    <input type="text" name="nombre_de_porte" class="form-control" id="exampleInputConfirmPassword1"
                                                        placeholder="Ex: 4">
                                                </div>
                                                <!-- <button class="btn btn-light" id="cancel">Annuler</button> -->
                                            </div>
                                            <!--  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
                                            <div class="form2">
                                                <div class="form-group">
                                                    <label for="exampleInputConfirmPassword1">Plaque d'imatriculation</label>
                                                    <input type="mail" name="plaque" class="form-control" id="exampleInputConfirmPassword1"
                                                        placeholder="235684AA">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputConfirmPassword1">Modèle</label>
                                                    <input type="mail" name="modele" class="form-control" id="exampleInputConfirmPassword1"
                                                        placeholder="Ex: Jeep">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputConfirmPassword1">Couleur</label>
                                                    <input type="mail" name="couleur" class="form-control" id="exampleInputConfirmPassword1"
                                                        placeholder="Ex: Blanche">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputConfirmPassword1">Catégorie</label>
                                                    <input type="mail" name="categorie" class="form-control" id="exampleInputConfirmPassword1"
                                                        placeholder="Ex: ">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputConfirmPassword1">Déclaration</label>
                                                    <input type="mail" name="declaration" class="form-control" id="exampleInputConfirmPassword1"
                                                        placeholder="Ex: ">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputConfirmPassword1">Photo</label>
                                                    <input type="file" name="photo" class="form-control" id="exampleInputConfirmPassword1"
                                                        placeholder="Password">
                                                </div>
                                                <button type="submit" class="btn btn-primary me-2" id="btn2">Valider</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </center>
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
    <!--  <script>
        const form = document.getElementById("form");
        const valider = document.getElementById("btn2");
        const serial = document.getElementById("serial");

        form.onsubmit = (event) => {
            event.preventDefault();
        }

        valider.addEventListener('click', () => {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../../php/add-engine.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        if (data === "") {
                           
                        } else {
                            serial.textContent = data;
                        }
                    }
                }
            }
            // we have to send form data through ajax to php
            let formData = new FormData(form); // creating new formData
            xhr.send(formData); //send form data to php
        });
    </script> -->
</body>

</html>