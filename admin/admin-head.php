<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - ERC Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark d-print-none">
    <!-- Navbar Brand-->
    <a href="index.php" style="margin-right: 60px; margin-left: 10px;">
        <img src="../assets/images/logo/logo_01_1x.png" srcset="../assets/images/logo/logo_01_2x.png 2x" alt="logo_not_found" >
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

    <!-- Navbar Search-->
    <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </div>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!"><?php echo $_SESSION['admin_firstname'], " ", $_SESSION['admin_lastname']; ?></a></li>
                <li><a class="dropdown-item" href="#!">Ajustes</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="logout.php">Salir</a></li>
            </ul>
        </li>
    </ul>
</nav>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
                        Panel
                    </a>
                    <a class="nav-link collapsed" href="reservas.php" data-bs-toggle="collapse" data-bs-target="#collapseReserva" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-circle-check"></i></div>
                        Reservas
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseReserva" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="reservas.php">Ver reservas</a>

                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="vehiculos.php" data-bs-toggle="collapse" data-bs-target="#collapseVehiculos" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-car"></i></div>
                        Vehículos
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseVehiculos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="vehiculos.php">Ver vehículos</a>
                            <a class="nav-link" href="agregar_vehiculo.php">Agregar vehículo</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="clientes.php" data-bs-toggle="collapse" data-bs-target="#collapseClientes" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-group"></i></div>
                        Clientes
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseClientes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="clientes.php">Ver Clientes</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="servicios.php" aria-expanded="false">
                        <div class="sb-nav-link-icon"><i class="fas fa-wifi"></i></div>
                        Servicios extras
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <a class="nav-link collapsed" href="sucursales.php" aria-expanded="false" >
                        <div class="sb-nav-link-icon"><i class="fas fa-earth-americas"></i></div>
                        Sucursales
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Sesión iniciada:</div>
                <?php echo $_SESSION['admin_firstname'], " ", $_SESSION['admin_lastname']; ?>
            </div>
        </nav>
    </div>