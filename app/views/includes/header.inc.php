<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Alsuper</title>
    <link href="<?= URLROOT ?>/css/bs/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= URLROOT ?>/css/fa/css/all.min.css">
    <link rel="stylesheet" href="<?= URLROOT ?>/css/fa/css/fontawesome.min.css">
    <!-- Favicons -->
    <!-- Custom styles for this template -->
    <script src='<?= URLROOT ?>/js/jquery/jquery-3.6.1.min.js'></script>
    <script src='<?= URLROOT ?>/js/jquery-validation/jquery.validate.min.js'></script>
    <script src='<?= URLROOT ?>/js/jquery-validation/additional-methods.min.js'></script>
    <script src="../js/bs/js/bootstrap.bundle.min.js"></script>
   
</head>

<body class="d-flex flex-column h-100">

    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark bg-danger">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= URLROOT ?>"><img src="<?= URLROOT ?>/images/alsuper-logo.png" height="60"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">

                        <li class=" nav-item">
                            <a class="nav-link" href="<?= URLROOT ?>/usuarios/">Usuarios</a>
                        </li>
                        <li class=" nav-item">
                            <a class="nav-link" href="<?= URLROOT ?>/proveedores/">Proveedores</a>
                        </li>
                        <li class=" nav-item">
                            <a class="nav-link" href="<?= URLROOT ?>/productos/">Productos</a>
                        </li>
                        <li class=" nav-item">
                            <a class="nav-link" href="<?= URLROOT ?>/movimientos/">Movimientos</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link disabled">Disabled</a>
                        </li> -->
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                productos1
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li> -->
                    </ul>

                    <!-- <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> -->
                    <ul class="navbar-nav my-2 d-flex">
                        <?php
                        if (estaLogueado()) {
                        ?>

                            <li class="nav-item">
                                <span class="nav-link"> <?= $_SESSION['usuario_nombreCompleto'] ?></span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= URLROOT; ?>/usuarios/logout">Logout</a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= URLROOT; ?>/usuarios/login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= URLROOT; ?>/usuarios/registro">Registro</a>
                            </li>
                    </ul>
                <?php } ?>

                </div>
            </div>
        </nav>
    </header>

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">