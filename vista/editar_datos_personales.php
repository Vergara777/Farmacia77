<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
// Verificar si hay sesión activa y si es administrador
if (isset($_SESSION['us_tipo']) && $_SESSION['us_tipo'] == 1) {

// Obtener la imagen de perfil del usuario actual
include_once '../modelo/Usuario.php';
$usuario = new Usuario();
$usuario->obtener_datos($_SESSION['usuario']);
$imagen_perfil = '../img/robert.jpg'; // Default
if (!empty($usuario->objetos) && $usuario->objetos[0]->imagen_perfil) {
    $imagen_perfil = $usuario->objetos[0]->imagen_perfil;
}

include_once 'Layouts/header.php';
?>
<head>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
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
                            src="<?php echo htmlspecialchars($imagen_perfil); ?>"
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
                                src="<?php echo htmlspecialchars($imagen_perfil); ?>"
                                class="rounded-circle shadow"
                                alt="User Image"
                            />
                            <p>
                                Luis Vergara - Estudiante del Sena
                                <small>Agosto 12-2007</small>
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
                            <a href="../contralador/logout.php" class="btn btn-default btn-flat float-end">Cerrar Sesión</a>
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
                <span class="brand-text fw-light">Farma Conecta</span>
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
                    <li class="nav-header">Saitama</li>
                    <li class="nav-item">
                        <a href="../gallery.html" class="nav-link" >
                            <i class="nav-icon fas fa-image"></i>
                            <p>
                                Muy pronto, solo en cine está version
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
                                        <div class="text-center position-relative">
                                            <img id="imagen-perfil" src="<?php echo htmlspecialchars($imagen_perfil); ?>" class="profile-user-img img-fluid rounded-circle" alt="User Image">
                                            <button type="button" class="btn btn-sm btn-success position-absolute cambiar-imagen-btn"
                                                    style="bottom: 0; right: calc(50% - 60px); border-radius: 50%;"
                                                    title="Cambiar imagen">
                                                <i class="fas fa-camera"></i>
                                            </button>
                                        </div>
                                        <input id = "id_usuario" type = "hidden" value = "<?php echo $_SESSION['usuario']; ?>">
                                        <h3 id = "nombre_us" class="profile-username text-center text-success">Nombre</h3>
                                        <p id = "apellidos_us" class="text-muted text-center">Apellidos</p>
                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <a style="color:black">Edad:</a><a id = "edad" class="float-right">18</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b style="color:black">DNI:</b><a id = "dni_us" class="float-right">777</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b style="color:black">Tipo de Usuario:</b>
                                                <span id = "us_tipo" class="float-right" style="background-color:rgb(255, 0, 21); color: white; padding: 4px 8px; border-radius: 4px; font-size: 12px;">Administrador</span>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="card bg-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Sobre mi</h3>
                                        </div>
                                        <div class="card-body" style="color:black;">
                                            <strong><i class="fas fa-phone mr-1" style="color:rgb(11, 11, 11);"></i>Teléfono</strong>
                                            <p id = "telefono_us" class="text-muted">+56 987654321</p>
                                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Residencia</strong>
                                            <p id = "residencia_us" class="text-muted">Calle 123, 123456 Ciudad, Estado</p>
                                            <strong><i class="fas fa-venus-mars mr-1"></i> Sexo</strong>
                                            <p id = "sexo_us" class="text-muted">Masculino</p>
                                            <strong><i class="fas fa-envelope mr-1"></i> Correo</strong>
                                            <p id = "correo_us" class="text-muted">correo@correo.com</p>
                                            <strong><i class="fas fa-info-circle mr-1"></i> Información Adicional</strong>
                                            <p id = "adicional_us" class="text-muted">Información Adicional</p>
                                            <div class="text-center">
                                                <button class="edit btn btn-primary">Editar</button>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <p class="text-muted">Click en el Botón si desea editar los datos personales.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Panel derecho: Información -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header bg-success">
                                        <h3 class="card-title text-white">Información Personal</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle"></i>
                                            <strong>Instrucciones:</strong> Haz clic en el botón "Editar" del panel izquierdo para modificar tus datos personales.
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-success"><i class="fas fa-phone"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Teléfono</span>
                                                        <span class="info-box-number" id="telefono_display">-</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-info"><i class="fas fa-envelope"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Correo</span>
                                                        <span class="info-box-number" id="correo_display">-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-warning"><i class="fas fa-map-marker-alt"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Residencia</span>
                                                        <span class="info-box-number" id="residencia_display">-</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-danger"><i class="fas fa-venus-mars"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Sexo</span>
                                                        <span class="info-box-number" id="sexo_display">-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal para editar datos -->
                        <div class="modal fade" id="modal-editar" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success">
                                        <h4 class="modal-title text-white">Editar Datos Personales</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form-usuario" class="form form-horizontal" enctype="multipart/form-data">
                                            <!-- Campo para imagen de perfil -->
                                            <div class="form-group row mb-3">
                                                <label class="col-sm-3 col-form-label">Imagen de Perfil</label>
                                                <div class="col-sm-9">
                                                    <div class="text-center mb-3">
                                                        <img id="preview-imagen" src="<?php echo htmlspecialchars($imagen_perfil); ?>" class="img-thumbnail rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" alt="Preview">
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                                                        <small class="form-text text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="form-group row mb-3">
                                                <label for="telefono" class="col-sm-3 col-form-label">Teléfono</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="telefono" placeholder="Teléfono" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label for="residencia" class="col-sm-3 col-form-label">Residencia</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="residencia" placeholder="Residencia" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label for="sexo" class="col-sm-3 col-form-label">Sexo</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="sexo" required>
                                                        <option value="Masculino">Masculino</option>
                                                        <option value="Femenino">Femenino</option>
                                                        <option value="Otro">Otro</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label for="correo" class="col-sm-3 col-form-label">Correo</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="correo" placeholder="Correo" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3">
                                                <label for="adicional" class="col-sm-3 col-form-label">Información Adicional</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" id="adicional" rows="3" placeholder="Información adicional..."></textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" form="form-usuario" class="btn btn-success">
                                            <i class="fas fa-save"></i> Guardar
                                        </button>
                                        <button type="button" id="cancelar" class="btn btn-danger">
                                            <i class="fas fa-times"></i> Cancelar
                                        </button>
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
<script src="../js/usuario.js"></script>



