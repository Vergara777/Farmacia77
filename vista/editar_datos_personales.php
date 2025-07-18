<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
// Verificar si hay sesión activa y si es administrador
if (isset($_SESSION['us_tipo']) && $_SESSION['us_tipo'] == 1) {
include_once 'Layouts/header.php';
?>
<body class="layout-fixed">
<title> Administrador | Editar Datos</title>
<?php
include_once 'Layouts/nav.php';
?>
<!--begin::Accessibility Meta Tags-->
<div class="app-wrapper sidebar-expand-lg">
    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">

            <!--begin::Start Navbar Links-->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                        <i class="bi bi-list"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
                <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
            </ul>
            <!--end::Start Navbar Links-->
            <!--begin::End Navbar Links-->
            <ul class="navbar-nav ms-auto">

                <!--begin::Navbar Search-->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="bi bi-search"></i>
                    </a>
                </li>

                <!--end::Notifications Dropdown Menu-->
                <!--begin::Fullscreen Toggle-->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                        <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                        <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                    </a>
                </li>
                <!--end::Fullscreen Toggle-->
                <!--begin::User Menu Dropdown-->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img
                            src="../img/avatar5.png"
                            class="user-image rounded-circle shadow"
                            alt="User Image"
                        />
                        <span class="d-none d-md-inline">
                                <?php
                                // Mostrar el nombre del usuario
                                if (isset($_SESSION['nombre_us'])) {
                                    echo htmlspecialchars($_SESSION['nombre_us']);
                                } else {
                                    echo 'Usuario';
                                }
                                ?>
                                </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <!--begin::User Image-->
                        <li class="user-header text-bg-primary">
                            <img
                                src="../img/avatar5.png"
                                class="rounded-circle shadow"
                                alt="User Image"
                            />
                            <p>
                                Luis Vergara - Web Developer
                                <small>Julio 15-2025</small>
                            </p>
                        </li>
                        <!--end::User Image-->
                        <!--begin::Menu Body-->
                        <li class="user-body">
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-4 text-center"><a href="#">Followers</a></div>
                                <div class="col-4 text-center"><a href="#">Sales</a></div>
                                <div class="col-4 text-center"><a href="#">Friends</a></div>

                            </div>
                            <!--end::Row-->
                        </li>
                        <!--end::Menu Body-->
                        <!--begin::Menu Footer-->
                        <li class="user-footer">
                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                            <a href="../contralador/logout.php" class="btn btn-default btn-flat float-end">Sign out</a>
                        </li>
                        <!--end::Menu Footer-->
                    </ul>
                </li>
                <!--end::User Menu Dropdown-->
            </ul>


            <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
    </nav>
    <!--end::Header-->
    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
            <!--begin::Brand Link-->
            <a href="../vista/adm_catalogo.php" class="brand-link">
                <!--begin::Brand Image-->
                <img
                    src="../img/doctor.png"
                    alt="AdminLTE Logo"
                    class="brand-image opacity-75 shadow"
                />
                <!--end::Brand Image-->
                <!--begin::Brand Text-->
                <span class="brand-text fw-light">Farmasys</span>
                <!--end::Brand Text-->
            </a>
            <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <!--begin::Sidebar Menu-->
                <ul
                    class="nav sidebar-menu flex-column"
                    data-lte-toggle="treeview"
                    role="navigation"
                    aria-label="Main navigation"
                    data-accordion="false"
                    id="navigation"
                >

                    <li class="nav-item">

                    </li>
                    <li class="nav-header">EXAMPLES</li>
                    <li class="nav-item">
                        <a href="../gallery.html" class="nav-link" >
                            <i class="nav-icon fas fa-image"></i>
                            <p>
                                Gallery
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Usuarios</li>
                    <li class="nav-item">
                        <a href="../vista/editar_datos_personales.php" class="nav-link" >
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                Datos Personales
                            </p>
                        </a>
                    </li>
                </ul>
                <!--end::Sidebar Menu-->
            </nav>
        </div>
        <!--end::Sidebar Wrapper-->
    </aside>
    <!--end::Sidebar-->
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">Datos Personales</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Datos Personales</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>

            <section>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Panel izquierdo: Sobre mí -->
                            <div class="col-md-4">
                                <div class="card card-success card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img src="../img/avatar5.png" class="profile-user-img img-fluid rounded-circle" alt="User Image">
                                        </div>
                                        <ul class="list-group list-group-flush mt-3 mb-3">
                                            <li class="list-group-item"><b>Nombre:</b> Nombre</li>
                                            <li class="list-group-item"><b>Apellidos:</b> Apellidos</li>
                                            <li class="list-group-item"><b>Edad:</b> 12</li>
                                            <li class="list-group-item"><b>DNI:</b> 777</li>
                                            <li class="list-group-item"><b>Tipo de Usuario:</b> Administrador</li>
                                        </ul>
                                    </div>
                                    <div class="card bg-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Sobre mi</h3>
                                        </div>
                                        <div class="card-body" style="color:black;">
                                            <strong><i class="fas fa-phone mr-1" style="color:rgb(11, 11, 11);"></i> Teléfono</strong>
                                            <p class="text-muted">+56 987654321</p>
                                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Residencia</strong>
                                            <p class="text-muted">Calle 123, 123456 Ciudad, Estado</p>
                                            <strong><i class="fas fa-venus-mars mr-1"></i> Sexo</strong>
                                            <p class="text-muted">Masculino</p>
                                            <strong><i class="fas fa-envelope mr-1"></i> Correo</strong>
                                            <p class="text-muted">correo@correo.com</p>
                                            <strong><i class="fas fa-info-circle mr-1"></i> Información Adicional</strong>
                                            <p class="text-muted">Información Adicional</p>
                                            <div class="text-center">
                                                <button class="btn btn-primary">Editar</button>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <p class="text-muted">Click en el Botón si desea editar los datos personales.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel derecho: Datos Personales -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header bg-green">
                                        <h3 class="card-title text-success">Datos Personales</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class = "form form-horizontal">
                                            <div class="form-group row mb-3">
                                                <label for="Telefono" class="col-sm-2 col-form-label">Teléfono</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="telefono" placeholder="Teléfono">
                                                </div>
                                            </div>   
                                            <div class="form-group row mb-3">
                                                <label for="Residencia" class="col-sm-2 col-form-label">Residencia</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="residencia" placeholder="Residencia">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label for="Sexo" class="col-sm-2 col-form-label">Sexo</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" id="sexo">
                                                        <option value="Masculino">Masculino</option>
                                                        <option value="Femenino">Femenino</option>
                                                        <option value="Otro">Otro</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label for="Correo" class="col-sm-2 col-form-label">Correo</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="correo" placeholder="Correo">
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label for="adicional" class="col-sm-2 col-form-label">Información Adicional</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" id="adicional" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class= "form-group row mb-3">
                                                <div class="offset-sm-2 col-sm-10 float-right">
                                                    <button class="btn btn-block btn-outline-success">Guardar</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class = "card-footer">
                                            <p class="text-muted">Cuidado con ingresar datos incorrectos..</p>
                                        </div>
                                        </form>
                                       
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                
            </section>
        </div>
        <?php
        include_once 'Layouts/footer.php';
} else {
    header('Location: ../index.php');
    exit();
                            }
                            ?>

