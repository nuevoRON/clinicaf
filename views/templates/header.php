<?php
// Redireccionar si no se tiene una sesión
if (empty($_SESSION['id_usuario'])) {
	// Redirige al usuario a la página de inicio de sesión
	header('Location: ' . BASE_URL);
	exit(); // Termina la ejecución del script
} else if ($_SESSION['estado'] == 1) {
	// Redirige al usuario a la página de configurar preguntas
	header('Location: ' . BASE_URL . 'usuarios/confPreguntas');
	exit(); // Termina la ejecución del script
} else if ($_SESSION['esEmpleado'] == true) {
	header('Location: ' . BASE_URL . 'usuarios/homeCandidatos');
	exit(); // Termina la ejecución del script
}

// Cerrar sesión
if (isset($_GET['cerrar_sesion']) && $_GET['cerrar_sesion'] == 1) {
	// Borra todas las variables de sesión
	session_unset();

	// Destruye la sesión
	session_destroy();

	header('Location: ' . BASE_URL);
	exit(); // Termina la ejecución del script
}
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="<?php echo BASE_URL; ?>assets/images/logo lgb.png" type="image/png" />
	<link href="<?php echo BASE_URL; ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="<?php echo BASE_URL; ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="<?php echo BASE_URL; ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="<?php echo BASE_URL; ?>assets/css/pace.min.css" rel="stylesheet" />
	<script src="<?php echo BASE_URL; ?>assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/app.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>assets/css/icons.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/dark-theme.css" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/semi-dark.css" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/header-colors.css" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/DataTables/datatables.min.css" />
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<script defer src="<?php echo BASE_URL; ?>assets/DataTables/pdfmake-0.2.7/vfs_fonts.js"></script>
	<script defer src="<?php echo BASE_URL; ?>assets/DataTables/pdfmake-0.2.7/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js"></script>

	<title><?php echo TITLE . ' - ' . $data['title']; ?></title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="<?php echo BASE_URL; ?>assets/images/logo lgb.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text text-dark" style="font-size: small; color: dark;">Recursos Humanos</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="<?php echo BASE_URL . 'admin'; ?>">
						<div class="parent-icon"><i class='fas fa-home'></i>
						</div>
						<div class="menu-title">DASHBOARD</div>
					</a>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="fa-solid fa-user"></i>
						</div>
						<div class="menu-title">Administración</div>
					</a>
					<ul>
						<li> <a href="<?php echo BASE_URL . 'usuarios'; ?>"><i class="bx bx-right-arrow-alt"></i>Usuarios</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/bitacora'; ?>"><i class="bx bx-right-arrow-alt"></i>Bitácora</a>
						</li>
						<!--<li> <a href="<?php echo BASE_URL . 'admin/roles'; ?>"><i class="bx bx-right-arrow-alt"></i>Roles</a>
						</li>-->
						<li> <a href="<?php echo BASE_URL . 'roles'; ?>"><i class="bx bx-right-arrow-alt"></i>Roles</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'roles/permisos'; ?>"><i class="bx bx-right-arrow-alt"></i>Permisos</a>
						</li>
						<!--<li> <a href="<?php echo BASE_URL . 'admin/permisos'; ?>"><i class="bx bx-right-arrow-alt"></i>Permisos</a>
						</li>-->
						<li> <a href="<?php echo BASE_URL . 'admin/respaldar'; ?>"><i class="bx bx-right-arrow-alt"></i>Respaldo/Restauración BD</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/parametros'; ?>"><i class="bx bx-right-arrow-alt"></i>Parámetros</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="fa-solid fa-screwdriver-wrench"></i>
						</div>
						<div class="menu-title">Mantenimiento</div>
					</a>
					<ul>
						<li> <a href="<?php echo BASE_URL . 'admin/areas'; ?>"><i class="bx bx-right-arrow-alt"></i>Áreas</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/departamentos'; ?>"><i class="bx bx-right-arrow-alt"></i>Departamentos</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/municipios'; ?>"><i class="bx bx-right-arrow-alt"></i>Municipio</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/estadoCivil'; ?>"><i class="bx bx-right-arrow-alt"></i>Estado Civil</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/sexo'; ?>"><i class="bx bx-right-arrow-alt"></i>Sexo</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/estudios'; ?>"><i class="bx bx-right-arrow-alt"></i>Tipo de Estudio</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="fa-solid fa-receipt"></i>
						</div>
						<div class="menu-title">Procesos</div>
					</a>
					<ul>
						<li> <a href="<?php echo BASE_URL . 'admin/plazas'; ?>"><i class="bx bx-right-arrow-alt"></i>Plazas</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/postulantes'; ?>"><i class="bx bx-right-arrow-alt"></i>Postulantes</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/tipoPostulaciones'; ?>"><i class="bx bx-right-arrow-alt"></i>Estado de Postulaciones</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/candidatosRechazados'; ?>"><i class="bx bx-right-arrow-alt"></i>Candidatos Rechazados</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="fa-solid fa-users"></i>
						</div>
						<div class="menu-title">Empleados</div>
					</a>
					<ul>
						<li> <a href="<?php echo BASE_URL . 'admin/empleados'; ?>"><i class="bx bx-right-arrow-alt"></i>Empleado</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/faltasEmpleados'; ?>"><i class="bx bx-right-arrow-alt"></i>Faltas y Sanciones</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/liquidacion'; ?>"><i class="bx bx-right-arrow-alt"></i>Liquidación</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/empleadosInactivos'; ?>"><i class="bx bx-right-arrow-alt"></i>Empleado Inactivo</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/puestos'; ?>"><i class="bx bx-right-arrow-alt"></i>Puestos</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/tiposFaltas'; ?>"><i class="bx bx-right-arrow-alt"></i>Tipos de Falta</a>
						</li>
						<li> <a href="<?php echo BASE_URL . 'admin/evidenciaFaltas'; ?>"><i class="bx bx-right-arrow-alt"></i>Evidencia de Faltas y Sanciones</a>
						</li>
					</ul>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar flex-grow-1">
						<div class="position-relative">
							<h6><?php echo TITLE; ?></h6>
						</div>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="<?php echo BASE_URL; ?>assets/images/avatars/perfil-lgb.png" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0 " style="text-align: font-size: small;" ><?php echo $_SESSION['nombre_usuario']; ?></p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="<?php echo BASE_URL . 'usuarios/perfil' ?>"><i class="bx bx-user"></i><span>Perfil</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li><a class="dropdown-item" href="?cerrar_sesion=1"><i class='bx bx-log-out-circle'></i><span>Cerrar Sesión</span></a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">