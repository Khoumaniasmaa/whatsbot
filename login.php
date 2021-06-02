<?php require_once 'config.php';

if(isset($_SESSION[APP_SESSION_ID])) redirect('index');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, materialpro admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, materialpro admin lite design, materialpro admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Material Pro Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title><?= APP_NAME ?> - Login</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/materialpro-lite/" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link href="assets/css/style.min.css" rel="stylesheet">
<![endif]-->
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="navbar-brand ms-4" href="login.php">
                        <span class="logo-text">
                            <span class="text-light" style="font-size: 24px;"><?= APP_NAME ?></span>
                        </span>
                    </a>
                    <a class="nav-toggler waves-effect waves-light text-white d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-lg-none d-md-block ">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white "
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>

                </div>
            </nav>
        </header>

<div class="container-fluid mt-5">
    <div class="row mt-5">
        <div class="col-md-6 m-auto">
            <div class="card">
                <div class="card-body p-5">
                    <h2 class="text-center"><?= APP_NAME ?></h2>
                    <h6 class="text-center mb-5">Connectez-vous à l'espace admin</h6>  

                    <?php if(isset($_GET['logged'])): ?>
                        <div class="alert alert-danger">Email ou mot de passe incorrect!</div>
                    <?php endif ?>

                    <form action="<?= route('login') ?>" method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="Adresse email">
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Mot de passe">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="dologin" class="btn btn-primary" style="float: right;">Connexion</button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <a href="register.php">Vous n'avez pas un compte ?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
            
<?php require_once 'footer.php' ?>